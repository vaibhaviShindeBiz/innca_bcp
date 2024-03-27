<?php
/* Smarty version 3.1.39, created on 2024-01-12 11:06:16
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/PDFMaker/GetPDFActions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65a11d288e2666_21523837',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd21c0bf0cefdd850bfe1b664f528e2ab3d5175fa' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/PDFMaker/GetPDFActions.tpl',
      1 => 1702495622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65a11d288e2666_21523837 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home2/bitechnosys/incca.crm-doctor.com/libraries/Smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
if ($_smarty_tpl->tpl_vars['ENABLE_PDFMAKER']->value == 'true') {?>

    <input type="hidden" name="email_function" id="email_function" value="<?php echo $_smarty_tpl->tpl_vars['EMAIL_FUNCTION']->value;?>
"/>
        <li>
        <a href="javascript:;" class="PDFMakerDownloadPDF PDFMakerTemplateAction"><?php echo vtranslate('LBL_DOWNLOAD','PDFMaker');?>
</a>
    </li>
    <li class="dropdown-header">
        <i class="fa fa-settings"></i> <?php echo vtranslate('LBL_SETTINGS','PDFMaker');?>

    </li>
        <li>
            <a href="javascript:;" class="showPDFBreakline"><?php echo vtranslate('LBL_PRODUCT_BREAKLINE','PDFMaker');?>
</a>
        </li>
    <li>
        <a href="javascript:;" class="showProductImages"><?php echo vtranslate('LBL_PRODUCT_IMAGE','PDFMaker');?>
</a>
    </li>

    <?php if (sizeof($_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value) > 1) {?>
        <li class="dropdown-header">
            <i class="fa fa-settings"></i> <?php echo vtranslate('LBL_PDF_LANGUAGE','PDFMaker');?>

        </li>
        <li>
            <select name="template_language" id="template_language" class="col-lg-12">
                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value,'selected'=>$_smarty_tpl->tpl_vars['CURRENT_LANGUAGE']->value),$_smarty_tpl);?>

            </select>
        </li>
    <?php } else { ?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value), 'lang', false, 'lang_key');
$_smarty_tpl->tpl_vars['lang']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['lang_key']->value => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->do_else = false;
?>
            <input type="text" name="template_language" id="template_language" value="<?php echo $_smarty_tpl->tpl_vars['lang_key']->value;?>
"/>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }
}
}
}
