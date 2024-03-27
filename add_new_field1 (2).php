<?php

// Turn on debugging level
$Vtiger_Utils_Log = true;

// Include necessary classes
include_once('vtlib/Vtiger/Module.php');

// Define instances
$module = Vtiger_Module::getInstance('Leads');

// Nouvelle instance pour le nouveau bloc
$block = Vtiger_Block::getInstance('Property Type Details', $module);

$field16 = new Vtiger_Field();
$field16->label = 'Property Type';
$field16->name = 'leads_propertytype';
$field16->table = $module->basetable;
$field16->column = 'leads_propertytype';
$field16->columntype = 'VARCHAR(100)';
$field16->uitype = 15;
$field16->typeofdata = 'V~O';
$block->addField($field16);
$field16->setPicklistValues( Array ('Apartment','Indivisual House','Villa','Other') );



?> 