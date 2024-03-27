<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 require_once 'vtlib/Vtiger/Package.php';
 require_once 'vtlib/Vtiger/Module.php';

$modulename = 'Sitevisit';
    $module = Vtiger_Module::getInstance($modulename);
    if ($module) {
        $pkg = new Vtiger_Package();
        $pkg->export($module, 'test', $modulename . '.zip', true);
        echo "<b>Package should be exported to the build directory of your install.</b><br>";
    } else {
        echo "<b>Failed to find " . $modulename . " module.</b><br>";
    }
?>

