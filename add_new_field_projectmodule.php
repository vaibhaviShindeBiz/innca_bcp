<?php

// Turn on debugging level
$Vtiger_Utils_Log = true;

// Include necessary classes
include_once('vtlib/Vtiger/Module.php');

$module = Vtiger_Module::getInstance('Project');

// Nouvelle instance pour le nouveau bloc
$block = new Vtiger_Block();
$block->label = 'Project Manager Inspection';
$module->addBlock($block);

$field1 = new Vtiger_Field();
$field1->name = 'project_comment';
$field1->label = 'Comments';
$field1->table = $module->basetable; 
$field1->column = 'project_comment';
$field1->columntype = 'TEXT';
$field1->uitype = 2;
$field1->typeofdata = 'V~O';
$block->addField($field1);

$field2 = new Vtiger_Field();
$field2->name = 'project_sitep';
$field2->label = 'Site planning';
$field2->table = $module->basetable; 
$field2->column = 'project_sitep';
$field2->columntype = 'TEXT';
$field2->uitype = 2;
$field2->typeofdata = 'V~O';
$block->addField($field2);

$field3 = new Vtiger_Field();
$field3->name = 'project_turntime';
$field3->label = 'Turnaround time';
$field3->table = $module->basetable; 
$field3->column = 'project_turntime';
$field3->columntype = 'DATE';
$field3->uitype = 5;
$field3->typeofdata = 'D~O';
$block->addField($field3);

$field5 = new Vtiger_Field();
$field5->name = 'project_spoint';
$field5->label = 'Special points';
$field5->table = $module->basetable; 
$field5->column = 'project_spoint';
$field5->columntype = 'TEXT';
$field5->uitype = 2;
$field5->typeofdata = 'V~O';
$block->addField($field5);

$field4 = new Vtiger_Field();
$field4->name = 'project_listing';
$field4->label = 'Vendor Listing';
$field4->table = $module->basetable; 
$field4->column = 'project_listing';
$field4->columntype = 'TEXT';
$field4->uitype = 2;
$field4->typeofdata = 'V~O';
$block->addField($field4);

$field6 = new Vtiger_Field();
$field6->name = 'project_timelines';
$field6->label = 'Timelines';
$field6->table = $module->basetable; 
$field6->column = 'project_timelines';
$field6->columntype = 'TEXT';
$field6->uitype = 2;
$field6->typeofdata = 'V~O';
$block->addField($field6);



$block1 = new Vtiger_Block();
$block1->label = 'Site Engineer Review';
$module->addBlock($block1);


$field31 = new Vtiger_Field();
$field31->name = 'pt_deliverydate';
$field31->label = 'Delivery Date';
$field31->table = $module->basetable; 
$field31->column = 'pt_deliverydate';
$field31->columntype = 'DATE';
$field31->uitype = 5;
$field31->typeofdata = 'D~O';
$block1->addField($field31);

$field32 = new Vtiger_Field();
$field32->name = 'pt_recieved';
$field32->label = 'Received';
$field32->table = $module->basetable; 
$field32->column = 'pt_recieved';
$field32->columntype = 'VARCHAR(100)';
$field32->uitype = 56;
$field32->typeofdata = 'V~O';
$block1->addField($field32);

$field61 = new Vtiger_Field();
$field61->name = 'pt_cross_varified';
$field61->label = 'Cross verified';
$field61->table = $module->basetable; 
$field61->column = 'pt_cross_varified';
$field61->columntype = 'TEXT';
$field61->uitype = 2;
$field61->typeofdata = 'V~O';
$block1->addField($field61);

$field321 = new Vtiger_Field();
$field321->name = 'pt_vediopl';
$field321->label = 'Video Planning';
$field321->table = $module->basetable; 
$field321->column = 'pt_vediopl';
$field321->columntype = 'VARCHAR(100)';
$field321->uitype = 56;
$field321->typeofdata = 'V~O';
$block1->addField($field321);

$field311 = new Vtiger_Field();
$field311->name = 'pt_falsecei';
$field311->label = 'False ceiling';
$field311->table = $module->basetable; 
$field311->column = 'pt_falsecei';
$field311->columntype = 'DATE';
$field311->uitype = 5;
$field311->typeofdata = 'D~O';
$block1->addField($field311);

$field312 = new Vtiger_Field();
$field312->name = 'pt_painting';
$field312->label = 'Painting';
$field312->table = $module->basetable; 
$field312->column = 'pt_painting';
$field312->columntype = 'DATE';
$field312->uitype = 5;
$field312->typeofdata = 'D~O';
$block1->addField($field312);

$field313 = new Vtiger_Field();
$field313->name = 'pt_installation';
$field313->label = 'Carcuss installation';
$field313->table = $module->basetable; 
$field313->column = 'pt_installation';
$field313->columntype = 'DATE';
$field313->uitype = 5;
$field313->typeofdata = 'D~O';
$block1->addField($field313);

$field314 = new Vtiger_Field();
$field314->name = 'pt_carpentry';
$field314->label = 'Carpentry';
$field314->table = $module->basetable; 
$field314->column = 'pt_carpentry';
$field314->columntype = 'DATE';
$field314->uitype = 5;
$field314->typeofdata = 'D~O';
$block1->addField($field314);

$field315 = new Vtiger_Field();
$field315->name = 'pt_panelling';
$field315->label = 'Panelling';
$field315->table = $module->basetable; 
$field315->column = 'pt_panelling';
$field315->columntype = 'DATE';
$field315->uitype = 5;
$field315->typeofdata = 'D~O';
$block1->addField($field315);

$field316 = new Vtiger_Field();
$field316->name = 'pt_countertop';
$field316->label = 'Counter top';
$field316->table = $module->basetable; 
$field316->column = 'pt_countertop';
$field316->columntype = 'DATE';
$field316->uitype = 5;
$field316->typeofdata = 'D~O';
$block1->addField($field316);

$field317 = new Vtiger_Field();
$field317->name = 'pt_appliance';
$field317->label = 'Appliance installation';
$field317->table = $module->basetable; 
$field317->column = 'pt_appliance';
$field317->columntype = 'DATE';
$field317->uitype = 5;
$field317->typeofdata = 'D~O';
$block1->addField($field317);

$field611 = new Vtiger_Field();
$field611->name = 'pt_snags';
$field611->label = 'Snags';
$field611->table = $module->basetable; 
$field611->column = 'pt_snags';
$field611->columntype = 'TEXT';
$field611->uitype = 19;
$field611->typeofdata = 'V~O';
$block1->addField($field611);

$field3171 = new Vtiger_Field();
$field3171->name = 'pt_snagsattended';
$field3171->label = 'Snags attended';
$field3171->table = $module->basetable; 
$field3171->column = 'pt_snagsattended';
$field3171->columntype = 'DATE';
$field3171->uitype = 5;
$field3171->typeofdata = 'D~O';
$block1->addField($field3171);

$field3172 = new Vtiger_Field();
$field3172->name = 'pt_completion';
$field3172->label = 'Completion ';
$field3172->table = $module->basetable; 
$field3172->column = 'pt_completion';
$field3172->columntype = 'DATE';
$field3172->uitype = 5;
$field3172->typeofdata = 'D~O';
$block1->addField($field3172);

$field61112 = new Vtiger_Field();
$field61112->name = 'pt_clientrev';
$field61112->label = 'Client review';
$field61112->table = $module->basetable; 
$field61112->column = 'pt_clientrev';
$field61112->columntype = 'TEXT';
$field61112->uitype = 19;
$field61112->typeofdata = 'V~O';
$block1->addField($field61112);

$field61113 = new Vtiger_Field();
$field61113->name = 'pt_sirereview';
$field61113->label = 'Sire Review';
$field61113->table = $module->basetable; 
$field61113->column = 'pt_sirereview';
$field61113->columntype = 'TEXT';
$field61113->uitype = 19;
$field61113->typeofdata = 'V~O';
$block1->addField($field61113);

$field31712 = new Vtiger_Field();
$field31712->name = 'pt_onsitechange';
$field31712->label = 'Onsite change request';
$field31712->table = $module->basetable; 
$field31712->column = 'pt_onsitechange';
$field31712->columntype = 'DATE';
$field31712->uitype = 5;
$field31712->typeofdata = 'D~O';
$block1->addField($field31712);

?> 