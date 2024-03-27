<?php

$body='<html>
<head>
   <title></title>
</head>
<body>
   <div>
       <div>
           <img  class="logo" src="header.png" alt="header">
       </div>
       <div>
           <div class="div-left"><p>Date:<p></div>           
           <div class="a">
              <h2><u>Offer Letter</u></h2>
           </div>
        <table>
            <tr>
                <td>
                <div class="div-left">
                    <p>Dear Candidate Name,<p>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            With reference to your application and subsequent interview with us,we are pleased to extend an offer of employment to you in our organization at the position of “Designation”,at a fixed Annual CTC of INR 00,00,000 Per Annum (INR Ten Lakh Only) with a take home salary of Rs.00,000/- (Eighty Three Thousand and Three hundred Thirty Three Only) per month.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            The first 3 months of your service will be on probation, at the end of which, the company may confirm your services, subject to your performance meeting our requisite standards. You will be on probation till the time you receive the confirmation letter. You have to serve 3 months’ notice period from the date of resignation submission.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            We would expect you to join as early as possible confirming us on your date of joining to be 11/02/2022.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            On the date of joining, you will receive your appointment letter. Please note that any false declaration of your documents mailed by you as a reply on Pre-Offer would result in cancellation of this offer.Kindlysign thecopy as atoken ofyouracceptanceoftheofferand returnus thesame.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            We look forward to having a long-term association with you.
                        </p>
                    </td>
                </tr>
                <br/>
            </table>
            <div class="outerDiv">
            <div class="leftDiv">
                 <p>Thanking You,</p>
                    <p>For Biztechnosys Infotech Pvt.Ltd.</p>
                    <img  class="sign" src="sign.png" alt="sign">
                    <p>Sathiaraj T</p>
                    <p>Manager - Human Resource & Admin<p>
            </div>
            <div class="rightDiv">
                <p style="padding-left:150px;">Accepted the Offer</p>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                      <p style="padding-left:150px;">_____________________</p>
                      <p style="padding-left:150px;">Signature of the candidate</p>
            </div>
            <div style="clear: both;"></div>
        </div>
      </div>
  </div>
</body>
</html>';

echo $body;
exit();
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
