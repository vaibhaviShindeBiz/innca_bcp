<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

class Potentials_DesignAttachment_View extends Vtiger_IndexAjax_View {

	function __construct() {
		parent::__construct();
		$this->exposeMethod('design2DAttachmentPopup');
		$this->exposeMethod('save2DDesignAttachment');

		$this->exposeMethod('design3DAttachmentPopup');
		$this->exposeMethod('save3DDesignAttachment');
	}

	function process(Vtiger_Request $request) {
		$mode = $request->get('mode');
		if(!empty($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}
	}

	function design2DAttachmentPopup(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$designType = $request->get('designType');
		$recordId = $request->get('recordId');

		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('recordId', $recordId);

		echo $viewer->view('2Dattachment.tpl', $moduleName, true);
	}

	function save2DDesignAttachment(Vtiger_Request $request) {
		global $adb, $current_user, $upload_badext;
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$designType = $request->get('designType');
		$recordId = $request->get('recordId');

		$contactDetail = Potentials_DesignAttachment_View::getContactDetail($recordId);
		$contactname = $contactDetail['contactname'];

		$currentDate = date('Y-m-d');
		
		$siteVisitRecordModel = Vtiger_Record_Model::getCleanInstance('Sitevisit');
		$siteVisitRecordModel->set('visitdate', $currentDate);
		$siteVisitRecordModel->set('sitevisit_oppid', $recordId);
		$siteVisitRecordModel->set('contactname', $contactname);
		$siteVisitRecordModel->save();

		$siteVisitId = $siteVisitRecordModel->getId();
		if($siteVisitId){
			$date_var = date("Y-m-d H:i:s");
			$current_id = $adb->getUniqueID("vtiger_crmentity");

			$adb->pquery("UPDATE vtiger_attachments 
				INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid SET vtiger_attachments.description = 'imagename' WHERE vtiger_seattachmentsrel.crmid = ?", array($siteVisitId));

			$adb->pquery("UPDATE vtiger_crmentity INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_crmentity.crmid SET vtiger_crmentity.setype = 'Sitevisit Image' WHERE vtiger_seattachmentsrel.crmid = ?", array($siteVisitId));

			$loadUrl = 'index.php?module=Potentials&view=Detail&record='.$recordId.'&mode=showDetailViewByMode&requestMode=summary&tab_label=Opportunity Summary&app=SALES';
			header("Location: $loadUrl");
		}
	}

	function design3DAttachmentPopup(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$designType = $request->get('designType');
		$recordId = $request->get('recordId');

		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('recordId', $recordId);

		echo $viewer->view('3Dattachment.tpl', $moduleName, true);
	}

	function save3DDesignAttachment(Vtiger_Request $request) {
		global $adb, $current_user, $upload_badext;
		$viewer = $this->getViewer($request);	
		$moduleName = $request->getModule();
		$designType = $request->get('designType');
		$recordId = $request->get('recordId');

		$contactDetail = Potentials_DesignAttachment_View::getContactDetail($recordId);
		$contactname = $contactDetail['contactname'];

		$currentDate = date('Y-m-d');
		
		$siteVisitRecordModel = Vtiger_Record_Model::getCleanInstance('Sitevisit');
		$siteVisitRecordModel->set('visitdate', $currentDate);
		$siteVisitRecordModel->set('sitevisit_oppid', $recordId);
		$siteVisitRecordModel->set('contactname', $contactname);
		$siteVisitRecordModel->save();

		$siteVisitId = $siteVisitRecordModel->getId();

		if($siteVisitId){
			$adb->pquery("UPDATE vtiger_attachments 
				INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid SET vtiger_attachments.description = 'imagename1' WHERE vtiger_seattachmentsrel.crmid = ?", array($siteVisitId));

			$adb->pquery("UPDATE vtiger_crmentity INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_crmentity.crmid SET vtiger_crmentity.setype = 'Sitevisit Image' WHERE vtiger_seattachmentsrel.crmid = ?", array($siteVisitId));

			$adb->pquery("UPDATE vtiger_sitevisit SET imagename = '', imagename1 = '".$_FILES['3DDesign']['name']."' WHERE sitevisitid = ?", array($siteVisitId));

			$loadUrl = 'index.php?module=Potentials&view=Detail&record='.$recordId.'&mode=showDetailViewByMode&requestMode=summary&tab_label=Opportunity Summary&app=SALES';
			header("Location: $loadUrl");
		}
	}

	function getContactDetail($recordId){
		$oppRecordModel = Vtiger_Record_Model::getInstanceById($recordId);
		$contact_id = $oppRecordModel->get('contact_id');
		if($contact_id){
			$contcactRecordModel = Vtiger_Record_Model::getInstanceById($contact_id);
			$contactname = $contcactRecordModel->get('firstname').' '.$contcactRecordModel->get('lastname');
		}

		$contactDetail = array('contactname' => $contactname);
		return $contactDetail;
	}
}