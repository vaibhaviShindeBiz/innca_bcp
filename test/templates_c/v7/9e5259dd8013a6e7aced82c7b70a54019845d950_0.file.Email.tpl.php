<?php
/* Smarty version 3.1.39, created on 2024-03-11 11:17:19
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\Vtiger\uitypes\Email.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65eee83f6390d8_59302134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9e5259dd8013a6e7aced82c7b70a54019845d950' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\Vtiger\\uitypes\\Email.tpl',
      1 => 1702537022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65eee83f6390d8_59302134 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());
if ((!$_smarty_tpl->tpl_vars['FIELD_NAME']->value)) {
$_smarty_tpl->_assignInScope('FIELD_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());
}?><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" class="inputElement" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" type="text"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" <?php if ($_smarty_tpl->tpl_vars['MODE']->value == 'edit' && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '106') {?> readonly <?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)) {?>data-validator="<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
"<?php }
if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"] == true) {?> data-rule-required="true" <?php }?> data-rule-email="true" data-rule-illegal="true"<?php if (php7_count($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator'])) {?>data-specific-rules='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"]);?>
'<?php }?>/>
<?php }
}
