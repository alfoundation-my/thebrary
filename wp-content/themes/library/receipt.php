<?php
/* Template Name: PaymentReceipt Page */
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 3/7/2020
 * Time: 12:20 AM
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

// After Step 2
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');
$amount = new \PayPal\Api\Amount();
$amount->setTotal('1.00');
$amount->setCurrency('USD');
$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);
$redirectUrls = new \PayPal\Api\RedirectUrls();

$redirectUrls->setReturnUrl(home_url() . "/receipt?do=success&bid=" . $_REQUEST["book_id"] . "&uid=" . $_REQUEST["user_id"] . "&date_due=" . $_REQUEST["date_due"] . "&issued_date=" . $_REQUEST["issued_date"] . "&payed_for_days=" . $_REQUEST["payed_for_days"])
    ->setCancelUrl(home_url() . "/receipt?do=cancel");
$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);
try {
    $payment->create($apiContext);
    //echo $payment;
    echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
} catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}
if (isset($_GET["do"]) && $_GET["do"] == "success") {
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $apiContext);
    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);
// Last chance to set the amount
//$transaction = new Transaction();
//$amount = new Amount();
//$amount->setCurrency('USD');
//$amount->setTotal($item_amount);
//$transaction->setAmount($amount);
//$execution->addTransaction($transaction);
    try {
        $result = $payment->execute($execution, $apiContext);
        try {
            $payment = Payment::get($paymentId, $apiContext);
            print_r($payment);
        } catch (Exception $ex) {
        }
    } catch (Exception $ex) {
    }
} else {
}
?>

