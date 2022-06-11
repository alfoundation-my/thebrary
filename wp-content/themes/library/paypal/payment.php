<?php
/* Template Name: PaymentHandler Page */
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 3/7/2020
 * Time: 1:01 PM
 */
// After Step 2
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');
$amount = new \PayPal\Api\Amount();
$amount->setTotal($_REQUEST["amount"]);
$amount->setCurrency($_REQUEST["currency_code"]);
$item_name = trim($_REQUEST["item_name"]);
$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount)->setDescription($item_name)->setInvoiceNumber($_REQUEST["order_id"]);
$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl(home_url() . "/receipt?do=success&paid_for_entry=" . $_REQUEST["paid_for_entry"] . "&book_id=" . $_REQUEST["book_id"] . "&user_id=" . $_REQUEST["user_id"] . "&date_due=" . $_REQUEST["date_due"] . "&issued_date=" . $_REQUEST["issued_date"] . "&paying_for_days=" . $_REQUEST["paying_for_days"] . "&per_day_fine=" . $_REQUEST["per_day_fine"])
    ->setCancelUrl(home_url() . "/payment-receipt?do=cancel");
$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);
try {
    $payment->create($apiContext);
    //echo $payment;
    //echo $payment->getApprovalLink();
    header("Location: " . $payment->getApprovalLink());
    exit;
    //header("Location: ". $payment->getApprovalLink());
} catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}