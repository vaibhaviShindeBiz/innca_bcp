<?php
/* Smarty version 3.1.39, created on 2024-03-04 06:53:03
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Settings/Roles/RoleTree.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65e56fcf25eb69_06009884',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '21a4f652547984eab3bdd3d211637ee88555953f' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Settings/Roles/RoleTree.tpl',
      1 => 1702537022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65e56fcf25eb69_06009884 (Smarty_Internal_Template $_smarty_tpl) {
?><ul><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ROLE']->value->getChildren(), 'CHILD_ROLE');
$_smarty_tpl->tpl_vars['CHILD_ROLE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CHILD_ROLE']->value) {
$_smarty_tpl->tpl_vars['CHILD_ROLE']->do_else = false;
?><li data-role="<?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getParentRoleString();?>
" data-roleid="<?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getId();?>
"><div class="toolbar-handle"><?php if ($_REQUEST['type'] == 'Transfer') {
$_smarty_tpl->_assignInScope('SOURCE_ROLE_SUBPATTERN', ('::').($_smarty_tpl->tpl_vars['SOURCE_ROLE']->value->getId()));
if (strpos($_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getParentRoleString(),$_smarty_tpl->tpl_vars['SOURCE_ROLE_SUBPATTERN']->value) !== false) {?><a style="white-space: nowrap" data-url="<?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getEditViewUrl();?>
" class="btn btn-default" disabled data-toggle="tooltip" data-placement="top" ><span class="muted"><?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getName();?>
</span></a><?php } else { ?><a style="white-space: nowrap" href="" data-url="<?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getEditViewUrl();?>
" class="btn btn-default roleEle" data-toggle="tooltip" data-placement="top" ><?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getName();?>
</a><?php }
} else { ?><a style="white-space: nowrap" href="<?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getEditViewUrl();?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getEditViewUrl();?>
" class="btn btn-default draggable droppable" data-toggle="tooltip" data-placement="top" data-animation="true" title="<?php echo vtranslate('LBL_CLICK_TO_EDIT_OR_DRAG_TO_MOVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getName();?>
</a><?php }
if ($_REQUEST['view'] != 'Popup') {?><div class="toolbar">&nbsp;<a href="<?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getCreateChildUrl();?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getCreateChildUrl();?>
" title="<?php echo vtranslate('LBL_ADD_RECORD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><span class="fa fa-plus-circle"></span></a>&nbsp;<a data-id="<?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getId();?>
" href="javascript:;" data-url="<?php echo $_smarty_tpl->tpl_vars['CHILD_ROLE']->value->getDeleteActionUrl();?>
" data-action="modal" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><span class="fa fa-trash"></span></a></div><?php }?></div><?php $_smarty_tpl->_assignInScope('ROLE', $_smarty_tpl->tpl_vars['CHILD_ROLE']->value);
$_smarty_tpl->_subTemplateRender(vtemplate_path("RoleTree.tpl","Settings:Roles"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul><?php }
}
