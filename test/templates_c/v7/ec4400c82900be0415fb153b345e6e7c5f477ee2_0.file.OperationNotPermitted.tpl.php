<?php
/* Smarty version 3.1.39, created on 2024-01-17 07:02:55
  from 'C:\xampp\htdocs\Innca\layouts\v7\modules\Vtiger\OperationNotPermitted.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65a77b9f7a6792_76019005',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec4400c82900be0415fb153b345e6e7c5f477ee2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Innca\\layouts\\v7\\modules\\Vtiger\\OperationNotPermitted.tpl',
      1 => 1702495622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65a77b9f7a6792_76019005 (Smarty_Internal_Template $_smarty_tpl) {
?><div style="margin:0 auto;width: 50em;">
	<table border='0' cellpadding='5' cellspacing='0' height='600px' width="700px">
	<tr><td align='center'>
		<div style='border: 3px solid rgb(153, 153, 153); background-color: rgb(255, 255, 255); width: 80%; position: relative; z-index: 100000020;'>

		<table border='0' cellpadding='5' cellspacing='0' width='98%'>
		<tr>
			<td rowspan='2' width='11%'><img src="<?php echo vimage_path('denied.gif');?>
" ></td>
			<td style='border-bottom: 1px solid rgb(204, 204, 204);' nowrap='nowrap' width='70%'>
				<span class='genHeaderSmall'><?php echo vtranslate($_smarty_tpl->tpl_vars['MESSAGE']->value);?>
</span></td>
		</tr>
		<tr>
			<td class='small' align='right' nowrap='nowrap'>
				<a href='javascript:window.history.back();'><?php echo vtranslate('LBL_GO_BACK');?>
</a><br>
			</td>
		</tr>
		</table>
		</div>
	</td></tr>
	</table>
</div><?php }
}
