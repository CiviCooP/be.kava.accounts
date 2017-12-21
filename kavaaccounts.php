<?php

require_once 'kavaaccounts.civix.php';


/* -- Custom hook implementations -- */

/**
 * Adds a link to the extension form to the contact summary.
 * Implements hook_civicrm_pageRun().
 * @link https://docs.civicrm.org/dev/en/stable/hooks/hook_civicrm_pageRun/
 */
function kavaaccounts_civicrm_pageRun(&$page) {
  CRM_KavaAccounts_Utils::addLinkToPage($page);
}


/* -- Default Civix hooks follow -- */

/**
 * Implements hook_civicrm_config().
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function kavaaccounts_civicrm_config(&$config) {
  _kavaaccounts_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function kavaaccounts_civicrm_xmlMenu(&$files) {
  _kavaaccounts_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function kavaaccounts_civicrm_install() {
  _kavaaccounts_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function kavaaccounts_civicrm_postInstall() {
  _kavaaccounts_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function kavaaccounts_civicrm_uninstall() {
  _kavaaccounts_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function kavaaccounts_civicrm_enable() {
  _kavaaccounts_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function kavaaccounts_civicrm_disable() {
  _kavaaccounts_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function kavaaccounts_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _kavaaccounts_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function kavaaccounts_civicrm_managed(&$entities) {
  _kavaaccounts_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 * Generate a list of case-types.
 * Note: This hook only runs in CiviCRM 4.4+.
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function kavaaccounts_civicrm_caseTypes(&$caseTypes) {
  _kavaaccounts_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 * Generate a list of Angular modules.
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function kavaaccounts_civicrm_angularModules(&$angularModules) {
  _kavaaccounts_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function kavaaccounts_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _kavaaccounts_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
 * function kavaaccounts_civicrm_preProcess($formName, &$form) {
 * } // */

/**
 * Implements hook_civicrm_navigationMenu().
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
 * function kavaaccounts_civicrm_navigationMenu(&$menu) {
 * _kavaaccounts_civix_insert_navigation_menu($menu, NULL, array(
 * 'label' => ts('The Page', array('domain' => 'be.kava.kavaaccounts')),
 * 'name' => 'the_page',
 * 'url' => 'civicrm/the-page',
 * 'permission' => 'access CiviReport,access CiviContribute',
 * 'operator' => 'OR',
 * 'separator' => 0,
 * ));
 * _kavaaccounts_civix_navigationMenu($menu);
 * } // */
