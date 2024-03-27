<?php
/* Smarty version 3.1.39, created on 2024-03-19 05:27:52
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\Inventory\DetailViewFullContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65f9225884e687_33671751',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '382962ba9ca3c9613ea19a39180e5a5f2487030e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\Inventory\\DetailViewFullContents.tpl',
      1 => 1710403179,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65f9225884e687_33671751 (Smarty_Internal_Template $_smarty_tpl) {
?><form id="detailView" method="POST">
    <?php $_smarty_tpl->_subTemplateRender(vtemplate_path('DetailViewBlockView.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0, true);
?>
    <?php $_smarty_tpl->_subTemplateRender(vtemplate_path('LineItemsDetail.tpl','Inventory'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</form>
<?php }
}
