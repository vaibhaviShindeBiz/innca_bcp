<?php
/***********************************************************************************************
** The contents of this file are subject to the Vtiger Module-Builder License Version 1.3
 * ( "License" ); You may not use this file except in compliance with the License
 * The Original Code is:  Technokrafts Labs Pvt Ltd
 * The Initial Developer of the Original Code is Technokrafts Labs Pvt Ltd.
 * Portions created by Technokrafts Labs Pvt Ltd are Copyright ( C ) Technokrafts Labs Pvt Ltd.
 * All Rights Reserved.
**
*************************************************************************************************/

include_once 'modules/Vtiger/CRMEntity.php';

class Payment extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_payment';
	var $table_index= 'paymentid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array('vtiger_paymentcf', 'paymentid');

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_payment', 'vtiger_paymentcf');
	
	
	/**
	 * Other Related Tables
	 */
	var $related_tables = Array( 
					'vtiger_paymentcf' => Array('paymentid')
					);

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_payment'   => 'paymentid',
	    'vtiger_paymentcf' => 'paymentid');

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = Array (
		/* Format: Field Label => Array(tablename, columnname) */
		// tablename should not have prefix 'vtiger_'
		'Payment No' => Array('payment', 'paymentno'),
/*'Payment No'=> Array('payment', 'paymentno'),*/
		'Assigned To' => Array('crmentity','smownerid')
	);
	var $list_fields_name = Array (
		/* Format: Field Label => fieldname */
		'Payment No' => 'paymentno',
/*'Payment No'=> 'paymentno',*/
		'Assigned To' => 'assigned_user_id'
	);

	// Make the field link to detail view
	var $list_link_field = 'paymentno';

	// For Popup listview and UI type support
	var $search_fields = Array(
		/* Format: Field Label => Array(tablename, columnname) */
		// tablename should not have prefix 'vtiger_'
		'Payment No' => Array('payment', 'paymentno'),
/*'Payment No'=> Array('payment', 'paymentno'),*/
		'Assigned To' => Array('vtiger_crmentity','assigned_user_id'),
	);
	var $search_fields_name = Array (
		/* Format: Field Label => fieldname */
		'Payment No' => 'paymentno',
/*'Payment No'=> 'paymentno',*/
		'Assigned To' => 'assigned_user_id',
	);

	// For Popup window record selection
	var $popup_fields = Array ('paymentno');

	// For Alphabetical search
	var $def_basicsearch_col = 'paymentno';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'paymentno';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = Array('paymentno','assigned_user_id');

	var $default_order_by = 'paymentno';
	var $default_sort_order='ASC';

	/**
	* Invoked when special actions are performed on the module.
	* @param String Module name
	* @param String Event Type
	*/
	function vtlib_handler($moduleName, $eventType) {
		global $adb;
 		if($eventType == 'module.postinstall') {
			// TODO Handle actions after this module is installed.
			Payment::checkWebServiceEntry();
			Payment::createUserFieldTable($moduleName);
			Payment::addInTabMenu($moduleName);
		} else if($eventType == 'module.disabled') {
			// TODO Handle actions before this module is being uninstalled.
		} else if($eventType == 'module.preuninstall') {
			// TODO Handle actions when this module is about to be deleted.
		} else if($eventType == 'module.preupdate') {
			// TODO Handle actions before this module is updated.
		} else if($eventType == 'module.postupdate') {
			// TODO Handle actions after this module is updated.
			Payment::checkWebServiceEntry();
		}
 	}
	
	/*
	 * Function to handle module specific operations when saving a entity
	 */
	function save_module($module)
	{
		global $adb,$log;
		$q = 'SELECT '.$this->def_detailview_recname.' FROM '.$this->table_name. ' WHERE ' . $this->table_index. ' = '.$this->id;
		
		$result =  $adb->pquery($q,array());
		$cnt = $adb->num_rows($result);
		if($cnt > 0) 
		{
			$label = $adb->query_result($result,0,$this->def_detailview_recname);
			$q1 = 'UPDATE vtiger_crmentity SET label = \''.$label.'\' WHERE crmid = '.$this->id;
			$adb->pquery($q1,array());
		}

		$quoteid = $_REQUEST['payment_tks_invoiceno'];
		if($quoteid){
    		$rquery = $adb->pquery("select total, balance, received, conversion_rate from vtiger_quotes q inner join vtiger_crmentity c on q.quoteid=c.crmid where c.deleted= 0 and q.quoteid=".$quoteid);
    		$total = $adb->query_result($rquery , 0 ,'total');
    		$balance = $adb->query_result($rquery , 0 ,'balance');
    		$received = $adb->query_result($rquery , 0 ,'received');
    	    $conversion_rate = $adb->query_result($rquery , 0 ,'conversion_rate');
    
    		$payment = $_REQUEST['payment_tks_paymenttotal'];
    
    		if($balance == 0){
    		   $exbalance = $total - $payment;
    		   $adb->pquery("update vtiger_quotes set received=".$payment.", balance =".$exbalance." where quoteid=".$quoteid);
    		   $log->debug("update vtiger_quotes set received=".$payment.", balance =".$exbalance." where quoteid=".$quoteid);
    	    }else{
    	    	$payquery = $adb->pquery("select SUM(payment_tks_paymenttotal) as payment from vtiger_payment p inner join vtiger_crmentity c on p.paymentid=c.crmid where c.deleted= 0 and p.payment_tks_invoiceno=".$quoteid);
    		    $totalreceived = $adb->query_result($payquery , 0 ,'payment');
    		    $totalreceived = $totalreceived * $conversion_rate;
    		    $exxbalance = $total - $totalreceived;
    		     $adb->pquery("update vtiger_quotes set received=".$totalreceived.", balance =".$exxbalance." where quoteid=".$quoteid);
    		     $log->debug("update vtiger_quotes set received=".$totalreceived.", balance =".$exxbalance." where quoteid=".$quoteid);
    	    }
		}
	}
	/**
	 * Function to check if entry exsist in webservices if not then enter the entry
	 */
	static function checkWebServiceEntry() {
		global $log;
		$log->debug("Entering checkWebServiceEntry() method....");
		global $adb;

		$sql       =  "SELECT count(id) AS cnt FROM vtiger_ws_entity WHERE name = 'Payment'";
		$result   	= $adb->query($sql);
		if($adb->num_rows($result) > 0)
		{
			$no = $adb->query_result($result, 0, 'cnt');
			if($no == 0)
			{
				$tabid = $adb->getUniqueID("vtiger_ws_entity");
				$ws_entitySql = "INSERT INTO vtiger_ws_entity ( id, name, handler_path, handler_class, ismodule ) VALUES".
						  " (?, 'Payment','include/Webservices/VtigerModuleOperation.php', 'VtigerModuleOperation' , 1)";
				$res = $adb->pquery($ws_entitySql, array($tabid));
				$log->debug("Entered Record in vtiger WS entity ");	
			}
		}
		$log->debug("Exiting checkWebServiceEntry() method....");					
	}
	
	static function createUserFieldTable($module)
	{
		global $log;
		$log->debug("Entering createUserFieldTable() method....");
		global $adb;
		
		$sql	=	"CREATE TABLE IF NOT EXISTS `vtiger_".$module."_user_field` (
  						`recordid` int(19) NOT NULL,
					  	`userid` int(19) NOT NULL,
  						`starred` varchar(100) DEFAULT NULL,
  						 KEY `record_user_idx` (`recordid`,`userid`)
						) 			
						ENGINE=InnoDB DEFAULT CHARSET=utf8";
		$result	=	$adb->pquery($sql,array());					
	}
	
	static function addInTabMenu($module)
	{
		global $log;
		$log->debug("Entering addInTabMenu() method....");
		global $adb;
		$gettabid	=	$adb->pquery("SELECT tabid,parent FROM vtiger_tab WHERE name = ?",array($module));
		$tabid		=	$adb->query_result($gettabid,0,'tabid');
		$parent		=	$adb->query_result($gettabid,0,'parent');
		$parent		=	strtoupper($parent);
		
		$getmaxseq	=	$adb->pquery("SELECT max(sequence)+ 1 as maxseq FROM vtiger_app2tab WHERE appname = ?",array($parent));
		$sequence	=	$adb->query_result($getmaxseq,0,'maxseq');
		
		$sql		=	"INSERT INTO `vtiger_app2tab` (`tabid` ,`appname` ,`sequence` ,`visible`)VALUES (?, ?, ?, ?)";
		$result		=	$adb->pquery($sql,array($tabid,$parent,$sequence,1));		
	}
	
}