<?php
/* Smarty version 3.1.39, created on 2024-03-13 11:18:32
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\Events\uitypes\MultireferenceDetailView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65f18b8808c6a3_63228799',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05421c11b2acac5b7a2708455f2a44e3880bdc61' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\Events\\uitypes\\MultireferenceDetailView.tpl',
      1 => 1702537022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65f18b8808c6a3_63228799 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_CONTACTS']->value, 'CONTACT_INFO');
$_smarty_tpl->tpl_vars['CONTACT_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CONTACT_INFO']->value) {
$_smarty_tpl->tpl_vars['CONTACT_INFO']->do_else = false;
?><a href='<?php echo $_smarty_tpl->tpl_vars['CONTACT_INFO']->value['_model']->getDetailViewUrl();?>
' title='<?php echo vtranslate("Contacts","Contacts");?>
'> <?php echo Vtiger_Util_Helper::getRecordName($_smarty_tpl->tpl_vars['CONTACT_INFO']->value['id']);?>
</a><br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
