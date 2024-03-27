<?php
/* Smarty version 3.1.39, created on 2024-01-17 09:07:47
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Vtiger/AddCommentFormwhatsapp.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65a798e3346300_21851880',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19e4a91180eb35494a1ac1dde3ca2ba8fd99b52e' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Vtiger/AddCommentFormwhatsapp.tpl',
      1 => 1705482459,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65a798e3346300_21851880 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('COMMENT_TEXTAREA_DEFAULT_ROWS', "2");?>
<div class="modal-dialog">
    <div class="modal-content">
        <form class="form-horizontal" id="massSave" method="post" action="index.php">
            <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" />
            <input type="hidden" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" />
            <input type="hidden" name="action" value="MassSaveAjax" />
            <input type="hidden" name="viewname" value="<?php echo $_smarty_tpl->tpl_vars['CVID']->value;?>
" />
            <input type="hidden" name="selected_ids" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SELECTED_IDS']->value);?>
>
            <input type="hidden" name="excluded_ids" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['EXCLUDED_IDS']->value);?>
>
            <input type="hidden" name="search_key" value= "<?php echo $_smarty_tpl->tpl_vars['SEARCH_KEY']->value;?>
" />
            <input type="hidden" name="operator" value="<?php echo $_smarty_tpl->tpl_vars['OPERATOR']->value;?>
" />
            <input type="hidden" name="search_value" value="<?php echo $_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value;?>
" />
            <input type="hidden" name="search_params" value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['SEARCH_PARAMS']->value));?>
' />
            <input type="hidden" name="tag_params" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['TAG_PARAMS']->value);?>
>

            <?php ob_start();
echo vtranslate('LBL_ADDING_COMMENT',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable1);?>
            <?php $_smarty_tpl->_subTemplateRender(vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row commentTextArea" id="mass_action_add_commentwhatsapp">
                        <select class="col-lg-12 form-control" name="commentcontent" id="commentcontent" rows="<?php echo $_smarty_tpl->tpl_vars['COMMENT_TEXTAREA_DEFAULT_ROWS']->value;?>
" placeholder="<?php echo vtranslate('LBL_WRITE_YOUR_COMMENT_HERE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
..." data-rule-required="true"></select>
                    </div>
                </div>
            </div>
			<?php $_smarty_tpl->_subTemplateRender(vtemplate_path('AddCommentFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
       </form>
    </div>
</div>

  <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.4.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
$(document).ready(function() {
    const selectElement = $("#commentcontent");

    $.ajax({
        url: 'api.php',
        type: 'GET',
       
        success: function(data) {
            console.log('Data:', data);

            // Parse the JSON string into a JavaScript object
            const parsedData = JSON.parse(data);

            const templates = parsedData.templates;
            templates.forEach(template => {
                const option = $("<option>");
                option.val(template.name);
                option.text(template.name + " (" + template.status + ")");
                selectElement.append(option);
            });
        },
        error: function(xhr, status, error) {
           
            console.error('Error fetching data:', error);
            console.log('Status:', status);
            console.log('Response:', xhr.responseText);
        }
    });
});

<?php echo '</script'; ?>
><?php }
}
