<?php
/* Smarty version 3.1.39, created on 2024-03-25 07:32:09
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\Potentials\ConvertPotential.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_660128790e3fa4_69473989',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5c2f6974d05bcc6753176c54c854449703dfb61' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\Potentials\\ConvertPotential.tpl',
      1 => 1710403179,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_660128790e3fa4_69473989 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-dialog"><div id="convertPotentialContainer" class='modelContainer modal-content'><?php $_smarty_tpl->_assignInScope('PROJECT_MODULE_MODEL', Vtiger_Module_Model::getInstance('Project'));
if (!$_smarty_tpl->tpl_vars['CONVERT_POTENTIAL_FIELDS']->value['Project']) {?><input type="hidden" id="convertPotentialErrorTitle" value="<?php echo vtranslate('LBL_CONVERT_ERROR_TITLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/><input id="converPotentialtError" class="convertPotentialError" type="hidden" value="<?php echo vtranslate('LBL_CONVERT_POTENTIALS_ERROR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/><?php } else {
ob_start();
echo vtranslate('LBL_CONVERT_POTENTIAL',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', (($_prefixVariable1).(" ")).($_prefixVariable2));
$_smarty_tpl->_subTemplateRender(vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><form class="form-horizontal" id="convertPotentialForm" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"/><input type="hidden" name="view" value="SaveConvertPotential"/><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
"/><input type="hidden" name="modules" value=''/><div class="modal-body accordion container-fluid" id="potentialAccordion"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CONVERT_POTENTIAL_FIELDS']->value, 'MODULE_FIELD_MODEL', false, 'MODULE_NAME');
$_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_NAME']->value => $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->do_else = false;
?><div class="row"><div class="col-lg-1"></div><div class="col-lg-10 moduleContent" style="border:1px solid #CCC;"><div class="accordion-group convertPotentialModules"><div class="header accordion-heading"><div data-parent="#potentialAccordion" data-toggle="collapse" class="accordion-toggle moduleSelection" href="#<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_FieldInfo"><h5><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
Module" class="convertPotentialModuleSelection alignBottom" data-module="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" type="checkbox" <?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == 'Project') {?> checked="" <?php }?>/><?php $_smarty_tpl->_assignInScope('SINGLE_MODULE_NAME', "SINGLE_".((string)$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>&nbsp;&nbsp;&nbsp;<?php echo vtranslate('LBL_CREATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h5></div></div><div id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_FieldInfo" class="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_FieldInfo accordion-body collapse fieldInfo <?php if ($_smarty_tpl->tpl_vars['CONVERT_POTENTIAL_FIELDS']->value['Project'] && $_smarty_tpl->tpl_vars['MODULE_NAME']->value == "Project") {?> in <?php }?>"><hr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->value, 'FIELD_MODEL');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
?><div class="row"><div class="fieldLabel col-lg-4"><label class='muted pull-right'><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory() == true) {?> <span class="redColor">*</span> <?php }?></label></div><div class="fieldValue col-lg-8"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName()), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div><br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div><div class="col-lg-1"></div></div><br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="defaultFields"><div class="row"><div class="col-lg-1"></div><div class="col-lg-10" style="border:1px solid #CCC;"><div style="margin-top:20px;margin-bottom: 20px;"><div class="row"><?php $_smarty_tpl->_assignInScope('FIELD_MODEL', $_smarty_tpl->tpl_vars['ASSIGN_TO']->value);?><div class="fieldLabel col-lg-4"><label class='muted pull-right'><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;<span class="redColor">*</span></label></div><div class="fieldValue col-lg-8"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div></div></div><div class="col-lg-1"></div></div></div></div><?php $_smarty_tpl->_subTemplateRender(vtemplate_path('ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></form><?php }?></div></div><?php }
}
