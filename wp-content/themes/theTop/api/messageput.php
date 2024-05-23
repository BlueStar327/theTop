<?php
/*
Template Name: message put api
*/

require_once 'testinput.php';

if(!isset($_SESSION["user_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

global $wpdb;
$table_name = "users";
$table_messages = "message_lists";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $user_id = $to_id = $content = "";
    $error = "";
    
    if(empty($_POST["user_id"])) {
        $error = "No user.";
    }
    else {
        $user_id = $_POST["user_id"];
    }

    if(empty($_POST["to_id"])) {
        $error = $error ." to_id is required.";
    }
    else {
        $to_id = $_POST["to_id"];
    }

    if(empty($_POST["content"])) {
        $error = $error ." content is required.";
    }
    else {
        $content = $_POST["content"];
    }

    if($error == "") {
        $date = date('Y-m-d H:me:s'); 
        $sql = "INSERT INTO $table_messages(m_from_uid, m_to_uid, m_content, update_at, create_at) 
            VALUES('$user_id', '$to_id', '$content', '$date', '$date')";
        $wpdb->query($sql);
        $res = array(
            'error' => $error,
            'success' => 1,
            'data' => array(
                'm_content' => "$content",
                'create_at' => "$date"
            )
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