<?php
/* Smarty version 3.1.39, created on 2023-12-29 10:32:39
  from 'C:\wamp64\www\Innca\layouts\v7\modules\Vtiger\ProjectMilestoneSummaryWidgetContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_658ea047722551_14582090',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7e87d0696d1249fc98a533b23c089828fc90583' => 
    array (
      0 => 'C:\\wamp64\\www\\Innca\\layouts\\v7\\modules\\Vtiger\\ProjectMilestoneSummaryWidgetContents.tpl',
      1 => 1702454222,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_658ea047722551_14582090 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value, 'HEADER');
$_smarty_tpl->tpl_vars['HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADER']->value) {
$_smarty_tpl->tpl_vars['HEADER']->do_else = false;
if ($_smarty_tpl->tpl_vars['HEADER']->value->get('label') == "Project Milestone Name") {
ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('PROJECTMILESTONE_NAME_HEADER', $_prefixVariable1);
} elseif ($_smarty_tpl->tpl_vars['HEADER']->value->get('label') == "Milestone Date") {
ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('PROJECTMILESTONE_DATE_HEADER', $_prefixVariable2);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="row"><span class="col-lg-8"><strong><?php echo $_smarty_tpl->tpl_vars['PROJECTMILESTONE_NAME_HEADER']->value;?>
</strong></span><span class="col-lg-4"><span class="pull-right"><strong><?php echo $_smarty_tpl->tpl_vars['PROJECTMILESTONE_DATE_HEADER']->value;?>
</strong></span></span></div><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_RECORDS']->value, 'RELATED_RECORD');
$_smarty_tpl->tpl_vars['RELATED_RECORD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_RECORD']->value) {
$_smarty_tpl->tpl_vars['RELATED_RECORD']->do_else = false;
?><div class="recentActivitiesContainer"><ul class="unstyled"><li><div class="row"><span class="col-lg-8 paddingLeft0 textOverflowEllipsis"><a href="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE']->value;?>
_Related_Record_<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('id');?>
" title="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue('projectmilestonename');?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue('projectmilestonename');?>
</a></span><span class="col-lg-4 horizontalLeftSpacingForSummaryWidgetContents"><span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue('projectmilestonedate');?>
</span></span></div></li></ul></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_smarty_tpl->_assignInScope('NUMBER_OF_RECORDS', php7_count($_smarty_tpl->tpl_vars['RELATED_RECORDS']->value));
if ($_smarty_tpl->tpl_vars['NUMBER_OF_RECORDS']->value == 5) {?><div class="row"><div class="pull-right"><a class="moreRecentMilestones cursorPointer"><?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></div></div><?php }
}
}
