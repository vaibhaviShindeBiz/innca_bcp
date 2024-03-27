<?php
/* Smarty version 3.1.39, created on 2024-01-16 06:30:10
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Project/DetailViewHeaderTitle.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65a62272583bb2_18489875',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '813916e67f8b206107f8497e1811932ef62bfb08' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Project/DetailViewHeaderTitle.tpl',
      1 => 1705386607,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65a62272583bb2_18489875 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
    .progress .bar {
        width: 50px !important;
    }

    .progress .circle .title a {
        width: 60px !important;
        display: inline-block;
    }
</style>
<div class="col-lg-6 col-md-6 col-sm-6"><div class="record-header clearfix"><div class="recordImage bgproject app-<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
"><div class="name"><span><strong> <i class="vicon-project"></i> </strong></span></div></div><div class="recordBasicInfo"><div class="info-row"><h4><div class="recordLabel pushDown" title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getNameFields(), 'NAME_FIELD');
$_smarty_tpl->tpl_vars['NAME_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['NAME_FIELD']->value) {
$_smarty_tpl->tpl_vars['NAME_FIELD']->do_else = false;
$_smarty_tpl->_assignInScope('FIELD_MODEL', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getField($_smarty_tpl->tpl_vars['NAME_FIELD']->value));
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPermissions()) {?><span class="<?php echo $_smarty_tpl->tpl_vars['NAME_FIELD']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['NAME_FIELD']->value);?>
</span>&nbsp;<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></h4></div><?php $_smarty_tpl->_subTemplateRender(vtemplate_path("DetailViewHeaderFieldsView.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?><div class="progress " style="margin: -53px -125px 0px 95px;"><div class="circle <?php if ($_smarty_tpl->tpl_vars['PTTASKSTATUS1']->value == 'Completed') {?> active <?php }?>"><span class="label">✓</span><span class="title" title="Discussion and payment received"><a href="index.php?module=ProjectTask&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['PTTASK1']->value;?>
&app=PROJECT" target="_blank">Discussion and payment received</a></span></div><span class="bar done"></span><div class="circle <?php if ($_smarty_tpl->tpl_vars['PTTASKSTATUS2']->value == 'Completed') {?> active <?php }?>"><span class="label">✓</span><span class="title" title="Implementation"><a href="index.php?module=ProjectTask&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['PTTASK2']->value;?>
&app=PROJECT" target="_blank">Implementation</a></span></div><span class="bar done"></span><div class="circle <?php if ($_smarty_tpl->tpl_vars['PTTASKSTATUS3']->value == 'Completed') {?> active <?php }?>"><span class="label">✓</span><span class="title" title="Installation"><a href="index.php?module=ProjectTask&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['PTTASK3']->value;?>
&app=PROJECT" target="_blank">Installation</a></span></div><span class="bar done"></span><div class="circle <?php if ($_smarty_tpl->tpl_vars['PTTASKSTATUS4']->value == 'Completed') {?> active <?php }?>"><span class="label">✓</span><span class="title" title="Site Verification"><a href="index.php?module=ProjectTask&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['PTTASK4']->value;?>
&app=PROJECT" target="_blank">Site Verification</a></span></div><span class="bar done"></span><div class="circle <?php if ($_smarty_tpl->tpl_vars['PTTASKSTATUS5']->value == 'Completed') {?> active <?php }?>"><span class="label">✓</span><span class="title" title="Closure"><a href="index.php?module=ProjectTask&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['PTTASK5']->value;?>
&app=PROJECT" target="_blank">Closure</a></span></div></div></div></div></div><?php }
}
