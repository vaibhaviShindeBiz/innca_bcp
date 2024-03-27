<?php
include_once 'include/Webservices/DescribeObject.php';
include_once('include/utils/GeneralUtils.php');
class Mobile_WS_PreUserSignUp extends Mobile_WS_Controller {


    function requireLogin() {
        return false;
    }

    function process(Mobile_API_Request $request) {
      
        $current_user = CRMEntity::getInstance('Users');
        $current_user->id = $current_user->getActiveAdminId();
        $current_user->retrieve_entity_info($current_user->id, 'Users');
        $describeInfo = vtws_describe('Users', $current_user);
        $emailId = vtlib_purify($request->get('email'));
        $responseObject = [];
        $response = new Mobile_API_Response();
        $firstname = $request->get('first_name');
        $lastname = $request->get('last_name');
        $username = $request->get('email');
      
        $mobileNo = $request->get('phone');
       
        $badgeNoAndMobile = IGisBadgeExits($request->get('email'),$request->get('phone'));
        
        if (!empty($badgeNoAndMobile)) {
            
            if (isset($badgeNoAndMobile['user_name']) && !empty($badgeNoAndMobile['phone_mobile']) && $username == $badgeNoAndMobile['user_name']) {
                $response->setError(100, "Email Already Exits");
                return $response;
            } else if (isset($badgeNoAndMobile['phone_mobile']) && !empty($badgeNoAndMobile['phone_mobile']) && $mobileNo == $badgeNoAndMobile['phone_mobile']) {
                $response->setError(100, "Mobile Number Already Exits");
                return $response;
            }
        }

       if(empty($firstname)){
        $response->setError(100, "Enter First Name");
        return $response;

       }
       if(empty($lastname)){
        $response->setError(100, "Enter Last Name");
        return $response;
       }

       

        $password = $request->get('user_password');
        $confirmPassword = $request->get('confirm_password');
        if($password != $confirmPassword ){
            $response->setError(100, "Password and Confirm Password are Not Same");
            return $response;
        }
        $validation_regex = array('password_regex' => '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})');
        if (preg_match('/'.$validation_regex['password_regex'].'/i', $password) != 1) {
            $response->setError(100, "Password Is Not Strong, Password Must Contain Capital Letters, ".
            "Numbers, Special Charcters, and Small Letters");
            return $response;
        }

        if (!empty($emailId)) {
            
            $time = time();
            $otp = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $options = array(
                'handler_path' => 'modules/Users/handlers/ForgotPassword.php',
                'handler_class' => 'Users_ForgotPassword_Handler',
                'handler_function' => 'changePassword',
                'onetime' => 0
            );
            $handler_data = [];
            $allData = [];
            $activeFields = $this->getActiveFields('Users', true);
          
            $activeFieldKeys = array_keys($activeFields);
            foreach ($activeFieldKeys as $activeFieldKey) {
                foreach ($describeInfo['fields'] as $key => $value) {
                    if (in_array($value['name'], $activeFieldKeys)) {
                        if ($value['mandatory'] == 1 && empty($request->get($value['name']))) {
                            $response->setError(100, 'Mandatory Field - ' . $value['label'] . ' Is Missing');
                            return $response;
                        }
                    }
                }
                if ($activeFieldKey == 'assigned_user_id') {
                    $handler_data['assigned_user_id'] = 1;
                } else {
                    $handler_data[$activeFieldKey] = $request->get($activeFieldKey);
                    $allData[$activeFieldKey] = $request->get($activeFieldKey);
                }
            }
            
            $handler_data['time'] = strtotime("+15 Minute");
            $handler_data['hash'] = md5($emailId . $time);
            $handler_data['otp'] = $otp;
            $options['handler_data'] = $handler_data;
            $trackURL = Vtiger_ShortURL_Helper::generateURLMobile($options);
            $content = 'Dear User,<br><br> 
                 Here is your OTP for Mobile Number verification : ' . $otp . '
                <br><br> 
                This request was made on ' . date("d/m/Y h:i:s a")  . ' and will expire in next 15 Minute.<br><br> 
                Regards,<br> 
                CRM Support Team.<br>';
            $subject = 'CCHS: OTP Verification';

            vimport('~~/modules/Emails/mail.php');
            global $HELPDESK_SUPPORT_EMAIL_ID, $HELPDESK_SUPPORT_NAME;
            $status = send_mail('Users', $emailId, $HELPDESK_SUPPORT_NAME, $HELPDESK_SUPPORT_EMAIL_ID, $subject, $content, '', '', '', '', '', true);
           $status = 1;
            print_r($status);
            if ($status === 1 || $status === true) {
                $responseObject['uid'] = $trackURL;
                $responseObject['otp'] = $otp;
                $response->setApiSucessMessage("OTP has sent to registered email");
                $response->setResult($responseObject);
            } else {
                $response->setError(100, 'Not Able to send email');
            }
        } else {
            $response->setError(100, 'Phone Number Or Email is required to send OTP');

        }
        print_r($handler_data);
        return $response;
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
            }
            Vtiger_Cache::set('CustomerPortal', 'activeFields', $activeFields);
        }

        $fieldsJSON = $activeFields[$module];
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
