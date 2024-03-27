<?php
/* Smarty version 3.1.39, created on 2024-01-16 06:22:27
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Vtiger/dashboards/MiniList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65a620a32cd1c1_69217193',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '97a29b6e934ac2d031ae3e0d2aea67d61b6e3468' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Vtiger/dashboards/MiniList.tpl',
      1 => 1702495622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65a620a32cd1c1_69217193 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="dashboardWidgetHeader">
	<?php $_smarty_tpl->_subTemplateRender(vtemplate_path("dashboards/WidgetHeader.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</div>

<div class="dashboardWidgetContent">
	<?php $_smarty_tpl->_subTemplateRender(vtemplate_path("dashboards/MiniListContents.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</div>

<div class="widgeticons dashBoardWidgetFooter">
    <div class="footerIcons pull-right">
        <?php $_smarty_tpl->_subTemplateRender(vtemplate_path("dashboards/DashboardFooterIcons.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    </div>
</div><?php }
}
