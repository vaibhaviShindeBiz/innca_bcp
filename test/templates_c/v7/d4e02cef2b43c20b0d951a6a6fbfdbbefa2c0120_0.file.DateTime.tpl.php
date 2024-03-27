<?php
/* Smarty version 3.1.39, created on 2024-01-02 05:51:53
  from 'C:\wamp64\www\Innca\layouts\v7\modules\Calendar\uitypes\DateTime.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6593a4798085c9_04306345',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4e02cef2b43c20b0d951a6a6fbfdbbefa2c0120' => 
    array (
      0 => 'C:\\wamp64\\www\\Innca\\layouts\\v7\\modules\\Calendar\\uitypes\\DateTime.tpl',
      1 => 1702454222,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6593a4798085c9_04306345 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName() == 'date_start') {
$_smarty_tpl->_assignInScope('DATE_FIELD', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value);
$_smarty_tpl->_assignInScope('MODULE_MODEL', $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getModule());
$_smarty_tpl->_assignInScope('TIME_FIELD', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getField('time_start'));
} elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName() == 'due_date') {
$_smarty_tpl->_assignInScope('DATE_FIELD', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value);
$_smarty_tpl->_assignInScope('TIME_FIELD', false);
}
$_smarty_tpl->_assignInScope('DATE_TIME_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));
$_smarty_tpl->_assignInScope('DATE_TIME_COMPONENTS', explode(' ',$_smarty_tpl->tpl_vars['DATE_TIME_VALUE']->value));
if (!empty($_smarty_tpl->tpl_vars['TIME_FIELD']->value)) {
$_smarty_tpl->_assignInScope('TIME_FIELD', $_smarty_tpl->tpl_vars['TIME_FIELD']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['DATE_TIME_COMPONENTS']->value[1]));
}
if ($_smarty_tpl->tpl_vars['TIME_FIELD']->value) {
$_smarty_tpl->_assignInScope('DATE_TIME_CONVERTED_VALUE', DateTimeField::convertToUserTimeZone($_smarty_tpl->tpl_vars['DATE_TIME_VALUE']->value)->format('Y-m-d H:i:s'));
$_smarty_tpl->_assignInScope('DATE_TIME_COMPONENTS', explode(' ',$_smarty_tpl->tpl_vars['DATE_TIME_CONVERTED_VALUE']->value));
$_smarty_tpl->_assignInScope('DATE_FIELD', $_smarty_tpl->tpl_vars['DATE_FIELD']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['DATE_TIME_COMPONENTS']->value[0]));
}?><div><?php $_smarty_tpl->_subTemplateRender(vtemplate_path('uitypes/Date.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'FIELD_MODEL'=>$_smarty_tpl->tpl_vars['DATE_FIELD']->value), 0, true);
?></div><?php if (!empty($_smarty_tpl->tpl_vars['TIME_FIELD']->value)) {?><div><?php $_smarty_tpl->_subTemplateRender(vtemplate_path('uitypes/Time.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'FIELD_MODEL'=>$_smarty_tpl->tpl_vars['TIME_FIELD']->value,'FIELD_NAME'=>$_smarty_tpl->tpl_vars['TIME_FIELD']->value->getFieldName()), 0, true);
?></div><?php }
}
}
