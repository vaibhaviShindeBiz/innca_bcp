<?php
/*+**********************************************************************************
The content of this file is subject to the MultiCompany license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
* Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
* All Rights Reserved.
************************************************************************************/
 
class whatsapp_DashBoard_View extends Vtiger_Index_View
{
    public function process(Vtiger_Request $request)
    {
        $modulename= $request->getModule();
        $viewer = $this->getViewer($request);
        $viewer->assign('MODULE', $request->getModule());
        $viewer->view('DashBoard.tpl', $modulename);
    }
}

?>