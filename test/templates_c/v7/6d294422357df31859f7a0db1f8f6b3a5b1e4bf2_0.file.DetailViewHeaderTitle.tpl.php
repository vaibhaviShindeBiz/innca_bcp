<?php
/* Smarty version 3.1.39, created on 2024-03-15 11:08:44
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\Potentials\DetailViewHeaderTitle.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65f42c3c19ca25_89070488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d294422357df31859f7a0db1f8f6b3a5b1e4bf2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\Potentials\\DetailViewHeaderTitle.tpl',
      1 => 1710500875,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65f42c3c19ca25_89070488 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
    .progress .bar {
        width: 60px !important;
    }
</style>

<div class="col-sm-6 col-lg-6 col-md-6"><div class="record-header clearfix"><div class="recordImage bgpotentials app-<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
"><div class="name"><span><strong><?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getModuleIcon();?>
</strong></span></div></div><div class="recordBasicInfo"><div class="info-row"><h4><span class="recordLabel pushDown" title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></span></h4></div><?php $_smarty_tpl->_subTemplateRender(vtemplate_path("DetailViewHeaderFieldsView.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?><div class="progress " style="margin: -100px -238px 0px 0px"><div class="circle <?php if ($_smarty_tpl->tpl_vars['advancePayment']->value == '1') {?> active <?php }?>"><span class="label">✓</span><span class="title" title="1st follow">Advance Payment</span></div><span class="bar done"></span><div class="circle <?php if ($_smarty_tpl->tpl_vars['quotesReady']->value == '1') {?> active <?php }?>"><span class="label">✓</span><span class="title" title="2nd follow">Quotes Ready</span></div><span class="bar done"></span><div class="circle <?php if ($_smarty_tpl->tpl_vars['siteVisit']->value == '1') {?> active <?php }?>"><span class="label">✓</span><span class="title" title="3rd follow">Site Visit</span></div><span class="bar done"></span><div class="circle <?php if ($_smarty_tpl->tpl_vars['design2d']->value == '1') {?> active <?php }?>"><span class="label">✓</span><span class="title" title="3rd follow">2D design</span></div><span class="bar done"></span><div class="circle <?php if ($_smarty_tpl->tpl_vars['design3d']->value == '1') {?> active <?php }?>"><span class="label">✓</span><span class="title" title="3rd follow">3D design</span></div></div></div></div></div><?php }
}
