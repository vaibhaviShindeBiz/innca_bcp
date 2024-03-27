<?php
/* Smarty version 3.1.39, created on 2024-01-11 04:33:34
  from 'C:\wamp64\www\Innca\layouts\v7\modules\ModuleBuilder\ModuleBuilderViewPreProcess.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_659f6f9e2faa10_41056519',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8ea7292cd3bfd762f16cfceb40b530d001c7115' => 
    array (
      0 => 'C:\\wamp64\\www\\Innca\\layouts\\v7\\modules\\ModuleBuilder\\ModuleBuilderViewPreProcess.tpl',
      1 => 1702454222,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/Vtiger/partials/Topbar.tpl' => 1,
  ),
),false)) {
function content_659f6f9e2faa10_41056519 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:modules/Vtiger/partials/Topbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container-fluid app-nav">
    <div class="row">
        <?php $_smarty_tpl->_subTemplateRender(vtemplate_path("partials/SidebarHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        <?php $_smarty_tpl->_subTemplateRender(vtemplate_path("ModuleHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    </div>
</div>
</nav>
     <div id='overlayPageContent' class='fade modal overlayPageContent content-area overlay-container-60' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="data">
        </div>
        <div class="modal-dialog">
        </div>
    </div>
	
<?php echo '<script'; ?>
 type="text/javascript">

	jQuery(document).ready(function () {
		var instance = new Vtiger_Index_Js();
		instance.registerEvents();
	});

<?php echo '</script'; ?>
>
<?php }
}
