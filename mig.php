<?php
require_once("modules/com_vtiger_workflow/include.inc");
require_once("modules/com_vtiger_workflow/tasks/VTEntityMethodTask.inc");
require_once("modules/com_vtiger_workflow/VTEntityMethodManager.inc");
require_once("include/database/PearDatabase.php");
$adb = PearDatabase::getInstance();
$emm = new VTEntityMethodManager($adb);
require_once 'vtlib/Vtiger/Module.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


/*$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Products');
$blockInstance = Vtiger_Block::getInstance('LBL_STOCK_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('height', $moduleInstance);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'height';
        $field->column = 'height';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Height';
        $field->uitype = 7;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is already Present --- damagephotos in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}*/

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('engineername', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'engineername';
        $fieldInstance->label = 'Site Engineer Name';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'engineername';
        $fieldInstance->uitype = '2';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(200)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
//        $fieldInstance->setPicklistValues(array('PUTTUR'));
     } else {
        echo "field is present -- engineername In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('contactname', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'contactname';
        $fieldInstance->label = 'Customer Name';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'contactname';
        $fieldInstance->uitype = '2';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(32)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
//        $fieldInstance->setPicklistValues(array('PUTTUR'));
     } else {
        echo "field is present -- contactname In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('address', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'address';
        $fieldInstance->label = 'Customer Address';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'address';
        $fieldInstance->uitype = '19';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(64)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- address in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- Site Vist Details -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('villa', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'villa';
        $field->column = 'villa';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Villa';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- villa In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('indivisualhouse', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'indivisualhouse';
        $field->column = 'indivisualhouse';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Indivisual House';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- indivisualhouse In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('mobile', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'mobile';
        $fieldInstance->label = 'Site Incharge mobile Number';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'mobile';
        $fieldInstance->uitype = '11';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(32)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
//        $fieldInstance->setPicklistValues(array('PUTTUR'));
     } else {
        echo "field is already Present --- mobile in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- Site Visit Details -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('landmark', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'landmark';
        $fieldInstance->label = 'Landmark';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'landmark';
        $fieldInstance->uitype = '19';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(64)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- landmark in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- Site Vist Details -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sitecondition', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sitecondition';
        $fieldInstance->label = 'Site Condition';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'sitecondition';
        $fieldInstance->uitype = '19';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(64)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- sitecondition in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- Site Vist Details -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('workingtime', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'workingtime';
        $fieldInstance->label = 'Working Time';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'workingtime';
        $fieldInstance->uitype = '19';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(64)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- workingtime in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- Site Vist Details -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('new', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'new';
        $fieldInstance->label = 'New';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'new';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Yes', 'No'));
    } else {
        echo "field is already Present --- new in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- Site Visit Details -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('new', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'new';
        $fieldInstance->label = 'New';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'new';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Yes', 'No'));
    } else {
        echo "field is already Present --- new in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- Site Visit Details -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('existingk_w', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'existingk_w';
        $fieldInstance->label = 'Existing Kitchen / Wardrobe';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'existingk_w';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Yes', 'No'));
    } else {
        echo "field is already Present --- new in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- Site Visit Details -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('platformexisting', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'platformexisting';
        $fieldInstance->label = 'Is The Platform Existing';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'platformexisting';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Yes', 'No'));
    } else {
        echo "field is already Present --- new in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- Site Visit Details -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ele_plumbing', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'ele_plumbing';
        $fieldInstance->label = 'Is the electric and plumbing work completed';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'ele_plumbing';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Yes', 'No'));
    } else {
        echo "field is already Present --- new in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- Site Visit Details -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('civilwork', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'civilwork';
        $fieldInstance->label = 'Civil Work';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'civilwork';
        $fieldInstance->uitype = '19';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(64)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- address in Sitevisit Module --- <br>";
    }
} else {
    echo " block does not exits --- Site Vist Details -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('bhk1', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'bhk1';
        $field->column = 'bhk1';
        $field->table = $invoiceModule->basetable;
        $field->label = 'BHK1';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- villa In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('bhk2', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'bhk2';
        $field->column = 'bhk2';
        $field->table = $invoiceModule->basetable;
        $field->label = 'BHK2';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- villa In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('bhk3', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'bhk3';
        $field->column = 'bhk3';
        $field->table = $invoiceModule->basetable;
        $field->label = 'BHK3';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- villa In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Site Visit Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('bhk4', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'bhk4';
        $field->column = 'bhk4';
        $field->table = $invoiceModule->basetable;
        $field->label = 'BHK4';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- villa In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom1 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('hinged', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'hinged';
        $field->column = 'hinged';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Hinged';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- hinged In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}


$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom1 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sliding', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sliding';
        $field->column = 'sliding';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Sliding';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- sliding In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom1 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('open', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'open';
        $field->column = 'open';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Open';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- open In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bathroom1 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vanity', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vanity';
        $field->column = 'vanity';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Vanity';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- vanity In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom2 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('hinged2', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'hinged2';
        $field->column = 'hinged2';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Hinged';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- hinged In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}


$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom2 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sliding2', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sliding2';
        $field->column = 'sliding2';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Sliding';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- sliding In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom2 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('open2', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'open2';
        $field->column = 'open2';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Open';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- open In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bathroom2 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vanity2', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vanity2';
        $field->column = 'vanity2';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Vanity';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- vanity In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom3 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('hinged3', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'hinged3';
        $field->column = 'hinged3';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Hinged';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- hinged In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}


$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom3 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sliding3', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sliding3';
        $field->column = 'sliding3';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Sliding';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- sliding In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom3 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('open4', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'open4';
        $field->column = 'open4';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Open';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- open In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bathroom3 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vanity4', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vanity4';
        $field->column = 'vanity4';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Vanity';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- vanity In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom4 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('hinged4', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'hinged4';
        $field->column = 'hinged4';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Hinged';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- hinged In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}


$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom4 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sliding4', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sliding4';
        $field->column = 'sliding4';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Sliding';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- sliding In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bedroom4 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('open3', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'open3';
        $field->column = 'open3';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Open';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- open In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('Bathroom4 Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vanity3', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vanity3';
        $field->column = 'vanity3';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Vanity';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
   } else {
        echo "field is present -- vanity In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('2D Design Attachment Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('imagename', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'imagename';
        $fieldInstance->label = 'Upload Attachment';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'imagename';
        $fieldInstance->uitype = '69';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(200)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
//        $fieldInstance->setPicklistValues(array('PUTTUR'));
     } else {
        echo "field is present -- engineername In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Sitevisit');
$blockInstance = Vtiger_Block::getInstance('3D Design Attachment Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('imagename1', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'imagename1';
        $fieldInstance->label = 'Upload Attachment';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'imagename1';
        $fieldInstance->uitype = '69';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(200)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
//        $fieldInstance->setPicklistValues(array('PUTTUR'));
     } else {
        echo "field is present -- engineername In Sitevisit Module --- <br>";
    }
} else {
    echo "Block Does not exits -- Site Visit Details in Sitevisit -- <br>";
}