{capture assign="kava_link_accounts"}{strip}
  <li class="crm-contact-kava-accounts">
    <a href="{crmURL p='civicrm/kava/account/create' q="cid=`$contactId`"}" class="link-account-create">
      <span><div class="icon ui-icon-person"></div>{ts}Account aanmaken{/ts}</span>
    </a>
  </li>
{/strip}{/capture}

<script type="text/javascript">
  {literal}
  cj(function() {
      cj('.crm-contact-actions-list-inner li.crm-contact-user-record').replaceWith('{/literal}{$kava_link_accounts}{literal}');
  });
  {/literal}
</script>