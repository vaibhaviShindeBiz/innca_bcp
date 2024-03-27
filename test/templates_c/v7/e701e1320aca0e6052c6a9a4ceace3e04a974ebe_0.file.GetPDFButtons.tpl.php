<?php
/* Smarty version 3.1.39, created on 2024-03-15 07:15:31
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\PDFMaker\GetPDFButtons.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65f3f593b26743_99559189',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e701e1320aca0e6052c6a9a4ceace3e04a974ebe' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\PDFMaker\\GetPDFButtons.tpl',
      1 => 1710403179,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65f3f593b26743_99559189 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['ENABLE_PDFMAKER']->value == 'true') {?>

     <div class="col-sm-4 pull-right" id="PDFMakerContentDiv">
        <div class="row clearfix">
                <div class="col-sm-6 padding0px pull-right">
                    <div class="btn-group pull-right">
                        <button class="btn btn-default selectPDFTemplates"><?php echo vtranslate('LBL_EXPORT_TO_PDF','PDFMaker');?>
</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split PDFMoreAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo vtranslate('LBL_MORE','PDFMaker');?>
&nbsp;&nbsp;<span class="caret"></span></button>
                        </button>
                            <ul class="dropdown-menu">
                                <?php $_smarty_tpl->_subTemplateRender(vtemplate_path("GetPDFActions.tpl",'PDFMaker'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
<?php }
}
}
