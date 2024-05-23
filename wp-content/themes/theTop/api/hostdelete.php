<?php
/*
Template Name: host delete api
*/

require_once 'testinput.php';

if(!isset($_SESSION["admin_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}


global $wpdb;
$table_name = "users";
$table_hosts = "hosts";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $host_id = "";
    $error = "";
    
    if(empty($_POST["host_id"])) {
        $error = "No diary";
    }
    else {
        $host_id = $_POST["host_id"];
    }

    if($error == "") {
        $sql = "UPDATE $table_hosts SET h_is_delete = 1 WHERE h_id = '$host_id'";
        $wpdb->query($sql);
        $res = array(
            'error' => $error,
            'data' => 'Successful delete',
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