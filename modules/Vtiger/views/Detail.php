<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_Detail_View extends Vtiger_Index_View {
	protected $record = false;
	protected $isAjaxEnabled = null;

	function __construct() {
		parent::__construct();
		$this->exposeMethod('showDetailViewByMode');
		$this->exposeMethod('showModuleDetailView');
		$this->exposeMethod('showModuleSummaryView');
		$this->exposeMethod('showModuleBasicView');
		$this->exposeMethod('showRecentActivities');
		$this->exposeMethod('showRecentComments');
		$this->exposeMethod('showRelatedList');
		$this->exposeMethod('showChildComments');
		$this->exposeMethod('getActivities');
		$this->exposeMethod('showRelatedRecords');
	}

	public function requiresPermission(Vtiger_Request $request){
		$permissions = parent::requiresPermission($request);
		$mode = $request->getMode();
		$permissions[] = array('module_parameter' => 'module', 'action' => 'DetailView', 'record_parameter' => 'record');
		if(!empty($mode)) {
			switch ($mode) {
				case 'showModuleDetailView':
				case 'showModuleSummaryView':
				case 'showModuleBasicView':
					$permissions[] = array('module_parameter' => 'module', 'action' => 'DetailView', 'record_parameter' => 'record');
					break;
				case 'showRecentComments':
				case 'showChildComments':
					$permissions[] = array('module_parameter' => 'custom_module', 'action' => 'DetailView');
					$request->set('custom_module', 'ModComments');
					break;
				case 'showRelatedList':
				case 'showRelatedRecords':
					$permissions[] = array('module_parameter' => 'relatedModule', 'action' => 'DetailView');
					break;
				case 'getActivities':
					$permissions[] = array('module_parameter' => 'custom_module', 'action' => 'DetailView');
					$request->set('custom_module', 'Calendar');
					break;
				default:
					break;
			}
		}
		return $permissions;
	}
	
	function checkPermission(Vtiger_Request $request) {
        parent::checkPermission($request);
		$moduleName = $request->getModule();
		$recordId = $request->get('record');

		$nonEntityModules = array('Users', 'Events', 'Calendar', 'Portal', 'Reports', 'Rss', 'EmailTemplates');
		if ($recordId && !in_array($moduleName, $nonEntityModules)) {
			$recordEntityName = getSalesEntityType($recordId);
			if ($recordEntityName !== $moduleName) {
				throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
			}
		}
		return true;
	}

	function preProcess(Vtiger_Request $request, $display=true) {
		parent::preProcess($request, false);

		$recordId = $request->get('record');
		$moduleName = $request->getModule();
		if(!$this->record){
			$this->record = Vtiger_DetailView_Model::getInstance($moduleName, $recordId);
		}
		$recordModel = $this->record->getRecord();
		$recordStrucure = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_DETAIL);
		$summaryInfo = array();
		// Take first block information as summary information
		$stucturedValues = $recordStrucure->getStructure();
		foreach($stucturedValues as $blockLabel=>$fieldList) {
			$summaryInfo[$blockLabel] = $fieldList;
			break;
		}

		$detailViewLinkParams = array('MODULE'=>$moduleName,'RECORD'=>$recordId);

		$detailViewLinks = $this->record->getDetailViewLinks($detailViewLinkParams);
		$navigationInfo = ListViewSession::getListViewNavigation($recordId);

		$viewer = $this->getViewer($request);
		$viewer->assign('RECORD', $recordModel);
		$viewer->assign('NAVIGATION', $navigationInfo);

		//Intially make the prev and next records as null
		$prevRecordId = null;
		$nextRecordId = null;
		$found = false;
		if ($navigationInfo) {
			foreach($navigationInfo as $page=>$pageInfo) {
				foreach($pageInfo as $index=>$record) {
					//If record found then next record in the interation
					//will be next record
					if($found) {
						$nextRecordId = $record;
						break;
					}
					if($record == $recordId) {
						$found = true;
					}
					//If record not found then we are assiging previousRecordId
					//assuming next record will get matched
					if(!$found) {
						$prevRecordId = $record;
					}
				}
				//if record is found and next record is not calculated we need to perform iteration
				if($found && !empty($nextRecordId)) {
					break;
				}
			}
		}

		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		if(!empty($prevRecordId)) {
			$viewer->assign('PREVIOUS_RECORD_URL', $moduleModel->getDetailViewUrl($prevRecordId));
		}
		if(!empty($nextRecordId)) {
			$viewer->assign('NEXT_RECORD_URL', $moduleModel->getDetailViewUrl($nextRecordId));
		}

		$viewer->assign('MODULE_MODEL', $this->record->getModule());
		$viewer->assign('DETAILVIEW_LINKS', $detailViewLinks);

		$viewer->assign('IS_EDITABLE', $this->record->getRecord()->isEditable($moduleName));
		$viewer->assign('IS_DELETABLE', $this->record->getRecord()->isDeletable($moduleName));

		$linkParams = array('MODULE'=>$moduleName, 'ACTION'=>$request->get('view'));
		$linkModels = $this->record->getSideBarLinks($linkParams);
		$viewer->assign('QUICK_LINKS', $linkModels);
		$viewer->assign('MODULE_NAME', $moduleName);

		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		$viewer->assign('DEFAULT_RECORD_VIEW', $currentUserModel->get('default_record_view'));

		$picklistDependencyDatasource = Vtiger_DependencyPicklist::getPicklistDependencyDatasource($moduleName);
		$viewer->assign('PICKIST_DEPENDENCY_DATASOURCE', Vtiger_Functions::jsonEncode($picklistDependencyDatasource));

		$tagsList = Vtiger_Tag_Model::getAllAccessible($currentUserModel->getId(), $moduleName, $recordId);
		$allUserTags = Vtiger_Tag_Model::getAllUserTags($currentUserModel->getId());
		$viewer->assign('TAGS_LIST', $tagsList);
		$viewer->assign('ALL_USER_TAGS', $allUserTags);
		$appName = $request->get('app');
		if(!empty($appName)){
			$viewer->assign('SELECTED_MENU_CATEGORY',$appName);
		}

		$selectedTabLabel = $request->get('tab_label');
		$relationId = $request->get('relationId');

		if(empty($selectedTabLabel)) {
			if($currentUserModel->get('default_record_view') === 'Detail') {
				$selectedTabLabel = vtranslate('SINGLE_'.$moduleName, $moduleName).' '. vtranslate('LBL_DETAILS', $moduleName);
			} else{
				if($moduleModel->isSummaryViewSupported()) {
					$selectedTabLabel = vtranslate('SINGLE_'.$moduleName, $moduleName).' '. vtranslate('LBL_SUMMARY', $moduleName);
				} else {
					$selectedTabLabel = vtranslate('SINGLE_'.$moduleName, $moduleName).' '. vtranslate('LBL_DETAILS', $moduleName);
				}
			}
		}

		$viewer->assign('SELECTED_TAB_LABEL', $selectedTabLabel);
		$viewer->assign('SELECTED_RELATION_ID',$relationId);

		//Vtiger7 - TO show custom view name in Module Header
		$viewer->assign('CUSTOM_VIEWS', CustomView_Record_Model::getAllByGroup($moduleName));

		$viewer->assign('IS_AJAX_ENABLED', $this->isAjaxEnabled($recordModel));

		//New changed for 2d 3d attahcment
		if($recordId){
			global $adb;
			$query = "SELECT * FROM vtiger_sitevisit 
					INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_sitevisit.sitevisitid 
					WHERE vtiger_crmentity.deleted = 0 AND vtiger_sitevisit.sitevisit_oppid = ?";

			$design2DQuery = $adb->pquery($query. "AND vtiger_sitevisit.imagename != ''", array($recordId));
			$design3DQuery = $adb->pquery($query. "AND vtiger_sitevisit.imagename1 != ''", array($recordId)); 

			$design2DId = $adb->query_result($design2DQuery, 0, 'sitevisitid');
			$design3DId = $adb->query_result($design3DQuery, 0, 'sitevisitid');

			$sql = "SELECT vtiger_attachments.*, vtiger_crmentity.setype FROM vtiger_attachments
						INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid
						INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_attachments.attachmentsid
						WHERE vtiger_seattachmentsrel.crmid = ?";

			$result2D = $adb->pquery($sql, array($design2DId));
			$row2D = $adb->num_rows($result2D);
			$result3D = $adb->pquery($sql, array($design3DId));
			$row3D = $adb->num_rows($result3D);

			$design2DType = $adb->query_result($result2D, 0, 'type');
			$design2DFile = $adb->query_result($result2D, 0, 'name');
			$design2D = $adb->query_result($result2D, 0, 'path').'/'.$adb->query_result($result2D, 0, 'attachmentsid').'_'.$adb->query_result($result2D, 0, 'storedname');

			$design3DType = $adb->query_result($result3D, 0, 'type');
			$design3DFile = $adb->query_result($result3D, 0, 'name');
			$design3D = $adb->query_result($result3D, 0, 'path').'/'.$adb->query_result($result3D, 0, 'attachmentsid').'_'.$adb->query_result($result3D, 0, 'storedname');
			
			$viewer->assign('row2D', $row2D);
			$viewer->assign('design2DType', $design2DType);
			$viewer->assign('design2DFile', $design2DFile);
			$viewer->assign('design2D', $design2D);
			$viewer->assign('row3D', $row3D);
			$viewer->assign('design3DType', $design3DType);
			$viewer->assign('design3DFile', $design3DFile);
			$viewer->assign('design3D', $design3D);
		}
		//New changed for 2d 3d attahcment

		global $adb;
		if($moduleName == "Project"){
			$prTaskQuery = "SELECT * FROM vtiger_projecttask INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_projecttask.projecttaskid WHERE vtiger_crmentity.deleted = 0 AND vtiger_projecttask.projectid = ".$recordId;

			$prtaskquery1 = $adb->pquery($prTaskQuery." AND vtiger_projecttask.projecttaskname = 'Discussion and payment received'");
			$pttaksid1 = $adb->query_result($prtaskquery1, 0, 'projecttaskid');
			$pttaksStatus1 = $adb->query_result($prtaskquery1, 0, 'projecttaskstatus');

			$prtaskquery2 = $adb->pquery($prTaskQuery." AND vtiger_projecttask.projecttaskname = 'Implementation'");
			$pttaksid2 = $adb->query_result($prtaskquery2, 0, 'projecttaskid');
			$pttaksStatus2 = $adb->query_result($prtaskquery2, 0, 'projecttaskstatus');

			$prtaskquery3 = $adb->pquery($prTaskQuery." AND vtiger_projecttask.projecttaskname = 'Installation'");
			$pttaksid3 = $adb->query_result($prtaskquery3, 0, 'projecttaskid');
			$pttaksStatus3 = $adb->query_result($prtaskquery3, 0, 'projecttaskstatus');

			$prtaskquery4 = $adb->pquery($prTaskQuery." AND vtiger_projecttask.projecttaskname = 'Site Verification'");
			$pttaksid4 = $adb->query_result($prtaskquery4, 0, 'projecttaskid');
			$pttaksStatus4 = $adb->query_result($prtaskquery4, 0, 'projecttaskstatus');

			$prtaskquery5 = $adb->pquery($prTaskQuery." AND vtiger_projecttask.projecttaskname = 'Closure'");
			$pttaksid5 = $adb->query_result($prtaskquery5, 0, 'projecttaskid');
			$pttaksStatus5 = $adb->query_result($prtaskquery5, 0, 'projecttaskstatus');

			$viewer->assign('PTTASK1', $pttaksid1);
			$viewer->assign('PTTASK2', $pttaksid2);
			$viewer->assign('PTTASK3', $pttaksid3);
			$viewer->assign('PTTASK4', $pttaksid4);
			$viewer->assign('PTTASK5', $pttaksid5);
			$viewer->assign('PTTASKSTATUS1', $pttaksStatus1);
			$viewer->assign('PTTASKSTATUS2', $pttaksStatus2);
			$viewer->assign('PTTASKSTATUS3', $pttaksStatus3);
			$viewer->assign('PTTASKSTATUS4', $pttaksStatus4);
			$viewer->assign('PTTASKSTATUS5', $pttaksStatus5);
		}

		if($moduleName == 'Leads'){
			global $adb;
			$query = $adb->pquery("SELECT * FROM vtiger_leads_followup WHERE leadsid = ?", array($recordId));
			$follow1st = $query->fields['1stfollow'];
			$follow2nd = $query->fields['2ndfollow'];
			$inccaVisit = $query->fields['inccaVisit'];
			$follow3rd = $query->fields['3rdfollow'];
			$viewer->assign('follow1st', $follow1st);
			$viewer->assign('follow2nd', $follow2nd);
			$viewer->assign('inccaVisit', $inccaVisit);
			$viewer->assign('follow3rd', $follow3rd);
		}

		if($moduleName == 'Potentials'){
			global $adb;
			$oppoquery = $adb->pquery("SELECT * FROM vtiger_oppo_followup WHERE oppoid = ?", array($recordId));
			$advancePayment = $oppoquery->fields['advancePayment'];
			$quotesReady = $oppoquery->fields['quotesReady'];
			$siteVisit = $oppoquery->fields['siteVisit'];
			$design2d = $oppoquery->fields['design2d'];
			$design3d = $oppoquery->fields['design3d'];
			$viewer->assign('advancePayment', $advancePayment);
			$viewer->assign('quotesReady', $quotesReady);
			$viewer->assign('siteVisit', $siteVisit);
			$viewer->assign('design2d', $design2d);
			$viewer->assign('design3d', $design3d);
		}

		if($display) {
			$this->preProcessDisplay($request);
		}
	}

	function preProcessTplName(Vtiger_Request $request) {
		return 'DetailViewPreProcess.tpl';
	}

	function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if(!empty($mode)) {
			echo $this->invokeExposedMethod($mode, $request);
			return;
		}

		$currentUserModel = Users_Record_Model::getCurrentUserModel();

		if ($currentUserModel->get('default_record_view') === 'Summary') {
			echo $this->showModuleBasicView($request);
		} else {
			echo $this->showModuleDetailView($request);
		}
	}

	public function postProcess(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$moduleName = $request->getModule();
		if($moduleName=="Calendar"){
			$recordModel = Vtiger_Record_Model::getInstanceById($recordId);
			$activityType = $recordModel->getType();
			if($activityType=="Events"){
				$moduleName="Events";
			}
		}
		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		if(!$this->record){
			$this->record = Vtiger_DetailView_Model::getInstance($moduleName, $recordId);
		}
		$detailViewLinkParams = array('MODULE'=>$moduleName,'RECORD'=>$recordId);
		$detailViewLinks = $this->record->getDetailViewLinks($detailViewLinkParams);

		$selectedTabLabel = $request->get('tab_label');
		$relationId = $request->get('relationId');

		if(empty($selectedTabLabel)) {
			if($currentUserModel->get('default_record_view') === 'Detail') {
				$selectedTabLabel = vtranslate('SINGLE_'.$moduleName, $moduleName).' '. vtranslate('LBL_DETAILS', $moduleName);
			} else{
				if($moduleModel->isSummaryViewSupported()) {
					$selectedTabLabel = vtranslate('SINGLE_'.$moduleName, $moduleName).' '. vtranslate('LBL_SUMMARY', $moduleName);
				} else {
					$selectedTabLabel = vtranslate('SINGLE_'.$moduleName, $moduleName).' '. vtranslate('LBL_DETAILS', $moduleName);
				}
			}
		}

		$viewer = $this->getViewer($request);

		$viewer->assign('SELECTED_TAB_LABEL', $selectedTabLabel);
		$viewer->assign('SELECTED_RELATION_ID',$relationId);
		$viewer->assign('MODULE_MODEL', $this->record->getModule());
		$viewer->assign('DETAILVIEW_LINKS', $detailViewLinks);

		$viewer->view('DetailViewPostProcess.tpl', $moduleName);

		parent::postProcess($request);
	}


	public function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();

		$jsFileNames = array(
			'modules.Vtiger.resources.Detail',
			"modules.$moduleName.resources.Detail",
			'modules.Vtiger.resources.RelatedList',
			"modules.$moduleName.resources.RelatedList",
			'libraries.jquery.jquery_windowmsg',
			"libraries.jquery.ckeditor.ckeditor",
			"libraries.jquery.ckeditor.adapters.jquery",
			"modules.Emails.resources.MassEdit",
			"modules.Vtiger.resources.CkEditor",
			"~/libraries/jquery/twitter-text-js/twitter-text.js",
			"libraries.jquery.multiplefileupload.jquery_MultiFile",
			'~/libraries/jquery/bootstrapswitch/js/bootstrap-switch.min.js',
			'~/libraries/jquery.bxslider/jquery.bxslider.min.js',
			"~layouts/v7/lib/jquery/Lightweight-jQuery-In-page-Filtering-Plugin-instaFilta/instafilta.js",
			'modules.Vtiger.resources.Tag',
			'modules.Google.resources.Map'
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

	function showDetailViewByMode(Vtiger_Request $request) {
		$requestMode = $request->get('requestMode');
		if($requestMode == 'full') {
			return $this->showModuleDetailView($request);
		}
		return $this->showModuleBasicView($request);
	}

	/**
	 * Function shows the entire detail for the record
	 * @param Vtiger_Request $request
	 * @return <type>
	 */
	function showModuleDetailView(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$moduleName = $request->getModule();

		if(!$this->record){
		$this->record = Vtiger_DetailView_Model::getInstance($moduleName, $recordId);
		}
		$recordModel = $this->record->getRecord();
		$recordStrucure = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_DETAIL);
		$structuredValues = $recordStrucure->getStructure();

		$moduleModel = $recordModel->getModule();

		$viewer = $this->getViewer($request);
		$viewer->assign('RECORD', $recordModel);
		$viewer->assign('RECORD_STRUCTURE', $structuredValues);
		$viewer->assign('BLOCK_LIST', $moduleModel->getBlocks());
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
		$viewer->assign('MODULE_NAME', $moduleName);
		$viewer->assign('IS_AJAX_ENABLED', $this->isAjaxEnabled($recordModel));
		$viewer->assign('MODULE', $moduleName);

		$picklistDependencyDatasource = Vtiger_DependencyPicklist::getPicklistDependencyDatasource($moduleName);
		$viewer->assign('PICKIST_DEPENDENCY_DATASOURCE', Vtiger_Functions::jsonEncode($picklistDependencyDatasource));

		if ($request->get('displayMode') == 'overlay') {
			$viewer->assign('MODULE_MODEL', $moduleModel);
			$this->setModuleInfo($request, $moduleModel);
			$viewer->assign('SCRIPTS',$this->getOverlayHeaderScripts($request));

			$detailViewLinkParams = array('MODULE'=>$moduleName, 'RECORD'=>$recordId);
			$detailViewLinks = $this->record->getDetailViewLinks($detailViewLinkParams);
			$viewer->assign('DETAILVIEW_LINKS', $detailViewLinks);
			return $viewer->view('OverlayDetailView.tpl', $moduleName);
		} else {
			return $viewer->view('DetailViewFullContents.tpl', $moduleName, true);
		}
	}
	public function getOverlayHeaderScripts(Vtiger_Request $request){
		$moduleName = $request->getModule();
		$jsFileNames = array(
			"modules.$moduleName.resources.Detail",
		);
		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		return $jsScriptInstances;	
	}

	function showModuleSummaryView($request) {
		$recordId = $request->get('record');
		$moduleName = $request->getModule();

		if(!$this->record){
			$this->record = Vtiger_DetailView_Model::getInstance($moduleName, $recordId);
		}
		$recordModel = $this->record->getRecord();
		$recordStrucure = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_SUMMARY);

		$moduleModel = $recordModel->getModule();
		$viewer = $this->getViewer($request);
		$viewer->assign('RECORD', $recordModel);
		$viewer->assign('BLOCK_LIST', $moduleModel->getBlocks());
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());

		$viewer->assign('MODULE_NAME', $moduleName);
		$viewer->assign('IS_AJAX_ENABLED', $this->isAjaxEnabled($recordModel));
		$viewer->assign('SUMMARY_RECORD_STRUCTURE', $recordStrucure->getStructure());
		$viewer->assign('RELATED_ACTIVITIES', $this->getActivities($request));

		$viewer->assign('CURRENT_USER_MODEL', Users_Record_Model::getCurrentUserModel());
		$pagingModel = new Vtiger_Paging_Model();
		$viewer->assign('PAGING_MODEL', $pagingModel);

		$picklistDependencyDatasource = Vtiger_DependencyPicklist::getPicklistDependencyDatasource($moduleName);
		$viewer->assign('PICKIST_DEPENDENCY_DATASOURCE', Vtiger_Functions::jsonEncode($picklistDependencyDatasource));

		return $viewer->view('ModuleSummaryView.tpl', $moduleName, true);
	}

	/**
	 * Function shows basic detail for the record
	 * @param <type> $request
	 */
	function showModuleBasicView(Vtiger_Request $request) {

		$recordId = $request->get('record');
		$moduleName = $request->getModule();

		if(!$this->record){
			$this->record = Vtiger_DetailView_Model::getInstance($moduleName, $recordId);
		}
		$recordModel = $this->record->getRecord();

		$detailViewLinkParams = array('MODULE'=>$moduleName,'RECORD'=>$recordId);
		$detailViewLinks = $this->record->getDetailViewLinks($detailViewLinkParams);

		$viewer = $this->getViewer($request);
		$viewer->assign('RECORD', $recordModel);
		$viewer->assign('MODULE_SUMMARY', $this->showModuleSummaryView($request));

		$viewer->assign('DETAILVIEW_LINKS', $detailViewLinks);
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
		$viewer->assign('IS_AJAX_ENABLED', $this->isAjaxEnabled($recordModel));
		$viewer->assign('MODULE_NAME', $moduleName);

		$recordStrucure = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_DETAIL);
		$structuredValues = $recordStrucure->getStructure();

		$moduleModel = $recordModel->getModule();
		$viewer->assign('CURRENT_USER_MODEL', Users_Record_Model::getCurrentUserModel());
		$viewer->assign('RECORD_STRUCTURE', $structuredValues);
		$viewer->assign('BLOCK_LIST', $moduleModel->getBlocks());
		echo $viewer->view('DetailViewSummaryContents.tpl', $moduleName, true);
	}

	/**
	 * Added to support Engagements view in Vtiger7
	 * @param Vtiger_Request $request
	 */
	function _showRecentActivities(Vtiger_Request $request){
		$parentRecordId = $request->get('record');
		$pageNumber = $request->get('page');
		$limit = $request->get('limit');
		$moduleName = $request->getModule();

		if(empty($pageNumber)) {
			$pageNumber = 1;
		}

		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', $pageNumber);
		if(!empty($limit)) {
			$pagingModel->set('limit', $limit);
		}

		$recentActivities = ModTracker_Record_Model::getUpdates($parentRecordId, $pagingModel,$moduleName);
		$pagingModel->calculatePageRange($recentActivities);

		if($pagingModel->getCurrentPage() == ModTracker_Record_Model::getTotalRecordCount($parentRecordId)/$pagingModel->getPageLimit()) {
			$pagingModel->set('nextPageExists', false);
		}
		$recordModel = Vtiger_Record_Model::getInstanceById($parentRecordId);
		$viewer = $this->getViewer($request);
		$viewer->assign('SOURCE',$recordModel->get('source'));
        $recentActivities = ModTracker_Record_Model::getUpdates($parentRecordId, $pagingModel,$moduleName);

        $totalCount = ModTracker_Record_Model::getTotalRecordCount($parentRecordId);
        $pageLimit = $pagingModel->getPageLimit();
        $pageCount = ceil((int) $totalCount / (int) $pageLimit);
        if($pageCount - $pagingModel->getCurrentPage() == 0) {
            $pagingModel->set('nextPageExists', false);
        } else {
            $pagingModel->set('nextPageExists', true);
        }
		$viewer->assign('RECENT_ACTIVITIES', $recentActivities);
		$viewer->assign('MODULE_NAME', $moduleName);
		$viewer->assign('PAGING_MODEL', $pagingModel);
		$viewer->assign('RECORD_ID',$parentRecordId);
	}

	/**
	 * Function returns recent changes made on the record
	 * @param Vtiger_Request $request
	 */
	function showRecentActivities (Vtiger_Request $request){
		$moduleName = $request->getModule();
		$this->_showRecentActivities($request);

		$viewer = $this->getViewer($request);
		echo $viewer->view('RecentActivities.tpl', $moduleName, true);
	}

	/**
	 * Function returns latest comments
	 * @param Vtiger_Request $request
	 * @return <type>
	 */
	function showRecentComments(Vtiger_Request $request) {
		$parentId = $request->get('record');
		$pageNumber = $request->get('page');
		$limit = $request->get('limit');
		$moduleName = $request->getModule();
		$currentUserModel = Users_Record_Model::getCurrentUserModel();

		if(empty($pageNumber)) {
			$pageNumber = 1;
		}

		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', $pageNumber);
		if(!empty($limit)) {
			$pagingModel->set('limit', $limit);
		}

		if($request->get('rollup-toggle')) {
			$rollupsettings = ModComments_Module_Model::storeRollupSettingsForUser($currentUserModel, $request);
		} else {
			$rollupsettings = ModComments_Module_Model::getRollupSettingsForUser($currentUserModel, $moduleName);
		}

		if(isset($rollupsettings['rollup_status']) && $rollupsettings['rollup_status']) {
			$parentRecordModel = Vtiger_Record_Model::getInstanceById($parentId, $moduleName);
			$recentComments = $parentRecordModel->getRollupCommentsForModule(0, 6);
		}else {
			$recentComments = ModComments_Record_Model::getRecentComments($parentId, $pagingModel);
		}

		$pagingModel->calculatePageRange($recentComments);
		if ($pagingModel->get('limit') < php7_count($recentComments)) {
			array_pop($recentComments);
		}

		$modCommentsModel = Vtiger_Module_Model::getInstance('ModComments');
		$fileNameFieldModel = Vtiger_Field::getInstance("filename", $modCommentsModel);
		$fileFieldModel = Vtiger_Field_Model::getInstanceFromFieldObject($fileNameFieldModel);

		$viewer = $this->getViewer($request);
		$viewer->assign('COMMENTS', $recentComments);
		$viewer->assign('CURRENTUSER', $currentUserModel);
		$viewer->assign('MODULE_NAME', $moduleName);
		$viewer->assign('PAGING_MODEL', $pagingModel);
		$viewer->assign('FIELD_MODEL', $fileFieldModel);
		$viewer->assign('MAX_UPLOAD_LIMIT_MB', Vtiger_Util_Helper::getMaxUploadSize());
		$viewer->assign('MAX_UPLOAD_LIMIT_BYTES', Vtiger_Util_Helper::getMaxUploadSizeInBytes());
		$viewer->assign('COMMENTS_MODULE_MODEL', $modCommentsModel);
		$viewer->assign('ROLLUP_STATUS', isset($rollupsettings['rollup_status']) ? 
			$rollupsettings['rollup_status'] : false);
		$viewer->assign('ROLLUPID', isset($rollupsettings['rollupid']) ?
			$rollupsettings['rollupid'] : 0);
		$viewer->assign('PARENT_RECORD', $parentId);

		return $viewer->view('RecentComments.tpl', $moduleName, 'true');
	}

	/**
	 * Function returns related records
	 * @param Vtiger_Request $request
	 * @return <type>
	 */
	function showRelatedList(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$relatedModuleName = $request->get('relatedModule');
		$targetControllerClass = null;

		if($relatedModuleName == 'ModComments') {
			$currentUserModel = Users_Record_Model::getCurrentUserModel();
			$rollupSettings = ModComments_Module_Model::getRollupSettingsForUser($currentUserModel, $moduleName);
			$request->set('rollup_settings', $rollupSettings);
		}

		// Added to support related list view from the related module, rather than the base module.
		try {
			$targetControllerClass = Vtiger_Loader::getComponentClassName('View', 'In'.$moduleName.'Relation', $relatedModuleName);
		}catch(AppException $e) {
			try {
				// If any module wants to have same view for all the relation, then invoke this.
				$targetControllerClass = Vtiger_Loader::getComponentClassName('View', 'InRelation', $relatedModuleName);
			}catch(AppException $e) {
				// Default related list
				$targetControllerClass = Vtiger_Loader::getComponentClassName('View', 'RelatedList', $moduleName);
			}
		}
		if($targetControllerClass) {
			$targetController = new $targetControllerClass();
			if($targetController->checkPermission($request)){
				return $targetController->process($request);
			}
		}
	}

	/**
	 * Function sends the child comments for a comment
	 * @param Vtiger_Request $request
	 * @return <type>
	 */
	function showChildComments(Vtiger_Request $request) {
		$parentCommentId = $request->get('commentid');
		$parentCommentModel = ModComments_Record_Model::getInstanceById($parentCommentId);
		$childComments = $parentCommentModel->getChildComments();
		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		$modCommentsModel = Vtiger_Module_Model::getInstance('ModComments');
		$moduleName = $parentCommentModel->getParentRecordModel()->getModuleName();

		$viewer = $this->getViewer($request);
		$viewer->assign('PARENT_COMMENTS', $childComments);
		$viewer->assign('CURRENTUSER', $currentUserModel);
		$viewer->assign('COMMENTS_MODULE_MODEL', $modCommentsModel);
		$viewer->assign('MODULE_NAME', $moduleName);

		return $viewer->view('CommentsList.tpl', $moduleName, 'true');
	}

	/**
	 * Function to get Ajax is enabled or not
	 * @param Vtiger_Record_Model record model
	 * @return <boolean> true/false
	 */
	function isAjaxEnabled($recordModel) {
		if(is_null($this->isAjaxEnabled)){
			$this->isAjaxEnabled = $recordModel->isEditable();
		}
		return $this->isAjaxEnabled;
	}

	/**
	 * Function to get activities
	 * @param Vtiger_Request $request
	 * @return <List of activity models>
	 */
	public function getActivities(Vtiger_Request $request) {
		return '';
	}


	/**
	 * Function returns related records based on related moduleName
	 * @param Vtiger_Request $request
	 * @return <type>
	 */
	function showRelatedRecords(Vtiger_Request $request) {
		$parentId = $request->get('record');
		$pageNumber = $request->get('page');
		$limit = $request->get('limit');
		$relatedModuleName = $request->get('relatedModule');
		$moduleName = $request->getModule();

		if(empty($pageNumber)) {
			$pageNumber = 1;
		}

		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', $pageNumber);
		if(!empty($limit)) {
			$pagingModel->set('limit', $limit);
		}

		$parentRecordModel = Vtiger_Record_Model::getInstanceById($parentId, $moduleName);
		$relationListView = Vtiger_RelationListView_Model::getInstance($parentRecordModel, $relatedModuleName);
		$models = $relationListView->getEntries($pagingModel);
		$header = $relationListView->getHeaders();

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE' , $moduleName);
		$viewer->assign('RELATED_RECORDS' , $models);
		$viewer->assign('RELATED_HEADERS', $header);
		$viewer->assign('RELATED_MODULE' , $relatedModuleName);
		$viewer->assign('PAGING_MODEL', $pagingModel);

		return $viewer->view('SummaryWidgets.tpl', $moduleName, 'true');
	}

	public function getHeaderCss(Vtiger_Request $request) {
		$headerCssInstances = parent::getHeaderCss($request);
		$cssFileNames = array(
			'~/libraries/jquery/bootstrapswitch/css/bootstrap2/bootstrap-switch.min.css',
		);
		$cssInstances = $this->checkAndConvertCssStyles($cssFileNames);
		$headerCssInstances = array_merge($headerCssInstances, $cssInstances);
		return $headerCssInstances;
	}

}
