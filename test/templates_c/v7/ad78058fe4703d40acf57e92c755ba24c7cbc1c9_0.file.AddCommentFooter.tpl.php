<?php
/* Smarty version 3.1.39, created on 2024-01-17 07:05:59
  from 'C:\xampp\htdocs\Innca\layouts\v7\modules\Vtiger\AddCommentFooter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65a77c57e02f39_35313764',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad78058fe4703d40acf57e92c755ba24c7cbc1c9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Innca\\layouts\\v7\\modules\\Vtiger\\AddCommentFooter.tpl',
      1 => 1702495622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65a77c57e02f39_35313764 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-footer"><div class="row-fluid"><div class="col-xs-6"><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getProfileReadWritePermission()) {
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?></div><div class="col-xs-6"><div><div class="pull-right cancelLinkContainer" style="margin-top:0px;"><a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><button class="btn btn-success" type="submit" name="saveButton"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div></div></div></div><?php }
}
