<?php

// Turn on debugging level
$Vtiger_Utils_Log = true;

// Include necessary classes
include_once('vtlib/Vtiger/Module.php');


$module = Vtiger_Module::getInstance('Payment');

// Nouvelle instance pour le nouveau bloc
$block = Vtiger_Block::getInstance('Item Details', $module);

$field018 = new Vtiger_Field();
$field018->name = 'opportunityid'; 
$field018->label = 'Opportunity'; 
$field018->column = 'opportunityid';
$field018->uitype = 10; 
$field018->typeofdata = 'V~O'; 
$block->addField($field018); 
$field018->setRelatedModules(Array('Potentials'));

?> 