<?php
/*
Template Name: diary delete api
*/

require_once 'testinput.php';

if(!isset($_SESSION["user_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}


global $wpdb;
$table_name = "users";
$table_diary = "diary";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $diary_id = "";
    $error = "";
    
    if(empty($_POST["diary_id"])) {
        $error = "No diary";
    }
    else {
        $diary_id = $_POST["diary_id"];
    }

    if($error == "") {
        $sql = "UPDATE $table_diary SET d_is_delete = 1 WHERE d_id = '$diary_id'";
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