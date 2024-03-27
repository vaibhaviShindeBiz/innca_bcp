<?php
/* Smarty version 3.1.39, created on 2024-03-13 11:18:31
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\Vtiger\uitypes\ReminderDetailView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65f18b87c3c393_93144270',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e5901c8023a516ae0358b1838d9e9c564462b689' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\Vtiger\\uitypes\\ReminderDetailView.tpl',
      1 => 1702537022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65f18b87c3c393_93144270 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('REMINDER_VALUES', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId()));
if ($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value == '') {?>
    <?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['MODULE']->value);?>

<?php } else { ?>
    <?php echo $_smarty_tpl->tpl_vars['REMINDER_VALUES']->value;
echo vtranslate('LBL_BEFORE_EVENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>

<?php }
}
}
