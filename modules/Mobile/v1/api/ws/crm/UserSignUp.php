<?php
//require_once('modules/ServiceEngineer/ServiceEngineer.php');
include_once('include/utils/GeneralConfigUtils.php');
class Mobile_WS_UserSignUp extends Mobile_WS_Controller {

    function requireLogin() {
        return false;
    }

    function process(Mobile_API_Request $request) {
        $response = new Mobile_API_Response();
        $responseObject = [];
        $id = $request->get('uid');
        $otp = $request->get('otp');
        $status = Vtiger_ShortURL_Helper::handleForgotPasswordMobile(vtlib_purify($id));
        if ($status == true) {
            $shortURLModel = Vtiger_ShortURL_Helper::getInstance($id);
            $handlerData = $shortURLModel->handler_data;
            $otpFromDataBase = $shortURLModel->handler_data['otp'];
            if ($otp == $otpFromDataBase) {
                global $current_user;
                $current_user = Users::getActiveAdminUser();
                $sentTime = $shortURLModel->handler_data['time'];
                $now = strtotime("Now");
                if ($now >  $sentTime) {
                    $response->setError(100, "OTP is Expired");
                    return $response;
                } else {
                    $activeFields = $this->getActiveFields('Users', true);
                    print_r($activeFields);
                    $focus = CRMEntity::getInstance('Users');
                    $activeFieldKeys = array_keys($activeFields);
                    
                    // $hasSubRoleArr = array(
                    //     'Regional Office', 'Service Centre', 'Activity Centre',
                    //     'District Office', 'Production Division',
                    //     'International Business Division-New Delhi'
                    // );
                    // if (in_array($handlerData['office'], $hasSubRoleArr)) {
                    //     $releventRole = '';
                        
                    //     if ($handlerData['office'] == 'District Office') {
                    //         $releventRole =  $handlerData['district_office'];
                    //         $handlerData['regional_office'] = IGGetRelventRegionalOfficeBasedOnType($releventRole);
                    //         $handlerData['service_centre'] = '';
                    //         $handlerData['activity_centre'] = '';
                    //         $handlerData['production_division'] = '';
                    //     } else if ($handlerData['office'] == 'Regional Office') {
                    //         $releventRole =  $handlerData['regional_office'];
                    //         $handlerData['district_office'] = '';
                    //         $handlerData['service_centre'] = '';
                    //         $handlerData['activity_centre'] = '';
                    //         $handlerData['production_division'] = '';
                    //     } else if ($handlerData['office'] == 'Production Division') {
                    //         $releventRole =  $handlerData['production_division'];
                    //         $focus->column_fields['sys_detect_role'] = $this->getProductionDivisionRole($releventRole);
                    //         $handlerData['district_office'] = '';
                    //         $handlerData['regional_office'] = '';
                    //         $handlerData['service_centre'] = '';
                    //         $handlerData['activity_centre'] = '';
                    //     } else if ($handlerData['office'] == 'Service Centre') {
                    //         $releventRole =  $handlerData['service_centre'];
                    //         $handlerData['district_office'] = '';
                    //         $handlerData['regional_office'] = IGGetRelventRegionalOfficeBasedOnType($releventRole);
                    //         $handlerData['activity_centre'] = '';
                    //         $handlerData['production_division'] = '';
                    //     } else if ($handlerData['office'] == 'Activity Centre') {
                    //         $releventRole =  $handlerData['activity_centre'];
                    //         $handlerData['district_office'] = '';
                    //         $handlerData['regional_office'] = IGGetRelventRegionalOfficeBasedOnType($releventRole);
                    //         $handlerData['service_centre'] = '';
                    //         $handlerData['production_division'] = '';
                    //     } else if ($handlerData['office'] == 'International Business Division-New Delhi') {
                    //         $releventRole = 'International Business Division-New Delhi';
                    //         $handlerData['district_office'] = '';
                    //         $handlerData['regional_office'] = '';
                    //         $handlerData['service_centre'] = '';
                    //         $handlerData['production_division'] = '';
                    //     }
                    //     if ($handlerData['cust_role'] == 'Service Manager') {
                    //         if ($handlerData['sub_service_manager_role'] == 'Service Manager Support') {
                    //             $focus->column_fields['sys_detect_role'] = $releventRole . ' - Service Manager';
                    //         } else {
                    //             $focus->column_fields['sys_detect_role'] = $releventRole . ' - ' . $handlerData['sub_service_manager_role'];
                    //         }
                    //     } else {
                    //         if ($handlerData['office'] != 'Production Division') {
                    //             $focus->column_fields['sys_detect_role'] = $releventRole . ' - ' . $handlerData['cust_role'];
                    //         }
                    //         if ($handlerData['office'] == 'International Business Division-New Delhi' && $handlerData['cust_role'] == 'BEML Management') {
                    //             $focus->column_fields['sys_detect_role'] = $handlerData['cust_role'];
                    //         }
                    //     }
                    //     if ($handlerData['cust_role'] == 'Service Engineer') {
                    //         $focus->column_fields['ser_usr_log_plat'] = 'Mobile App';
                    //     }
                    // } else {
                    //     $focus->column_fields['sys_detect_role'] = $handlerData['cust_role'];
                    // }

                    foreach ($activeFieldKeys as $activeFieldKey) {
                        if ($activeFieldKey == 'assigned_user_id') {
                            
                            $focus->column_fields['assigned_user_id'] = $this->getParentRoleUserId($handlerData['regional_office'], $handlerData);
                        } else {
                       
                            $focus->column_fields[$activeFieldKey] = $handlerData[$activeFieldKey];
                        }
                    }
                    $focus->column_fields['assigned_user_id'] = $this->getParentRoleUserId($handlerData['regional_office'], $handlerData);
                    $focus->column_fields['source'] = 'MOBILE';
                   
                    $focus->save("Users");
                    $responseObject['phone'] = $focus->column_fields['phone'];
                    $responseObject['usercreatedid'] =  $focus->id;
                    $date = new DateTime();
                    $responseObject['timestamp'] = $date->getTimestamp();
                    $responseObject['message'] = "Thank you for your valuable registration. " .
                        "Verification pending from BEML. " .
                        "After succesful verification, you will be communicated through SMS/Email.";
                    $name = $handlerData['service_engineer_name'];
                    global $smsEndPoint;
                    $text = urlencode("Dear Sir / madam,Hi, $name, Thank you for registering with us on BEML CRM Application. Your account is pending for validation. After Successful validation you will be intimated.BEML CRM Project");
                    $reusultOfCUrl = '';
                    $mobile = $focus->column_fields['phone'];
                    $url = "$smsEndPoint?loginID=beml_htuser&mobile=$mobile&text=$text&senderid=BEMLHQ"
                    . "&DLT_TM_ID=1001096933494158&DLT_CT_ID=1007274055441774716"
                    . "&DLT_PE_ID=1001209734454178165&route_id=DLT_SERVICE_IMPLICT&Unicode=0&camp_name=beml_htuser&password=beml@123";
                    if (!empty($mobile)) {
                        $header = array('Content-Type:multipart/form-data');
                        $resource = curl_init();
                        curl_setopt($resource, CURLOPT_URL, $url);
                        curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
                        curl_setopt($resource, CURLOPT_POST, 1);
                        curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($resource, CURLOPT_POSTFIELDS, array());
                        $reusultOfCUrl = trim(curl_exec($resource));
                    }

                    $response->setApiSucessMessage("Successfully User Is Created");
                    $response->setResult($responseObject);
                   // $shortURLModel->delete();
                    return $response;
                }
            } else {
                $response->setError(100, "OTP Is Invalid");
                return $response;
            }
        } else {
            $response->setError(100, "UID Is Invalid");
            return $response;
        }
    }

    function getProductionDivisionRole($releventRole) {
        $role = '';
        switch ($releventRole) {
            case "EM Division":
                $role = 'EM DIVISION, KGF';
                break;
            case "Engine Division":
                $role = 'ENGINE DIVISION';
                break;
            case "Truck Division":
                $role = "TRUCK DIVISION, MYSORE";
                break;
            case "H&P Division":
                $role = "H&P DIVISION";
                break;
            case "Palakkad Division":
                $role = "DEFENCE PRODUCTION, PALAKKAD";
                break;
            default:
                $role = '';
        }
        return $role;
    }

    function getParentRoleUserId($roleName, $data) {
        // $parentRole = $this->getParentRole($roleName);
        // only for service engineeres
        $office = $data['office'];
        $parentRole = '';
        if ($data['cust_role'] == 'Service Engineer') {
            if ($data['office'] == 'District Office') {
                $parentRole =  $data['district_office'] . ' - DISTRICT SERVICE MANAGER';
            } else if ($data['office'] == 'Regional Office') {
                $parentRole =  $data['regional_office'] . ' - REGIONAL SERVICE MANAGER';
            } else if ($data['office'] == 'Service Centre') {
                $parentRole =  $data['service_centre'] . ' - SERVICE CENTRE IN-CHARGE';
            } else if ($office == 'Activity Centre') {
                $parentRole =  $data['regional_office'] . ' - REGIONAL SERVICE MANAGER'; // todo
            } else if ($office == 'International Business Division-New Delhi') {
                $parentRole =  'International Business Division-New Delhi - IBD Service Manager';
            }
        } elseif ($data['cust_role'] == 'Service Manager') {
            if (
                $data['sub_service_manager_role'] == 'Sales Manager'
                || $data['sub_service_manager_role'] == 'Parts Manager'
            ) {
                $parentRole = $data['regional_office'] . ' - REGIONAL MANAGER';
            } else if (
                $data['sub_service_manager_role'] == 'District Service Manager'
                || $data['sub_service_manager_role'] == 'District Manager'
            ) {
                $parentRole = '';
            } else if (
                $data['sub_service_manager_role'] == 'Regional Manager'
                || $data['sub_service_manager_role'] == 'Regional Service Manager'
            ) {
                $parentRole = '';
            } else if ($data['sub_service_manager_role'] == 'Service Centre In-charge' && $data['office'] == 'Service Centre') {
                $parentRole = '';
            } else if ($data['sub_service_manager_role'] == 'Service Manager Support' && $data['office'] == 'District Office') {
                $parentRole = $data['district_office'] . ' - DISTRICT SERVICE MANAGER';
            } else if ($data['sub_service_manager_role'] == 'Service Manager Support' && $data['office'] == 'Service Centre') {
                $parentRole = $data['service_centre'] . ' - SERVICE CENTRE IN-CHARGE';
            } else if ($data['sub_service_manager_role'] == 'Service Manager Support') {
                $parentRole = $data['regional_office'] . ' - REGIONAL SERVICE MANAGER';
            } else if ($data['sub_service_manager_role'] == 'Service Centre In-charge') {
                $parentRole = '';
            }
        }

        $userId = $this->getUserIdOfRole($parentRole);
        if (empty($userId)) {
            return 1;
            // $this->getParentRoleUserId($parentRole);
        } else {
            return $userId;
        }
    }

    function getUserIdOfRole($roleName) {
        global $adb;
        $sql = "SELECT userid FROM `vtiger_role` 
		INNER JOIN `vtiger_user2role` ON `vtiger_user2role`.`roleid` = `vtiger_role`.`roleid` 
		where rolename = ?";
        $result = $adb->pquery($sql, array($roleName));
        $userIds = [];
        while ($row = $adb->fetchByAssoc($result)) {
            array_push($userIds, $row['userid']);
        }
        if (empty($userIds)) {
            return 1;
        }
        $userSql = "SELECT `vtiger_users`.id FROM `vtiger_users`
		where `vtiger_users`.id  in (" . generateQuestionMarks($userIds) . ") ";
        $result = $adb->pquery($userSql, $userIds);
        $userIdsWithVeri = [];
        while ($row = $adb->fetchByAssoc($result)) {
            array_push($userIdsWithVeri, $row['id']);
        }
        if (empty($userIdsWithVeri)) {
            return 1;
        }
        $date = date('Y-m-d');
        $userSql = "SELECT count(*) as counte , `vtiger_crmentity`.smownerid FROM `vtiger_users` 
		INNER JOIN `vtiger_users` ON `vtiger_users`.`user_name` = `vtiger_users`.`user_name` 
        INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_users.id
		where `vtiger_crmentity`.smownerid  in (" . generateQuestionMarks($userIdsWithVeri) . ")
        and `vtiger_crmentity`.createdtime < concat('$date',' 23:59:59') and `vtiger_crmentity`.createdtime > concat('$date',' 00:00:00')
        and vtiger_crmentity.deleted = 0 GROUP BY smownerid ORDER BY counte ASC ";

        $result = $adb->pquery($userSql, $userIdsWithVeri);
        $dataRow = $adb->fetchByAssoc($result, 0);
        $num_rows = $adb->num_rows($result);
        if (empty($dataRow)) {
            return $userIdsWithVeri[0];
        } else if ($num_rows != count($userIdsWithVeri)) {
            $allExt = [];
            for ($j = 0; $j < $num_rows; $j++) {
                $verId = $adb->query_result($result, $j, 'smownerid');
                array_push($allExt, $verId);
            }
            $nonExt = array_diff($userIdsWithVeri, $allExt);
            foreach ($nonExt as $nonExtId) {
                return $nonExtId;
            }
        } else {
            return $dataRow['smownerid'];
        }
    }

    function getAssignedPerson() {
        return 1;
    }

    function getActiveFields($module, $withPermissions = false) {
        $activeFields = Vtiger_Cache::get('Users', 'activeFields'); // need to flush cache when fields updated at CRM settings

        if (empty($activeFields)) {
            global $adb;
            $sql = "SELECT name, fieldinfo FROM vtiger_customerportal_fields INNER JOIN vtiger_tab ON vtiger_customerportal_fields.tabid=vtiger_tab.tabid";
            $sqlResult = $adb->pquery($sql, array());
            $num_rows = $adb->num_rows($sqlResult);
       
            for ($i = 0; $i < $num_rows; $i++) {
            
                $retrievedModule = $adb->query_result($sqlResult, $i, 'name');
                $fieldInfo = $adb->query_result($sqlResult, $i, 'fieldinfo');
                $activeFields[$retrievedModule] = $fieldInfo;
                echo $activeFields[$retrievedModule];
               
            }
            Vtiger_Cache::set('Users', 'activeFields', $activeFields);
        }

        $fieldsJSON = $activeFields[$module];
        print_r($fieldsJSON);
        $data = Zend_Json::decode(decode_html($fieldsJSON));
        $fields = array();

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (self::isViewable($key, $module)) {
                    if ($withPermissions) {
                        $fields[$key] = $value;
                    } else {
                        $fields[] = $key;
                    }
                }
            }
        }
        return $fields;
    }

    function isViewable($fieldName, $module) {
        global $db;
        $db = PearDatabase::getInstance();
        $tabidSql = "SELECT tabid from vtiger_tab WHERE name = ?";
        $tabidResult = $db->pquery($tabidSql, array($module));
        if ($db->num_rows($tabidResult)) {
            $tabId = $db->query_result($tabidResult, 0, 'tabid');
        }
        $presenceSql = "SELECT presence,displaytype FROM vtiger_field WHERE fieldname=? AND tabid = ?";
        $presenceResult = $db->pquery($presenceSql, array($fieldName, $tabId));
        $num_rows = $db->num_rows($presenceResult);
        if ($num_rows) {
            $fieldPresence = $db->query_result($presenceResult, 0, 'presence');
            $displayType = $db->query_result($presenceResult, 0, 'displaytype');
            if ($fieldPresence == 0 || $fieldPresence == 2 && $displayType !== 4) {
                return true;
            } else {
                return false;
            }
        }
    }

    function fixUIType($module, $fieldname, $uitype) {
        if ($module == 'Contacts' || $module == 'Leads') {
            if ($fieldname == 'salutationtype') {
                return 16;
            }
        }
        return $uitype;
    }
}
