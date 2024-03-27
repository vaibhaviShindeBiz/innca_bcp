<?php
/* Smarty version 3.1.39, created on 2024-01-02 05:34:05
  from 'C:\wamp64\www\Innca\layouts\v7\modules\PDFMaker\GetPDFButtons.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6593a04df2a215_99622882',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5f917e9c1f3a60fa6fb8ab05e4e0b961d44a3aec' => 
    array (
      0 => 'C:\\wamp64\\www\\Innca\\layouts\\v7\\modules\\PDFMaker\\GetPDFButtons.tpl',
      1 => 1702454222,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6593a04df2a215_99622882 (Smarty_Internal_Template $_smarty_tpl) {
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
