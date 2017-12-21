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

    $this->addButtons([
      [
        'type' => 'button',
        'name' => ts('Annuleren'),
      ],
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
   * Process form.
   */
  public function postProcess() {
    echo "TODO";
    exit;
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
