<?php
$body='<html>
<head>
   <title></title>
</head>
<body>
   <div>
       <div>
           <img  class="logo" src="includes/mpdf/header.png" alt="header">
       </div>
       <div>
           <div class="div-left"><p>Date:'.$todaydate.'<p></div>           
           <div class="a">
              <h2><u>OFFER LETTER OF INTERNSHIP</u></h2>
           </div>
        <table>
            <tr>
                <td>
                <div class="div-left">
                    <p>Dear '.$firstname.' '.$lastname.',<p>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            With reference to your application and subsequent interview with us,we are pleased to extend an offer of Internship to you in our organization at the position of <b> “'.$position.'” <b/>,at a <b>stipend of INR '.$thsvalue.' Per Annum ('.$thsword.')</b>.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            The first <b>3</b> months of your service will be on <b>Internship</b>, at the end of which, the company may confirm your services, subject to your performance meeting our requisite standards. You will be on <b>Internship</b> till the time you receive the confirmation letter. You have to serve <b>3</b> months’ notice period from the date of resignation <b>Internship confirmation letter</b> from the HR.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            On the date Internship Confirmation, you will receive your <b>Appointment letter</b>. You may need to submit the essential documents requested by the HR.Kindly sign the copy as a token of your acceptance of the offer and return us the same.
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
