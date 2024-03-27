<?php
/* Smarty version 3.1.39, created on 2023-12-29 10:31:49
  from 'C:\wamp64\www\Innca\layouts\v7\modules\Vtiger\DetailViewFullContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_658ea015b4cb30_81892147',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96db4b667fc4b13fad900a80f0a0a800650074d8' => 
    array (
      0 => 'C:\\wamp64\\www\\Innca\\layouts\\v7\\modules\\Vtiger\\DetailViewFullContents.tpl',
      1 => 1703844842,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_658ea015b4cb30_81892147 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form id="detailView" method="POST"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path('DetailViewBlockView.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0, true);
?></form>
<?php }
}
