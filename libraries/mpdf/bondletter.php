<?php
$body='<html>
<head>
   <title></title>
</head>
<body>
   <div>
       <div>
           <img  class="logo" src="bondheader.png" alt="header">
       </div>
       <div>          
           <div class="a bondheader">
              <h2><u>EMPLOYMENT BOND OR CONTRACT</u></h2>
           </div>
            <table>
                <tr>
                    <td>
                        <p>THIS AGREEMENT is made on the Date between Biztechnosys Infotech Pvt. Ltd., a company registered under the Companies Act 1956 year and having its registered office at Bangalore office address #722/1, Raj Arcade, 1st Floor,Above Bank of Maharashtra, 24th Main Rd, 6th Phase, J.P. Nagar -560078 (here in after called the “company”) of the one part and Candidate Full Name residingat Candidate Full Address(Here in after called the “Employee”) of the other part.
                            </p>
                    </td>
                </tr>
                <tr>
                <td>
                <div class="div-left">
                    <p style="color:green;"><b>WHERE AS</b><p>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>The company is desirous making an agreement with Candidate Full Name (Emp. No. 0000) joined with Company in Date as its Designation and the Employee has agreed to do the terms and condition soutlined here below.
                        </p>
                    </td>
                </tr>
                <tr>
                <td>
                <div class="div-left bondtitle">
                    <p style="color:green;"><b>NOW THIS AGREEMENT WITNESSES AS FOLLOW:</b><p>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>1.  The said Candidate Full Name is here by appointed as the Designation of the company and he/she will hold the said office, subject to the provisions made here in after, for the term of (Duration with theorganization) of TWO YEARS from the date of this agreement. If the Appointee fails to complete the bond agreement period of TWO Years will be liable to pay bond amount of rupees 50,000/-, will face the jurisdictional actions as per Karnataka Court Act.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>2. Your monthly salary package will be as per the appointment. Based on the periodic reviews your compensation package may differ as per the compensation Policy applicable to all employees of your category in respective department.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>3. The Employee shall perform such duties and exercises such powers as may from time to time be assigned to orvested in him by the reporting manager or Board of Directors of the company.
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            4.  The Employee shall obey the orders from time to time of the Board of  Directors of the company andin all respect conform to and comply with the directions given and regulation made by the Board.He/she shall well and faithfully serve the company to the best of his abilities and shall make his utmost endeavors to promote interests of the company.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            5.  The said Employee shall not resign until the end of this contract period.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            6.  The company may terminate this agreement at any time before the expiry of the stipulated term by giving one month´s notice in writing to him. The company can terminate your contract any time if you-
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            • Commit any material or persistent breach of any of the provisions contained.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            • Be guilty of any default, misconduct or neglecting the discharge of your duties affecting the business of the company.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                      <p>
                          • Any of the employee’s performance  issues. This is completely at the discretion of the organization.
                      </p>
                    </td>
                </tr>
                <br/>
            </table>
            <div>
            <div class="leftDiv">
                 <p>Signature of the Employee:</p>
                 <p>Name of the Employee:  </p>
            </div>
            <div class="rightDiv">
                <p style="padding-left:150px;">Date:</p>
                <p style="padding-left:150px;">Place:</p>
            </div>
            <div style="clear: both;"></div>
      </div>
  </div>
</body>
</html>';

        ob_start();
         $body = iconv("UTF-8","UTF-8//IGNORE",$body);
         include("mpdf/mpdf.php");
         $mpdf=new mPDF('c','A4','','',15,15,15,15,15,15);  
         $stylesheet = file_get_contents('mpdfstyletables.css');
         $mpdf->WriteHTML($stylesheet,1);
         //write html to PDF
         $m=$mpdf->WriteHTML($body,2);
         //output pdf
         $mpdf->Output('Offerlatter-'.$employeename.'-'.$month.'-'.$year.'.pdf','D');
