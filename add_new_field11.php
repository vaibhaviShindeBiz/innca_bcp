<?php

// Turn on debugging level
$Vtiger_Utils_Log = true;

// Include necessary classes
include_once('vtlib/Vtiger/Module.php');

$module = Vtiger_Module::getInstance('SiteValidationMasking');

// Nouvelle instance pour le nouveau bloc
$block = Vtiger_Block::getInstance('Designs', $module);



//Do not change any value for filed2.
$field2 = new Vtiger_Field();
$field2->name = 'assigned_user_id';
$field2->label = 'Assigned To';
$field2->table = 'vtiger_crmentity'; 
$field2->column = 'smownerid';
$field2->columntype = 'int(19)';
$field2->uitype = 53;
$field2->typeofdata = 'V~M';
$block->addField($field2);

?> 