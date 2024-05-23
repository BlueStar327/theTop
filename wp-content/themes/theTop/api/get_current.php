<?php
/*
Template Name: get current api
*/

require_once 'testinput.php';

if(!isset($_SESSION["user_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}


global $wpdb;
$table_name = "users";
$table_orders = "orders";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $user_id = "";
    $error = "";
    
    if(empty($_POST["user_id"])) {
        $error = "No user.";
    }
    else {
        $user_id = $_POST["user_id"];
    }

    if($error == "") {
        $sql = "SELECT SUM(o_price * o_purchase) AS total FROM $table_orders WHERE o_is_delete = '0'";
        $retrieve_data = $wpdb->get_results($sql);
        $total = $retrieve_data[0]->total;
        $sql = "SELECT SUM(o_price * o_purchase) AS total FROM $table_orders WHERE o_is_delete = '0' AND o_state < '2'";
        $retrieve_data = $wpdb->get_results($sql);
        $purchase = $retrieve_data[0]->total;
        $sql = "SELECT SUM(o_price * o_purchase) AS total FROM $table_orders WHERE o_is_delete = '0' AND o_pay = '1'";
        $retrieve_data = $wpdb->get_results($sql);
        $deposit_com = $retrieve_data[0]->total;
        $res = array(
            'error' => $error,
            'total' => $total,
            'purchase' => $purchase,
            'closure' => round( $deposit_com * 0.2 ),
            'deposit_com' => $deposit_com,
            'success' => 1
        );
        echo json_encode($res);
    }
    else {
        $res = array(
            'error' => $error,
            'success' => 0
        );
        echo json_encode($res);
    }       
}
          
?>