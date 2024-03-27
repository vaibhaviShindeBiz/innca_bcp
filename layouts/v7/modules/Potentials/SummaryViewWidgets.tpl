{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*
********************************************************************************/
-->*}
{strip}
	{foreach item=DETAIL_VIEW_WIDGET from=$DETAILVIEW_LINKS['DETAILVIEWWIDGET']}
		{if ($DETAIL_VIEW_WIDGET->getLabel() eq 'Documents') }
			{assign var=DOCUMENT_WIDGET_MODEL value=$DETAIL_VIEW_WIDGET}
		{elseif ($DETAIL_VIEW_WIDGET->getLabel() eq 'LBL_RELATED_CONTACTS')}
			{assign var=CONTACT_WIDGET_MODEL value=$DETAIL_VIEW_WIDGET}
		{elseif ($DETAIL_VIEW_WIDGET->getLabel() eq 'LBL_RELATED_PRODUCTS')}
			{assign var=PRODUCT_WIDGET_MODEL value=$DETAIL_VIEW_WIDGET}
		{elseif ($DETAIL_VIEW_WIDGET->getLabel() eq 'ModComments')}
			{assign var=COMMENTS_WIDGET_MODEL value=$DETAIL_VIEW_WIDGET}
		{elseif ($DETAIL_VIEW_WIDGET->getLabel() eq 'LBL_UPDATES')}
			{assign var=UPDATES_WIDGET_MODEL value=$DETAIL_VIEW_WIDGET}
		{/if}
	{/foreach}

	<div class="left-block col-lg-4 col-md-4 col-sm-4">
		{* Module Summary View*}
		<div class="summaryView">
			<div class="summaryViewHeader">
				<h4 class="display-inline-block">{vtranslate('LBL_KEY_FIELDS', $MODULE_NAME)}</h4>
			</div>
			<div class="summaryViewFields">
				{$MODULE_SUMMARY}
			</div>
		</div>
		{* Module Summary View Ends Here*}

		{* Summary View Documents Widget*}
		{if $DOCUMENT_WIDGET_MODEL}
			<div class="summaryWidgetContainer">
				<div class="widgetContainer_documents" data-url="{$DOCUMENT_WIDGET_MODEL->getUrl()}" data-name="{$DOCUMENT_WIDGET_MODEL->getLabel()}">
					<div class="widget_header clearfix">
						<input type="hidden" name="relatedModule" value="{$DOCUMENT_WIDGET_MODEL->get('linkName')}" />
						<span class="toggleButton pull-left"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;</span>
						<h4 class="display-inline-block pull-left">{vtranslate($DOCUMENT_WIDGET_MODEL->getLabel(),$MODULE_NAME)}</h4>

						{if $DOCUMENT_WIDGET_MODEL->get('action')}
							{assign var=PARENT_ID value=$RECORD->getId()}
							<div class="pull-right">
								<div class="dropdown">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										<span class="fa fa-plus" title="{vtranslate('LBL_NEW_DOCUMENT', $MODULE_NAME)}"></span>&nbsp;{vtranslate('LBL_NEW_DOCUMENT', 'Documents')}&nbsp; <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li class="dropdown-header"><i class="fa fa-upload"></i> {vtranslate('LBL_FILE_UPLOAD', 'Documents')}</li>
										<li id="VtigerAction">
											<a href="javascript:Documents_Index_Js.uploadTo('Vtiger',{$PARENT_ID},'{$MODULE_NAME}')">
												<img style="  margin-top: -3px;margin-right: 4%;" title="Vtiger" alt="Vtiger" src="layouts/v7/skins//images/Vtiger.png">
												{vtranslate('LBL_TO_SERVICE', 'Documents', {vtranslate('LBL_VTIGER', 'Documents')})}
											</a>
										</li>
										<li role="separator" class="divider"></li>
										<li id="shareDocument"><a href="javascript:Documents_Index_Js.createDocument('E',{$PARENT_ID},'{$MODULE_NAME}')">&nbsp;<i class="fa fa-external-link"></i>&nbsp;&nbsp; {vtranslate('LBL_FROM_SERVICE', 'Documents', {vtranslate('LBL_FILE_URL', 'Documents')})}</a></li>
										<li role="separator" class="divider"></li>
										<li id="createDocument"><a href="javascript:Documents_Index_Js.createDocument('W',{$PARENT_ID},'{$MODULE_NAME}')"><i class="fa fa-file-text"></i> {vtranslate('LBL_CREATE_NEW', 'Documents', {vtranslate('SINGLE_Documents', 'Documents')})}</a></li>
									</ul>
								</div>
							</div>
						{/if}
					</div>
					<div class="widget_contents">

					</div>
				</div>
			</div>
		{/if}
		{* Summary View Documents Widget Ends Here*}

	</div>

	<div class="middle-block col-lg-4 col-md-4 col-sm-4">

		{* Summary View Related Activities Widget*}
		<div id="relatedActivities">
			{$RELATED_ACTIVITIES}
		</div>
		{* Summary View Related Activities Widget Ends Here*}

		{* Summary View Comments Widget*}
		{if $COMMENTS_WIDGET_MODEL}
			<div class="summaryWidgetContainer">
				<div class="widgetContainer_comments" data-url="{$COMMENTS_WIDGET_MODEL->getUrl()}" data-name="{$COMMENTS_WIDGET_MODEL->getLabel()}">
					<div class="widget_header clearfix">
						<input type="hidden" name="relatedModule" value="{$COMMENTS_WIDGET_MODEL->get('linkName')}" />
						<h4 class="display-inline-block">{vtranslate($COMMENTS_WIDGET_MODEL->getLabel(),$MODULE_NAME)}</h4>
					</div>
					<div class="widget_contents">
					</div>
				</div>
			</div>
		{/if}
		{* Summary View Comments Widget Ends Here*}

	</div>

	<div class="right-block col-lg-4 col-sm-4 col-md-4">
		{* Summary View Products Widget*}
		{if $PRODUCT_WIDGET_MODEL}
			<div class="summaryWidgetContainer">
				<div class="widgetContainer_products" data-url="{$PRODUCT_WIDGET_MODEL->getUrl()}" data-name="{$PRODUCT_WIDGET_MODEL->getLabel()}">
					<div class="widget_header clearfix">
						<input type="hidden" name="relatedModule" value="{$PRODUCT_WIDGET_MODEL->get('linkName')}" />
						<span class="toggleButton pull-left"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;</span>
						<h4 class="display-inline-block pull-left">{vtranslate($PRODUCT_WIDGET_MODEL->getLabel(),$MODULE_NAME)}</h4>

						{if $PRODUCT_WIDGET_MODEL->get('action')}
							<div class="pull-right">
								<button class="btn addButton btn-sm btn-default createRecord" type="button" data-url="{$PRODUCT_WIDGET_MODEL->get('actionURL')}">
									<i class="fa fa-plus"></i>&nbsp;&nbsp;{vtranslate('LBL_ADD',$MODULE_NAME)}
								</button>
							</div>
						{/if}
					</div>
					<div class="widget_contents">
					</div>
				</div>
			</div>
		{/if}
		{* Summary View Products Widget Ends Here*}

		{* Summary View Contacts Widget *}
		{if $CONTACT_WIDGET_MODEL}
			<div class="summaryWidgetContainer">
				<div class="widgetContainer_contacts" data-url="{$CONTACT_WIDGET_MODEL->getUrl()}" data-name="{$CONTACT_WIDGET_MODEL->getLabel()}">
					<div class="widget_header clearfix">
						<input type="hidden" name="relatedModule" value="{$CONTACT_WIDGET_MODEL->get('linkName')}" />
						<span class="toggleButton pull-left"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;</span>
						<h4 class="display-inline-block pull-left">{vtranslate($CONTACT_WIDGET_MODEL->getLabel(),$MODULE_NAME)}</h4>

						{if $CONTACT_WIDGET_MODEL->get('action')}
							<div class="pull-right">
								<button class="btn addButton btn-sm btn-default createRecord" type="button" data-url="{$CONTACT_WIDGET_MODEL->get('actionURL')}">
									<i class="fa fa-plus"></i>&nbsp;&nbsp;{vtranslate('LBL_ADD',$MODULE_NAME)}
								</button>
							</div>
						{/if}
					</div>
					<div class="widget_contents">
					</div>
				</div>
			</div>
		{/if}
		{* Summary View Contacts Widget Ends Here *}

	
		<!-- //New changed for 2d 3d attahcment -->
		<div class="summaryWidgetContainer">
			<div class="widgetContainer_contacts">
				<div class="widget_header clearfix">
					<h4 class="display-inline-block pull-left">{vtranslate('2D Design',$MODULE_NAME)}</h4><br><br>
					{if $row2D eq 0}
						<div>
							<button class="btn btn-success select2Dattachment" >{vtranslate('Select 2D Design',$MODULE_NAME)}</button>
						</div>
					{/if}
				</div>
				<div class="">
					{if $design2DType eq 'image/png'}
						<img src="{$design2D}" style="width: 80px;"/>
					{else}
						<span>{$design2DFile}</span>
					{/if}
				</div>
			</div>
		</div>

		<div class="summaryWidgetContainer">
			<div class="widgetContainer_contacts">
				<div class="widget_header clearfix">
					<h4 class="display-inline-block pull-left">{vtranslate('3D Design',$MODULE_NAME)}</h4><br><br>
					{if $row3D eq 0}
						<div>
							<button class="btn btn-success select3Dattachment" >{vtranslate('Select 3D Design',$MODULE_NAME)}</button>
						</div>
					{/if}
				</div>
				<div class="">
					{if $design3DType eq 'image/png'}
						<img src="{$design3D}" style="width: 80px;"/>
					{else}
						<span>{$design3DFile}</span>
					{/if}
				</div>
			</div>
		</div>
		<!-- //New changed for 2d 3d attahcment -->
			

		<div class="summaryWidgetContainer">
	        <div class="widgetContainer_comments">
	            <div class="widget_header">
	                <h4 class="display-inline-block">Followup</h4>
	            </div><br><br>
	            <div class="widget_contents1">
	                <table class="class="table table-borderless"">
	                    <tr>
	                        <td>
	                            <input type="checkbox" name="advancePayment" id="advancePayment" {if $advancePayment eq '1'} checked {/if}> Advance Payment<br><br>
	                        <td>
	                    <tr>
	                    <tr>
	                        <td>
	                            <input type="checkbox" name=quotesReady" id="quotesReady" {if $quotesReady eq '1'} checked {/if}> Quotes Ready<br><br>
	                        <td>
	                    <tr>
	                    <tr>
	                        <td>
	                            <input type="checkbox" name="siteVisit" id="siteVisit" {if $siteVisit eq '1'} checked {/if}> Site Visit<br><br>
	                        <td>
	                    <tr>
	                    <tr>
	                        <td>
	                            <input type="checkbox" name="design2d" id="design2d" {if $design2d eq '1'} checked {/if}> 2D design<br><br>
	                        <td>
	                    <tr>
	                    <tr>
	                        <td>
	                            <input type="checkbox" name="design3d" id="design3d" {if $design3d eq '1'} checked {/if}> 3D design<br><br>
	                        <td>
	                    <tr>
	                </table>
	            </div>
	        </div>
	    </div>


	</div>
{/strip}
