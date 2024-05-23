<?php
/*

Template Name: orders get api

*/

require_once 'testinput.php';

if(!isset($_SESSION["user_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

global $wpdb;
$table_name = "users";
$table_orders = "orders";
$table_admins = "admins";
$table_hosts = "hosts";
$user_profile = "user_profile";
$host_id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = "";

    if(empty($_POST["host_id"])) {
        $host_id = "";
    }
    else {
        $host_id = $_POST["host_id"];
    }

    $host_work = "";
    if(empty($_POST["host_work"])) {
    }
    else {
        $host_work = $_POST["host_work"];
    }

    $admin_id = "";
    if(empty($_POST["admin_id"])) {
        $admin_id = "";
    }
    else {
        $admin_id = $_POST["admin_id"];
    }

    $admin_work = "";
    if(empty($_POST["admin_work"])) {
    }
    else {
        $admin_work = $_POST["admin_work"];
    }
    $search_work = "";
    if(empty($_POST["search_work"])) {
    }
    else {
        $search_work = $_POST["search_work"];
    }

    $startDate = "";
    if(empty($_POST["startDate"])) {
    }
    else {
        $startDate = $_POST["startDate"];
    }

    $endDate = "";
    if(empty($_POST["endDate"])) {
    }
    else {
        $endDate = $_POST["endDate"];
    }

    $selectCourse = "";
    if(empty($_POST["selectCourse"])) {
    }
    else {
        $selectCourse = $_POST["selectCourse"];
    }

    $selectHost = "";
    if(empty($_POST["selectHost"])) {
    }
    else {
        $selectHost = $_POST["selectHost"];
    }

    $dash_schedule_box = "";
    if(empty($_POST["selectHost"])) {
    }
    else {
        $selectHost = $_POST["selectHost"];
    }

    $now_working = "";
    if(empty($_POST["now_working"])) {
    }
    else {
        $now_working = $_POST["now_working"];
    }

    $report = "";
    if(empty($_POST["report"])) {
    }
    else {
        $report = $_POST["report"];
    }

    if($error == "") {
        if($search_work == "") {
            if($host_id != "") {
                if($host_work == '1') {
                    $sql = "SELECT * FROM $table_orders LEFT JOIN $user_profile ON $table_orders.o_uid = $user_profile.uf_uid WHERE o_allow = '1' AND o_hostid = '$host_id' AND o_is_delete = '0' ORDER BY o_start";
                } else {
                    $sql = "SELECT * FROM $table_orders LEFT JOIN $user_profile ON $table_orders.o_uid = $user_profile.uf_uid WHERE o_hostid = '$host_id' AND o_is_delete = '0' ORDER BY o_start";
                }
            } else {
                if($report == "") {
                    if($admin_work == '1') {
                        $sql = "SELECT * FROM $table_orders LEFT JOIN $user_profile ON $table_orders.o_hostid = $user_profile.uf_uid WHERE o_allow = '1' AND o_is_delete = '0' ORDER BY o_start";
                    } else {
                        $sql = "SELECT * FROM $table_orders LEFT JOIN $user_profile ON $table_orders.o_hostid = $user_profile.uf_uid WHERE o_is_delete = '0' ORDER BY o_start";
                    }
                } else {
                    $sql = "SELECT * FROM $table_orders LEFT JOIN $user_profile ON $table_orders.o_hostid = $user_profile.uf_uid WHERE o_is_delete = '0' AND o_pay = '1' ORDER BY o_start";
                }
            }
    
            $retrieve_data = $wpdb->get_results($sql);
            $_SESSION["total"] = sizeof($retrieve_data);
            $res = array(
                'error' => $error,
                'data' => $retrieve_data,
                'total' => sizeof($retrieve_data),
                'success' => 1
            );
            echo json_encode($res);
        } else {
            if($now_working == "") {
                $add_sql = "";
                if( $startDate != "" ) $add_sql = "SELECT * FROM $table_orders LEFT JOIN $user_profile ON $table_orders.o_hostid = $user_profile.uf_uid WHERE o_is_delete = '0' AND DATE( o_end ) BETWEEN '$startDate' AND '2200-04-30'";
                else $add_sql =  "SELECT * FROM $table_orders LEFT JOIN $user_profile ON $table_orders.o_hostid = $user_profile.uf_uid WHERE o_is_delete = '0'";
                if( $endDate != "" ) $add_sql .= " AND DATE( o_start ) BETWEEN '1900-04-20' AND '$endDate'";
                if( $selectCourse != "" ) $add_sql .= " AND o_coursetype = ". ($selectCourse - 1);
                if( $selectHost != "" ) 
                {
                    $sql = "SELECT * FROM $table_hosts WHERE $table_hosts.h_uid = $selectHost AND $table_hosts.h_is_delete = '0'";
                    $retrieve_data = $wpdb->get_results($sql);
                    if (sizeof($retrieve_data) > 0) {
                        $selectHost = $retrieve_data[0]->u_id;
                    }
                    $add_sql .= " AND o_hostid =  $selectHost";
                }
                $add_sql .= " ORDER BY o_start";
                $retrieve_data = $wpdb->get_results($add_sql);
            } else {
                if($host_id == "") {
                    $date = date('Y-m-d H:me:s'); 
                    $sql = "SELECT * FROM $table_orders LEFT JOIN $user_profile ON $table_orders.o_hostid = $user_profile.uf_uid WHERE o_allow = '1' AND o_state = 1 AND o_is_delete = '0' ORDER BY o_start";
                    $retrieve_data = $wpdb->get_results($sql);
                } else {
                    $date = date('Y-m-d H:me:s'); 
                    $sql = "SELECT * FROM $table_orders LEFT JOIN $user_profile ON $table_orders.o_uid = $user_profile.uf_uid WHERE o_allow = '1' AND o_state = 1 AND o_is_delete = '0' AND o_uid = '$host_id' ORDER BY o_start";
                    $retrieve_data = $wpdb->get_results($sql);
                }
            }
            $_SESSION["total"] = sizeof($retrieve_data);
            $res = array(
                'error' => $error,
                'data' => $retrieve_data,
                'total' => sizeof($retrieve_data),
                'success' => 2
            );
            echo json_encode($res);
        }
    }
    else {
        $res = array(
            'error' => $error,
            'data' => [],
            'success' => 0
        );
        echo json_encode($res);
    }
}
?>