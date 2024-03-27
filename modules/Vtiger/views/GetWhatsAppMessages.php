<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouMultiCompany license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You  s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */ 
 
class Vtiger_GetWhatsAppMessages_View extends Vtiger_IndexAjax_View  
{
    function __construct() {
        parent::__construct();
        $this->exposeMethod('getWhatsAppMessages');
    }
    
    /*public function requiresPermission(Vtiger_Request $request){
		return true;
	}*/
	
	public function checkPermission(Vtiger_Request $request){
	    
		return true;
	}

    function process(Vtiger_Request $request) {
        $mode = $request->getMode();
        if(!empty($mode)) {
            echo $this->invokeExposedMethod($mode, $request);
            return;
        }
    }

    public function getWhatsAppMessages(Vtiger_Request $request) {
        global $adb;
        $date = date('Y-m-d H:i:s');
        
        $query = $adb->pquery("SELECT * FROM received_whatsapp_message WHERE status = 'unread' ORDER BY id DESC", array());
        
        $unreadMessages = array();
        for($i=0;$i < $adb->num_rows($query);$i++) {
		    $fromNumber = $query->fields['fromNumber'];
		    $createdAt = $query->fields['createdAt'];
		    $messages = $adb->query_result($query,$i,'messages');
		     
		    //$adb->pquery("UPDATE received_whatsapp_message SET status = 'read' WHERE fromNumber = ?", array($fromNumber));  
		     
		    if($request->get('sourcemodule') == 'Leads'){
		        $leadsQuery = $adb->pquery("SELECT * FROM vtiger_leaddetails INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_leaddetails.leadid INNER JOIN vtiger_leadaddress ON vtiger_leadaddress.leadaddressid = vtiger_leaddetails.leadid WHERE vtiger_crmentity.deleted = 0 AND vtiger_leadaddress.mobile LIKE '%".substr($fromNumber, 2)."%'", array());
		        
		        $lead_no = $adb->query_result($leadsQuery,0,'lead_no');
		        $customername = $adb->query_result($leadsQuery,0,'firstname').' '.$adb->query_result($leadsQuery,0,'lastname');
		        
		    }else if($request->get('sourcemodule') == 'Potentials'){
		        $leadsQuery = $adb->pquery("SELECT * FROM vtiger_potential INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_potential.potentialid WHERE vtiger_crmentity.deleted = 0 AND vtiger_potential.mobile LIKE '%".substr($fromNumber, 2)."%'", array());
		        
		        $lead_no = $adb->query_result($leadsQuery,0,'potential_no');
		        $customername = $adb->query_result($leadsQuery,0,'potential_no');
		        
		    }else if($request->get('sourcemodule') == 'Project'){
		        $leadsQuery = $adb->pquery("SELECT * FROM vtiger_project INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_project.projectid INNER JOIN vtiger_projectcf ON vtiger_projectcf.projectid = vtiger_project.projectid WHERE vtiger_crmentity.deleted = 0 AND vtiger_projectcf.cf_1185 LIKE '%".substr($fromNumber, 2)."%'", array());
		        
		        $lead_no = $adb->query_result($leadsQuery,0,'project_no');
		        $customername = $adb->query_result($leadsQuery,0,'projectname');
		        
		    }
		    if($lead_no){
		        $unreadMessages[] = array('fromNumber' => $fromNumber, 'messages' => $messages, 'createdAt' => $createdAt, 'lead_no' => $lead_no, 'customername' => $customername);
		    }
		}
        
        $viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
        
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('unreadMessages', $unreadMessages);

		echo $viewer->view('GetWhatsAppMessages.tpl', 'Vtiger', true);
		
    }

}