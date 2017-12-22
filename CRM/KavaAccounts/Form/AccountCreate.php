<?php

/**
 * Class CRM_KavaAccounts_Form_AccountCreate.
 * Form to create a new Drupal / CAS user account.
 *
 * @author Kevin Levie <kevin.levie@civicoop.org>
 * @package be.kava.accounts
 * @license AGPL-3.0
 */
class CRM_KavaAccounts_Form_AccountCreate extends CRM_Core_Form {

  /**
   * Add form fields.
   */
  public function buildQuickForm() {

    $this->add('hidden', 'cid', 'Contact ID', [], TRUE);

    $this->addButtons([
      [
        'type'      => 'submit',
        'name'      => ts('Account aanmaken'),
        'isDefault' => TRUE,
      ],
    ]);

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }


  /**
   * Set default values.
   * @return array Defaults
   * @throws \Exception
   */
  public function setDefaultValues() {
    $defaults = parent::setDefaultValues();

    $cid = CRM_Utils_Request::retrieve('cid', 'Positive', $this, FALSE, NULL, 'GET');
    $defaults['cid'] = $cid;

    if (!isset($cid)) {
      throw new CRM_KavaAccounts_Exception('Cannot load AccountCreate form: cid parameter not set.');
    }

    $contact = CRM_Contact_BAO_Contact::getContactDetails($cid);
    $this->assign('cid', $cid);
    $this->assign('contact', $contact);

    return $defaults;
  }

  /**
   * Process form.
   * Calls functions from the 'kavalogin' Drupal module to create an account.
   */
  public function postProcess() {
    $values = $this->exportValues();

    $contact = civicrm_api3('Contact', 'getsingle', [
      'id'     => $values['cid'],
      'return' => 'email,first_name,last_name,street_name,street_number,postal_code,city,phone,contact_type,contact_sub_type',
    ]);

    if (!class_exists('KAVALogin_AccountAPI') || !class_exists('KAVALogin_CiviCRM')) {
      throw new CRM_KavaAccounts_Exception('Cannot create account: KAVA login Drupal module not available.');
    }

    $kaccapi = KAVALogin_AccountAPI::getInstance();
    $kcivicrm = KAVALogin_CiviCRM::getInstance();

    // Create user
    $contactSubType = is_array($contact['contact_sub_type']) ? array_shift($contact['contact_sub_type']) : 'none';
    $result = $kaccapi->callAccountAPI($contact['email'], $contact['first_name'], $contact['last_name'], $contact['street_name'], $contact['street_number'], $contact['postal_code'], $contact['city'], $contact['phone'], $contactSubType);

    if (!$result || !isset($result->user) || !isset($result->user->login)) {
      CRM_Core_Session::setStatus('Er is een fout opgetreden bij het aanroepen van de account API. Zie het Drupal-log voor details.', 'KAVA User Accounts');
      return FALSE;
    }

    // Update contact
    $username = isset($result->user->login->login) ? $result->user->login->login : NULL;
    if (!$kcivicrm->addUpdateContact([
      'contact_id' => $contact['id'],
      'barcode'    => isset($result->user->barcode) ? $result->user->barcode : NULL,
      'username'   => $username,
    ])) {
      CRM_Core_Session::setStatus('Er is een fout opgetreden bij het updaten van het CiviCRM-contact. Zie het Drupal-log voor details.', 'KAVA User Accounts');
      return FALSE;
    }

    // Create Drupal user
    $drupalUser = $kcivicrm->addDrupalUser([
      'username' => $result->user->login->login,
      'email'    => $contact['email'],
    ]);
    if (!$drupalUser) {
      CRM_Core_Session::setStatus('Er is een fout opgetreden bij het aanmaken van een Drupal-account. Zie het Drupal-log voor details.', 'KAVA User Accounts');
      return FALSE;
    }

    // Add UFMatch
    if (!$kcivicrm->addUFMatch($drupalUser->uid, $contact['id'], $result->user->login->login)) {
      CRM_Core_Session::setStatus('Er is een fout opgetreden bij het aanmaken van een UFMatch-record. Zie het Drupal-log voor details.', 'KAVA User Accounts');
      return FALSE;
    }

    // Redirect to contact page
    CRM_Core_Session::setStatus('Account aangemaakt met gebruikersnaam: ' . $username . '.', 'KAVA User Accounts', 'success');
    CRM_Utils_System::redirect(CRM_Utils_System::url('civicrm/contact/view', 'reset=1&cid=' . $contact['id']));
  }

  /**
   * Get the fields/elements defined in this form.
   * @return array (string)
   *
   * @internal
   */
  public function getRenderableElementNames() {
    $elementNames = [];
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

}
