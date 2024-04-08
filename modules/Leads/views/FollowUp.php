<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Leads_FollowUp_View extends Vtiger_IndexAjax_View {

	function __construct() {
		parent::__construct();
		$this->exposeMethod('follow1st');
		$this->exposeMethod('follow2nd');
		$this->exposeMethod('inccaVisit');
		$this->exposeMethod('follow3rd');
		$this->exposeMethod('advancePayment');
		$this->exposeMethod('quotesReady');
		$this->exposeMethod('siteVisit');
		$this->exposeMethod('design2d');
		$this->exposeMethod('design3d');
	}

	function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if(!empty($mode)) {
			echo $this->invokeExposedMethod($mode, $request);
			return;
		}
	}

	public function follow1st(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$follow1st = $request->get('checkboxvalue');
		if($follow1st == 'true'){
			$followup1st = 1;
		}else if($follow1st == 'false'){
			$followup1st = 0;
		}

		global $adb;
		$query = $adb->pquery("SELECT * FROM vtiger_leads_followup WHERE leadsid = ?", array($recordId));
		$row = $adb->num_rows($query);
		if($row){
			$adb->pquery("UPDATE vtiger_leads_followup SET 1stfollow = ? WHERE leadsid = ?", array($followup1st, $recordId));
		}else{
			$adb->pquery("INSERT INTO vtiger_leads_followup(leadsid, 1stfollow, 2ndfollow, 3rdfollow) VALUES (?,?,?,?)", array($recordId, $followup1st, 0, 0));
		}
	}

	public function follow2nd(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$follow2nd = $request->get('checkboxvalue');
		if($follow2nd == 'true'){
			$followup2nd = 1;
		}else if($follow2nd == 'false'){
			$followup2nd = 0;
		}

		global $adb;
		$query = $adb->pquery("SELECT * FROM vtiger_leads_followup WHERE leadsid = ?", array($recordId));
		$row = $adb->num_rows($query);
		if($row){
			$adb->pquery("UPDATE vtiger_leads_followup SET 2ndfollow = ? WHERE leadsid = ?", array($followup2nd, $recordId));
		}else{
			$adb->pquery("INSERT INTO vtiger_leads_followup(leadsid, 1stfollow, 2ndfollow, 3rdfollow) VALUES (?,?,?,?)", array($recordId, 0, $followup2nd, 0));
		}
	}
	
	public function inccaVisit(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$inccaVisit = $request->get('checkboxvalue');
		if($inccaVisit == 'true'){
			$inccaVisits = 1;
		}else if($inccaVisit == 'false'){
			$inccaVisits = 0;
		}

		global $adb;
		$query = $adb->pquery("SELECT * FROM vtiger_leads_followup WHERE leadsid = ?", array($recordId));
		$row = $adb->num_rows($query);
		if($row){
			$adb->pquery("UPDATE vtiger_leads_followup SET inccaVisit = ? WHERE leadsid = ?", array($inccaVisits, $recordId));
		}else{
			$adb->pquery("INSERT INTO vtiger_leads_followup(leadsid, 1stfollow, 2ndfollow, inccaVisit, 3rdfollow) VALUES (?,?,?,?,?)", array($recordId, 0, 0, $inccaVisits, 0));
		}
		

		$getLeadData = $adb->pquery("SELECT * FROM vtiger_leadaddress WHERE leadaddressid = ?", array($recordId));
		if ($adb->num_rows($getLeadData) > 0) {
			$leadRecord = $adb->fetchByAssoc($getLeadData);
			$mobile = $leadRecord['mobile'];
			if($inccaVisits == 1){
				$midlewareQuery = "SELECT id, middlewareurl, authtoken FROM middleware";
				$midlewareResult = $adb->pquery($midlewareQuery);
				$midlewareRow = $adb->fetchByAssoc($midlewareResult);
				$middlewareurl = $midlewareRow['middlewareurl'];
				$authtoken = $midlewareRow['authtoken'];
				$url = $middlewareurl . 'send-template';
				$headers = array(
					'Authorization: '. $authtoken,
					'Content-Type: application/json'
				);
				$data = array(
					"to" => "91".$mobile,
					"name" => "innca_1st_visit_feedback"
				);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_exec($ch);
				curl_close($ch);
			}
		}
	}

	public function follow3rd(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$follow3rd = $request->get('checkboxvalue');
		if($follow3rd == 'true'){
			$followup3rd = 1;
		}else if($follow3rd == 'false'){
			$followup3rd = 0;
		}

		global $adb;
		$query = $adb->pquery("SELECT * FROM vtiger_leads_followup WHERE leadsid = ?", array($recordId));
		$row = $adb->num_rows($query);
		if($row){
			$adb->pquery("UPDATE vtiger_leads_followup SET 3rdfollow = ? WHERE leadsid = ?", array($followup3rd, $recordId));
		}else{
			$adb->pquery("INSERT INTO vtiger_leads_followup(leadsid, 1stfollow, 2ndfollow, 3rdfollow) VALUES (?,?,?,?)", array($recordId, 0, 0, $followup3rd));
		}
	}

	public function advancePayment(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$advancePayment = $request->get('checkboxvalue');
		if($advancePayment == 'true'){
			$advancePayment = 1;
		}else if($advancePayment == 'false'){
			$advancePayment = 0;
		}
		
		global $adb;
		$query = $adb->pquery("SELECT * FROM vtiger_oppo_followup WHERE oppoid = ?", array($recordId));
		$row = $adb->num_rows($query);
		if($row){
			$adb->pquery("UPDATE vtiger_oppo_followup SET advancePayment = ? WHERE oppoid = ?", array($advancePayment, $recordId));
		}else{
			$adb->pquery("INSERT INTO vtiger_oppo_followup(oppoid, advancePayment, quotesReady, siteVisit, design2d, design3d) VALUES (?,?,?,?,?,?)", array($recordId, $advancePayment, 0, 0, 0, 0));
		}

		$getPotentialData = $adb->pquery("SELECT * FROM vtiger_potential WHERE potentialid = ?", array($recordId));
		if ($adb->num_rows($getPotentialData) > 0) {
			$potentialRecord = $adb->fetchByAssoc($getPotentialData);
			$mobile = $potentialRecord['mobile']; 
	
			if($advancePayment == 1){
				$midlewareQuery = "SELECT id, middlewareurl, authtoken FROM middleware";
				$midlewareResult = $adb->pquery($midlewareQuery);
				$midlewareRow = $adb->fetchByAssoc($midlewareResult);
				$middlewareurl = $midlewareRow['middlewareurl'];
				// echo $middlewareurl;
				$authtoken = $midlewareRow['authtoken'];
			// echo $authtoken;
				$url = $middlewareurl . 'send-template';
				// echo $url; exit;
				$headers = array(
					'Authorization: '. $authtoken,
					'Content-Type: application/json'
				);
				$data = array(
					"to" => "91".$mobile,
					"name" => "innca_acknowledement_msg"
				);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($ch);
				print_r($response);
				curl_close($ch);
			}
		}
	}		

	public function quotesReady(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$quotesReady = $request->get('checkboxvalue');
		if($quotesReady == 'true'){
			$quotesReady = 1;
		} else if($quotesReady == 'false'){
			$quotesReady = 0;
		}
	
		global $adb;
		$query = $adb->pquery("SELECT * FROM vtiger_oppo_followup WHERE oppoid = ?", array($recordId));
		$row = $adb->num_rows($query);
		if($row){
			$adb->pquery("UPDATE vtiger_oppo_followup SET quotesReady = ? WHERE oppoid = ?", array($quotesReady, $recordId));
		} else {
			$adb->pquery("INSERT INTO vtiger_oppo_followup(oppoid, advancePayment, quotesReady, siteVisit, design2d, design3d) VALUES (?,?,?,?,?,?)", array($recordId, 0, $quotesReady, 0, 0, 0));
		}
	
		$getPotentialData = $adb->pquery("SELECT * FROM vtiger_potential WHERE potentialid = ?", array($recordId));
		if ($adb->num_rows($getPotentialData) > 0) {
			$potentialRecord = $adb->fetchByAssoc($getPotentialData);
			$mobile = $potentialRecord['mobile']; 
			// print_r($mobile); exit;
			if($quotesReady == 1){
				$record = '';
				$query = $adb->pquery("SELECT relcrmid FROM vtiger_crmentityrel WHERE crmid = ? AND module = 'Potentials' AND relmodule = 'Quotes'", array($recordId));
				if ($query && $adb->num_rows($query) > 0) {
					$relationRow = $adb->fetchByAssoc($query);
					$record = $relationRow['relcrmid'];
				}
			
				if (!empty($record)) {
					$getDataPDF = $adb->pquery("SELECT body FROM vtiger_pdfmaker WHERE module = ?", array('Quotes'));
					if ($getDataPDF && $adb->num_rows($getDataPDF) > 0) {
						$row = $adb->fetchByAssoc($getDataPDF);
						$body = $row['body'];
						// Include MPDF library
						require_once 'libraries/mpdf/mpdf/mpdf.php';
			
						$module = 'Quotes';
						$language = 'en_us';
						// Initialize MPDF instance
						$mpdf = new Mpdf('c','A4','','',15,15,15,15,15,15);  
						
						// Generate PDF content
						$pdfContent = Leads_FollowUp_View::GetPreparedMPDF($mpdf, $record, $module, $language);
						
						// Print the directory path for debugging
						$pdfDirectory = 'C:\\xampp\\htdocs\\innca\\QuotePdf\\';
	
						// Generate a unique file name for the PDF
						$pdfFileName = $pdfDirectory . $this->GenerateName($record, $module) . '.pdf';
						$pdfFileLink = $this->GenerateName($record, $module) . '.pdf';
						// Save the PDF content to the file
						file_put_contents($pdfFileName, $pdfContent);
	
						// Set headers for PDF download
						header('Pragma: public');
						header('Expires: 0');
						header('Content-Type: application/pdf');
						header('Content-Disposition: attachment; filename="' . basename($pdfFileName) . '"');
						header('Content-Length: ' . filesize($pdfFileName));
	
						// Send the file for download
						// readfile($pdfFileName);
					}
				}
				$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
				$hostname = $_SERVER['HTTP_HOST'];
				$pdfLink = "$protocol://$hostname/innca/" . $pdfFileLink;
				$midlewareQuery = "SELECT id, middlewareurl, authtoken FROM middleware";
				$midlewareResult = $adb->pquery($midlewareQuery);
				$midlewareRow = $adb->fetchByAssoc($midlewareResult);
				$middlewareurl = $midlewareRow['middlewareurl'];
				$authtoken = $midlewareRow['authtoken'];
				$url = $middlewareurl . 'send-template';
				$headers = array(
					'Authorization: '. $authtoken,
					'Content-Type: application/json'
				);
				
				// Send first template
				$data = array(
					"to" => "91".$mobile,
					"name" => "innca_quotation_acceptance",
					"components" => array(
						array(
							"type" => "header",
							"parameters" => array(
								array(
									"type" => "document",
									"document" => array(
										"link" => $pdfLink,
									)
								)
							)
						)
					)
				);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response1 = curl_exec($ch);
				print_r($response1);
				curl_close($ch);
				
				// Send second template
				$data1 = array(
					"to" => "91".$mobile,
					"name" => "innca_qrcode_message",
					"components" => array(
						array(
							"type" => "header",
							"parameters" => array(
								array(
									"type" => "image",
									"image" => array(
										"link" => "https://qrcg-free-editor.qr-code-generator.com/main/assets/images/websiteQRCode_noFrame.png",
									)
								)
							)
						)
					)
				);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data1));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response2 = curl_exec($ch);
				print_r($response2); 
				curl_close($ch);
			}
		}
	}
	

	// start site visit
	public function siteVisit(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$siteVisit = $request->get('checkboxvalue');
		if($siteVisit == 'true'){
			$siteVisit = 1;
		} else if($siteVisit == 'false'){
			$siteVisit = 0;
		}
	
		global $adb;
		$query = $adb->pquery("SELECT * FROM vtiger_oppo_followup WHERE oppoid = ?", array($recordId));
		$row = $adb->num_rows($query);
		if($row){
			$adb->pquery("UPDATE vtiger_oppo_followup SET siteVisit = ? WHERE oppoid = ?", array($siteVisit, $recordId));
		} else {
			$adb->pquery("INSERT INTO vtiger_oppo_followup(oppoid, advancePayment, quotesReady, siteVisit, design2d, design3d) VALUES (?,?,?,?,?,?)", array($recordId, 0, 0, $siteVisit, 0, 0));
		}

		
		$getPotentialData = $adb->pquery("SELECT * FROM vtiger_potential WHERE potentialid = ?", array($recordId));
		if ($adb->num_rows($getPotentialData) > 0) {
			$potentialRecord = $adb->fetchByAssoc($getPotentialData);
			$mobile = $potentialRecord['mobile']; 
			
			if($siteVisit == 1){
				$record = '';
				$query = $adb->pquery("SELECT relcrmid FROM vtiger_crmentityrel WHERE crmid = ? AND module = 'Potentials' AND relmodule = 'Quotes'", array($recordId));
				if ($query && $adb->num_rows($query) > 0) {
					$relationRow = $adb->fetchByAssoc($query);
					$record = $relationRow['relcrmid'];
				}
			
				if (!empty($record)) {
					$getDataPDF = $adb->pquery("SELECT body FROM vtiger_pdfmaker WHERE module = ?", array('Quotes'));
					if ($getDataPDF && $adb->num_rows($getDataPDF) > 0) {
						$row = $adb->fetchByAssoc($getDataPDF);
						$body = $row['body'];
					
						require_once 'libraries/mpdf/mpdf/mpdf.php';
			
						$module = 'Quotes';
						$language = 'en_us';
		
						$mpdf = new Mpdf('c','A4','','',15,15,15,15,15,15,'UTF-8');  
					
						$pdfContent = Leads_FollowUp_View::GetPreparedMPDF($mpdf, $record, $module, $language);
						
						$pdfDirectory = 'C:\\xampp\\htdocs\\innca\\QuotePdf\\';

						$pdfFileName = $pdfDirectory . $this->GenerateName($record, $module) . '.pdf';
						$pdfFileLink = $this->GenerateName($record, $module) . '.pdf';
					
						file_put_contents($pdfFileName, $pdfContent);

						header('Pragma: public');
						header('Expires: 0');
						header('Content-Type: application/pdf');
						header('Content-Disposition: attachment; filename="' . basename($pdfFileName) . '"');
						header('Content-Length: ' . filesize($pdfFileName));

						// readfile($pdfFileName);
					}
				}
				$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
				$hostname = $_SERVER['HTTP_HOST'];
				$pdfLink = "$protocol://$hostname/innca/" . $pdfFileLink;
				$midlewareQuery = "SELECT id, middlewareurl, authtoken FROM middleware";
				$midlewareResult = $adb->pquery($midlewareQuery);
				$midlewareRow = $adb->fetchByAssoc($midlewareResult);
				$middlewareurl = $midlewareRow['middlewareurl'];
				$authtoken = $midlewareRow['authtoken'];
				$url = $middlewareurl . 'send-template';
                $headers = array(
                    'Authorization: '. $authtoken,
                    'Content-Type: application/json'
                );
               
                $data = array(
                    "to" => "91".$mobile,
                    "name" => "innca_2nd_visit_feedback_template",
                    "components" => array(
                        array(
                            "type" => "header",
                            "parameters" => array(
                                array(
                                    "type" => "document",
                                    "document" => array(
                                        "link" => $pdfLink,
                                    )
                                )
                            )
                        )
                    )
                );
           
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                print_r($response);
                curl_close($ch);	
			}
		}
	}
	
	public function GetPreparedMPDF(&$mpdf, $record, $module, $language) {
		$header_html = '';
		$body_html = '';
		$footer_html = '';
	
		$focus = CRMEntity::getInstance($module);
		foreach ($focus->column_fields as $cf_key => $cf_value) {
			$focus->column_fields[$cf_key] = '';
		}
		$focus->retrieve_entity_info($record, $module);
		$focus->id = $record;
	
		$PDFContent = $this->GetPDFContentRef($module, $focus, $language);
		$Settings = $PDFContent->getSettingsForModule($module);
		$pdf_content = $PDFContent->getContent();

		$header_html = $pdf_content["header"];
		$body_html = $pdf_content["body"];
		$footer_html = $pdf_content["footer"];
	
		 $mpdf->SetFont('Arial Unicode MS', '', 12);

		$header_html_with_symbol = $header_html;
		$body_html_with_symbol =  $body_html;
		$footer_html_with_symbol =  $footer_html;

		// Convert HTML content to HTML entities with proper encoding
		$header_html_with_symbol = mb_convert_encoding($header_html, 'HTML-ENTITIES', 'UTF-8');
		$body_html_with_symbol = mb_convert_encoding($body_html, 'HTML-ENTITIES', 'UTF-8');
		$footer_html_with_symbol = mb_convert_encoding($footer_html, 'HTML-ENTITIES', 'UTF-8');

		// Write HTML content to mPDF with explicit encoding
		$mpdf->WriteHTML($header_html_with_symbol);
	 	$mpdf->WriteHTML($body_html_with_symbol);
		$mpdf->WriteHTML($footer_html_with_symbol);
		// Output the PDF content
		$pdfContent = $mpdf->Output('', 'S');
		
		return $pdfContent;
	}

	public function GenerateName($record, $module) {
		$focus = CRMEntity::getInstance($module);
		$focus->retrieve_entity_info($record, $module);
		$module_tabid = getTabId($module);
		global $adb; 
		$result = $adb->pquery("SELECT fieldname FROM vtiger_field WHERE uitype=? AND tabid=?", array('4', $module_tabid));
		if ($adb->num_rows($result) > 0) {
			$fieldname = $adb->query_result($result, 0, "fieldname");
			if (isset($focus->column_fields[$fieldname]) && $focus->column_fields[$fieldname] != "") {
				$name = $focus->column_fields[$fieldname];
			} else {
				$name = 'DefaultName_' . $record . '_' . date("ymdHi");
			}
		} else {
			$name = 'DefaultName_' . $record . '_' . date("ymdHi");
		}
		return $name;
	}
	
	public function GetPDFContentRef($module, $focus, $language) {
        return new PDFMaker_PDFContent_Model($module, $focus, $language);
    }
	// end Site visit

	public function design2d(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$design2d = $request->get('checkboxvalue');
		if($design2d == 'true'){
			$design2d = 1;
		}else if($design2d == 'false'){
			$design2d = 0;
		}

		global $adb;
		$query = $adb->pquery("SELECT * FROM vtiger_oppo_followup WHERE oppoid = ?", array($recordId));
		$row = $adb->num_rows($query);
		if($row){
			$adb->pquery("UPDATE vtiger_oppo_followup SET design2d = ? WHERE oppoid = ?", array($design2d, $recordId));
		}else{
			$adb->pquery("INSERT INTO vtiger_oppo_followup(oppoid, advancePayment, quotesReady, siteVisit, design2d, design3d) VALUES (?,?,?,?,?,?)", array($recordId, 0, 0, 0, $design2d, 0));
		}

	}

	public function design3d(Vtiger_Request $request) {
		$recordId = $request->get('record');
		$design3d = $request->get('checkboxvalue');
		if($design3d == 'true'){
			$design3d = 1;
		}else if($design3d == 'false'){
			$design3d = 0;
		}

		global $adb;
		$query = $adb->pquery("SELECT * FROM vtiger_oppo_followup WHERE oppoid = ?", array($recordId));
		$row = $adb->num_rows($query);
		if($row){
			$adb->pquery("UPDATE vtiger_oppo_followup SET design3d = ? WHERE oppoid = ?", array($design3d, $recordId));
		}else{
			$adb->pquery("INSERT INTO vtiger_oppo_followup(oppoid, advancePayment, quotesReady, siteVisit, design2d, design3d) VALUES (?,?,?,?,?,?)", array($recordId, 0, 0, 0, 0, $design3d));
		}
	}

}
