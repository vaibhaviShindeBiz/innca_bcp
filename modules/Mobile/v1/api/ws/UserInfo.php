<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
include_once dirname(__FILE__) . '/../../api/ws/LoginAndFetchModules.php';

class Mobile_WS_UserInfo extends Mobile_WS_Controller {

	function process(Mobile_API_Request $request) {
		$current_user = $this->getActiveUser();
		
		$mobileWsLogin = new Mobile_WS_Login(); // Instantiate the class
		$imagewithurl = $mobileWsLogin->getUserImageDetails($current_user->id);

		$userinfo = array(
			'profile_image' => $imagewithurl,
			'username' => $current_user->user_name,
			'id'       => $current_user->id,
			'first_name' => $current_user->first_name,
			'last_name' => $current_user->last_name,
			'email' => $current_user->email1,
			'phone' => $current_user->phone_mobile,
			'address' => [
				'street_address' => $current_user->address_street,
				'city'			 => $current_user->address_city,
				'state'			 => $current_user->address_state,
				'country'		 => $current_user->address_country,
				'postal_code'	 => $current_user->address_postalcode
			]
			
		);
		
		
		$allVisibleModules = Settings_MenuEditor_Module_Model::getAllVisibleModules();
		$appModulesMap = array();
		
		foreach($allVisibleModules as $app => $moduleModels) {
            $moduleInfo = array();
			foreach($moduleModels as $moduleModel) {
				$moduleInfo[] = array('name' => $moduleModel->get('name'), 'label'=>vtranslate($moduleModel->get('label'), $moduleModel->get('name')));
			}
			$appModulesMap[$app] = $moduleInfo;
		}
		
		$response = new Mobile_API_Response();
		$result['userinfo'] = $userinfo;
		//$result['menus'] = $appModulesMap;
	//	$result['apps'] = Vtiger_MenuStructure_Model::getAppMenuList();
		//$result['defaultApp'] = $this->_getDefaultApp();
		$response->setApiSucessMessage('User Profile Is Fetched Successfully');
		$response->setResult($result);
		return $response;
	}

	
	
	function _getDefaultApp() {
		return '';
	}
}