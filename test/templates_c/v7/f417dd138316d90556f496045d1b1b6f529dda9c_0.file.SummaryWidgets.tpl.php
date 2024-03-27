<?php
/* Smarty version 3.1.39, created on 2024-01-17 06:00:13
  from 'C:\xampp\htdocs\Innca\layouts\v7\modules\Vtiger\SummaryWidgets.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65a76ceded50f0_19633608',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f417dd138316d90556f496045d1b1b6f529dda9c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Innca\\layouts\\v7\\modules\\Vtiger\\SummaryWidgets.tpl',
      1 => 1702495622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65a76ceded50f0_19633608 (Smarty_Internal_Template $_smarty_tpl) {
?>
<input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->get('page');?>
" /><input type="hidden" name="pageLimit" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->get('limit');?>
" /><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value && $_smarty_tpl->tpl_vars['RELATED_RECORDS']->value) {
$_smarty_tpl->_assignInScope('FILENAME', ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value).("SummaryWidgetContents.tpl"));
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FILENAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RELATED_RECORDS'=>$_smarty_tpl->tpl_vars['RELATED_RECORDS']->value), 0, true);
} else { ?><div class="summaryWidgetContainer noContent"><p class="textAlignCenter"><?php echo vtranslate('LBL_NO_RELATED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE']->value;?>
</p></div><?php }
}
}
