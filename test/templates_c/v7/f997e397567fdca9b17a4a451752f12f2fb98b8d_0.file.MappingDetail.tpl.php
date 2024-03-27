<?php
/* Smarty version 3.1.39, created on 2024-01-23 09:08:49
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Settings/Leads/MappingDetail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65af8221edc310_26656511',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f997e397567fdca9b17a4a451752f12f2fb98b8d' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Settings/Leads/MappingDetail.tpl',
      1 => 1702537022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65af8221edc310_26656511 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="leadsFieldMappingListPageDiv"><div class="col-sm-12 col-xs-12"><div class="row settingsHeader"><span class="col-sm-12"><span class="pull-right"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDetailViewLinks(), 'LINK_MODEL');
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LINK_MODEL']->value) {
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = false;
?><button type="button" class="btn btn-default" onclick=<?php echo $_smarty_tpl->tpl_vars['LINK_MODEL']->value->getUrl();?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['LINK_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></span></span></div><div class="contents table-container" id="detailView"><table id="listview-table" class="table listview-table"><thead><tr><th width="5%"></th><th width="15%"><?php echo vtranslate('LBL_FIELD_LABEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th width="15%"><?php echo vtranslate('LBL_FIELD_TYPE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th colspan="3" width="70%"><?php echo vtranslate('LBL_MAPPING_WITH_OTHER_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr><tr><th width="5%"><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getHeaders(), 'LABEL', false, 'key');
$_smarty_tpl->tpl_vars['LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['LABEL']->value) {
$_smarty_tpl->tpl_vars['LABEL']->do_else = false;
?><th width="15%"><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['LABEL']->value);?>
</th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></thead><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMapping(), 'MAPPING', false, 'MAPPING_ID');
$_smarty_tpl->tpl_vars['MAPPING']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MAPPING_ID']->value => $_smarty_tpl->tpl_vars['MAPPING']->value) {
$_smarty_tpl->tpl_vars['MAPPING']->do_else = false;
?><tr class="listViewEntries" data-cfmid="<?php echo $_smarty_tpl->tpl_vars['MAPPING_ID']->value;?>
"><td width="5%"><?php if ($_smarty_tpl->tpl_vars['MAPPING']->value['editable'] == 1) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMappingLinks(), 'LINK_MODEL');
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LINK_MODEL']->value) {
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = false;
?><div class="table-actions"><span><a onclick=<?php echo $_smarty_tpl->tpl_vars['LINK_MODEL']->value->getUrl();?>
><i title="<?php echo vtranslate($_smarty_tpl->tpl_vars['LINK_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-trash alignMiddle"></i></a></span></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></td><td width="10%"><?php ob_start();
echo $_smarty_tpl->tpl_vars['MAPPING']->value['Leads']['label'];
$_prefixVariable1 = ob_get_clean();
echo vtranslate($_prefixVariable1,'Leads');?>
</td><td width="10%"><?php ob_start();
echo $_smarty_tpl->tpl_vars['MAPPING']->value['Leads']['fieldDataType'];
$_prefixVariable2 = ob_get_clean();
echo vtranslate($_prefixVariable2,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</td><td width="10%"><?php ob_start();
echo $_smarty_tpl->tpl_vars['MAPPING']->value['Accounts']['label'];
$_prefixVariable3 = ob_get_clean();
echo vtranslate($_prefixVariable3,'Accounts');?>
</td><td width="10%"><?php ob_start();
echo $_smarty_tpl->tpl_vars['MAPPING']->value['Contacts']['label'];
$_prefixVariable4 = ob_get_clean();
echo vtranslate($_prefixVariable4,'Contacts');?>
</td><td width="10%"><?php ob_start();
echo $_smarty_tpl->tpl_vars['MAPPING']->value['Potentials']['label'];
$_prefixVariable5 = ob_get_clean();
echo vtranslate($_prefixVariable5,'Potentials');?>
</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div><div id="scroller_wrapper" class="bottom-fixed-scroll"><div id="scroller" class="scroller-div"></div></div></div></div><?php }
}
