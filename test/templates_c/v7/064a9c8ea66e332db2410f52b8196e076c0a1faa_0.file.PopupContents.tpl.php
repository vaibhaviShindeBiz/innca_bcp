<?php
/* Smarty version 3.1.39, created on 2024-01-04 03:47:31
  from 'C:\wamp64\www\Innca\layouts\v7\modules\Inventory\PopupContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65962a5396f5c9_89908209',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '064a9c8ea66e332db2410f52b8196e076c0a1faa' => 
    array (
      0 => 'C:\\wamp64\\www\\Innca\\layouts\\v7\\modules\\Inventory\\PopupContents.tpl',
      1 => 1702454222,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65962a5396f5c9_89908209 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(vtemplate_path("PicklistColorMap.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?><div class="row"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path('PopupNavigation.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div><div id='popupContentsDiv'><div class="row"><div class="col-md-12"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path("PopupEntries.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div></div>

<?php }
}
