<?php

// Turn on debugging level
$Vtiger_Utils_Log = true;

// Include necessary classes
include_once('vtlib/Vtiger/Module.php');


$module = Vtiger_Module::getInstance('Sitevisit');

// Nouvelle instance pour le nouveau bloc
$block = Vtiger_Block::getInstance('Site Visit Details', $module);

$field16 = new Vtiger_Field();
$field16->label = 'Site Engineer Name';
$field16->name = 'site_engname';
$field16->table = $module->basetable;
$field16->column = 'site_engname';
$field16->columntype = 'VARCHAR(100)';
$field16->uitype = 15;
$field16->typeofdata = 'V~O';
$block->addField($field16);
$field16->setPicklistValues( Array ('Internal','External') );

?> 