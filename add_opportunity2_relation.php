<?php

include_once('vtlib/Vtiger/Module.php');
$moduleInstance = Vtiger_Module::getInstance('Potentials');
$accountsModule = Vtiger_Module::getInstance('Payment');
$relationLabel  = 'Payment';
$moduleInstance->setRelatedList($accountsModule, $relationLabel,array('ADD', 'SELECT'),'get_related_list');

echo "done";