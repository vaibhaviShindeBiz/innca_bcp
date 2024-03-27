<?php

// Turn on debugging level
$Vtiger_Utils_Log = true;

// Include necessary classes
include_once('vtlib/Vtiger/Module.php');

// Define instances
$module = Vtiger_Module::getInstance('Sitevisit');

// Nouvelle instance pour le nouveau bloc
$block = Vtiger_Block::getInstance('Site Visit Details', $module);

$field018 = new Vtiger_Field();
$field018->name = 'sitevisit_oppid'; 
$field018->label = 'Opportunity'; 
$field018->column = 'sitevisit_oppid';
$field018->uitype = 10; 
$field018->typeofdata = 'V~O'; 
$block->addField($field018); 
$field018->setRelatedModules(Array('Potentials'));



?> 