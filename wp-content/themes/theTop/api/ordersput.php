<?php
/*
Template Name: orders put api

*/

require_once 'testinput.php';

if(!isset($_SESSION["user_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

global $wpdb;
$table_name = "users";
$table_news= "orders";
$table_admins = "admins";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $name = $title = $imageurl = $imgname = $content = $aid = "";
    $error = "";
    
    $user_id = "";
    if(empty($_POST["user_id"])) {
        $error = "No user";
    }
    else {
        $user_id = $_POST["user_id"];
    }

    $price = 1000;
    if(empty($_POST["price"])) {
        $error = $error;
    }
    else {
        $price = $_POST["price"];
    }

    if(empty($_POST["nickname"])) {
        $error = $error;
    }
    else {
        $name = $_POST["nickname"];
    }

    $state = '0';
    if(empty($_POST["state"])) {
        $error = $error;
    }
    else {
        $state = $_POST["state"];
    }

    $host_id = 0;
    if(empty($_POST["host_id"])) {
        $host_id = 0;
    }
    else {
        $host_id = $_POST["host_id"];
    }

    $pay = "";
    if(empty($_POST["pay"])) {
        $pay = "";
    }
    else {
        $host_id = $_POST["pay"];
    }

    $start = "";
    if(empty($_POST["start"])) {
        $start = "";
    }
    else {
        $start = $_POST["start"];
    }

    $end = "";
    if(empty($_POST["end"])) {
        $end = "";
    }
    else {
        $end = $_POST["end"];
    }

    $course = "";
    if(empty($_POST["course"])) {
        $course = "";
    }
    else {
        $course = $_POST["course"];
    }

    $address = "";
    if(empty($_POST["address"])) {
        $address = "";
    }
    else {
        $address = $_POST["address"];
    }
    
    $contact = "";
    if(empty($_POST["contact"])) {
        $contact = "";
    }
    else {
        $contact = $_POST["contact"];
    }

    $coursetype = "0";
    if(empty($_POST["coursetype"])) {
        $coursetype = "0";
    }
    else {
        $coursetype = $_POST["coursetype"];
    }

    $purchase = "";
    if(empty($_POST["purchase"])) {
        $purchase = "";
    }
    else {
        $purchase = $_POST["purchase"];
    }

    $schedule_id = "";
    if(empty($_POST["schedule_id"])) {
        $schedule_id = "";
    }
    else {
        $schedule_id = $_POST["schedule_id"];
    }

    $delete = "";
    if(empty($_POST["delete"])) {
        $delete = "";
    }
    else {
        $delete = $_POST["delete"];
    }

    $pay = "";
    if(empty($_POST["pay"])) {
        $pay = "";
    }
    else {
        $pay = $_POST["pay"];
    }
    
    $changeState = "";
    if(empty($_POST["changeState"])) {
        $changeState = "";
    }
    else {
        $changeState = $_POST["changeState"];
    }

    $order_allow = "";
    if(empty($_POST["order_allow"])) {
        $order_allow = "";
    }
    else {
        $order_allow = $_POST["order_allow"] - 1;
    }

    if($error == "") {
        if($delete == "") {
            if($pay == "") {
                if($changeState == "") {
                    if($order_allow == "") {
                        $date = date('Y-m-d H:me:s'); 
                        $sql = "INSERT INTO $table_news(o_uid, o_name, o_hostid, o_price, o_state, o_pay, o_start, o_end, o_course, o_coursetype, o_address, o_contact, o_purchase, update_at, create_at) 
                            VALUES('$user_id', '$name', '$host_id', '$price', '$state', '$pay', '$start', '$end', '$course', '$coursetype', '$address', '$contact', '$purchase', '$date', '$date')";
                        $wpdb->query($sql);
                        $res = array(
                            'error' => $error,
                            'success' => 1
                        );  
                    } else {
                        $date = date('Y-m-d H:me:s'); 
                        $sql = "UPDATE $table_news SET o_allow = '$order_allow', update_at = '$date' WHERE o_id = '$schedule_id'";
                        $wpdb->query($sql);
                        $res = array(
                            'error' => $error,
                            'success' => 5
                        ); 
                    }
                } else {
                    $date = date('Y-m-d H:me:s'); 
                    $sql = "UPDATE $table_news SET o_state = '$changeState', update_at = '$date' WHERE o_id = '$schedule_id'";
                    $wpdb->query($sql);
                    $res = array(
                        'error' => $error,
                        'success' => 4
                    );    
                }
            } else {
                $date = date('Y-m-d H:me:s'); 
                $sql = "UPDATE $table_news SET o_pay = 1, o_pay_date = '$date', update_at = '$date' WHERE o_id = '$schedule_id'";
                $wpdb->query($sql);
                $res = array(
                    'error' => $error,
                    'success' => 3
                );
            }
        } else {
            $date = date('Y-m-d H:me:s'); 
            $sql = "UPDATE $table_news SET o_is_delete = 1, update_at = '$date' WHERE o_id = '$schedule_id'";
            $wpdb->query($sql);
            $res = array(
                'error' => $error,
                'success' => 2
            );
        }

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