<?php
/* Smarty version 3.1.39, created on 2024-03-08 05:02:09
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Settings/ITS4YouInstaller/ExtensionModules.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65ea9bd1095260_85956281',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '018ebc3595a283f2ea0c22711019de2ccc6c704c' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Settings/ITS4YouInstaller/ExtensionModules.tpl',
      1 => 1702537022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ea9bd1095260_85956281 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('IS_AUTH', ($_smarty_tpl->tpl_vars['REGISTRATION_STATUS']->value && $_smarty_tpl->tpl_vars['PASSWORD_STATUS']->value));?><div class="col-lg-12"><br><ul class="nav nav-tabs layoutTabs massEditTabs"><li class="tab-item taxesTab active"><a data-toggle="tab" href="#installedModules"><strong><?php echo vtranslate('LBL_INSTALLED_AND_AVAILABLE_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><?php if (!$_smarty_tpl->tpl_vars['IS_HOSTING_LICENSE']->value) {?><li class="tab-item chargesTab"><a data-toggle="tab" href="#modulesShop"><strong><?php echo vtranslate('LBL_MODULES_SHOP',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><?php }?></ul><br></div><div class="tab-content layoutContent overflowVisible" style="height:100%"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path("InstalledModules.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
if (!$_smarty_tpl->tpl_vars['IS_HOSTING_LICENSE']->value) {
$_smarty_tpl->_subTemplateRender(vtemplate_path("ModulesShop.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?></div><?php }
}
