<?php
    require '../lib/vendor/autoload.php';
    require '../funcoes/banco/conexao.php';


    function attvenda($status,$ref){
        $pdo = conectar();

        try{
            $addvenda = $pdo->prepare("UPDATE venda SET status=? WHERE ordem=?");

            $addvenda->bindValue(1,$status,PDO::PARAM_STR);
            $addvenda->bindValue(2,$ref,PDO::PARAM_INT);
            $addvenda->execute();

            if($addvenda->rowCount() === 1){
                return TRUE;
            } else {
                return FALSE;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }



    MercadoPago\SDK::setAccessToken("APP_USR-1135667050758244-110218-3e4fd3203c16a1c9524565cbc3996ab8-253669077");

    MercadoPago\SDK::setClientId("1135667050758244");
    MercadoPago\SDK::setClientSecret("1Flw2MULCeMUtLsejdJlaAzJWYbDgA6R");
    

    $merchant_order = null;

    switch($_GET["topic"]) {
        case "payment":
            $payment = MercadoPago\Payment::find_by_id($_GET["id"]);

            $merchant_order = MercadoPago\MerchantOrder::find_by_id($_GET["id"]);
        break;

        case "plan":
            $plan = MercadoPago\Plan.find_by_id($_GET["id"]);
        break;

        case "subscription":
            $plan = MercadoPago\Subscription.find_by_id($_GET["id"]);
        break;

        case "invoice":
            $plan = MercadoPago\Invoice.find_by_id($_GET["id"]);
        break;

        case "merchant_order":
            $merchant_order = MercadoPago\MerchantOrder::find_by_id($_GET["id"]);
        break;
    }

    $paid_amount = 0;
    if ($payment->status == 'approved'){
        $paid_amount += $payment->transaction_amount;
    }

    if($paid_amount >= $payment->transaction_amount){
        if ($merchant_order->shipments > 0) { // The merchant_order has shipments
            if($merchant_order->shipments[0]->status == "ready_to_ship") {
                print_r("Totally paid. Print the label and release your item.");


                $external_ref = $payment->external_reference;
                $status = $payment->status;
                //$ext_email = $payment->payer->email;
                //$ext_val = $payment->transaction_amount;
                attvenda($status,$external_ref);


            }
        } else { // The merchant_order don't has any shipments
            print_r("Totally paid. Release your item.<br>");


            $external_ref = $payment->external_reference;
            $status = $payment->status;
            //$ext_email = $payment->payer->email;
            //$ext_val = $payment->transaction_amount;
            attvenda($status,$external_ref);


        }
    } else {
            print_r("Not paid yet. Do not release your item.");


            $external_ref = $payment->external_reference;
            $status = $payment->status;
            //$ext_email = $payment->payer->email;
            //$ext_val = $payment->transaction_amount;
            attvenda($status,$external_ref);

            
    }

?>
