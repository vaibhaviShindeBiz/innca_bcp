
<?php
 
include_once 'vtlib/Vtiger/Module.php';
$servicesModule = Vtiger_Module::getInstance('Contacts');
$servicecontractModule = Vtiger_Module::getInstance('Vendorjobsubmission');
$relationLabel  = 'Vendorjobsubmission';
$servicesModule->setRelatedList(
      $servicecontractModule , $relationLabel, array('add','select'), 'get_attachments'
);
echo "DONE";
?>
 