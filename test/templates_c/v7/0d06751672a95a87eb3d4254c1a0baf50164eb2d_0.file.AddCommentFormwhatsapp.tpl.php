<?php
/* Smarty version 3.1.39, created on 2024-01-17 07:05:59
  from 'C:\xampp\htdocs\Innca\layouts\v7\modules\Vtiger\AddCommentFormwhatsapp.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65a77c57bbdfc3_33325212',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0d06751672a95a87eb3d4254c1a0baf50164eb2d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Innca\\layouts\\v7\\modules\\Vtiger\\AddCommentFormwhatsapp.tpl',
      1 => 1698402300,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65a77c57bbdfc3_33325212 (Smarty_Internal_Template $_smarty_tpl) {
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
>
    function populateSelect() {
            const selectElement = document.getElementById("commentcontent");
            const proxyUrl = 'https://thingproxy.freeboard.io/fetch/';
            const apiUrl = 'https://midware.onrender.com/templateNames';
            fetch(proxyUrl + apiUrl, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJPd25lck5hbWUiOiJrYXJhbkJCIiwiaWF0IjoxNjkyMjU2OTk5fQ.l_e0ynSm3kziO9q4xFLpdehdK9E81M6na8bb0YXt3Dw',
                }
            })
            .then(response => response.json())
            .then(data => {
                const templates = data.templates;
                templates.forEach(template => {
                    const option = document.createElement("option");
                    option.value = template.name;
                    option.textContent = template.name + " (" + template.status + ")";
                    selectElement.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        }
    populateSelect();
<?php echo '</script'; ?>
>
<?php }
}
