<?php
/* Smarty version 3.1.39, created on 2024-03-13 05:30:01
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\Vtiger\partials\RelatedListHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65f139d9106304_24523103',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd295d52f11486a6793562dafe7ff79a09d894225' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\Vtiger\\partials\\RelatedListHeader.tpl',
      1 => 1703138282,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65f139d9106304_24523103 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="relatedHeader"><div class="btn-toolbar row"><div class="col-lg-6 col-md-6 col-sm-6 btn-toolbar"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value['LISTVIEWBASIC'], 'RELATED_LINK');
$_smarty_tpl->tpl_vars['RELATED_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_LINK']->value) {
$_smarty_tpl->tpl_vars['RELATED_LINK']->do_else = false;
?><div class="btn-group"><?php $_smarty_tpl->_assignInScope('DROPDOWNS', $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkdropdowns'));
if (!empty($_smarty_tpl->tpl_vars['DROPDOWNS']->value) && (php7_count($_smarty_tpl->tpl_vars['DROPDOWNS']->value) > 0)) {?><a class="btn dropdown-toggle" href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200" data-close-others="false" style="width:20px;height:18px;"><img title="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
" alt="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
" src="<?php echo vimage_path(((string)$_smarty_tpl->tpl_vars['RELATED_LINK']->value->getIcon()));?>
"></a><ul class="dropdown-menu"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DROPDOWNS']->value, 'DROPDOWN');
$_smarty_tpl->tpl_vars['DROPDOWN']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DROPDOWN']->value) {
$_smarty_tpl->tpl_vars['DROPDOWN']->do_else = false;
?><li><a id="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
_relatedlistView_add_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['DROPDOWN']->value['label']);?>
" class="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkclass');?>
" href='javascript:void(0)' data-documentType="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['type'];?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['url'];?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" data-firsttime="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['firsttime'];?>
"><i class="icon-plus"></i>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['DROPDOWN']->value['label'],$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul><?php } else {
ob_start();
echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_selectRelation');
$_prefixVariable7 = ob_get_clean();
$_smarty_tpl->_assignInScope('IS_SELECT_BUTTON', $_prefixVariable7);
ob_start();
echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linklabel');
$_prefixVariable8 = ob_get_clean();
$_smarty_tpl->_assignInScope('LINK_LABEL', $_prefixVariable8);
if ($_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_linklabel') === '_add_event') {
$_smarty_tpl->_assignInScope('RELATED_MODULE_NAME', 'Events');
} elseif ($_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_linklabel') === '_add_task') {
$_smarty_tpl->_assignInScope('RELATED_MODULE_NAME', 'Calendar');
}
if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value || $_smarty_tpl->tpl_vars['IS_CREATE_PERMITTED']->value) {?><!--<?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'Payment' && $_smarty_tpl->tpl_vars['TOTAL']->value <= $_smarty_tpl->tpl_vars['TOTALRECEIVED']->value) {?> hide <?php }?>--><button type="button" module="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" class=" btn btn-default<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value == true) {?> selectRelation<?php } else { ?> addButton" name="addButton<?php }?>"<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value == true) {?> data-moduleName="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_module')->get('name');?>
" <?php }
if (($_smarty_tpl->tpl_vars['RELATED_LINK']->value->isPageLoadLink())) {
if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value) {?> data-name="<?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD']->value->getName();?>
" <?php }?>data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();
if ($_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value) {?>&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;
}?>"<?php }?>><?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value == false) {?><i class="fa fa-plus"></i>&nbsp;<?php }?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
</button><?php }
}?></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>&nbsp;</div><?php $_smarty_tpl->_assignInScope('CLASS_VIEW_ACTION', 'relatedViewActions');
$_smarty_tpl->_assignInScope('CLASS_VIEW_PAGING_INPUT', 'relatedViewPagingInput');
$_smarty_tpl->_assignInScope('CLASS_VIEW_PAGING_INPUT_SUBMIT', 'relatedViewPagingInputSubmit');
$_smarty_tpl->_assignInScope('CLASS_VIEW_BASIC_ACTION', 'relatedViewBasicAction');
$_smarty_tpl->_assignInScope('PAGING_MODEL', $_smarty_tpl->tpl_vars['PAGING']->value);
$_smarty_tpl->_assignInScope('RECORD_COUNT', count($_smarty_tpl->tpl_vars['RELATED_RECORDS']->value));
$_smarty_tpl->_assignInScope('PAGE_NUMBER', $_smarty_tpl->tpl_vars['PAGING']->value->get('page'));
$_smarty_tpl->_subTemplateRender(vtemplate_path("Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('SHOWPAGEJUMP'=>true), 0, true);
?></div></div><?php }
}
