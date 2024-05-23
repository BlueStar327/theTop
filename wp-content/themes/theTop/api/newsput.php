<?php
/*
Template Name: news put api

*/

session_start();

require_once 'testinput.php';

global $wpdb;
$table_name = "users";
$table_news = "news";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $user_id = "";
    $error = "";
    
    if(isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    }

    if(empty($_POST["diary_title"])) {
        $error = "No title";
    }
    else {
        $diary_title = $_POST["diary_title"];
    }

    if(empty($_POST["diary_content"])) {
        $error = $error + "No Content";
    }
    else {
        $diary_content = $_POST["diary_content"];
    }

    $imageurl = "";
    if(json_encode($_FILES["image"]['size']) != 0) {
        $url = $_FILES["image"]["tmp_name"];
        $destination_folder = $_SERVER["DOCUMENT_ROOT"]."/wp-content/themes/theTop/image/";

        $date = new DateTimeImmutable();
        $milli = (int)$date->format('Uv'); // Timestamp in milliseconds

        $imgurl = $destination_folder . $milli . 'myfile0000000.png'; //set you're file ext
        $imageurl = get_home_url() . '/wp-content/themes/theTop/image/'. $milli . 'myfile0000000.png';

        $file = fopen ($url, "rb");

        if ($file) {
            $newf = fopen ($imgurl, "a"); // to overwrite existing file

            if ($newf)
                while(!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
                }
        }

        if ($file) {
            fclose($file);
        }

        if ($newf) {
            fclose($newf);
        }
    }

    $diary_id = "";
    if(isset($_SESSION["news_id"])) {
        $diary_id = $_SESSION["news_id"];
    }
    
    if($diary_id != "") {

        if($error == "") {
            $date = date('Y-m-d H:me:s'); 
            if($imageurl == "") {
                $sql = "UPDATE $table_news SET n_title = '$diary_title', n_content = '$diary_content', update_at = '$date' WHERE n_id = '$diary_id'";
            } else {
                $sql = "UPDATE $table_news SET n_title = '$diary_title', n_content = '$diary_content', n_image = '$imageurl', update_at = '$date' WHERE n_id = '$diary_id'";
            }

            $wpdb->query($sql);
            $res = array(
                'error' => $error,
                'data' => "Update",
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
    } else {
        if($error == "") {
            $date = date('Y-m-d H:me:s'); 
            if($imageurl == "") {
                $sql = "INSERT INTO $table_news(n_aid, n_title, n_content, update_at, create_at) 
                    VALUES('$user_id', '$diary_title', '$diary_content', '$date', '$date')";
            } else {
            $sql = "INSERT INTO $table_news(n_aid, n_title, n_content, n_image, update_at, create_at) 
                VALUES('$user_id', '$diary_title', '$diary_content', '$imageurl', '$date', '$date')";
            }
            $wpdb->query($sql);
            $res = array(
                'error' => $error,
                'data' => "Input",
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