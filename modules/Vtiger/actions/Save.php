<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_Save_Action extends Vtiger_Action_Controller {

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$moduleParameter = $request->get('source_module');
		if (!$moduleParameter) {
			$moduleParameter = 'module';
		}else{
			$moduleParameter = 'source_module';
		}
		$record = $request->get('record');
		$recordId = $request->get('id');
		if (!$record) {
			$recordParameter = '';
		}else{
			$recordParameter = 'record';
		}
		$actionName = ($record || $recordId) ? 'EditView' : 'CreateView';
        $permissions[] = array('module_parameter' => $moduleParameter, 'action' => 'DetailView', 'record_parameter' => $recordParameter);
		$permissions[] = array('module_parameter' => $moduleParameter, 'action' => $actionName, 'record_parameter' => $recordParameter);
		return $permissions;
	}
	
	public function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$record = $request->get('record');

		$nonEntityModules = array('Users', 'Events', 'Calendar', 'Portal', 'Reports', 'Rss', 'EmailTemplates');
		if ($record && !in_array($moduleName, $nonEntityModules)) {
			$recordEntityName = getSalesEntityType($record);
			if ($recordEntityName !== $moduleName) {
				throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
			}
		}
		return parent::checkPermission($request);
	}
	
	public function validateRequest(Vtiger_Request $request) {
		return $request->validateWriteAccess();
	}

	public function process(Vtiger_Request $request) {
		try {
			$recordModel = $this->saveRecord($request);
			if ($request->get('returntab_label')){
				$loadUrl = 'index.php?'.$request->getReturnURL();
			} else if($request->get('relationOperation')) {
				$parentModuleName = $request->get('sourceModule');
				$parentRecordId = $request->get('sourceRecord');
				$parentRecordModel = Vtiger_Record_Model::getInstanceById($parentRecordId, $parentModuleName);
				//TODO : Url should load the related list instead of detail view of record
				$loadUrl = $parentRecordModel->getDetailViewUrl();
			} else if ($request->get('returnToList')) {
				$loadUrl = $recordModel->getModule()->getListViewUrl();
			} else if ($request->get('returnmodule') && $request->get('returnview')) {
				$loadUrl = 'index.php?'.$request->getReturnURL();
			} else {
				$loadUrl = $recordModel->getDetailViewUrl();
			}
			//append App name to callback url
			//Special handling for vtiger7.
			$appName = $request->get('appName');
			if(strlen($appName) > 0){
				$loadUrl = $loadUrl.$appName;
			}
			header("Location: $loadUrl");
		} catch (DuplicateException $e) {
			$requestData = $request->getAll();
			$moduleName = $request->getModule();
			unset($requestData['action']);
			unset($requestData['__vtrftk']);

			if ($request->isAjax()) {
				$response = new Vtiger_Response();
				$response->setError($e->getMessage(), $e->getDuplicationMessage(), $e->getMessage());
				$response->emit();
			} else {
				$requestData['view'] = 'Edit';
				$requestData['duplicateRecords'] = $e->getDuplicateRecordIds();
				$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

				global $vtiger_current_version;
				$viewer = new Vtiger_Viewer();

				$viewer->assign('REQUEST_DATA', $requestData);
				$viewer->assign('REQUEST_URL', $moduleModel->getCreateRecordUrl().'&record='.$request->get('record'));
				$viewer->view('RedirectToEditView.tpl', 'Vtiger');
			}
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Function to save record
	 * @param <Vtiger_Request> $request - values of the record
	 * @return <RecordModel> - record Model of saved record
	 */
	public function saveRecord($request) {
		$recordModel = $this->getRecordModelFromRequest($request);
		if($request->get('imgDeleted')) {
			$imageIds = $request->get('imageid');
			foreach($imageIds as $imageId) {
				$status = $recordModel->deleteImage($imageId);
			}
		}
		$recordModel->save();
		

		$moduleName = $request->getModule();
		if($moduleName == 'Quotes'){
			$quotestage = $_REQUEST['quotestage'];
			if($quotestage == 'Accepted'){
				$potential_id = $_REQUEST['potential_id'];
				$record = $_REQUEST['record'];
				$loadUrl = 'index.php?module=Payment&view=Edit&app=SALES&payment_tks_invoiceno='.$record.'&opportunityid='.$potential_id.'';
				header("Location: $loadUrl");
				exit;
			}
		}

		if($moduleName == 'Payment'){
			$quotesid = $_REQUEST['payment_tks_invoiceno'];
			$opportunityid = $_REQUEST['opportunityid'];
			global $adb;
			$paymentQuery = $adb->pquery("SELECT * FROM vtiger_payment 
				INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_payment.paymentid 
				WHERE vtiger_crmentity.deleted = 0 AND vtiger_payment.payment_tks_invoiceno = ? AND vtiger_payment.opportunityid = ?", array($quotesid, $opportunityid));
			$paymentRow = $adb->num_rows($paymentQuery);
			if($paymentRow == 2){
				if($quotesid){
					if($opportunityid){
						$oppRecordModel = Vtiger_Record_Model::getInstanceById($opportunityid, 'Potentials');
						$potentialname = $oppRecordModel->get('potentialname');
						$contact_id = $oppRecordModel->get('contact_id');
						
						if($contact_id){
						    $contactsRecordModel = Vtiger_Record_Model::getInstanceById($contact_id, 'Contacts');
						    $mobile = $oppRecordModel->get('mobile');
						}

						$pRecordModel = Vtiger_Record_Model::getCleanInstance('Project');
						$pRecordModel->set('projectname', $potentialname);
						$pRecordModel->set('potentialid', $opportunityid);
						$pRecordModel->set('cf_1185', $mobile);
						$pRecordModel->save();
						$projectId = $pRecordModel->getId();

						$foyer = $oppRecordModel->get('foyer');
						$living = $oppRecordModel->get('living');
						$dining = $oppRecordModel->get('dining');
						$mbr = $oppRecordModel->get('mbr');
						$gbr = $oppRecordModel->get('gbr');
						$kbr = $oppRecordModel->get('kbr');
						$pooja = $oppRecordModel->get('pooja');
						$drykitchen = $oppRecordModel->get('drykitchen');
						$wetkitchen = $oppRecordModel->get('wetkitchen');
						$servantroom = $oppRecordModel->get('servantroom');
						$appliances = $oppRecordModel->get('appliances');
						$hob = $oppRecordModel->get('hob');
						$chimney = $oppRecordModel->get('chimney');
						$microwave = $oppRecordModel->get('microwave');
						$oven = $oppRecordModel->get('oven');
						$dishwasher = $oppRecordModel->get('dishwasher');
						$coffeemaker = $oppRecordModel->get('coffeemaker');
						$bathroom1 = $oppRecordModel->get('bathroom1');
						$bathroom2 = $oppRecordModel->get('bathroom2');
						$commontoilet = $oppRecordModel->get('commontoilet');
						$balconies = $oppRecordModel->get('oppo_balcony');
						$terrace = $oppRecordModel->get('oppo_terrace');
						
						if($foyer == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Foyer');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($living == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Living');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($dining == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Dining');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($mbr == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Master Badroom');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($gbr == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Guest Badroom');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($kbr == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Kids Badroom');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($pooja == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Pooja');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($drykitchen == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Drykitchen');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($wetkitchen == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Wetkitchen');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($servantroom == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Servantroom');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($appliances == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Appliances');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($hob == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Hob');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($chimney == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Chimney');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($microwave == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Microwave');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($oven == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Oven');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($dishwasher == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Dishwasher');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($coffeemaker == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Coffeemaker');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($bathroom1 == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Bathroom1');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($bathroom2 == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Bathroom2');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($commontoilet == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Commontoilet');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($balconies == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Balconies');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						if($terrace == 1){
							$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectMilestone');
							$ptRecordModel->set('projectmilestonename', 'Terrace');
							$ptRecordModel->set('projectid', $projectId);
							$ptRecordModel->save();
						}

						$projectRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
						$projectRecordModel->set('projecttaskname', 'Discussion and payment received');
						$projectRecordModel->set('projectid', $projectId);
						$projectRecordModel->save();

						$projectRecordModel1 = Vtiger_Record_Model::getCleanInstance('ProjectTask');
						$projectRecordModel1->set('projecttaskname', 'Implementation');
						$projectRecordModel1->set('projectid', $projectId);
						$projectRecordModel1->save();

						$projectRecordModel2 = Vtiger_Record_Model::getCleanInstance('ProjectTask');
						$projectRecordModel2->set('projecttaskname', 'Installation');
						$projectRecordModel2->set('projectid', $projectId);
						$projectRecordModel2->save();

						$projectRecordModel3 = Vtiger_Record_Model::getCleanInstance('ProjectTask');
						$projectRecordModel3->set('projecttaskname', 'Site Verification');
						$projectRecordModel3->set('projectid', $projectId);
						$projectRecordModel3->save();

						$projectRecordModel4 = Vtiger_Record_Model::getCleanInstance('ProjectTask');
						$projectRecordModel4->set('projecttaskname', 'Closure');
						$projectRecordModel4->set('projectid', $projectId);
						$projectRecordModel4->save();

					}
				}
			}

		}

		if($request->get('relationOperation')) {
			$parentModuleName = $request->get('sourceModule');
			$parentModuleModel = Vtiger_Module_Model::getInstance($parentModuleName);
			$parentRecordId = $request->get('sourceRecord');
			$relatedModule = $recordModel->getModule();
			$relatedRecordId = $recordModel->getId();
			if($relatedModule->getName() == 'Events'){
				$relatedModule = Vtiger_Module_Model::getInstance('Calendar');
			}

			$relationModel = Vtiger_Relation_Model::getInstance($parentModuleModel, $relatedModule);
			$relationModel->addRelation($parentRecordId, $relatedRecordId);
		}
		$this->savedRecordId = $recordModel->getId();
		return $recordModel;
	}

	/**
	 * Function to get the record model based on the request parameters
	 * @param Vtiger_Request $request
	 * @return Vtiger_Record_Model or Module specific Record Model instance
	 */
	protected function getRecordModelFromRequest(Vtiger_Request $request) {

		$moduleName = $request->getModule();
		$recordId = $request->get('record');

		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		if(!empty($recordId)) {
			$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
			$recordModel->set('id', $recordId);
			$recordModel->set('mode', 'edit');
		} else {
			$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			$recordModel->set('mode', '');
		}

		$fieldModelList = $moduleModel->getFields();
		foreach ($fieldModelList as $fieldName => $fieldModel) {
			$fieldValue = $request->get($fieldName, null);
			$fieldDataType = $fieldModel->getFieldDataType();
			if($fieldDataType == 'time' && $fieldValue !== null){
				$fieldValue = Vtiger_Time_UIType::getTimeValueWithSeconds($fieldValue);
			}
            $ckeditorFields = array('commentcontent', 'notecontent');
            if((in_array($fieldName, $ckeditorFields)) && $fieldValue !== null){
                $purifiedContent = vtlib_purify(decode_html($fieldValue));
                // Purify malicious html event attributes
                $fieldValue = purifyHtmlEventAttributes(decode_html($purifiedContent),true);
			}
			if($fieldValue !== null) {
				if(!is_array($fieldValue) && $fieldDataType != 'currency') {
					$fieldValue = trim($fieldValue);
				}
				$recordModel->set($fieldName, $fieldValue);
			}
		}
		return $recordModel;
	}
}
