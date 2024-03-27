
<?php
 
include_once 'vtlib/Vtiger/Module.php';
$servicesModule = Vtiger_Module::getInstance('Potentials');
$servicecontractModule = Vtiger_Module::getInstance('Quotes');
$relationLabel  = 'Quotes';
$servicesModule->setRelatedList(
      $servicecontractModule , $relationLabel, array('add','select'), 'get_quotes'
);
echo "DONE";
?>
 