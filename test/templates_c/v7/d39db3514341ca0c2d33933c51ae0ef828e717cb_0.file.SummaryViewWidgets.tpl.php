<?php
/* Smarty version 3.1.39, created on 2024-01-12 11:03:47
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Potentials/SummaryViewWidgets.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65a11c937f12b5_01590359',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd39db3514341ca0c2d33933c51ae0ef828e717cb' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Potentials/SummaryViewWidgets.tpl',
      1 => 1704412666,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65a11c937f12b5_01590359 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEWWIDGET'], 'DETAIL_VIEW_WIDGET');
$_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value) {
$_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->do_else = false;
if (($_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel() == 'Documents')) {
$_smarty_tpl->_assignInScope('DOCUMENT_WIDGET_MODEL', $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value);
} elseif (($_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel() == 'LBL_RELATED_CONTACTS')) {
$_smarty_tpl->_assignInScope('CONTACT_WIDGET_MODEL', $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value);
} elseif (($_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel() == 'LBL_RELATED_PRODUCTS')) {
$_smarty_tpl->_assignInScope('PRODUCT_WIDGET_MODEL', $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value);
} elseif (($_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel() == 'ModComments')) {
$_smarty_tpl->_assignInScope('COMMENTS_WIDGET_MODEL', $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value);
} elseif (($_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel() == 'LBL_UPDATES')) {
$_smarty_tpl->_assignInScope('UPDATES_WIDGET_MODEL', $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="left-block col-lg-4 col-md-4 col-sm-4"><div class="summaryView"><div class="summaryViewHeader"><h4 class="display-inline-block"><?php echo vtranslate('LBL_KEY_FIELDS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4></div><div class="summaryViewFields"><?php echo $_smarty_tpl->tpl_vars['MODULE_SUMMARY']->value;?>
</div></div><?php if ($_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value) {?><div class="summaryWidgetContainer"><div class="widgetContainer_documents" data-url="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value->getUrl();?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value->getLabel();?>
"><div class="widget_header clearfix"><input type="hidden" name="relatedModule" value="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value->get('linkName');?>
" /><span class="toggleButton pull-left"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;</span><h4 class="display-inline-block pull-left"><?php echo vtranslate($_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><?php if ($_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value->get('action')) {
$_smarty_tpl->_assignInScope('PARENT_ID', $_smarty_tpl->tpl_vars['RECORD']->value->getId());?><div class="pull-right"><div class="dropdown"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="fa fa-plus" title="<?php echo vtranslate('LBL_NEW_DOCUMENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></span>&nbsp;<?php echo vtranslate('LBL_NEW_DOCUMENT','Documents');?>
&nbsp; <span class="caret"></span></button><ul class="dropdown-menu"><li class="dropdown-header"><i class="fa fa-upload"></i> <?php echo vtranslate('LBL_FILE_UPLOAD','Documents');?>
</li><li id="VtigerAction"><a href="javascript:Documents_Index_Js.uploadTo('Vtiger',<?php echo $_smarty_tpl->tpl_vars['PARENT_ID']->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
')"><img style="  margin-top: -3px;margin-right: 4%;" title="Vtiger" alt="Vtiger" src="layouts/v7/skins//images/Vtiger.png"><?php ob_start();
echo vtranslate('LBL_VTIGER','Documents');
$_prefixVariable7 = ob_get_clean();
echo vtranslate('LBL_TO_SERVICE','Documents',$_prefixVariable7);?>
</a></li><li role="separator" class="divider"></li><li id="shareDocument"><a href="javascript:Documents_Index_Js.createDocument('E',<?php echo $_smarty_tpl->tpl_vars['PARENT_ID']->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
')">&nbsp;<i class="fa fa-external-link"></i>&nbsp;&nbsp; <?php ob_start();
echo vtranslate('LBL_FILE_URL','Documents');
$_prefixVariable8 = ob_get_clean();
echo vtranslate('LBL_FROM_SERVICE','Documents',$_prefixVariable8);?>
</a></li><li role="separator" class="divider"></li><li id="createDocument"><a href="javascript:Documents_Index_Js.createDocument('W',<?php echo $_smarty_tpl->tpl_vars['PARENT_ID']->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
')"><i class="fa fa-file-text"></i> <?php ob_start();
echo vtranslate('SINGLE_Documents','Documents');
$_prefixVariable9 = ob_get_clean();
echo vtranslate('LBL_CREATE_NEW','Documents',$_prefixVariable9);?>
</a></li></ul></div></div><?php }?></div><div class="widget_contents"></div></div></div><?php }?></div><div class="middle-block col-lg-4 col-md-4 col-sm-4"><div id="relatedActivities"><?php echo $_smarty_tpl->tpl_vars['RELATED_ACTIVITIES']->value;?>
</div><?php if ($_smarty_tpl->tpl_vars['COMMENTS_WIDGET_MODEL']->value) {?><div class="summaryWidgetContainer"><div class="widgetContainer_comments" data-url="<?php echo $_smarty_tpl->tpl_vars['COMMENTS_WIDGET_MODEL']->value->getUrl();?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['COMMENTS_WIDGET_MODEL']->value->getLabel();?>
"><div class="widget_header clearfix"><input type="hidden" name="relatedModule" value="<?php echo $_smarty_tpl->tpl_vars['COMMENTS_WIDGET_MODEL']->value->get('linkName');?>
" /><h4 class="display-inline-block"><?php echo vtranslate($_smarty_tpl->tpl_vars['COMMENTS_WIDGET_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4></div><div class="widget_contents"></div></div></div><?php }?></div><div class="right-block col-lg-4 col-sm-4 col-md-4"><?php if ($_smarty_tpl->tpl_vars['PRODUCT_WIDGET_MODEL']->value) {?><div class="summaryWidgetContainer"><div class="widgetContainer_products" data-url="<?php echo $_smarty_tpl->tpl_vars['PRODUCT_WIDGET_MODEL']->value->getUrl();?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['PRODUCT_WIDGET_MODEL']->value->getLabel();?>
"><div class="widget_header clearfix"><input type="hidden" name="relatedModule" value="<?php echo $_smarty_tpl->tpl_vars['PRODUCT_WIDGET_MODEL']->value->get('linkName');?>
" /><span class="toggleButton pull-left"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;</span><h4 class="display-inline-block pull-left"><?php echo vtranslate($_smarty_tpl->tpl_vars['PRODUCT_WIDGET_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><?php if ($_smarty_tpl->tpl_vars['PRODUCT_WIDGET_MODEL']->value->get('action')) {?><div class="pull-right"><button class="btn addButton btn-sm btn-default createRecord" type="button" data-url="<?php echo $_smarty_tpl->tpl_vars['PRODUCT_WIDGET_MODEL']->value->get('actionURL');?>
"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button></div><?php }?></div><div class="widget_contents"></div></div></div><?php }
if ($_smarty_tpl->tpl_vars['CONTACT_WIDGET_MODEL']->value) {?><div class="summaryWidgetContainer"><div class="widgetContainer_contacts" data-url="<?php echo $_smarty_tpl->tpl_vars['CONTACT_WIDGET_MODEL']->value->getUrl();?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['CONTACT_WIDGET_MODEL']->value->getLabel();?>
"><div class="widget_header clearfix"><input type="hidden" name="relatedModule" value="<?php echo $_smarty_tpl->tpl_vars['CONTACT_WIDGET_MODEL']->value->get('linkName');?>
" /><span class="toggleButton pull-left"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;</span><h4 class="display-inline-block pull-left"><?php echo vtranslate($_smarty_tpl->tpl_vars['CONTACT_WIDGET_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><?php if ($_smarty_tpl->tpl_vars['CONTACT_WIDGET_MODEL']->value->get('action')) {?><div class="pull-right"><button class="btn addButton btn-sm btn-default createRecord" type="button" data-url="<?php echo $_smarty_tpl->tpl_vars['CONTACT_WIDGET_MODEL']->value->get('actionURL');?>
"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button></div><?php }?></div><div class="widget_contents"></div></div></div><?php }?><!-- //New changed for 2d 3d attahcment --><div class="summaryWidgetContainer"><div class="widgetContainer_contacts"><div class="widget_header clearfix"><h4 class="display-inline-block pull-left"><?php echo vtranslate('2D Design',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><br><br><?php if ($_smarty_tpl->tpl_vars['row2D']->value == 0) {?><div><button class="btn btn-success select2Dattachment" ><?php echo vtranslate('Select 2D Design',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button></div><?php }?></div><div class=""><?php if ($_smarty_tpl->tpl_vars['design2DType']->value == 'image/png') {?><img src="<?php echo $_smarty_tpl->tpl_vars['design2D']->value;?>
" style="width: 80px;"/><?php } else { ?><span><?php echo $_smarty_tpl->tpl_vars['design2DFile']->value;?>
</span><?php }?></div></div></div><div class="summaryWidgetContainer"><div class="widgetContainer_contacts"><div class="widget_header clearfix"><h4 class="display-inline-block pull-left"><?php echo vtranslate('3D Design',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><br><br><?php if ($_smarty_tpl->tpl_vars['row3D']->value == 0) {?><div><button class="btn btn-success select3Dattachment" ><?php echo vtranslate('Select 3D Design',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button></div><?php }?></div><div class=""><?php if ($_smarty_tpl->tpl_vars['design3DType']->value == 'image/png') {?><img src="<?php echo $_smarty_tpl->tpl_vars['design3D']->value;?>
" style="width: 80px;"/><?php } else { ?><span><?php echo $_smarty_tpl->tpl_vars['design3DFile']->value;?>
</span><?php }?></div></div></div><!-- //New changed for 2d 3d attahcment --><div class="summaryWidgetContainer"><div class="widgetContainer_comments"><div class="widget_header"><h4 class="display-inline-block">Followup</h4></div><br><br><div class="widget_contents1"><table class="class="table table-borderless""><tr><td><input type="checkbox" name="advancePayment" id="advancePayment" <?php if ($_smarty_tpl->tpl_vars['advancePayment']->value == '1') {?> checked <?php }?>> Advance Payment<br><br><td><tr><tr><td><input type="checkbox" name=quotesReady" id="quotesReady" <?php if ($_smarty_tpl->tpl_vars['quotesReady']->value == '1') {?> checked <?php }?>> Quotes Ready<br><br><td><tr><tr><td><input type="checkbox" name="siteVisit" id="siteVisit" <?php if ($_smarty_tpl->tpl_vars['siteVisit']->value == '1') {?> checked <?php }?>> Site Visit<br><br><td><tr><tr><td><input type="checkbox" name="design2d" id="design2d" <?php if ($_smarty_tpl->tpl_vars['design2d']->value == '1') {?> checked <?php }?>> 2D design<br><br><td><tr><tr><td><input type="checkbox" name="design3d" id="design3d" <?php if ($_smarty_tpl->tpl_vars['design3d']->value == '1') {?> checked <?php }?>> 3D design<br><br><td><tr></table></div></div></div></div>
<?php }
}
