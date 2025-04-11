<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Check if any data has been submitted in the form
    if (!empty($_POST)) {
        $counterContent = '';
        for($x = 1; $x <= ($_POST['serv_count'] ?? 0); $x++){
            $counterContent .= '
                <div style="float: left; width: 46%; padding: 2px 1%; ">
                    <div style="padding: 3px; margin: 1px; "> &nbsp;' . htmlspecialchars($_POST['services_description_' . $x] ?? '') . '</div>
                </div>
                <div style="float: left; width: 13%; padding: 2px 1%; ">
                    <p><span>' . htmlspecialchars($_POST['services_initial_units_' . $x] ?? '') . '</span></p>
                </div>
                <div style="float: left; width: 13%; padding: 2px 1%; ">
                    <p>$<span>' . htmlspecialchars($_POST['services_unit_rate_' . $x] ?? '') . '</span></p>
                </div>
                <div style="float: right; width: 13%; padding: 2px 1%; ">
                    <p>$<span>' . htmlspecialchars($_POST['services_extended_cost_' . $x] ?? '') . '</span></p>
                </div>
                <div class="clear" style="margin: 2px 0; "></div>
              ';
        }

        $html = '<!DOCTYPE html>
        <html>
            <head>
                <style type="text/css">

                    @page { margin: 20px; }
                    body {
                        font-family: Arial, sans-serif;
                    }
                    .clear{ clear: both; display: block; width: 100%; }
                    p {
                        text-align: left;
                        padding: 0px;
                        margin: 0;
                        font-size:13px;
                        line-height: 1.5;
                    }
                    div {
                        font-size:13px;
                        line-height: 1.5;
                    }
                    table {
                        width: 100%;
                        border-spacing: 5px;
                    }
                    hr {
                        border: none;
                        height: 1px;
                        color: #333; 
                        background-color: #333; 
                        margin: 0;
                        padding: 0;
                    }
                </style>
            </head>
            <body>

            <img src="./images/ServiceOrder.jpg" />


            <div style="float: left; margin-top: 10px; width: 100%; ">
                <p style=" margin: 0 5px; background-color: #4446db; border-radius: 30px; padding: 5px 20px; float: left; color: #FFF; width: 170px; display: block; "><strong>Quote Date: ' . htmlspecialchars($_POST['quote_date']) . '</strong></p> 
                <p style=" margin: 0 5px; background-color: #4446db; border-radius: 30px; padding: 5px 20px; float: left; color: #FFF; width: 250px; display: block; "><strong>Quote Expiration Date: ' . htmlspecialchars($_POST['exp_date']) . '</strong></p>
            </div>



            <div style="float: left; margin-top: 10px; width: 100%; border: 1px solid #000000; border-radius: 8px; ">
                <p style=" margin: 0; background-color: #0583f2; border-radius: 8px; padding: 5px 20px; float: left; color: #FFF; width: 100%; display: block; text-align: center; "><strong>CLIENT INFORMATION</strong></p>

                <p style="padding: 10px 1% 5px 1%;">
                    <strong>Company: </strong><span> ' . htmlspecialchars($_POST['cust_info_company']) . '</span>
                </p>
                <div class="clear"></div>

                <p style="padding: 5px 1%; width: 36%; float: left;"><strong>Billing Address: </strong><span> ' . htmlspecialchars($_POST['cust_info_billing_address']) . '</span> </p>
                <p style="padding: 5px 1%; width: 18%; float: left;"><strong>City:</strong><span> ' . htmlspecialchars($_POST['cust_info_city']) . '</span></p>
                <p style="padding: 5px 1%; width: 18%; float: left;"> <strong>State:</strong><span> ' . htmlspecialchars($_POST['cust_info_state']) . '</span></p>
                <p style="padding: 5px 1%; width: 18%; float: left;"> <strong>Zip Code:</strong><span> ' . htmlspecialchars($_POST['cust_info_zip_code']) . '</span></p>
                <div class="clear"></div>
                    
                <p style="padding: 5px 1% 10px 1%; width: 36%; float: left;"><strong>Contact:</strong><span> ' . htmlspecialchars($_POST['cust_info_contact']) . '</span> </p>
                <p style="padding: 5px 1%; width: 33%; float: left;"><strong>Email:</strong><span> ' . htmlspecialchars($_POST['cust_info_email']) . '</span></p>
                <p style="padding: 5px 1%; width: 23%; float: left;"><strong>Phone:</strong><span> ' . htmlspecialchars($_POST['cust_info_phone']) . '</span></p>                
            </div>

            <div style="float: left; margin-top: 10px; width: 100%; border: 1px solid #000000; border-radius: 8px; ">
                <p style=" margin: 0; background-color: #0583f2; border-radius: 8px; padding: 5px 20px; float: left; color: #FFF; width: 100%; display: block; text-align: center; "><strong>PROJECT INFORMATION</strong></p>
                
                <p style="padding: 10px 1% 5px 1%;"><strong>Project Name: </strong><span> ' . htmlspecialchars($_POST['proj_info_project_name']) . '</span></p>
                <p style="padding: 5px 1% 10px 1%;"><strong>Prefered Start Date:</strong><span> ' . htmlspecialchars($_POST['proj_info_start_date']) . '</span></p>
            </div>
            


            <div style="float: left; margin-top: 10px; width: 100%; border: 1px solid #000000; border-radius: 8px; ">
                <p style=" margin: 0; background-color: #0583f2; border-radius: 8px; padding: 5px 20px; float: left; color: #FFF; width: 100%; display: block; text-align: center; "><strong>SERVICES</strong></p>

                <div style="float: left; width: 46%; padding: 10px 1% 5px 1%; ">
                    <p><strong>Description</strong></p>
                </div>
                <div style="float: left; width: 13%; padding: 5px 1%; ">
                    <p><strong>Initial Units</strong></p>
                </div>
                <div style="float: left; width: 13%; padding: 5px 1%; ">
                    <p><strong>Unit Rate</strong></p>
                </div>
                <div style="float: right; width: 13%; padding: 5px 1%; ">
                    <p><strong>Extended Cost</strong></p>
                </div>
                <div class="clear"></div>
                ' . $counterContent . '
                <div class="clear"></div>
                <div style="float: left; width: 76%; padding: 5px 1% 10px 1%; ">
                    <p><strong>Notes: </strong></p>
                    <div style="padding: 5px; ">&nbsp;' . htmlspecialchars($_POST['services_notes']) . '</div>
                </div>
                <div style="float: right; width: 20%; ">
                    <p><strong>Total: </strong><span> $' . htmlspecialchars($_POST['services_extended_cost_total']) . '</span></p>
                </div>
            </div>
            <div class="clear"></div>



            <div style="float: left; margin-top: 10px; margin-bottom: 25px; width: 100%; border: 1px solid #000000; border-radius: 8px; ">
                <p style=" margin: 0; background-color: #0583f2; border-radius: 8px; padding: 5px 20px; float: left; color: #FFF; width: 100%; display: block; text-align: center; "><strong>ACCEPTANCE</strong></p>

                <div style="width: 85%; display: block; margin: 10px auto 0 auto; ">
                    <div style="float: left; width: 40%; text-align: center; padding: 10px 5%; ">
                        <p style="text-align: left;"><img src="./images/Arrow.png" style="width: 35px; " /></p>
                        <hr />
                        <div><strong>Client Signature</strong></div>

                        <br />
                        <div> &nbsp;'. htmlspecialchars($_POST['printed_name_title_1']) . '</div>
                        <hr />
                        <div><strong>Printed Name and Title </strong></div>

                        <br />
                        <div> &nbsp;'. htmlspecialchars($_POST['date_signed_1']) . '</div>
                        <hr />
                        <div><strong>Date </strong></div>
                    </div>
                    <div style="float: right; width: 40%; text-align: center; padding: 10px 5%; ">
                        <p style="text-align: left;"><img src="./images/Arrow.png" style="width: 35px; " /></p>
                        <hr />
                        <div><strong>Bold Signature</strong></div>

                        <br />
                        <div> &nbsp;'. htmlspecialchars($_POST['printed_name_title_2']) . '</div>
                        <hr />
                        <div><strong>Printed Name and Title </strong></div>

                        <br />
                        <div> &nbsp;'. htmlspecialchars($_POST['date_signed_2']) . '</div>
                        <hr />
                        <div><strong>Date </strong></div>
                    </div>
                </div>

                <h2 style="text-align: center; margin: 0; display: block;">Thank you for choosing Bold Business!</h2>
                <h4 style="font-size: 15px; background-color: #FFF; text-align: center; background: #FFF; border: 1px solid #000000; border-radius: 8px; padding: 5px; margin: 10px auto -18px auto; width: 300px; z-index: 9999; ">
                    <a href="https://www.boldbusiness.com/terms/" target="_blank" style="color: #0583f2; ">See Terms and Conditions here</a>
                </h4>
                
            </div>



            <div style="float: left; margin-top: 10px; padding-bottom: 5px; width: 100%; border: 1px solid #000000; border-radius: 8px; ">
                <p style="background-color: #FFF; z-index: 9999; padding: 5px; color: #000000; margin: -15px auto 0 auto; width: 70px; display: block; text-align: center; "><strong>INTERNAL</strong></p>
                
                <div style="width: 100%; float: left; display: block; padding: 5px 0;">
                    <p style="float: left; width: 23%; margin: 0 1%; "><strong>Name: </strong><span> ' . htmlspecialchars($_POST['bold_rep_name']) . '</span></p>
                    <p style="float: left; width: 18%; margin: 0 1%; "><strong>Title: </strong><span> ' . htmlspecialchars($_POST['bold_rep_title']) . '</span></p>
                    <p style="float: left; width: 33%; margin: 0 1%; "><strong>Email: </strong><span> ' . htmlspecialchars($_POST['bold_rep_email']) . '</span></p>
                    <p style="float: left; width: 18%; margin: 0 1%; "><strong>Phone: </strong><span> ' . htmlspecialchars($_POST['bold_rep_phone']) . '</span></p>
                </div>
                
            </div>

            <div style="margin-top: 10px;">
                <div style="border: 1px solid #000000; border-radius: 8px; width: 35%; float: left; ">
                    <p style="background-color: #0583f2; border-radius: 8px; padding: 5px 1%; width: 80px; float: left; color: #FFF; width: 33%; display: block; text-align: center; "><strong>Control No: </strong></p>
                    <p style="float: left; padding: 5px 1%; width: 60%; text-align: center; "><strong>' . htmlspecialchars($_POST['control_no']) . '</strong></p>
                </div>
                <p style="float: right; text-align: right; width: 60%; font-size: 12px; padding: 5px 1%; ">Bold Business LLC - 263 13th Ave S - St. Petersburg, FL 33701 - 212-913-9132</p>
            </div>

        
                

            </body>
            </html>
            ';
        
            

        $mpdf->WriteHTML($html);
        $mpdf->Output('Service_Order_' . htmlspecialchars($_POST['control_no'] ?? '') . '_CustomerName_' . htmlspecialchars($_POST['cust_info_customer'] ?? '') . '.pdf', 'I');    } else {
        // Option 1: Display a message to the user
        // $mpdf->Output('Service_Order_Debug.pdf', 'D');
        echo '<p>Please fill out the form before submitting.</p>';

        // Option 2: Prevent PDF generation (no further action needed here)
    }
}
?>