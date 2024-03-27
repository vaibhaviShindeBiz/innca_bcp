<?php
/* Smarty version 3.1.39, created on 2024-03-11 09:02:23
  from 'C:\xampp\htdocs\innca\layouts\v7\modules\Vtiger\GetWhatsAppMessages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65eec89f57da02_50044755',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c99e666b1e29085c0818ad30e173ce23c41dfa7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\innca\\layouts\\v7\\modules\\Vtiger\\GetWhatsAppMessages.tpl',
      1 => 1706003577,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65eec89f57da02_50044755 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="2Dattachment" class='modal-xs modal-dialog'>
    <div class = "modal-content">
        <?php ob_start();
echo vtranslate('Received Messages',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable1);?>
        <?php $_smarty_tpl->_subTemplateRender(vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0, true);
?>

        <table class="table  listview-table ">
            <thead>
                <tr>
                    <th>Module Record No</th>
                    <th>Customer Name</th>
                    <th>Mobil No</th>
                    <th>Message</th>
                    <th>Date Time</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unreadMessages']->value, 'unreadMessages_value', false, 'unreadMessages_key');
$_smarty_tpl->tpl_vars['unreadMessages_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['unreadMessages_key']->value => $_smarty_tpl->tpl_vars['unreadMessages_value']->value) {
$_smarty_tpl->tpl_vars['unreadMessages_value']->do_else = false;
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['unreadMessages_value']->value['lead_no'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['unreadMessages_value']->value['customername'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['unreadMessages_value']->value['fromNumber'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['unreadMessages_value']->value['messages'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['unreadMessages_value']->value['createdAt'];?>
</td>
                    </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
            
        </table>    
     
    </div>
</div>
<?php }
}
