<?php

include_once('vtlib/Vtiger/Module.php');
$moduleInstance = Vtiger_Module::getInstance('Potentials');
$accountsModule = Vtiger_Module::getInstance('Sitevisit');
$relationLabel  = 'Sitevisit';
$moduleInstance->setRelatedList($accountsModule, $relationLabel,array('ADD', 'SELECT'),'get_dependents_list');

echo "done";