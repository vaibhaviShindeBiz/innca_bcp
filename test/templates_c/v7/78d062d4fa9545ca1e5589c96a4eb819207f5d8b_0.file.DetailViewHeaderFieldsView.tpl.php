<?php
/* Smarty version 3.1.39, created on 2023-12-29 10:31:36
  from 'C:\wamp64\www\Innca\layouts\v7\modules\Vtiger\DetailViewHeaderFieldsView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_658ea008c8d4b7_87678395',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '78d062d4fa9545ca1e5589c96a4eb819207f5d8b' => 
    array (
      0 => 'C:\\wamp64\\www\\Innca\\layouts\\v7\\modules\\Vtiger\\DetailViewHeaderFieldsView.tpl',
      1 => 1702454222,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_658ea008c8d4b7_87678395 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form id="headerForm" method="POST"><?php $_smarty_tpl->_assignInScope('FIELDS_MODELS_LIST', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getFields());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS_MODELS_LIST']->value, 'FIELD_MODEL');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('FIELD_DATA_TYPE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType());
ob_start();
echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();
$_prefixVariable5 = ob_get_clean();
$_smarty_tpl->_assignInScope('FIELD_NAME', $_prefixVariable5);
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderField() && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isActiveField() && $_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value) && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isViewable()) {
ob_start();
echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;
$_prefixVariable6 = ob_get_clean();
$_smarty_tpl->_assignInScope('FIELD_MODEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['RECORD']->value->get($_prefixVariable6)));?><div class="info-row row headerAjaxEdit td"><div class="col-lg-7 fieldLabel"><?php $_smarty_tpl->_assignInScope('DISPLAY_VALUE', ((string)$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value))));?><span class="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
 value" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <?php echo strip_tags($_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value);?>
"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getDetailViewTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value,'RECORD'=>$_smarty_tpl->tpl_vars['RECORD']->value), 0, true);
?></span><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEditable() == 'true' && $_smarty_tpl->tpl_vars['LIST_PREVIEW']->value != 'true' && $_smarty_tpl->tpl_vars['IS_AJAX_ENABLED']->value == 'true') {?><span class="hide edit"><?php if ($_smarty_tpl->tpl_vars['FIELD_DATA_TYPE']->value == 'multipicklist') {?><input type="hidden" class="fieldBasicData" data-name='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
[]' data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType();?>
" data-displayvalue='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')));?>
' data-value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" /><?php } else { ?><input type="hidden" class="fieldBasicData" data-name='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
' data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType();?>
" data-displayvalue='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')));?>
' data-value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" /><?php }?></span><span class="action"><a href="#" onclick="return false;" class="editAction fa fa-pencil"></a></span><?php }?></div></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></form><?php }
}
