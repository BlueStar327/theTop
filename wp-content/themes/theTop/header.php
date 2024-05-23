<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Task</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=get_home_url();?>/wp-content/themes/theTop/css/slick.css">
    <link rel="stylesheet" href="<?=get_home_url();?>/wp-content/themes/theTop/css/slick-theme.css">
    <link rel="stylesheet" href="<?=get_home_url();?>/wp-content/themes/theTop/css/style.css">
</head>
<body> 
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <?php
        require_once 'login.php';
        require_once 'logon.php';
    ?>
    <header class="xl_container">
        <h2 class="flex justify-between header_icobox">
            <p class="text-white">トップページ｜出張ホスト在籍全国トップの出張型女性用風俗店【東京BESTSTORYS】</p>
            <p class="flex justify-end ico_box">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#news" title="ニュース">
                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/ico/news_ico.png" alt="img">
                </a>
                <a title="メッセージ" href="<?php echo esc_url( home_url( '/'. (isset($_SESSION["host_id"]) ? 'host_message' : 'admin_message') ) ); ?>">
                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/ico/message_ico.png" alt="img">
                </a>
                <a title="専門家が知らせる" href="<?php echo (isset($_SESSION["user_id"]) ? (esc_url( home_url( '/' . (($_SESSION["user_job"] == 2) ? 'admin_dashboard' : 'host_dashboard')))) : ""); ?>">
                    <?=isset($_SESSION['user_image']) ?
                        '<img class="face" src="'. $_SESSION['user_image'] .'" alt="img"> ' : '<img class="face" src="' . get_home_url() . '/wp-content/themes/theTop/image/top_human_g_ico.png" alt="img"> ';
                    ?>
                </a>
                <a title="サインイン / オン" onclick="<?=isset($_SESSION["user_id"]) ? "logout()" : "login()";?>">
                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/ico/sign_<?=isset($_SESSION["user_id"])?"out" : "in";?>_ico.png" alt="img">
                </a>
            </p>
        </h2>
        <div class="block justify-between md:flex">
            <h1 class="flex">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/header_logo.png" alt="logo">
                </a>
            </h1>
            <ul class="flex justify-between">
                <li>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-white">トップ</a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/cast_page' ) ); ?>"  class="text-white">キャスト</a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/review_page' ) ); ?>"  class="text-white">レビュー</a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/price_page' ) ); ?>" class="text-white">価格</a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/course_page' ) ); ?>" class="text-white">コース</a>
                </li>
            </ul>
        </div>
    </header>
    <main>