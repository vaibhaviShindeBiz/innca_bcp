<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Class Inventory_Edit_View extends Vtiger_Edit_View {

	public function process(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$record = $request->get('record');
		$sourceRecord = $request->get('sourceRecord');
		$sourceModule = $request->get('sourceModule');
		if(empty($sourceRecord) && empty($sourceModule)) {
			$sourceRecord = $request->get('returnrecord');
			$sourceModule = $request->get('returnmodule');
		}
		$relatedProducts = null;
		$currencyInfo = null;

		$viewer->assign('MODE', '');
		$viewer->assign('IS_DUPLICATE', false);
		if ($request->has('totalProductCount')) {
			if($record) {
				$recordModel = Vtiger_Record_Model::getInstanceById($record);
			} else {
				$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			}
			$relatedProducts = $recordModel->convertRequestToProducts($request);
			$taxes = $relatedProducts[1]['final_details']['taxes'];
		} else if(!empty($record)  && $request->get('isDuplicate') == true) {
			$recordModel = Inventory_Record_Model::getInstanceById($record, $moduleName);
			$currencyInfo = $recordModel->getCurrencyInfo();
			$taxes = $recordModel->getProductTaxes();
			$relatedProducts = $recordModel->getProducts();

			//While Duplicating record, If the related record is deleted then we are removing related record info in record model
			$mandatoryFieldModels = $recordModel->getModule()->getMandatoryFieldModels();
			foreach ($mandatoryFieldModels as $fieldModel) {
				if ($fieldModel->isReferenceField()) {
					$fieldName = $fieldModel->get('name');
					if (Vtiger_Util_Helper::checkRecordExistance($recordModel->get($fieldName))) {
						$recordModel->set($fieldName, '');
					}
				}
			}
			$viewer->assign('IS_DUPLICATE', true);
		} elseif (!empty($record)) {
			$recordModel = Inventory_Record_Model::getInstanceById($record, $moduleName);
			$currencyInfo = $recordModel->getCurrencyInfo();
			$taxes = $recordModel->getProductTaxes();
			$relatedProducts = $recordModel->getProducts();
			$viewer->assign('RECORD_ID', $record);
			$viewer->assign('MODE', 'edit');
		} elseif (($request->get('salesorder_id') || $request->get('quote_id') || $request->get('invoice_id')) && ($moduleName == 'PurchaseOrder')) {
			if ($request->get('salesorder_id')) {
				$referenceId = $request->get('salesorder_id');
			} elseif ($request->get('invoice_id')) {
				$referenceId = $request->get('invoice_id');
			} else{
				$referenceId = $request->get('quote_id');
			}

			$parentRecordModel = Inventory_Record_Model::getInstanceById($referenceId);
			$currencyInfo = $parentRecordModel->getCurrencyInfo();

			$relatedProducts = $parentRecordModel->getProductsForPurchaseOrder();
			$taxes = $parentRecordModel->getProductTaxes();

			$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			$recordModel->setRecordFieldValues($parentRecordModel);
		} elseif ($request->get('salesorder_id') || $request->get('quote_id')) {
			if ($request->get('salesorder_id')) {
				$referenceId = $request->get('salesorder_id');
			} else {
				$referenceId = $request->get('quote_id');
			}

			$parentRecordModel = Inventory_Record_Model::getInstanceById($referenceId);
			$currencyInfo = $parentRecordModel->getCurrencyInfo();
			$taxes = $parentRecordModel->getProductTaxes();
			$relatedProducts = $parentRecordModel->getProducts();
			$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			$recordModel->setRecordFieldValues($parentRecordModel);
		} else {
			$taxes = Inventory_Module_Model::getAllProductTaxes();
			$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);

			//The creation of Inventory record from action and Related list of product/service detailview the product/service details will calculated by following code
			if ($request->get('product_id') || $sourceModule === 'Products' || $request->get('productid')) {
				if($sourceRecord) {
					$productRecordModel = Products_Record_Model::getInstanceById($sourceRecord);
				} else if($request->get('product_id')) {
					$productRecordModel = Products_Record_Model::getInstanceById($request->get('product_id'));
				} else if($request->get('productid')) {
					$productRecordModel = Products_Record_Model::getInstanceById($request->get('productid'));
				}
				$relatedProducts = $productRecordModel->getDetailsForInventoryModule($recordModel);
			} elseif ($request->get('service_id') || $sourceModule === 'Services') {
				if($sourceRecord) {
					$serviceRecordModel = Services_Record_Model::getInstanceById($sourceRecord);
				} else {
					$serviceRecordModel = Services_Record_Model::getInstanceById($request->get('service_id'));
				}
				$relatedProducts = $serviceRecordModel->getDetailsForInventoryModule($recordModel);
			} elseif ($sourceRecord && in_array($sourceModule, array('Accounts', 'Contacts', 'Potentials', 'Vendors', 'PurchaseOrder'))) {
				$parentRecordModel = Vtiger_Record_Model::getInstanceById($sourceRecord, $sourceModule);
				$recordModel->setParentRecordData($parentRecordModel);
				if ($sourceModule !== 'PurchaseOrder') {
					$relatedProducts = $recordModel->getParentRecordRelatedLineItems($parentRecordModel);
				}
			} elseif ($sourceRecord && in_array($sourceModule, array('HelpDesk', 'Leads'))) {
				$parentRecordModel = Vtiger_Record_Model::getInstanceById($sourceRecord, $sourceModule);
				$relatedProducts = $recordModel->getParentRecordRelatedLineItems($parentRecordModel);
			}
		}

		//New Changes Opp Module
		$potential_id = $request->get('potential_id');
		if($potential_id == ''){
			$potential_id = $recordModel->get('potential_id');
		}

		if($potential_id){
			$oppRecordModel = Vtiger_Record_Model::getInstanceById($potential_id, 'Potentials');
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
			
			$multiplelLineItemBlock = array();
			if($foyer == 1){
				$multiplelLineItemBlock[] = "Foyer";
			}

			if($living == 1){
				$multiplelLineItemBlock[] = "Living";
			}

			if($dining == 1){
				$multiplelLineItemBlock[] = "Dining";
			}

			if($mbr == 1){
				$multiplelLineItemBlock[] = "Master Badroom	";
			}

			if($gbr == 1){
				$multiplelLineItemBlock[] = "Guest Badroom";
			}

			if($kbr == 1){
				$multiplelLineItemBlock[] = "Kids Badroom";
			}

			if($pooja == 1){
				$multiplelLineItemBlock[] = "Pooja";
			}

			if($drykitchen == 1){
				$multiplelLineItemBlock[] = "Drykitchen";
			}

			if($wetkitchen == 1){
				$multiplelLineItemBlock[] = "Wetkitchen";
			}

			if($servantroom == 1){
				$multiplelLineItemBlock[] = "Servantroom";
			}

			if($appliances == 1){
				$multiplelLineItemBlock[] = "Appliances";
			}

			if($hob == 1){
				$multiplelLineItemBlock[] = "Hob";
			}

			if($chimney == 1){
				$multiplelLineItemBlock[] = "Chimney";
			}

			if($microwave == 1){
				$multiplelLineItemBlock[] = "Microwave";
			}

			if($oven == 1){
				$multiplelLineItemBlock[] = "Oven";
			}

			if($dishwasher == 1){
				$multiplelLineItemBlock[] = "Dishwasher";
			}

			if($coffeemaker == 1){
				$multiplelLineItemBlock[] = "Coffeemaker";
			}

			if($bathroom1 == 1){
				$multiplelLineItemBlock[] = "Bathroom1";
			}

			if($bathroom2 == 1){
				$multiplelLineItemBlock[] = "Bathroom2";
			}

			if($commontoilet == 1){
				$multiplelLineItemBlock[] = "Commontoilet";
			}

			if($balconies == 1){
				$multiplelLineItemBlock[] = "Balconies";
			}

			if($terrace == 1){
				$multiplelLineItemBlock[] = "Terrace";
			}

			$viewer->assign('MILTUPLE_LINE_ITEM_BLOCK', $multiplelLineItemBlock);
			$viewer->assign('MILTUPLE_LINE_ITEM_BLOCK_COUNT', count($multiplelLineItemBlock));

			global $adb;
			if($record==''){
				foreach ($multiplelLineItemBlock as $key => $value) {
					if($value){
						/*$query = $adb->pquery("SELECT * FROM vtiger_products 
							INNER JOIN vtiger_crmentity ON  vtiger_crmentity.crmid = vtiger_products.productid 
							WHERE vtiger_crmentity.deleted = 0 AND vtiger_products.productcategory = ?", array($value));

						$productname = $adb->query_result($query, 0, 'productname');
						$productid = $adb->query_result($query, 0, 'productid');
						$unit_price = str_replace(',', '', number_format($adb->query_result($query, 0, 'unit_price'), 2));*/

						$key = $key + 1;
						$relatedProducts[$key] = array("roww0" => "Acrylic", "purchaseCost".$key => 0, "margin".$key => '', "productDeleted".$key => '', "entityType".$key => "Products", "delRow".$key => "Del", "hdnProductId".$key => $productid, "productName".$key => $productname, "hdnProductcode".$key => '', "productDescription".$key => '', "comment".$key => '', "qtyInStock".$key => '', "qty".$key => 1, "listPrice".$key => $unit_price, "unitPrice".$key => '', "productTotal".$key => '', "subprod_names".$key => '', "discount_percent".$key => 0, "discount_amount".$key => 0, "checked_discount_zero".$key =>  "checked", "discountTotal".$key => 0, "totalAfterDiscount".$key => '', "taxTotal".$key => 0, "netPrice".$key => '', "prdctgry".$key => $value, "usgunit".$key => "Sq Ft", "untpricee".$key => '', "finish_var".$key => "Acrylic", "length_value".$key => 1, "height_value".$key => 1, "glacct".$key => "Acrylic", "sqfoot".$key => 0.00, "totalcost".$key => 0.00, "productImage".$key => '', "productType".$key => $value);
					}
				}
			}
		}
		//New Changes Opp Module



		$deductTaxes = $relatedProducts ? $relatedProducts[1]['final_details']['deductTaxes'] : null;
		if (!$deductTaxes) {
			$deductTaxes = Inventory_TaxRecord_Model::getDeductTaxesList();
		}

		$taxType = $relatedProducts ? $relatedProducts[1]['final_details']['taxtype'] : null;
		$moduleModel = $recordModel->getModule();
		$fieldList = $moduleModel->getFields();
		$requestFieldList = array_intersect_key($request->getAllPurified(), $fieldList);

		//get the inventory terms and conditions
		$inventoryRecordModel = Inventory_Record_Model::getCleanInstance($moduleName);
		$termsAndConditions = $inventoryRecordModel->getInventoryTermsAndConditions();

		foreach($requestFieldList as $fieldName=>$fieldValue) {
			$fieldModel = $fieldList[$fieldName];
			if($fieldModel->isEditable()) {
				$recordModel->set($fieldName, $fieldModel->getDBInsertValue($fieldValue));
			}
		}
		$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);

		$viewer->assign('VIEW_MODE', "fullForm");

		$isRelationOperation = $request->get('relationOperation');

		//if it is relation edit
		$viewer->assign('IS_RELATION_OPERATION', $isRelationOperation);
		if($isRelationOperation) {
			$viewer->assign('SOURCE_MODULE', $sourceModule);
			$viewer->assign('SOURCE_RECORD', $sourceRecord);
		}
		if(!empty($record)  && $request->get('isDuplicate') == true) {
			$viewer->assign('IS_DUPLICATE',true);
		} else {
			$viewer->assign('IS_DUPLICATE',false);
		}
		$currencies = Inventory_Module_Model::getAllCurrencies();
		$picklistDependencyDatasource = Vtiger_DependencyPicklist::getPicklistDependencyDatasource($moduleName);

		$recordStructure = $recordStructureInstance->getStructure();

		$viewer->assign('PICKIST_DEPENDENCY_DATASOURCE',Vtiger_Functions::jsonEncode($picklistDependencyDatasource));
		$viewer->assign('RECORD',$recordModel);
		$viewer->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
		$viewer->assign('RECORD_STRUCTURE', $recordStructure);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('CURRENTDATE', date('Y-n-j'));
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());

		$taxRegions = $recordModel->getRegionsList();
		$defaultRegionInfo = $taxRegions[0];
		unset($taxRegions[0]);

		$viewer->assign('TAX_REGIONS', $taxRegions);
		$viewer->assign('DEFAULT_TAX_REGION_INFO', $defaultRegionInfo);
		$viewer->assign('INVENTORY_CHARGES', Inventory_Charges_Model::getInventoryCharges());
		$viewer->assign('RELATED_PRODUCTS', $relatedProducts);
		$viewer->assign('DEDUCTED_TAXES', $deductTaxes);
		$viewer->assign('TAXES', $taxes);
		$viewer->assign('TAX_TYPE', $taxType);
		$viewer->assign('CURRENCINFO', $currencyInfo);
		$viewer->assign('CURRENCIES', $currencies);
		$viewer->assign('TERMSANDCONDITIONS', $termsAndConditions);

		$productModuleModel = Vtiger_Module_Model::getInstance('Products');
		$viewer->assign('PRODUCT_ACTIVE', $productModuleModel->isActive());

		$serviceModuleModel = Vtiger_Module_Model::getInstance('Services');
		$viewer->assign('SERVICE_ACTIVE', $serviceModuleModel->isActive());

		// added to set the return values
		if ($request->get('returnview')) {
			$request->setViewerReturnValues($viewer);
		}

		if ($request->get('displayMode') == 'overlay') {
			$viewer->assign('SCRIPTS', $this->getOverlayHeaderScripts($request));
			echo @$viewer->view('OverlayEditView.tpl', $moduleName);
		} else {
			@$viewer->view('EditView.tpl', 'Inventory');
		}
	}

	/**
	 * Function to get the list of Script models to be included
	 * @param Vtiger_Request $request
	 * @return <Array> - List of Vtiger_JsScript_Model instances
	 */
	function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);

		$moduleName = $request->getModule();
		$modulePopUpFile = 'modules.'.$moduleName.'.resources.Popup';
		$moduleEditFile = 'modules.'.$moduleName.'.resources.Edit';
		unset($headerScriptInstances[$modulePopUpFile]);
		unset($headerScriptInstances[$moduleEditFile]);

		$jsFileNames = array(
				'modules.Inventory.resources.Edit',
				'modules.Inventory.resources.Popup',
				'modules.PriceBooks.resources.Popup',
		);
		$jsFileNames[] = $moduleEditFile;
		$jsFileNames[] = $modulePopUpFile;
		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

	public function getOverlayHeaderScripts(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$modulePopUpFile = 'modules.'.$moduleName.'.resources.Popup';
		$moduleEditFile = 'modules.'.$moduleName.'.resources.Edit';

		$jsFileNames = array(
			'modules.Inventory.resources.Popup',
			'modules.PriceBooks.resources.Popup',
		);
		$jsFileNames[] = $moduleEditFile;
		$jsFileNames[] = $modulePopUpFile;
		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		return $jsScriptInstances;
	}

}
