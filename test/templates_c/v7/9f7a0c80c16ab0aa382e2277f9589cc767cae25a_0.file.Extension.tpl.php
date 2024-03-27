<?php
/* Smarty version 3.1.39, created on 2024-03-08 05:02:09
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Settings/ITS4YouInstaller/rows/Extension.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65ea9bd10f3b07_38943427',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f7a0c80c16ab0aa382e2277f9589cc767cae25a' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Settings/ITS4YouInstaller/rows/Extension.tpl',
      1 => 1702537022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ea9bd10f3b07_38943427 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('MODULE_MODEL', $_smarty_tpl->tpl_vars['EXTENSION']->value->get('moduleModel'));
$_smarty_tpl->_assignInScope('MODULE_NAME', $_smarty_tpl->tpl_vars['EXTENSION']->value->get('name'));
$_smarty_tpl->_assignInScope('IS_PACKAGE_INCLUDED', $_smarty_tpl->tpl_vars['EXTENSION']->value->isPackageIncludedModule());?>
<tr class="installedModuleRow <?php if ($_smarty_tpl->tpl_vars['IS_PACKAGE_INCLUDED']->value) {?>packageIncluded<?php } else { ?>packageNotIncluded<?php }?>" data-cfmid="1" id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" <?php if (!$_smarty_tpl->tpl_vars['IS_PACKAGE_INCLUDED']->value) {?>title="<?php echo vtranslate('LBL_NOT_INCLUDED_IN_PACKAGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"<?php }?>>
    <td><a <?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value && $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isActive()) {?>href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultUrl();?>
" target="_blank" <?php } else { ?> href="#<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['EXTENSION']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></td>
    <td class="validateVersion"><?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->getVersion();?>
</td>
    <td class="updateTime" title="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->getUpdateTimeRaw();?>
"><?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->getUpdateTime();?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('pkgVersion');?>
</td>
    <td>
        <span class="extension_container">
            <?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isVtigerCompatible()) {?>
                <input type="hidden" name="extensionName" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('name');?>
"/>
                <input type="hidden" name="extensionUrl" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('downloadURL');?>
"/>
                <input type="hidden" name="extensionId" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('id');?>
"/>
                <input type="hidden" name="extensionType" value="Single"/>
                <input type="hidden" name="moduleMode" value="showChangelog"/>
                <?php if (!$_smarty_tpl->tpl_vars['EXTENSION']->value->isAlreadyExists()) {?>
                    <input type="hidden" name="moduleAction" value="Install"/>
                    <button class="showChangeLog btn btn-primary <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value) {?>authenticated <?php } else { ?> loginRequired<?php }?>">
                        <?php echo vtranslate('LBL_INSTALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                    </button>
                <?php } elseif ($_smarty_tpl->tpl_vars['EXTENSION']->value->isUpgradable()) {?>
                    <input type="hidden" name="moduleAction" value="Upgrade"/>
                    <input type="hidden" name="moduleMessage" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->getUpdateMessage();?>
"/>
                    <button class="showChangeLog isUpdateBtn btn btn-success margin0px <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value) {?>authenticated <?php } else { ?> loginRequired<?php }?>">
                        <?php echo vtranslate('LBL_UPDATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                    </button>
                <?php }?>
            <?php }?>
        </span>
        <?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value) {?>
            <?php $_smarty_tpl->_assignInScope('SETTINGS_LINKS', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getSettingLinks());?>
            <?php if ((count($_smarty_tpl->tpl_vars['SETTINGS_LINKS']->value) > 0)) {?>
                <span class="btn-group pull-right <?php if (!$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isActive()) {?>hide<?php }?>">
                    <button class="btn btn-default btn dropdown-toggle unpin hiden " data-toggle="dropdown">
                        <?php echo vtranslate('LBL_SETTINGS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<i class="caret"></i>
                    </button>
                    <ul class="dropdown-menu pull-right dropdownfields">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SETTINGS_LINKS']->value, 'SETTINGS_LINK');
$_smarty_tpl->tpl_vars['SETTINGS_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value) {
$_smarty_tpl->tpl_vars['SETTINGS_LINK']->do_else = false;
?>
                            <li>
                                <a target="_blank" <?php if (stripos($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'],'javascript:') === 0) {?>onclick='<?php echo substr($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'],strlen("javascript:"));?>
'<?php } else { ?>href='<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
'<?php }?>>
                                    <?php echo vtranslate($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate("SINGLE_".((string)$_smarty_tpl->tpl_vars['MODULE_NAME']->value),$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>

                                </a>
                            </li>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                </span>
            <?php }?>
        <?php }?>
        <span class="pull-right">
            <?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->get('website') != '') {?>
                <button class="btn installExtension addButton" style="margin-right:5px;" data-url="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('website');?>
"><?php echo vtranslate('LBL_MORE_DETAILS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
            <?php }?>
        </span>
    </td>
</tr><?php }
}
