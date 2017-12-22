<?php

/**
 * Class CRM_KavaAccounts_Utils.
 * Various utility functions.
 *
 * @author Kevin Levie <kevin.levie@civicoop.org>
 * @package be.kava.accounts
 * @license AGPL-3.0
 */
class CRM_KavaAccounts_Utils {

  /**
   * Adds a link to the account creation form to the contact summary page,
   * if the contact isn't linked to a Drupal account yet.
   * @param CRM_Core_Page $page
   */
  public static function addLinkToPage(&$page) {
    if ($page instanceof CRM_Contact_Page_View_Summary) {
      $contactId = $page->getVar('_contactId');
      $contactType = $page->get('contactType');

      if (is_string($contactType) && $contactType === 'Individual' && !static::hasUFAccount($contactId)) {
        CRM_Core_Region::instance('page-body')->add([
          'template' => 'CRM/KavaAccounts/Page/View/Summary/link_accounts.tpl',
        ]);
      }
    }
  }

  /**
   * Check if a contact has a UF account.
   * @param int $contact_id Contact ID
   * @return bool
   */
  public static function hasUFAccount($contact_id) {
    try {
      $data = civicrm_api3('UFMatch', 'getcount', [
        'contact_id' => $contact_id,
      ]);

      if (!isset($data['is_error']) && $data === 0) {
        return FALSE;
      }

      return TRUE;
    } catch (\CiviCRM_API3_Exception $e) {
      return TRUE;
    }
  }
}
