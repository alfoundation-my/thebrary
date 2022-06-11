<?php
/* Template Name: Receipt Page */
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 3/7/2020
 * Time: 1:01 PM
 */
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payment;

if (isset($_GET["do"]) && $_GET["do"] == "success") {
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $apiContext);
    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);
    try {
        $result = $payment->execute($execution, $apiContext);
        try {
            $payment = Payment::get($paymentId, $apiContext);
            $payer_name = $payment->payer->payer_info->first_name . ' ' . $payment->payer->payer_info->last_name;
            $payer_id = $payment->payer->payer_info->payer_id;
            $payer_email = $payment->payer->payer_info->email;
            $payer_phone = $payment->payer->payer_info->phone;
            $payment_status = $payment->payer->status;
            //$country_code = $payment->payer->payer_info->country_code;
            $amount = $payment->transactions[0]->amount->total;
            $currency = $payment->transactions[0]->amount->currency;
            $invoice_id = $payment->transactions[0]->invoice_number;
            $payment_mode = "PayPal";
            $book_id = $_REQUEST["book_id"];
            $user_id = $_REQUEST["user_id"];
            $date_due = $_REQUEST["date_due"];
            $issued_date = $_REQUEST["issued_date"];
            $payed_for_days = $_REQUEST["paying_for_days"];
            $payed_for_entry = $_REQUEST["paid_for_entry"];
            $per_day_fine = $_REQUEST["per_day_fine"];
            $payment_id = $payment->id; //payment_id
            $refund_url = $payment->transactions[0]->related_resources[0]->sale->links[1]->href;
            //Add Save Code then Print Recipt Page
            $sql = "INSERT IGNORE INTO `tblpayments`(`Id`,`InvoiceNo`, `Currency`,`PayerId`,`PayerEmail`,`RefundUrl`,`PayerPhone`,`PayerName`,`PaymentId`,`PerDayFine` ,`PayedAmount`, `PaymentStatus`, `BookId`, 
            `UserId`, `DateDue`, `IssuedDate`, `PayedForDays`, `PaymentMode`, `CreatedTime`,`PayedForEntry`) VALUES (NULL,'" . $invoice_id . "','" . $currency . "','" . $payer_id . "','" . $payer_email . "','" . $refund_url . "','" . $payer_phone . "','" . $payer_name . "','" . $paymentId . "'," . $per_day_fine . "," . $amount . ",'" . $payment_status . "','" . $book_id . "','" . $user_id . "',
            '" . $date_due . "','" . $issued_date . "'," . $payed_for_days . ",'" . $payment_mode . "','" . get_cdate() . "'," . $payed_for_entry . ");";
            global $wpdb;
            $temp = $wpdb->query($sql);
            if ($temp > 0) {
                $order_status = "Success";
            } else {
                $order_status = "Failure";
            }
        } catch (Exception $ex) {
        }
    } catch (Exception $ex) {
    }
} else {
    // We are in cancel section
    $order_status = "Aborted";
}
$home_page = home_url();
?>
    <html>
    <head><!-- Bootstrap CSS -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
        >
    </head>
<body style="background-color: #e9ecef;">
<?php
if ($order_status === "Success") {
    ?>

    <div class="jumbotron text-xs-center" style="    height: -webkit-fill-available;">
        <h3 class="display-3" style="    font-size: 2.5rem;">Your due has been paid! </h3>
        <hr>


        <h6> Note down the information for your reference </h6>
        <table class="table table-bordered table-responsive">
            <tbody>
            <tr>
                <td>
                    Invoice No :
                </td>
                <td><?php echo $invoice_id; ?></td>
            </tr>
            <tr>
                <td>
                    Payers Name :
                </td>
                <td>
                    <?php echo $payer_name; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Payment Mode :
                </td>
                <td><?php echo $payment_mode; ?></td>
            </tr>
            <tr>
                <td>
                    User ID :
                </td>
                <td><?php echo $user_id; ?></td>
            </tr>
            <tr>
                <td>
                    Book ID :
                </td>
                <td><?php echo $book_id; ?></td>
            </tr>
            <tr>
                <td>
                    Due Paid :
                </td>
                <td><?php echo $amount; ?></td>
            </tr>
            <tr>
                <td>
                    Due Paid By:
                </td>
                <td><?php echo $payer_email; ?></td>
            </tr>
            <tr>
                <td>
                    Due Payer Id:
                </td>
                <td><?php echo $payer_id; ?></td>
            </tr>
            </tbody>
        </table>


        <p class="lead">
            <a class="btn btn-primary btn-sm" href="<?php echo $home_page . "/dashboard"; ?>" target="_blank">Dashboard
            </a>
        </p>
    </div>


    <?php
} else if ($order_status === "Aborted") {
    ?>

    <div class="jumbotron text-xs-center" style="    height: -webkit-fill-available;">
        <h1 class="display-3">Transaction has been aborted!</h1>
        <hr>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="<?php echo $home_page; ?>" target="_blank">Continue to homepage</a>
        </p>
    </div>


    <?php
} else if ($order_status === "Failure") {
    ?>

    <div class="jumbotron text-xs-center" style="    height: -webkit-fill-available;">
        <h1 class="display-3">Transaction TimedOut </h1>
        <hr>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="<?php echo $home_page . "/dashboard"; ?>" target="_blank">Continue
                to homepage</a>
        </p>
    </div>


    <?php
} else {
    ?>
    <div class="jumbotron text-xs-center" style="    height: -webkit-fill-available;">
        <h1 class="display-3">Illegal security data access. </h1>
        <hr>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="<?php echo $home_page; ?>" target="_blank">Continue to homepage</a>
        </p>
    </div>

    <?php
}
