<?php
/* Smarty version 3.1.39, created on 2024-01-04 03:47:31
  from 'C:\wamp64\www\Innca\layouts\v7\modules\Vtiger\PopupNavigation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65962a53afacf8_51547101',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90650086c6ae6d78ee89ebd91b4bd0e626124ab4' => 
    array (
      0 => 'C:\\wamp64\\www\\Innca\\layouts\\v7\\modules\\Vtiger\\PopupNavigation.tpl',
      1 => 1702454222,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65962a53afacf8_51547101 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-md-2"><?php if ($_smarty_tpl->tpl_vars['MULTI_SELECT']->value) {
if (!empty($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value)) {?><button class="select btn btn-default" disabled="disabled"><strong><?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><?php }
} else { ?>&nbsp;<?php }?></div><div class="col-md-10"><?php $_smarty_tpl->_assignInScope('RECORD_COUNT', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value);
$_smarty_tpl->_subTemplateRender(vtemplate_path("Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('SHOWPAGEJUMP'=>true), 0, true);
?></div><?php }
}
