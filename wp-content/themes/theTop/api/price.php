<?php
/*
Template Name: price get api
*/

session_start();

require_once 'testinput.php';

global $wpdb;
$table_name = "price";
$table_method = "method";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $user_id = "";
    $error = "";
    
    if(isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    }

    $type = 0;
    if(empty($_POST["type"])) {
        $error = "No type";
    }
    else {
        $type = $_POST["type"];
    }

    if($type == '1') {
        $sql = "SELECT * FROM $table_name WHERE p_is_delete = '0'";
        $retrieve_data = $wpdb->get_results($sql);
        if (sizeof($retrieve_data) > 0) {
            $res = array(
                'error' => $error,
                'data' => $retrieve_data[0],
                'success' => 1
            );
            echo json_encode($res);
        }
        else {
            $error = "No data";
            $res = array(
                'error' => $error,
                'data' => [],
                'success' => 0
            );
            echo json_encode($res);
        }
    } elseif($type == '2') {
        
        if(!isset($_SESSION["admin_id"])) {
            header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
        }

        $p_rookie_date = 0;
        if(empty($_POST["p_rookie_date"])) {
            $error = $error + "No rookie date";
        }
        else {
            $p_rookie_date = $_POST["p_rookie_date"];
        }

        $p_bronze_date = 0;
        if(empty($_POST["p_bronze_date"])) {
            $error = $error + "No bronze date";
        }
        else {
            $p_bronze_date = $_POST["p_bronze_date"];
        }

        $p_silver_date = 0;
        if(empty($_POST["p_silver_date"])) {
            $error = $error + "No silver_date";
        }
        else {
            $p_silver_date = $_POST["p_silver_date"];
        }

        $p_gold_date = 0;
        if(empty($_POST["p_gold_date"])) {
            $error = $error + "No gold_date";
        }
        else {
            $p_gold_date = $_POST["p_gold_date"];
        }

        $p_legend_date = 0;
        if(empty($_POST["p_legend_date"])) {
            $error = $error + "No legend_date";
        }
        else {
            $p_legend_date = $_POST["p_legend_date"];
        }

        $p_rookie_hotel = 0;
        if(empty($_POST["p_rookie_hotel"])) {
            $error = $error + "No rookie_hotel";
        }
        else {
            $p_rookie_hotel = $_POST["p_rookie_hotel"];
        }

        $p_bronze_hotel = 0;
        if(empty($_POST["p_bronze_hotel"])) {
            $error = $error + "No bronze_hotel";
        }
        else {
            $p_bronze_hotel = $_POST["p_bronze_hotel"];
        }

        $p_silver_hotel = 0;
        if(empty($_POST["p_silver_hotel"])) {
            $error = $error + "No silver_hotel";
        }
        else {
            $p_silver_hotel = $_POST["p_silver_hotel"];
        }

        $p_gold_hotel = 0;
        if(empty($_POST["p_gold_hotel"])) {
            $error = $error + "No gold_hotel";
        }
        else {
            $p_gold_hotel = $_POST["p_gold_hotel"];
        }

        $p_legend_hotel = 0;
        if(empty($_POST["p_legend_hotel"])) {
            $error = $error + "No legend_hotel";
        }
        else {
            $p_legend_hotel = $_POST["p_legend_hotel"];
        }

        $p_rookie_call = 0;
        if(empty($_POST["p_rookie_call"])) {
            $error = $error + "No rookie_call";
        }
        else {
            $p_rookie_call = $_POST["p_rookie_call"];
        }

        $p_normal_call = 0;
        if(empty($_POST["p_normal_call"])) {
            $error = $error + "No normal_call";
        }
        else {
            $p_normal_call = $_POST["p_normal_call"];
        }

        $p_rookie_10h = 0;
        if(empty($_POST["p_rookie_10h"])) {
            $error = $error + "No p_rookie_10h";
        }
        else {
            $p_rookie_10h = $_POST["p_rookie_10h"];
        }

        $p_normal_10h = 0;
        if(empty($_POST["p_normal_10h"])) {
            $error = $error + "No normal_10h";
        }
        else {
            $p_normal_10h = $_POST["p_normal_10h"];
        }

        $p_rookie_24h = 0;
        if(empty($_POST["p_rookie_24h"])) {
            $error = $error + "No rookie_24h";
        }
        else {
            $p_rookie_24h = $_POST["p_rookie_24h"];
        }

        $p_normal_24h = 0;
        if(empty($_POST["p_normal_24h"])) {
            $error = $error + "No normal_24h";
        }
        else {
            $p_normal_24h = $_POST["p_normal_24h"];
        }

        $p_region_price = 0;
        if(empty($_POST["p_region_price"])) {
            $error = $error + "No region_price";
        }
        else {
            $p_region_price = $_POST["p_region_price"];
        }

        $p_traffic_price = 0;
        if(empty($_POST["p_traffic_price"])) {
            $error = $error + "No traffic_price";
        }
        else {
            $p_traffic_price = $_POST["p_traffic_price"];
        }
        
        $p_traffic_price_etc = 0;
        if(empty($_POST["p_traffic_price_etc"])) {
            $error = $error + "No traffic_price";
        }
        else {
            $p_traffic_price_etc = $_POST["p_traffic_price_etc"];
        }

        $p_travel_price = 0;
        if(empty($_POST["p_travel_price"])) {
            $error = $error + "No travel_price";
        }
        else {
            $p_travel_price = $_POST["p_travel_price"];
        }

        $sql = "SELECT * FROM $table_name WHERE p_is_delete = '0'";
        $retrieve_data = $wpdb->get_results($sql);
        if (sizeof($retrieve_data) > 0) {
            $p_id = $retrieve_data[0]->p_id;
            $date = date('Y-m-d H:me:s');
            $sql = "UPDATE $table_name SET p_is_delete = '1', updated_at = '$date' WHERE p_id = '$p_id'";
            $wpdb->query($sql);
        }

        $date = date('Y-m-d H:me:s');
        $sql = "INSERT INTO $table_name(p_rookie_date, p_bronze_date, p_silver_date, p_gold_date, p_legend_date, p_rookie_hotel, p_bronze_hotel, p_silver_hotel, p_gold_hotel, p_legend_hotel, p_rookie_call, p_normal_call, p_rookie_10h, p_normal_10h, p_rookie_24h, p_normal_24h, p_region_price, p_traffic_price, p_traffic_price_etc, p_travel_price, updated_at, create_at) 
            VALUES('$p_rookie_date', '$p_bronze_date', '$p_silver_date', '$p_gold_date', '$p_legend_date', '$p_rookie_hotel', '$p_bronze_hotel', '$p_silver_hotel', '$p_gold_hotel', '$p_legend_hotel', '$p_rookie_call', '$p_normal_call', '$p_rookie_10h', '$p_normal_10h', '$p_rookie_24h', '$p_normal_24h', '$p_region_price', '$p_traffic_price', '$p_traffic_price_etc', '$p_travel_price', '$date', '$date')";
        $wpdb->query($sql);
        $res = array(
            'error' => $error,
            'data' => [],
            'success' => 2
        );
        echo json_encode($res);
    } elseif($type == '3') {
        $sql = "SELECT * FROM $table_method WHERE m_is_delete = '0'";
        $retrieve_data = $wpdb->get_results($sql);
        if (sizeof($retrieve_data) > 0) {
            $res = array(
                'error' => $error,
                'data' => $retrieve_data[0],
                'success' => 1
            );
            echo json_encode($res);
        }
        else {
            $error = "No data";
            $res = array(
                'error' => $error,
                'data' => [],
                'success' => 0
            );
            echo json_encode($res);
        }
    } elseif($type == '4') {
        
        if(!isset($_SESSION["admin_id"])) {
            header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
        }

        $get_method = 0;
        if(empty($_POST["get_method"])) {
            $error = $error + "No method";
        }
        else {
            $get_method = $_POST["get_method"];
        }

        $sql = "SELECT * FROM $table_method WHERE m_is_delete = '0'";
        $retrieve_data = $wpdb->get_results($sql);
        if (sizeof($retrieve_data) > 0) {
            $m_id = $retrieve_data[0]->m_id;
            $date = date('Y-m-d H:me:s');
            $sql = "UPDATE $table_method SET m_is_delete = '1', update_at = '$date' WHERE m_id = '$m_id'";
            $wpdb->query($sql);
        }

        $date = date('Y-m-d H:me:s');
        $sql = "INSERT INTO $table_method(m_method, update_at, create_at) 
            VALUES('$get_method', '$date', '$date')";
        $wpdb->query($sql);
        $res = array(
            'error' => $error,
            'data' => [],
            'success' => 2
        );
        echo json_encode($res);
    } else {
        $res = array(
            'error' => $error,
            'data' => [],
            'success' => 0
        );
        echo json_encode($res);
    }
  }     
?>