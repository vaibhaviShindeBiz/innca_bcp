<?php
/* Smarty version 3.1.39, created on 2024-02-05 05:45:11
  from '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Potentials/dashboards/GroupBySalesPerson.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_65c075e7f3e1c0_03514046',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ce33fe00e5affe2c5c847e42f0cee408213d074f' => 
    array (
      0 => '/home2/bitechnosys/incca.crm-doctor.com/layouts/v7/modules/Potentials/dashboards/GroupBySalesPerson.tpl',
      1 => 1702537022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65c075e7f3e1c0_03514046 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="dashboardWidgetHeader">
    <?php $_smarty_tpl->_subTemplateRender(vtemplate_path("dashboards/WidgetHeader.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</div>

<div class="dashboardWidgetContent">
    <?php $_smarty_tpl->_subTemplateRender(vtemplate_path("dashboards/DashBoardWidgetContents.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</div>

<div class="widgeticons dashBoardWidgetFooter">
    <div class="footerIcons pull-right">
        <?php $_smarty_tpl->_subTemplateRender(vtemplate_path("dashboards/DashboardFooterIcons.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    </div>
</div>

<?php echo '<script'; ?>
 type="text/javascript">

	Vtiger_MultiBarchat_Widget_Js('Vtiger_GroupedBySalesPerson_Widget_Js',{},{
			getCharRelatedData : function() {
				var container = this.getContainer();
				var data = container.find('.widgetData').val();
				data = JSON.parse(data);
				var users = new Array();
				var stages = new Array();
				var count = new Array();
				for(var i=0; i<data.length ;i++) {
					if($.inArray(data[i].last_name, users) == -1) {
						users.push(data[i].last_name);
					}
					if($.inArray(data[i].sales_stage, stages) == -1) {
						stages.push(data[i].sales_stage);
					}
				}
				
                var allLinks = new Array();
				for(j in stages) {
					var salesStageCount = new Array();
                    var links = new Array();
					for(i in users) {
						var salesCount = 0;
						for(var k in data) {
							var userData = data[k];
							if(userData.sales_stage == stages[j] && userData.last_name == users[i]) {
								salesCount = parseFloat(userData.count);
                                link = userData.links
								break;
							}
						}
                        links.push(link);
						salesStageCount.push(salesCount);
					}
                    allLinks.push(links);
					count.push(salesStageCount);
				}
				return {
					'data' : count,
					'ticks' : users,
					'labels' : stages,
                     'links' : allLinks
				}
			}
		});
<?php echo '</script'; ?>
>
<?php }
}
