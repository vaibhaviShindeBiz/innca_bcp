<?php
/* Smarty version 3.1.39, created on 2024-01-16 06:22:24
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Vtiger/dashboards/DashBoardHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65a620a0214a08_25601707',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '691e4cdfd5c7ebd05b5a88314ca8965fe7a7faf6' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Vtiger/dashboards/DashBoardHeader.tpl',
      1 => 1702495622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65a620a0214a08_25601707 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class='dashboardHeading container-fluid'>
	<div class="buttonGroups pull-right">
		<div class="btn-group">
			<?php if (count($_smarty_tpl->tpl_vars['SELECTABLE_WIDGETS']->value) > 0) {?>
				<button class='btn btn-default addButton dropdown-toggle' data-toggle='dropdown'>
					<?php echo vtranslate('LBL_ADD_WIDGET');?>
&nbsp;&nbsp;<i class="caret"></i>
				</button>

				<ul class="dropdown-menu dropdown-menu-right widgetsList pull-right" style="min-width:100%;text-align:left;">
					<?php $_smarty_tpl->_assignInScope('MINILISTWIDGET', '');?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SELECTABLE_WIDGETS']->value, 'WIDGET');
$_smarty_tpl->tpl_vars['WIDGET']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['WIDGET']->value) {
$_smarty_tpl->tpl_vars['WIDGET']->do_else = false;
?>
						<?php if ($_smarty_tpl->tpl_vars['WIDGET']->value->getName() == 'MiniList') {?>
							<?php $_smarty_tpl->_assignInScope('MINILISTWIDGET', $_smarty_tpl->tpl_vars['WIDGET']->value);?> 						<?php } elseif ($_smarty_tpl->tpl_vars['WIDGET']->value->getName() == 'Notebook') {?>
							<?php $_smarty_tpl->_assignInScope('NOTEBOOKWIDGET', $_smarty_tpl->tpl_vars['WIDGET']->value);?> 						<?php } else { ?>
							<li>
								<a onclick="Vtiger_DashBoard_Js.addWidget(this, '<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->getUrl();?>
')" href="javascript:void(0);"
									data-linkid="<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->get('linkid');?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->getName();?>
" data-width="<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->getWidth();?>
" data-height="<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->getHeight();?>
">
									<?php echo vtranslate($_smarty_tpl->tpl_vars['WIDGET']->value->getTitle(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a>
							</li>
						<?php }?>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

					<?php if ($_smarty_tpl->tpl_vars['MINILISTWIDGET']->value && $_smarty_tpl->tpl_vars['MODULE_NAME']->value == 'Home') {?>
						<li class="divider"></li>
						<li>
							<a onclick="Vtiger_DashBoard_Js.addMiniListWidget(this, '<?php echo $_smarty_tpl->tpl_vars['MINILISTWIDGET']->value->getUrl();?>
')" href="javascript:void(0);"
								data-linkid="<?php echo $_smarty_tpl->tpl_vars['MINILISTWIDGET']->value->get('linkid');?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['MINILISTWIDGET']->value->getName();?>
" data-width="<?php echo $_smarty_tpl->tpl_vars['MINILISTWIDGET']->value->getWidth();?>
" data-height="<?php echo $_smarty_tpl->tpl_vars['MINILISTWIDGET']->value->getHeight();?>
">
								<?php echo vtranslate($_smarty_tpl->tpl_vars['MINILISTWIDGET']->value->getTitle(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a>
						</li>
						<li>
							<a onclick="Vtiger_DashBoard_Js.addNoteBookWidget(this, '<?php echo $_smarty_tpl->tpl_vars['NOTEBOOKWIDGET']->value->getUrl();?>
')" href="javascript:void(0);"
								data-linkid="<?php echo $_smarty_tpl->tpl_vars['NOTEBOOKWIDGET']->value->get('linkid');?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['NOTEBOOKWIDGET']->value->getName();?>
" data-width="<?php echo $_smarty_tpl->tpl_vars['NOTEBOOKWIDGET']->value->getWidth();?>
" data-height="<?php echo $_smarty_tpl->tpl_vars['NOTEBOOKWIDGET']->value->getHeight();?>
">
								<?php echo vtranslate($_smarty_tpl->tpl_vars['NOTEBOOKWIDGET']->value->getTitle(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a>
						</li>
					<?php }?>

				</ul>
			<?php } elseif ($_smarty_tpl->tpl_vars['MODULE_PERMISSION']->value) {?>
				<button class='btn btn-default addButton dropdown-toggle' disabled="disabled" data-toggle='dropdown'>
					<strong><?php echo vtranslate('LBL_ADD_WIDGET');?>
</strong> &nbsp;&nbsp;
					<i class="caret"></i>
				</button>
			<?php }?>
		</div>
	</div>
</div>
<?php }
}
