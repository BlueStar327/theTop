<?php
/*
Template Name: review page
*/
 get_header(); 
?>
<section class="xl_container cast_mv">
    <picture>
        <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg_sp.png">
        <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg.png" alt="mv">
    </picture>
    <div class="absolute">
        <p>レビュー</p>
    </div>
</section>

<div class="flex justify-between navigation">
    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a> レビュー</p>
    <p></p>
</div>

<section class="xl_container top_review review_box">
    <div class="review">
    </div>

    <div class="flex justify-center items-center">
        <a class="red_btn" onclick="continue_page()">続きを読む</a>
    </div>
</section>

<?php get_footer(); ?>

<script>
    var reviews = [];
    var end = 4;

    function continue_page() {
        end += 4;
        display();
    }

    function display() {
        var len = reviews.length;
        var reviews_list = "";
        if (len > end) {
        } else {
            end = len;
        }
    
        for (let i = 0; i < end; i++) {
            var str = reviews[i]['create_at'];
            var date = new Date(str);
            var str = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
            reviews_list += '<div class="history_card">'
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
                                + '    </div>';
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
        }
    });
</script>