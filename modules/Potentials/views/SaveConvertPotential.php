<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
vimport('~~/include/Webservices/ConvertPotential.php');

class Potentials_SaveConvertPotential_View extends Vtiger_View_Controller {

	public function requiresPermission(Vtiger_Request $request){
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'DetailView', 'record_parameter' => 'record');
		$permissions[] = array('module_parameter' => 'custom_module', 'action' => 'CreateView');
		$request->set('custom_module', 'Project');
		
		return $permissions;
	}
	
	public function process(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$modules = $request->get('modules');
		$assignId = $request->get('assigned_user_id');
		$currentUser = Users_Record_Model::getCurrentUserModel();

		$entityValues = array();

		$entityValues['assignedTo'] = vtws_getWebserviceEntityId(vtws_getOwnerType($assignId), $assignId);
		$entityValues['potentialId'] = vtws_getWebserviceEntityId($request->getModule(), $recordId);

		$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $request->getModule());
		$convertPotentialFields = $recordModel->getConvertPotentialFields();

		$availableModules = array('Project');
		foreach ($availableModules as $module) {
			if(vtlib_isModuleActive($module)&& in_array($module, $modules)) {
				$entityValues['entities'][$module]['create'] = true;
				$entityValues['entities'][$module]['name'] = $module;

				// Converting lead should save records source as CRM instead of WEBSERVICE
				$entityValues['entities'][$module]['source'] = 'CRM';
				foreach ($convertPotentialFields[$module] as $fieldModel) {
					$fieldName = $fieldModel->getName();
					$fieldValue = $request->get($fieldName);

					//Potential Amount Field value converting into DB format
					if ($fieldModel->getFieldDataType() === 'currency') {
						if($fieldModel->get('uitype') == 72){
							// Some of the currency fields like Unit Price, Totoal , Sub-total - doesn't need currency conversion during save
							$fieldValue = Vtiger_Currency_UIType::convertToDBFormat($fieldValue, null, true);
						} else {
							$fieldValue = Vtiger_Currency_UIType::convertToDBFormat($fieldValue);
						}
					} elseif ($fieldModel->getFieldDataType() === 'date') {
						$fieldValue = DateTimeField::convertToDBFormat($fieldValue);
					} elseif ($fieldModel->getFieldDataType() === 'reference' && $fieldValue) {
						$ids = vtws_getIdComponents($fieldValue);
						if (php7_count($ids) === 1) {
							$fieldValue = vtws_getWebserviceEntityId(getSalesEntityType($fieldValue), $fieldValue);
						}
					}
					$entityValues['entities'][$module][$fieldName] = $fieldValue;
				}
			}
		}
		try {
			$result = vtws_convertpotential($entityValues, $currentUser);
		} catch(Exception $e) {
			$this->showError($request, $e);
			exit;
		}

		if(!empty($result['Project'])) {
			$projectIdComponents = vtws_getIdComponents($result['Project']);
			$projectId = $projectIdComponents[1];
		}

		//New changes when create convert opportunity to project
		/*if($projectId){
			if($recordId){
				$oppRecordModel = Vtiger_Record_Model::getInstanceById($recordId, 'Potentials');
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
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Foyer');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($living == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Living');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($dining == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Dining');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($mbr == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Master Badroom');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($gbr == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Guest Badroom');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($kbr == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Kids Badroom');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($pooja == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Pooja');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($drykitchen == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Drykitchen');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($wetkitchen == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Wetkitchen');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($servantroom == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Servantroom');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($appliances == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Appliances');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($hob == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Hob');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($chimney == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Chimney');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($microwave == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Microwave');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($oven == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Oven');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($dishwasher == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Dishwasher');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($coffeemaker == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Coffeemaker');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($bathroom1 == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Bathroom1');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($bathroom2 == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Bathroom2');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($commontoilet == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Commontoilet');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($balconies == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Balconies');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}

				if($terrace == 1){
					$ptRecordModel = Vtiger_Record_Model::getCleanInstance('ProjectTask');
					$ptRecordModel->set('projecttaskname', 'Terrace');
					$ptRecordModel->set('projectid', $projectId);
					$ptRecordModel->save();
				}
			}
		}*/
		//New changes when create convert opportunity to project

		if(!empty($projectId)) {
			header("Location: index.php?view=Detail&module=Project&record=$projectId");
		} else {
			$this->showError($request);
			exit;
		}
	}

	function showError($request, $exception=false) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();

		$isDupicatesFailure = false;
		if($exception != false) {
			$viewer->assign('EXCEPTION', $exception->getMessage());
			if ($exception instanceof DuplicateException) {
				$isDupicatesFailure = true;
				$viewer->assign('EXCEPTION', $exception->getDuplicationMessage());
			}
		}

		$currentUser = Users_Record_Model::getCurrentUserModel();

		$viewer->assign('IS_DUPICATES_FAILURE', $isDupicatesFailure);
		$viewer->assign('CURRENT_USER', $currentUser);
		$viewer->assign('MODULE', $moduleName);
		$viewer->view('ConvertPotentialError.tpl', $moduleName);
	}

	public function validateRequest(Vtiger_Request $request) {
		$request->validateWriteAccess();
	}
}
