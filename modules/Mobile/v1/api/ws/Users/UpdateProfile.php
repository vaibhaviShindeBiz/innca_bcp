<?php
include_once dirname(__FILE__) . '../../../../api/ws/LoginAndFetchModules.php';
class Mobile_WS_UpdateProfile extends Mobile_WS_Controller {
    function process(Mobile_API_Request $request) {
        global $current_user, $adb;
        $response = new Mobile_API_Response();
        $recordId = $current_user->id;
        $userName = $current_user->user_name;
        $sql = 'select serviceengineerid from vtiger_serviceengineer ' .
            ' inner join vtiger_crmentity on vtiger_crmentity.crmid = vtiger_serviceengineer.serviceengineerid' .
            ' where badge_no = ? and vtiger_crmentity.deleted= 0 ORDER BY serviceengineerid DESC LIMIT 1';
        $sqlResult = $adb->pquery($sql, array($userName));
        // $employeeRecordModel = '';
        $num_rows = $adb->num_rows($sqlResult);
        if ($num_rows > 0) {
            $dataRow = $adb->fetchByAssoc($sqlResult, 0);
            // $employeeRecordModel = Vtiger_Record_Model::getInstanceById($dataRow['serviceengineerid'], 'ServiceEngineer');

            $updateSql = "update vtiger_serviceengineer set service_engineer_name = ?,
                    email = ? where serviceengineerid = ?"; 
            $adb->pquery($updateSql, array(
                $request->get('service_engineer_name'),
                $request->get('email'),
                $dataRow['serviceengineerid']
            ));
        }
        $recordModel = Vtiger_Record_Model::getInstanceById($recordId, 'Users');
        if (!empty($recordModel)) {
            $recordModel->set('mode', 'edit');
            $recordModel->set('first_name', $request->get('firstname'));
            $recordModel->set('last_name', $request->get('lastname'));
            $recordModel->set('email1', $request->get('email'));
            $recordModel->set('phone_mobile', $request->get('phone'));
            $recordModel->set('address_street', $request->get('street'));
            $recordModel->set('address_city', $request->get('city'));
            $recordModel->set('address_state', $request->get('state'));
            $recordModel->set('address_country', $request->get('country'));
            $recordModel->set('address_postalcode', $request->get('postalcode'));
            $recordModel->save();

            // $employeeRecordModel->set('mode', 'edit');
            // $employeeRecordModel->set('service_engineer_name', $request->get('service_engineer_name'));
            // $employeeRecordModel->set('email', $request->get('email'));
            // $employeeRecordModel->save();

            $response->setApiSucessMessage('User Profile Is Updated Successfully');
            $responseObject['userDetails'] = $this->getUserDetailsForProfile($recordId);
            $response->setResult($responseObject);
            return $response;
        } else {
            $response->setError(100, 'Not Able To Update User Profile');
            return $response;
        }
    }

    function getUserDetailsForProfile($recordId) {
        $userDetails = [];
        $recordModel = Vtiger_Record_Model::getInstanceById($recordId, 'Users');
        $mobileWsLogin = new Mobile_WS_Login(); // Instantiate the class
		$imagewithurl = $mobileWsLogin->getUserImageDetails($recordId);
        $userDetails['imagename'] = $imagewithurl;
        $userDetails['email'] = $recordModel->get('email1');
        $userDetails['firstname'] = $recordModel->get('first_name');
        $userDetails['lastname'] = $recordModel->get('last_name');
        $userDetails['phone'] = $recordModel->get('phone_mobile');
        $userDetails['street'] = $recordModel->get('address_street');
        $userDetails['city'] = $recordModel->get('address_city');
        $userDetails['state'] = $recordModel->get('address_state');
        $userDetails['country'] = $recordModel->get('address_country');
        $userDetails['postalcode'] = $recordModel->get('address_postalcode');
        
        return $userDetails;
    }
}
