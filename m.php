<?php
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $counterContent = '';
    // user bracket notation and OR operator to handle undefined values instead of displaying undefined
      for($x = 1; $x <= $_POST['serv_count']; $x++){
          $counterContent .= '
            <div style="float: left; width: 50%; ">
                <div style="border: 1px solid #000; padding: 3px; margin: 1px; ">' . htmlspecialchars($_POST['services_description_' . $x] ?? '') . '</div>
            </div>
            <div style="float: left; width: 15%; ">
                <p><span>' . htmlspecialchars($_POST['services_initial_units_' . $x] ?? '') . '</span></p>
            </div>
            <div style="float: left; width: 15%; ">
                <p>$<span> ' . htmlspecialchars($_POST['services_unit_rate_' . $x] ?? '') . '</span></p>
            </div>
            <div style="float: right; width: 15%; ">
                <p><span>' . htmlspecialchars($_POST['services_extended_cost_' . $x] ?? '') . '</span></p>
            </div>
            <div class="clear" style="margin: 2px 0; "></div>
          ';
      }

$html = '<!DOCTYPE html>
<html>
    <head>
        <style>
            @page { margin: 20px; }
            body {
                font-family: Arial, sans-serif;
            }
            .clear{ clear: both; display: block; width: 100%; }
            h1{ margin: 10px 0; text-align: center; }
            h3 {
                text-align: center;
                background: #ddd;
                padding: 3px;
                font-size: 13px;
                display: block;
                width: 100%;
                margin: 0;
            }
            h4{ font-size: 13px; }
            p {
                text-align: left;
                padding: 0px;
                margin: 3px;
                font-size:13px;
                line-height: 1.5;
            }
            div {
                font-size:13px;
                line-height: 1.5;
            }
            p span{ border-bottom: 1px solid #000; }
            table {
                width: 100%;
                border-spacing: 5px;
            }
            hr{ margin: 0; padding: 0; }
        </style>
    </head>
    <body>
    <!-- FIRST ROW ------------------------------------------------------------------------------------------ -->
        <div style="width: 100%; display: block; float: left; margin: 5px 0; ">
            <div style="float: left; border: 1px solid #000; width: 54%; ">
                <h1><img src="Bold-Business-logo.png" style="width: 100px;" /></h1>
                <h3>SERVICE ORDER</h3>
                <p style="float: left; "><strong>Control No:</strong><span> ' . htmlspecialchars($_POST['control_no']) . '</span> &nbsp; &nbsp; &nbsp; <strong>Quote Date:</strong><span> ' . htmlspecialchars($_POST['quote_date']) . '</span></p>
            </div>
            <div style="float: right; border: 1px solid #000; width: 44%; ">
                <h3>BOLD BUSINESS REPRESENTATIVE</h3>
                <p><strong>Name:</strong><span> ' . htmlspecialchars($_POST['bold_rep_name']) . '</span></p>
                <p><strong>Title:</strong><span> ' . htmlspecialchars($_POST['bold_rep_title']) . '</span></p>
                <p><strong>Email:</strong><span> ' . htmlspecialchars($_POST['bold_rep_email']) . '</span></p>
                <p><strong>Phone:</strong><span> ' . htmlspecialchars($_POST['bold_rep_phone']) . '</span></p>
            </div>
        </div>
        <div class="clear"></div>

        <!-- SECOND ROW ------------------------------------------------------------------------------------------ -->
        <div style="width: 100%; border: 1px solid #000; display: block; float: left; margin: 5px 0;">
            <h3>CUSTOMER INFORMATION</h3>
            <div style="float: left; width: 30%; ">
                <p><strong>Customer:</strong><span> ' . htmlspecialchars($_POST['cust_info_customer']) . '</span></p>
            </div>
            <div style="float: left; width: 30%; ">
                <p><strong>Email:</strong><span> ' . htmlspecialchars($_POST['cust_info_email']) . '</span></p>
            </div>
            <div style="float: left; width: 20%; ">
                <p><strong>Contact:</strong><span> ' . htmlspecialchars($_POST['cust_info_contact']) . '</span></p>
            </div>
            <div style="float: left; width: 20%; ">
                <p><strong>Phone:</strong><span> ' . htmlspecialchars($_POST['cust_info_phone']) . '</span></p>
            </div>
            <div class="clear"></div>
            <div style="float: left; width: 40%; ">
                <p><strong>Billing Address:</strong><span> ' . htmlspecialchars($_POST['cust_info_billing_address']) . '</span></p>
            </div>
            <div style="float: left; width: 20%; ">
                <p><strong>City:</strong><span> ' . htmlspecialchars($_POST['cust_info_city']) . '</span></p>
            </div>
            <div style="float: left; width: 20%; ">
                <p><strong>State:</strong><span> ' . htmlspecialchars($_POST['cust_info_state']) . '</span></p>
            </div>
            <div style="float: left; width: 20%; ">
                <p><strong>Zip Code:</strong><span> ' . htmlspecialchars($_POST['cust_info_zip_code']) . '</span></p>
            </div>
        </div>
        <div class="clear"></div>

        <!-- THIRD ROW ------------------------------------------------------------------------------------------ -->
        <div style="width: 100%; border: 1px solid #000; display: block; float: left; margin: 5px 0;">
            <h3>PROJECT INFORMATION</h3>
            <p><strong>Project Name:</strong><span> ' . htmlspecialchars($_POST['proj_info_project_name']) . '</span></p>
                
            <div style="float: left; width: 33%; ">
                <p><strong>Contact:</strong><span> ' . htmlspecialchars($_POST['proj_info_contact']) . '</span></p>
            </div>
            <div style="float: left; width: 33%; ">
                <p><strong>Email:</strong><span> ' . htmlspecialchars($_POST['proj_info_email']) . '</span></p>
            </div>
            <div style="float: right; width: 33%; ">
                <p><strong>Prefered Start Date:</strong><span> ' . htmlspecialchars($_POST['proj_info_prefered_date_type']) . ' ' .htmlspecialchars($_POST['proj_info_start_date']) . '</span></p>
            </div>
        </div>
        <div class="clear"></div>

        <!-- FOURTH ROW ------------------------------------------------------------------------------------------ -->
        <div style="width: 100%; border: 1px solid #000; display: block; float: left; margin: 5px 0;">
            <h3>SERVICES</h3>
            <p style="text-align: center; ">Bold Business will provide the following:</p>

            <div style="float: left; width: 50%; ">
                <p><strong>Description</strong></p>
            </div>
            <div style="float: left; width: 15%; ">
                <p><strong>Initial Units</strong></p>
            </div>
            <div style="float: left; width: 15%; ">
                <p><strong>Unit Rate</strong></p>
            </div>
            <div style="float: right; width: 15%; ">
                <p><strong>Extended Cost</strong></p>
            </div>
            <div class="clear"></div>
            ' . $counterContent . '
            <div class="clear"></div>
            <div style="float: left; width: 80%; ">
                <p><strong>Notes: </strong></p>
                <div style="border: 1px solid #000; padding: 5px; margin: 5px;">' . htmlspecialchars($_POST['services_notes']) . '</div>
            </div>
            <div style="float: right; width: 20%; ">
                <p><strong>Total: </strong><span> ' . htmlspecialchars($_POST['services_extended_cost_total']) . '</span></p>
            </div>
        </div>
        <div class="clear"></div>

        <!-- FIFTH ROW ------------------------------------------------------------------------------------------ -->
        <div style="width: 100%; border: 1px solid #000; display: block; float: left; margin: 5px 0;">
            <p style="text-align: left">
            <strong>ACCEPTANCE</strong><br />
            IN WITNESS WHEREOF, the parties hereto have caused their duly authorized representatives to execute this Service Order at the rates and total cost for the above described services in accordance with the Commercial Terms and Conditions located at <a href="https://www.boldbusiness.com/terms/" target="_blank">https://www.boldbusiness.com/terms</a></p>
            
            <div style="float: left; width: 48%; text-align: center; ">
                <br /><br />
                <hr />
                <div><strong>Authorized Signature for Bold Business LLC</strong></div>

                <br /><br />
                <div> '. htmlspecialchars($_POST['printed_name_title_1']) . '</div>
                <hr />
                <div><strong>Printed Name and Title </strong></div>

                <br /><br />
                <div> '. htmlspecialchars($_POST['date_signed_1']) . '</div>
                <hr />
                <div><strong>Date Signed </strong></div>
            </div>
            <div style="float: right; width: 48%; text-align: center; ">
                <br /><br />
                <hr />
                <div><strong>Authorized Signature for </strong><span> ' . htmlspecialchars($_POST['cust_info_customer']) . '</span></div>
                <br /><br />
                <div> '. htmlspecialchars($_POST['printed_name_title_2']) . '</div>
                <hr />
                <div><strong>Printed Name and Title </strong></div>
                <br /><br />
                <div> '. htmlspecialchars($_POST['date_signed_2']) . '</div>
                <hr />
                <div><strong>Date Signed </strong></div>
            </div>
            </div>
        </div>
        <p style="text-align: center;">Bold Business LLC - 263 13th Ave S - St. Petersburg, FL 33701 - 212-913-9132</p>

    </body>
</html>
';

$mpdf->WriteHTML($html);
$mpdf->Output('Service_Order_' . htmlspecialchars($_POST['control_no']) . '_CustomerName_' . htmlspecialchars($_POST['cust_info_customer']) . '.pdf', 'D');
//$mpdf->Output();

echo $counterContent;
}
?>