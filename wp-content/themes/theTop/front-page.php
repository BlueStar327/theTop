<?php 
get_header(); 
session_start();
?>

<div class="age-gate__wrapper">
    <div class="age-gate" role="dialog" aria-modal="true" aria-label="">
        <form method="post" class="age-gate__form">
            <div class="age-gate__heading">
                <img src="<?php echo get_template_directory_uri(); ?>/image/header_logo_black.png" alt="THE TOP"class="age-gate__heading-title age-gate__heading-title--logo" />
            </div>
            <p class="age-gate__subheadline">
                当サイトは、関係法規により18歳未満の方による閲覧は禁止しております。</p>
            <div class="age-gate__fields">
                    
                <p class="age-gate__challenge">あなたは18歳以上ですか？</p>
                <div class="age-gate__buttons">
                    <button type="button" class="age-gate__submit age-gate__submit--yes" value="1" name="age_gate[confirm]" onclick="page_continue()">はい</button>
                    <button class="age-gate__submit age-gate__submit--no" value="0" name="age_gate[confirm]" type="button" onclick="page_stop()">いいえ</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="wrap">

<section class="xl_container top_header">
    <picture>
        <img src="<?php echo get_template_directory_uri(); ?>/image/top_main_bg1.png" alt="Flowers" style="width:auto;">
        <source media="(max-width:768px)" srcset="<?php echo get_template_directory_uri(); ?>/image/top_main_bg1.png">
    </picture>
        <video class="main_video" poster="<?php echo get_template_directory_uri(); ?>/image/video_post.png" preload="none" webkit-playsinline="" playsinline="" muted="" autoplay="" loop="" src="https://the-top.jp/wp-content/themes/the-top/images/index/the_top_pv_720_mute.mp4"></video>
</section>

<section class="xl_container top_ranking">
    <h2 class="text-center">RANKING</h2>
    <p class="text-center txt last_month">3月度売上ランキング</p>
    <script>
        var date = new Date();
        if(date.getMonth() == 0) $(".last_month").html("12月度売上ランキング");
        else $(".last_month").html(date.getMonth() + "月度売上ランキング");
    </script>
    <div class="human_card first_rank"></div>
    <div class="flex justify-between secondd_rank">
    </div>
    <div class="grid grid-cols-4 extra_rank">
    </div>
    <div class="flex justify-center">
        <a href="<?php echo esc_url( home_url( '/cast_page' ) ); ?>" class="red_btn">キャスト一覧</a>
    </div>
</section>

<section class="xl_container yellow_bg top_cast">
    <h2 class="text-center">TODAY'S CAST</h2>
    <p class="text-center txt">本日の出勤情報</p>
    <div class="relative">
        <div class="flex justify-between top_slider">
        </div>
    </div>
    <div class="flex justify-center top_cast_btn">
        <a href="<?php echo esc_url( home_url( '/cast_page' ) ); ?>" class="red_btn">キャストスケジュール</a>
    </div>
</section>
 <script>
    $.ajax({
        url: "<?php echo esc_url( home_url( '/hosts_get_api' ) ); ?>", 
        type: "POST",
        data: {
        },
        success: function(res){
            var data = JSON.parse(res);
            if(data['data'] != [])  {
                var end = 11;
                var hosts = data['data'];
                var htmltext = "";
                $.each(hosts, function(index, value ) {
                    htmltext += '<div>'
                                + '    <div class="human_card">'
                                + '     <p class="number">Star</p>'
                                + '     <h5>' + (value["uf_image"] ? value["uf_firstname"] : "キャスト名") + (value["uf_image"] ? value["uf_lastname"] : "") + '</h5>'
                                + '     <a href="<?php echo esc_url( home_url( '/cast_detail' ) ); ?>?host_id=' + value['h_id'] + '">'
                                + '     <picture>'
                                + '         <img src="' + (value["uf_image"] ? value["uf_image"] : "<?php echo get_template_directory_uri(); ?>/image/cast_detail_img.png") + '" alt="order">'
                                + '     </picture>'
                                + '     </a>'
                                + '     <p class="infor"></p>'
                                + '     <p class="detail"></p>'
                                + ' </div>'
                                + '</div>';
                });
                $(".top_slider").html(htmltext);
                $('.top_slider').slick({
                    dots: false,
                    infinite: true,
                    centerMode: true,
                    centerPadding: '0px',
                    speed: 800,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: false,
                    pauseOnFocus: true,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 769,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            }
        }
    });
</script> 

<section class="xl_container top_realrank">
    <h2 class="text-center">REAL TIME RANKING</h2>
    <p class="text-center txt">コイン別売上ランキング</p>
    <ul class="real_rank">
    </ul>
    <div class="flex justify-center top_cast_btn">
        <a href="<?php echo esc_url( home_url( '/cast_page' ) ); ?>" class="red_btn">コインの購入はこちらから</a>
    </div>
</section>

<section class="xl_container yellow_bg top_realnews" id="news">
    <h2 class="text-center">NEWS</h2>
    <ul class="grid grid-cols-2 news_table">
    </ul>
</section>

<section class="xl_container top_review">
    <div class="block justify-between lg:flex">
    	<div class="p_imgs">
            <h2 class="text-center">CAST DIARY<br><span>写メ日記</span></h2>
            <div class="imgs">
            </div>
        </div>
        <div class="review">
        </div>
    </div>
</section>
</div>

<?php get_footer(); ?>

<script>
$("body").addClass("full_vh");
$("#wrap").addClass("wrap");
$("header").addClass("filter");

function page_continue() {
    $("body").removeClass("full_vh");
    $("#wrap").removeClass("wrap");
    $("header").removeClass("filter");
    $(".age-gate__wrapper").addClass("none");
}

<?php
if(isset($_SESSION["visit"])) {
    echo "page_continue();";
} else {
    $_SESSION["visit"] = "visit";
}
?>

function page_stop() {
    $(".age-gate__wrapper").addClass("none");
}

$.ajax({
    url: "<?php echo esc_url( home_url( '/news_get_api' ) ); ?>", 
    type: "POST",
    data: {
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var news = data['data'];
            var htmltext = "";
            var end = 0;
            if(news.length > 6) end = 6;
            else end = news.length;
            for (let i = 0; i < end; i++) {
                htmltext += '<li class="flex">'
                + '    <div class="human_left_card">'
                + '     <picture>'
                + '         <img src="' + (news[i]["n_image"] ? news[i]["n_image"] : "<?=get_home_url();?>/wp-content/themes/theTop/image/IMG_5166.JPG") + '" alt="person">'
                + '     </picture>'
                + '     <div class="txt">'
                + '         <h5>' + news[i]["n_title"] + '</h5>'
                + '         <p class="news_height">' + news[i]["n_content"] + '</p>'
                + '     </div>'
                + '     <a class="more_link" href="<?php echo esc_url( home_url( '/news_detail' ) ); ?>?news_id=' + news[i]["n_id"] + '">もっと見る</a>'
                + ' </div>'
                + '</li>';
            }
            $("ul.news_table").html(htmltext);
        }
    }
});

$.ajax({
    url: "<?php echo esc_url( home_url( '/diarys_get_api' ) ); ?>", 
    type: "POST",
    data: {
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var news = data['data'];
            var htmltext = '';
            var end = 0;
            if(news.length > 8) end = 8;
            else end = news.length;
            for (let i = 0; i < end; i++) {
                htmltext += '<div class="card">'
                            + '<a href="<?php echo esc_url( home_url( '/diary_detail' ) ); ?>?id=' + news[i]["d_id"] + '">'
                            + '    <div class="picture">'
                            + '     <picture>'
                            + '         <img src="' + news[i]["d_image"] + '" alt="img">'
                            + '         <source media="(max-width: 768px)" srcset="' + news[i]["d_image"] + '">'
                            + '     </picture>'
                            + '     <p class="date">' + news[i]["update_at"] + '</p>'
                            + ' </div>'
                            + ' <div>'
                            + '     <p class="text-center topic">' + news[i]["d_title"] + '</p>'
                            + '     <p class="text-center name">' + news[i]["uf_firstname"] + " " + news[i]["uf_lastname"] + '</p>'
                            + ' </div>'
                            + '</a></div>';
            }
            $(".imgs").html(htmltext);
        }
    }
});

var reviews = [];

function display() {
    var end = 4;
    var len = reviews.length;
    var reviews_list = '<h2 class="text-center">CAST REVEIEW<br><span>レビュー</span></h2>';
    if (len > end) {
    } else {
        end = len;
    }

    for (let i = 0; i < end; i++) {
        var str = reviews[i]['create_at'];
        var date = new Date(str);
        var str = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
        reviews_list += '<div class="history_card"><a  href="<?php echo esc_url( home_url( '/review_page' ) ); ?>">'
                        + '    <div class="flex card_header">'
                        + '        <p class="text-center index">' + str + '<br>スーパー忍者</p>'
                        + '        <div class="line_circle">'
                        + '            <div></div>'
                        + '        </div>'
                        + '        <picture>'
                        + '            <img src="' + reviews[i]['uf_image'] + '" alt="cast">'
                        + '            <source media="(max-width: 768px)" srcset="top_human_ico1.png">'
                        + '        </picture>'
                        + '        <p class="name">' + reviews[i]['uf_firstname'] + ' ' + reviews[i]['uf_lastname'] + '</p>'
                        + '        <ul class="flex justify-between">'
                        + '            <li>'
                        + '                <picture>'
                        + '                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/top_star_ico1.png" alt="cast">'
                        + '                    <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/top_star_ico1.png">'
                        + '                </picture>'
                        + '            </li>'
                        + '           <li>'
                        + '                <picture>'
                        + '                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/top_star_ico1.png" alt="cast">'
                        + '                    <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/top_star_ico1.png">'
                        + '                </picture>'
                        + '            </li>'
                        + '           <li>'
                        + '                <picture>'
                        + '                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/top_star_ico1.png" alt="cast">'
                        + '                    <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/top_star_ico1.png">'
                        + '                </picture>'
                        + '            </li>'
                        + '            <li>'
                        + '                <picture>'
                        + '                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/top_star_ico1.png" alt="cast">'
                        + '                    <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/top_star_ico1.png">'
                        + '                </picture>'
                        + '            </li>'
                        + '            <li>'
                        + '                <picture>'
                        + '                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/top_star_ico1.png" alt="cast">'
                        + '                    <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/top_star_ico1.png">'
                        + '                </picture>'
                        + '            </li>'
                        + '        </ul>'
                        + '    </div>'
                        + '<div class="card_body">'
                        + '    <p>' + reviews[i]['r_content'] + '</p>';
                        if(reviews[i]['r_back']) {
                            reviews_list += '<div class="detail">'
                        + '           <h6>良いレビューありがとうございます。</h6>'
                        + '            <p>' + reviews[i]['r_back'] + '</p>'
                        + '         </div>';
                        }
                        reviews_list += '</div>'
                            + '  </a>  </div>';
    }
    $(".review").html(reviews_list);
}

$.ajax({
    url: "<?php echo esc_url( home_url( '/review_get_api' ) ); ?>", 
    type: "POST",
    data: {
    },
    success: function(res){
        var data = JSON.parse(res);
        reviews = data['data'];
        display();

        $.ajax({
            url: "<?php echo esc_url( home_url( '/hosts_get_api' ) ); ?>", 
            type: "POST",
            data: {
            },
            success: function(res){
                var data = JSON.parse(res);
                if(data['data'] != [])  {
                    var end = 11;
                    var hosts = data['data'];
                    var htmltext = "";
                    if(hosts.length < end) end = hosts.length;
                    for (let i = 0;  i < end; i++) {
                        if(i == 0) {
                            htmltext += '<p class="number"> ' + (i + 1) + '</p>'
                                        + '<a href="<?php echo esc_url( home_url( '/cast_detail' ) ); ?>?host_id=' + hosts[i]['h_id'] + '">'
                                        + ' <picture>'
                                        + '  <img src="' + (hosts[i]["uf_image"] ? hosts[i]["uf_image"] : "<?php echo get_template_directory_uri(); ?>/image/cast_detail_img.png") + '" alt="order">'
                                        + ' </picture>'
                                        + ' </a>'
                                        + ' <h5>' + (hosts[i]["uf_firstname"] ? hosts[i]["uf_firstname"] : "キャスト名") + " " + (hosts[i]["uf_lastname"] ? hosts[i]["uf_lastname"] : "") + '</h5>'
                                        + ' <p class="detail"></p>';
                            $(".first_rank").html(htmltext);
                            htmltext = "";
                        } else if(i == 1 || i == 2) {
                            htmltext += '<div class="human_card">'
                                        +' <p class="number"> ' + (i + 1) + '</p>'
                                        + '<a href="<?php echo esc_url( home_url( '/cast_detail' ) ); ?>?host_id=' + hosts[i]['h_id'] + '">'
                                        + ' <picture>'
                                        + '  <img src="' + (hosts[i]["uf_image"] ? hosts[i]["uf_image"] : "<?php echo get_template_directory_uri(); ?>/image/cast_detail_img.png") + '" alt="order">'
                                        + ' </picture>'
                                        + ' </a>'
                                        + ' <h5>' + (hosts[i]["uf_firstname"] ? hosts[i]["uf_firstname"] : "キャスト名") + " " + (hosts[i]["uf_lastname"] ? hosts[i]["uf_lastname"] : "") + '</h5>'
                                        + ' <p class="detail"></p>'
                                        + ' </div>';
                            $(".secondd_rank").html(htmltext);
                            if(i == 2) htmltext = "";
                        } else {
                            htmltext += '<div class="human_card end_rank">'
                                        +' <p class="number"> ' + (i + 1) + '</p>'
                                        + '<a href="<?php echo esc_url( home_url( '/cast_detail' ) ); ?>?host_id=' + hosts[i]['h_id'] + '">'
                                        + ' <picture>'
                                        + '  <img src="' + (hosts[i]["uf_image"] ? hosts[i]["uf_image"] : "<?php echo get_template_directory_uri(); ?>/image/cast_detail_img.png") + '" alt="order">'
                                        + ' </picture>'
                                        + ' </a>'
                                        + ' <h5>' + (hosts[i]["uf_firstname"] ? hosts[i]["uf_firstname"] : "キャスト名") + " " + (hosts[i]["uf_lastname"] ? hosts[i]["uf_lastname"] : "") + '</h5>'
                                        + ' <p class="detail"></p>'
                                        + ' </div>';
                            $(".extra_rank").html(htmltext);
                        }
                    }
        
                    end = 5;
                    htmltext = "";
                    if(hosts.lenght < end) end = hosts.lenght;
                    for (let i = 0;  i < end; i++) {
                        var neededObject = reviews.find(obj => obj.h_id === hosts[i]["h_id"]);
                        htmltext += '<li class="flex justify-center">'
                                    +'    <div class="human_left_card">'
                                    +'      <picture>'
                                    +'          <img src="' + (hosts[i]["uf_image"] ? hosts[i]["uf_image"] : "<?php echo get_template_directory_uri(); ?>/image/cast_detail_img.png") + '" alt="person">'
                                    +'      </picture>'
                                    +'      <div class="txt">'
                                    +'          <h5>' + (hosts[i]["uf_firstname"] ? hosts[i]["uf_firstname"] : "キャスト名") + " " + (hosts[i]["uf_lastname"] ? hosts[i]["uf_lastname"] : "") + '</h5>'
                                    +'          <p>'+ (neededObject["r_content"]? neededObject["r_content"]: ('7/19 Hさん 10コイン 今月もファイトです！<br>'
                                    +'              7/25 匿名さん 1コイン 真似事もセラピーも頑張ってます！ ！<br>'
                                    +'              8/20 匿名さん 1コイン ありがとうございます！<br>')) +'</p>'
                                    +'      </div>'
                                    +'  </div>'
                                    +'</li>';
                        $(".real_rank").html(htmltext);
                    }
                }
            }
        });
    }
});

</script>