<div class="kava-account-create-info">
  <p>{ts}Weet u zeker dat u een nieuw gebruikersaccount voor dit contact wilt aanmaken en de logingegevens naar zijn/haar e-mailadres wilt sturen?{/ts}</p>
</div>

<div class="crm-section" style="margin: 15px 0;">
  <div class="label">{ts}Naam:{/ts}</div>
  <div class="content">{$contact[0]}</div>
  <div class="clear"></div>
</div>

<div class="crm-section" style="margin: 15px 0;">
  <div class="label">{ts}E-mail:{/ts}</div>
  <div class="content">{$contact[1]}</div>
  <div class="clear"></div>
</div>

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>

<div class="crm-section" style="margin: 20px 0;">
  <a href="{crmURL p="civicrm/contact/view" q="reset=1&cid=`$cid`"}">Terug naar contact</a>
</div>