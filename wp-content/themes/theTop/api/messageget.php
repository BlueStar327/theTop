<?php
/*
Template Name: message get api
*/

require_once 'testinput.php';

if(!isset($_SESSION["user_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}


global $wpdb;
$table_name = "users";
$table_admin = "admins";
$table_messages = "message_lists";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link_id = $user_id = "";
    $error = "";
    
    if(empty($_POST["user_id"])) {
        $error = "No user.";
    }
    else {
        $user_id = $_POST["user_id"];
    }

    if(empty($_POST["link_id"])) {
        $error = $error."No link.";
    }
    else {
        $link_id = $_POST["link_id"];
    }

    $admin_id = "";
    if(empty($_POST["admin_id"])) {
    }
    else {
        $admin_id = $_POST["admin_id"];
    }

    if($error == "") {
        if($admin_id == "") {
            $sql = "SELECT * FROM $table_messages WHERE (( m_from_uid = '$user_id' AND m_to_uid = '$link_id') OR (m_from_uid = '$link_id' AND m_to_uid = '$user_id')) AND m_is_delete = '0'";
            $retrieve_data = $wpdb->get_results($sql);
        } else {
            $sql = "SELECT * FROM $table_messages WHERE ( m_to_uid = '$link_id' OR m_from_uid = '$link_id' ) AND m_is_delete = '0'";
            $retrieve_data = $wpdb->get_results($sql);
        }
        foreach ($retrieve_data as $retrieved_data){ 
            if($user_id == $retrieved_data->m_to_uid && $retrieved_data->m_isread == 0 ){
                $date = date('Y-m-d H:me:s'); 
                $sql = "UPDATE $table_messages SET m_isread = 1, update_at = '$date' WHERE m_id = '$retrieved_data->m_id'";
                $wpdb->query($sql);
            }
        }
        $res = array(
            'error' => $error,
            'data' => $retrieve_data,
            'total' => sizeof($retrieve_data),
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