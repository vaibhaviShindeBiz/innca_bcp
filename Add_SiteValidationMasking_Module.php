<?php 

// Turn on debugging level
$Vtiger_Utils_Log = true;
include_once('vtlib/Vtiger/Menu.php');
include_once('vtlib/Vtiger/Module.php');

$module = new Vtiger_Module();
$module->name = 'SiteValidationMasking';//(No space in module name)
$module->save();

$module->initTables();
$module->initWebservice();

$menu = Vtiger_Menu::getInstance('TOOLS');
$menu->addModule($module);

$block1 = new Vtiger_Block();
$block1->label = 'Designs';
$module->addBlock($block1); //to create a new block

$field0 = new Vtiger_Field();
$field0->name = 'sitevm_2d';
$field0->label = '2D';
$field0->table = $module->basetable; 
$field0->column = 'sitevm_2d';
$field0->columntype = 'VARCHAR(100)';
$field0->uitype = 56;
$field0->typeofdata = 'V~O';
$block1->addField($field0);

$field01 = new Vtiger_Field();
$field01->name = 'sitevm_3d';
$field01->label = '3D';
$field01->table = $module->basetable; 
$field01->column = 'sitevm_3d';
$field01->columntype = 'VARCHAR(100)';
$field01->uitype = 56;
$field01->typeofdata = 'V~O';
$block1->addField($field01);



$block2 = new Vtiger_Block();
$block2->label = 'Desiger';
$module->addBlock($block2); //to create a new block

$field02 = new Vtiger_Field();
$field02->name = 'sitevm_alongwith';
$field02->label = 'Along With';
$field02->table = $module->basetable; 
$field02->column = 'sitevm_alongwith';
$field02->columntype = 'VARCHAR(100)';
$field02->uitype = 56;
$field02->typeofdata = 'V~O';
$block2->addField($field02);

$field03 = new Vtiger_Field();
$field03->name = 'sitevm_alone';
$field03->label = 'Alone';
$field03->table = $module->basetable; 
$field03->column = 'sitevm_alone';
$field03->columntype = 'VARCHAR(100)';
$field03->uitype = 56;
$field03->typeofdata = 'V~O';
$block2->addField($field03);



$block3 = new Vtiger_Block();
$block3->label = 'Electrical and plumbing points';
$module->addBlock($block3); //to create a new block

$field021 = new Vtiger_Field();
$field021->name = 'sitevm_docreceived';
$field021->label = 'Doc Received';
$field021->table = $module->basetable; 
$field021->column = 'sitevm_docreceived';
$field021->columntype = 'VARCHAR(100)';
$field021->uitype = 56;
$field021->typeofdata = 'V~O';
$block3->addField($field021);

$field031 = new Vtiger_Field();
$field031->name = 'sitevm_prepare';
$field031->label = 'Yet to prepare ';
$field031->table = $module->basetable; 
$field031->column = 'sitevm_prepare';
$field031->columntype = 'VARCHAR(100)';
$field031->uitype = 56;
$field031->typeofdata = 'V~O';
$block3->addField($field031);

$block4 = new Vtiger_Block();
$block4->label = 'Points for the rectification';
$module->addBlock($block4); //to create a new block

$field02111 = new Vtiger_Field();
$field02111->name = 'sitevm_description1';
$field02111->label = 'Description';
$field02111->table = $module->basetable; 
$field02111->column = 'sitevm_description1';
$field02111->columntype = 'VARCHAR(100)';
$field02111->uitype = 19;
$field02111->typeofdata = 'V~O';
$block4->addField($field02111);


$block5 = new Vtiger_Block();
$block5->label = 'Client';
$module->addBlock($block5); //to create a new block

$field0211 = new Vtiger_Field();
$field0211->name = 'sitevm_alongwith1';
$field0211->label = 'Along With';
$field0211->table = $module->basetable; 
$field0211->column = 'sitevm_alongwith1';
$field0211->columntype = 'VARCHAR(100)';
$field0211->uitype = 56;
$field0211->typeofdata = 'V~O';
$block5->addField($field0211);

$field032 = new Vtiger_Field();
$field032->name = 'sitevm_alone1';
$field032->label = 'Alone';
$field032->table = $module->basetable; 
$field032->column = 'sitevm_alone1';
$field032->columntype = 'VARCHAR(100)';
$field032->uitype = 56;
$field032->typeofdata = 'V~O';
$block5->addField($field032);



$block6 = new Vtiger_Block();
$block6->label = 'Scope of work';
$module->addBlock($block6); //to create a new block

$field02113 = new Vtiger_Field();
$field02113->name = 'sitevm_scopework';
$field02113->label = 'Scope of work';
$field02113->table = $module->basetable; 
$field02113->column = 'sitevm_scopework';
$field02113->columntype = 'VARCHAR(100)';
$field02113->uitype = 56;
$field02113->typeofdata = 'V~O';
$block6->addField($field02113);


$block7 = new Vtiger_Block();
$block7->label = 'Comments';
$module->addBlock($block7); //to create a new block

$field021112 = new Vtiger_Field();
$field021112->name = 'sitevm_comments';
$field021112->label = 'Comments';
$field021112->table = $module->basetable; 
$field021112->column = 'sitevm_comments';
$field021112->columntype = 'VARCHAR(100)';
$field021112->uitype = 19;
$field021112->typeofdata = 'V~O';
$block7->addField($field021112);


$field1 = new Vtiger_Field();
$field1->name = 'sitevm_no';
$field1->label = 'SiteValidationMasking No';
$field1->table = $module->basetable; 
$field1->column = 'sitevm_no';
$field1->columntype = 'VARCHAR(100)';
$field1->uitype = 4;
$field1->typeofdata = 'V~O';
$module->setEntityIdentifier($field1);
$block1->addField($field1);

$mfield2 = new Vtiger_Field();
$mfield2->name = 'createdtime';
$mfield2->label= 'Created Time';
$mfield2->table = 'vtiger_crmentity';
$mfield2->column = 'createdtime';
$mfield2->uitype = 70;
$mfield2->typeofdata = 'DT~O';
$mfield2->displaytype= 2;
$block1->addField($mfield2);

$mfield3 = new Vtiger_Field();
$mfield3->name = 'modifiedtime';
$mfield3->label= 'Modified Time';
$mfield3->table = 'vtiger_crmentity';
$mfield3->column = 'modifiedtime';
$mfield3->uitype = 70;
$mfield3->typeofdata = 'DT~O';
$mfield3->displaytype= 2;
$block1->addField($mfield3);

//Do not change any value for filed2.
$field2 = new Vtiger_Field();
$field2->name = 'assigned_user_id';
$field2->label = 'Assigned To';
$field2->table = 'vtiger_crmentity'; 
$field2->column = 'smownerid';
$field2->columntype = 'int(19)';
$field2->uitype = 53;
$field2->typeofdata = 'V~M';
$block1->addField($field2);

$filter1 = new Vtiger_Filter();
$filter1->name = 'All';
$filter1->isdefault = true;
$module->addFilter($filter1);
// Add fields to the filter created
$filter1->addField($field0, 1);
$filter1->addField($field1, 2);
$filter1->addField($field2, 3);


/** Set sharing access of this module */
$module->setDefaultSharing('Private'); 
/** Enable and Disable available tools */
$module->enableTools(Array('Import', 'Export'));
$module->disableTools('Merge');