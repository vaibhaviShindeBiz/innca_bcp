<?php
/* Smarty version 3.1.39, created on 2024-03-18 04:57:48
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\Documents\QuickCreate.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65f7c9cc229855_10077266',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '787ab77b7bd9620bd1f9f876e05a1c2e7ecef1f8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\Documents\\QuickCreate.tpl',
      1 => 1710403179,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65f7c9cc229855_10077266 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SCRIPTS']->value, 'jsModel', false, 'index');
$_smarty_tpl->tpl_vars['jsModel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['jsModel']->value) {
$_smarty_tpl->tpl_vars['jsModel']->do_else = false;
echo '<script'; ?>
 type="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getType();?>
" src="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getSrc();?>
"><?php echo '</script'; ?>
><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['FILE_LOCATION_TYPE']->value == 'I') {
$_smarty_tpl->_subTemplateRender(vtemplate_path("UploadDocument.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
} else {
$_smarty_tpl->_subTemplateRender(vtemplate_path("CreateDocument.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value != null) {
echo '<script'; ?>
 type="text/javascript">var quickcreate_uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}}};})();<?php echo '</script'; ?>
><?php }?></div>
<?php }
}
