<?php
/* Smarty version 3.1.39, created on 2024-03-08 05:10:08
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Settings/Picklist/Index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65ea9db0434d33_89147001',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4969c08cb4bebef239fe494ffc3d06063c457345' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Settings/Picklist/Index.tpl',
      1 => 1702537022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ea9db0434d33_89147001 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="listViewPageDiv detailViewContainer " id="listViewContent">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-horizontal" >
        <br>
        <div class="detailViewInfo">
            <div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel">
                    <label class="fieldLabel "><?php echo vtranslate('LBL_SELECT_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 </label>
                </div>
                <div class="fieldValue col-sm-3 col-xs-3">
                    <select class="select2 inputElement" id="pickListModules" name="pickListModules">
                        <option value=""><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_MODULES']->value, 'PICKLIST_MODULE');
$_smarty_tpl->tpl_vars['PICKLIST_MODULE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_MODULE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_MODULE']->do_else = false;
?>
                            <option <?php if ($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value == $_smarty_tpl->tpl_vars['PICKLIST_MODULE']->value->get('name')) {?> selected="" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_MODULE']->value->get('name');?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_MODULE']->value->get('name'),$_smarty_tpl->tpl_vars['PICKLIST_MODULE']->value->get('name'));?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
            </div>
        </div>

        <div id="modulePickListContainer">
            <?php $_smarty_tpl->_subTemplateRender(vtemplate_path("ModulePickListDetail.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        </div>
        <br>
        <div id="modulePickListValuesContainer">
            <?php if (empty($_smarty_tpl->tpl_vars['NO_PICKLIST_FIELDS']->value)) {?>
                <?php $_smarty_tpl->_subTemplateRender(vtemplate_path("PickListValueDetail.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            <?php }?>
        </div>

    </div>
</div><?php }
}
