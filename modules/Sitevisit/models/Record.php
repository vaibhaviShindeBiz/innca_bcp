<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Sitevisit_Record_Model extends Vtiger_Record_Model {

	/**
	 * Function to get Url to Create a new Invoice from this record
	 * @return <String> Url to Create new Invoice
	 */
	function getCreateInvoiceUrl() {
		$InvoiceModuleModel = Vtiger_Module_Model::getInstance('Invoice');
		 return "index.php?module=". $InvoiceModuleModel ->getName()."&view=". $InvoiceModuleModel->getEditViewName()."&salesorder_id=".$this->getId();
	}

	/**
	 * Function to get Image Details
	 * @return <array> Image Details List
	 */
	public function getImageDetails() {
		
        global $site_URL;
		$db = PearDatabase::getInstance();
		$imageDetails = array();
		$recordId = $this->getId();

		if ($recordId) {
			$sql = "SELECT vtiger_attachments.*, vtiger_crmentity.setype FROM vtiger_attachments
						INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid
						INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_attachments.attachmentsid
						WHERE vtiger_crmentity.setype = 'Sitevisit Image' AND vtiger_seattachmentsrel.crmid = ?";

			$result = $db->pquery($sql, array($recordId));
			$count = $db->num_rows($result);

			for($i=0; $i<$count; $i++) {
                $imageId = $db->query_result($result, $i, 'attachmentsid');
				$imageIdsList[] = $db->query_result($result, $i, 'attachmentsid');
				$imagePathList[] = $db->query_result($result, $i, 'path');
				$storedname[] = $db->query_result($result, $i, 'storedname');
				$imageName = $db->query_result($result, $i, 'name');
                $url = \Vtiger_Functions::getFilePublicURL($imageId, $imageName);

				//decode_html - added to handle UTF-8 characters in file names
				$imageOriginalNamesList[] = urlencode(decode_html($imageName));

				//urlencode - added to handle special characters like #, %, etc.,
				$imageNamesList[] = $imageName;
                $imageUrlsList[] = $url;
				// ============================== lokesh ===== changes
				$descriptionOffield[] = $db->query_result($result, $i, 'description');
				// ============================== lokesh ===== changes
			}

			if(is_array($imageOriginalNamesList)) {
				$countOfImages = count($imageOriginalNamesList);
				for($j=0; $j<$countOfImages; $j++) {
					$imageDetails[] = array(
							'id' => $imageIdsList[$j],
							'orgname' => $imageOriginalNamesList[$j],
							'path' => $imagePathList[$j].$imageIdsList[$j],
							'location' =>$imagePathList[$j].$imageIdsList[$j].'_'.$storedname[$j],
							'name' => $imageNamesList[$j],
                            'url' => $imageUrlsList[$j],
							'field' => $imageUrlsList[$j],
							// ============================== lokesh ===== changes
							'descriptionOffield' => $descriptionOffield[$j]
							// ============================== lokesh ===== changes
					);
				}
			}
		}
		// print_r($imageDetails);
		// die();
		return $imageDetails;
	}

	/**
	 * Function to get images lists of given product records
	 * @param <Array> $recordIdsList
	 * @return <Array> List of images of given products
	 */
	public static function getProductsImageDetails($recordIdsList = false) {
		$db = PearDatabase::getInstance();
		$imageDetails = $imageIdsList = $imagePathList = $imageNamesList = $imageOriginalNamesList = array();
		if ($recordIdsList) {
			$sql = "SELECT vtiger_attachments.*, vtiger_crmentity.setype, vtiger_seattachmentsrel.crmid AS projecttaskid FROM vtiger_attachments
						INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid
						INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_attachments.attachmentsid
						WHERE vtiger_crmentity.setype = 'Sitevisit Image' AND vtiger_seattachmentsrel.crmid IN (".generateQuestionMarks($recordIdsList).")";

			$result = $db->pquery($sql, $recordIdsList);
			$count = $db->num_rows($result);

			for($i=0; $i<$count; $i++) {
				$productId						= $db->query_result($result, $i, 'projecttaskid');
				$imageName						= $db->query_result($result, $i, 'name');
				$productIdsList[$productId]		= $productId;
				$imageIdsList[$productId][]		= $db->query_result($result, $i, 'attachmentsid');
				$imagePathList[$productId][]	= $db->query_result($result, $i, 'path');

				//decode_html - added to handle UTF-8 characters in file names
				$imageOriginalNamesList[$productId][] = decode_html($imageName);

				//urlencode - added to handle special characters like #, %, etc.,
				$imageNamesList[$productId][] = $imageName;
			}

			if(is_array($imageOriginalNamesList)) {
				foreach ($imageOriginalNamesList as $productId => $originalNamesList) {
					$countOfImages = count($originalNamesList);
					for($j=0; $j<$countOfImages; $j++) {
						$imageDetails[$productId][] = array(
														'id'		=> $imageIdsList[$productId][$j],
														'orgname'	=> $imageOriginalNamesList[$productId][$j],
														'path'		=> $imagePathList[$productId][$j].$imageIdsList[$productId][$j],
														'name'		=> $imageNamesList[$productId][$j]
													);
					}
				}
			}
		}
		return $imageDetails;
	}
}
