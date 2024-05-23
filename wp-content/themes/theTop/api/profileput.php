<?php
/*
Template Name: profile put api

*/

require_once 'testinput.php';

if(!isset($_SESSION["user_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

global $wpdb;
$table_name = "users";
$table_hosts = "hosts";
$table_admins = "admins";
$table_name_profile = "user_profile";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $firstname = $lastname = $contactnumber = $age = $tall = $weight = $bodytype = $state = $imageurl = "";
    $error = "";
    
    $type = "";
    if(empty($_POST["type"])) {
    }
    else {
        $type = $_POST["type"]; 
    }

    if($type == "gone") {
        if(empty($_POST["user_id"])) {
            $error = "User is required.";
        }
        else {
            $user_id = $_POST["user_id"]; 
        }

        $from0 = "";
        if(empty($_POST["from0"])) {
        }
        else {
            $from0 = $_POST["from0"]; 
        }
        $to0 = "";
        if(empty($_POST["to0"])) {
        }
        else {
            $to0 = $_POST["to0"]; 
        }
        $from1 = "";
        if(empty($_POST["from1"])) {
        }
        else {
            $from1 = $_POST["from1"]; 
        }
        $to1 = "";
        if(empty($_POST["to1"])) {
        }
        else {
            $to1 = $_POST["to1"]; 
        }
        $from2 = "";
        if(empty($_POST["from2"])) {
        }
        else {
            $from2 = $_POST["from2"]; 
        }
        $to2 = "";
        if(empty($_POST["to2"])) {
        }
        else {
            $to2 = $_POST["to2"]; 
        }
        $from3 = "";
        if(empty($_POST["from3"])) {
        }
        else {
            $from3 = $_POST["from3"]; 
        }
        $to3 = "";
        if(empty($_POST["to3"])) {
        }
        else {
            $to3 = $_POST["to3"]; 
        }
        $from4 = "";
        if(empty($_POST["from4"])) {
        }
        else {
            $from4 = $_POST["from4"]; 
        }
        $to4 = "";
        if(empty($_POST["to4"])) {
        }
        else {
            $to4 = $_POST["to4"]; 
        }
        $from5 = "";
        if(empty($_POST["from5"])) {
        }
        else {
            $from5 = $_POST["from5"]; 
        }
        $to5 = "";
        if(empty($_POST["to5"])) {
        }
        else {
            $to5 = $_POST["to5"]; 
        }
        $from6 = "";
        if(empty($_POST["from6"])) {
        }
        else {
            $from6 = $_POST["from6"]; 
        }
        $to6 = "";
        if(empty($_POST["to6"])) {
        }
        else {
            $to6 = $_POST["to6"]; 
        }

        $table_gone = "gone";

        $sql = "SELECT * FROM $table_gone WHERE g_is_delete = '0' AND g_uid = $user_id";
        $retrieve_data = $wpdb->get_results($sql);
        if (sizeof($retrieve_data) > 0) {
            $g_id = $retrieve_data[0]->g_id;
            $date = date('Y-m-d H:me:s');
            $sql = "UPDATE $table_gone SET g_is_delete = '1', updated_at = '$date' WHERE g_id = '$g_id'";
            $wpdb->query($sql);
        }

        $date = date('Y-m-d H:me:s');
        $sql = "INSERT INTO $table_gone(g_uid, g_from0, g_to0, g_from1, g_to1, g_from2, g_to2, g_from3, g_to3, g_from4, g_to4, g_from5, g_to5, g_from6, g_to6, updated_at, create_at) 
            VALUES('$user_id', '$from0', '$to0', '$from1', '$to1', '$from2', '$to2', '$from3', '$to3', '$from4', '$to4', '$from5', '$to5', '$from6', '$to6', '$date', '$date')";
        $wpdb->query($sql);
        $res = array(
            'error' => $error,
            'data' => [],
            'success' => 2
        );
        echo json_encode($res);
    } else {
        if(empty($_POST["email"])) {
            $error = "Email is required.";
        }
        else {
            $email = test_input($_POST["email"]); 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format";
            }
        }
        
        if(empty($_POST["fir_name"])) {
            $error = $error ." firstname is required.";
        }
        else {
            $firstname = $_POST["fir_name"];
        }
    
        if(empty($_POST["last_name"])) {
            $error = $error ." lastname is required.";
        }
        else {
            $lastname = $_POST["last_name"];
        }
    
        if(empty($_POST["number"])) {
            $error = $error ." contactnumber is required.";
        }
        else {
            $contactnumber = $_POST["number"];
        }
    
        if(!empty($_POST["age"])) {
            $age = $_POST["age"];
        }
    
        if(!empty($_POST["tall"])) {
            $tall = $_POST["tall"];
        }
    
        if(!empty($_POST["weight"])) {
            $weight = $_POST["weight"];
        }
    
        if(!empty($_POST["body_type"])) {
            $bodytype = $_POST["body_type"];
        }
    
        $level = "";
        if(!empty($_POST["level"])) {
            $level = $_POST["level"];
        }
    
    
        $ranking = 0;
        if(!empty($_POST["ranking"])) {
            $ranking = $_POST["ranking"];
        }
    
        $point = 10000;
        if(!empty($_POST["point"])) {
            $point = $_POST["point"];
        }
        
        $host_content = "";
        if(!empty($_POST["host_content"])) {
            $host_content = $_POST["host_content"];
        }
    
        if(!empty($_POST["state"])) {
            $state = $_POST["state"];
        }
    
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
    
        if($error == "") {
            $sql = "SELECT u_id FROM $table_name LEFT JOIN $table_name_profile ON $table_name.u_id = $table_name_profile.uf_uid WHERE u_email='$email' AND u_is_delete = '0'";
            $retrieve_data = $wpdb->get_results($sql);
            $uid = $retrieve_data[0]->u_id;
            $date = date('Y-m-d H:me:s'); 
            $sql = "UPDATE $table_hosts SET h_level = '$level', h_ranking = '$ranking', h_point = '$point', update_at = '$date' WHERE h_uid = '$uid'";
            $wpdb->query($sql);
            $sql = "SELECT * FROM $table_name_profile WHERE uf_uid='$uid' AND uf_is_delete = '0'";
            $retrieve_data = $wpdb->get_results($sql);
            if (sizeof($retrieve_data) > 0) {
                $date = date('Y-m-d H:me:s'); 
                if($imageurl == "") {
                    $sql = "UPDATE $table_name_profile SET uf_firstname = '$firstname', uf_lastname = '$lastname', uf_contact_number = '$contactnumber', uf_age = '$age', uf_tall = '$tall', uf_weight = '$weight', uf_bodytype = '$bodytype', uf_state = '$state', uf_content = '$host_content', update_at = '$date' WHERE uf_uid = '$uid'";
                } else {
                    $sql = "UPDATE $table_name_profile SET uf_firstname = '$firstname', uf_lastname = '$lastname', uf_contact_number = '$contactnumber', uf_age = '$age', uf_tall = '$tall', uf_weight = '$weight', uf_bodytype = '$bodytype', uf_state = '$state', uf_content = '$host_content', uf_image = '$imageurl', update_at = '$date' WHERE uf_uid = '$uid'";
                }
                $wpdb->query($sql);
                $res = array(
                    'error' => $error,
                    'success' => 2
                );
                echo json_encode($res);
            }
            else {
                $sql = "SELECT u_id FROM $table_name WHERE u_email='$email'  AND u_is_delete = '0'";
                $retrieve_data = $wpdb->get_results($sql);
                $uid = $retrieve_data[0]->u_id;
                $date = date('Y-m-d H:me:s'); 
                if($imageurl == "") {
                    $sql = "INSERT INTO $table_name_profile(uf_uid, uf_firstname, uf_lastname, uf_contact_number, uf_age, uf_tall, uf_weight, uf_bodytype, uf_state, uf_content, update_at, create_at) 
                    VALUES('$uid', '$firstname', '$lastname', '$contactnumber', '$age', '$tall', '$weight', '$bodytype', '$state', '$host_content', '$date', '$date')";
                } else {
                    $sql = "INSERT INTO $table_name_profile(uf_uid, uf_firstname, uf_lastname, uf_contact_number, uf_age, uf_tall, uf_weight, uf_bodytype, uf_state, uf_image, uf_content, update_at, create_at) 
                        VALUES('$uid', '$firstname', '$lastname', '$contactnumber', '$age', '$tall', '$weight', '$bodytype', '$state', '$imageurl', '$host_content', '$date', '$date')";
                }
                $wpdb->query($sql);
                $res = array(
                    'error' => $error,
                    'success' => 1
                );
                echo json_encode($res);
            }
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