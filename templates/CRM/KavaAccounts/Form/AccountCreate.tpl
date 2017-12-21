<div class="kava-account-create-info">
  <p>{ts}Weet u zeker dat u een nieuw gebruikersaccount voor dit contact wilt aanmaken en de logingegevens naar zijn/haar e-mailadres wilt sturen?{/ts}</p>
</div>

{foreach from=$elementNames item=elementName}
  <div class="crm-section" style="margin: 15px 0;">
    <div class="label">{$form.$elementName.label}</div>
    <div class="content">{$form.$elementName.html}</div>
    <div class="clear"></div>
  </div>
{/foreach}

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
