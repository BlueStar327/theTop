<?php
/*

Template Name: news get api

*/

require_once 'testinput.php';

global $wpdb;
$table_name = "users";
$table_news = "news";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $user_id = "";
    $error = "";
    
    if(empty($_POST["user_id"])) {
    }
    else {
        $user_id = $_POST["user_id"];
    }

    if(empty($_POST["news_id"])) {
        if($error == "") {
            $sql = "SELECT * FROM $table_news WHERE n_is_delete = '0'";
            $retrieve_data = $wpdb->get_results($sql);
            $_SESSION["total"] = sizeof($retrieve_data);
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
    else {
        $news_id = $_POST["news_id"];

        if($error == "") {
            $sql = "SELECT * FROM $table_news WHERE n_is_delete = '0' AND n_id='$news_id'";
            $retrieve_data = $wpdb->get_results($sql);
            $res = array(
                'error' => $error,
                'data' => $retrieve_data[0],
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