<?php
/* Smarty version 3.1.39, created on 2024-01-04 10:45:56
  from 'C:\wamp64\www\Innca\layouts\v7\modules\Vtiger\uitypes\SalutationDetailView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65968c6410cc98_25391466',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '638cff06cf39ba19825011c3517db6599fe16447' => 
    array (
      0 => 'C:\\wamp64\\www\\Innca\\layouts\\v7\\modules\\Vtiger\\uitypes\\SalutationDetailView.tpl',
      1 => 1702454222,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65968c6410cc98_25391466 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('salutationtype');?>


<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value);
}
}
