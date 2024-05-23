<?php
/*
Template Name: review put api
*/

require_once 'testinput.php';

global $wpdb;
$table_name = "users";
$table_messages = "reviews";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $user_id = $to_id = $content = "";
    $error = "";
    
    if(empty($_POST["user_id"])) {
    }
    else {
        $user_id = $_POST["user_id"];
    }

    if(!empty($_POST["review_back"])) {
        if(empty($_POST["review_id"])) {
            $error = $error ." review_id is required.";
        }
        else {
            $review_id = $_POST["review_id"]; 
        }

        if(empty($_POST["review_back"])) {
            $error = $error ." review_back is required.";
        }
        else {
            $review_back = $_POST["review_back"];
        }

        $date = date('Y-m-d H:me:s'); 
        $sql = "UPDATE $table_messages SET r_back = '$review_back', update_at = '$date' WHERE r_id = '$review_id'";
        $wpdb->query($sql);

        $res = array(
            'error' => $error,
            'success' => 1
        );
        echo json_encode($res);

    } elseif(!empty($_POST["review_allow"])) {
        if(empty($_POST["review_id"])) {
            $error = $error ." review_id is required.";
        }
        else {
            $review_id = $_POST["review_id"];
        }

        if(empty($_POST["review_allow"])) {
            $error = $error ." review_allow is required.";
        }
        else {
            $review_allow = $_POST["review_allow"] - 1;
        }

        $date = date('Y-m-d H:me:s'); 
        $sql = "UPDATE $table_messages SET r_allow = '$review_allow', update_at = '$date' WHERE r_id = '$review_id'";
        $wpdb->query($sql);

        $res = array(
            'error' => $error,
            'success' => 1
        );
        echo json_encode($res);

    } else {
        if(empty($_POST["content"])) {
            $error = $error ." content is required.";
        }
        else {
            $content = $_POST["content"];
        }
    
        if($error == "") {
            $date = date('Y-m-d H:me:s'); 
            $sql = "INSERT INTO $table_messages(r_uid, r_content, update_at, create_at) 
                VALUES('$user_id', '$content', '$date', '$date')";
            $wpdb->query($sql);
            $res = array(
                'error' => $error,
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
}
          
?>