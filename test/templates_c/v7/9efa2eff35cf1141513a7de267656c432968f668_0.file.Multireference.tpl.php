<?php
/* Smarty version 3.1.39, created on 2024-03-13 06:06:44
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\Events\uitypes\Multireference.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65f14274a8d3e7_30192195',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9efa2eff35cf1141513a7de267656c432968f668' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\Events\\uitypes\\Multireference.tpl',
      1 => 1702537022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65f14274a8d3e7_30192195 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_assignInScope('FIELD_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'));
$_smarty_tpl->_assignInScope('REFERENCE_LIST', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getReferenceList());
$_smarty_tpl->_assignInScope('REFERENCE_LIST_COUNT', php7_count($_smarty_tpl->tpl_vars['REFERENCE_LIST']->value));
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());?><div class="referencefield-wrapper"><?php ob_start();
echo $_smarty_tpl->tpl_vars['REFERENCE_LIST_COUNT']->value;
$_prefixVariable2 = ob_get_clean();
if ($_prefixVariable2 == 1) {?><input name="popupReferenceModule" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['REFERENCE_LIST']->value[0];?>
" /><?php }
ob_start();
echo $_smarty_tpl->tpl_vars['REFERENCE_LIST_COUNT']->value;
$_prefixVariable3 = ob_get_clean();
if ($_prefixVariable3 > 1) {
$_smarty_tpl->_assignInScope('DISPLAYID', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));
$_smarty_tpl->_assignInScope('REFERENCED_MODULE_STRUCT', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getReferenceModule($_smarty_tpl->tpl_vars['DISPLAYID']->value));
if (!empty($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value)) {
$_smarty_tpl->_assignInScope('REFERENCED_MODULE_NAME', $_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value->get('name'));
}
if (in_array($_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['REFERENCE_LIST']->value)) {?><input name="popupReferenceModule" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value;?>
" /><?php } else { ?><input name="popupReferenceModule" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['REFERENCE_LIST']->value[0];?>
" /><?php }
}?><input name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" class="sourceField" data-displayvalue='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
' data-fieldinfo='<?php echo $_smarty_tpl->tpl_vars['FIELD_INFO']->value;?>
' data-multiple='true'/><div class="input-group"><input id="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
_display" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
_display" data-fieldname="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" data-fieldtype="reference" type="text"class="marginLeftZero autoComplete inputElement"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['displayId']->value);?>
"data-fieldinfo='<?php echo $_smarty_tpl->tpl_vars['FIELD_INFO']->value;?>
' data-fieldtype="multireference" placeholder="<?php echo vtranslate('LBL_TYPE_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"] == true) {?> data-rule-required="true" <?php }?>/><span class="input-group-addon relatedPopup cursorPointer" title="<?php echo vtranslate('LBL_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" style="height:auto;width: 30px;"><i id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
_select" class="fa fa-search"></i></span><input type="hidden" name="relatedContactInfo" data-value='<?php echo json_encode($_smarty_tpl->tpl_vars['RELATED_CONTACTS']->value,(defined('JSON_HEX_APOS') ? constant('JSON_HEX_APOS') : null));?>
' /><!-- Show the add button only if it is edit view  --><?php if ($_REQUEST['view'] == 'Edit') {?><span class="input-group-addon createReferenceRecord cursorPointer clearfix" title="<?php echo vtranslate('LBL_CREATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
_create" class="fa fa-plus"></i></span><?php }?></div></div>
<?php }
}
