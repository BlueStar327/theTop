<?php
/*
Template Name: admin reviews page
*/

session_start();

if(!isset($_SESSION["admin_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

get_header(); 

$page = 1;
if(!empty($_GET["cpage"])) {
   $page = $_GET["cpage"];
} else {
   $page = 1;
}

$total = 1;
if(isset($_SESSION["total"])) {
    $total = $_SESSION["total"];
} else {
   $total = 1;
}

$items_per_page = 10;

?>
<div class="flex">
    <?php require_once 'a_nav.php' ?>
    <div class="flex justify-between reviews_box">
        <div class="w-full show_review">
            <div class="show_box a_review">
            </div>
            <div class="page_nav a_review">
                <?php 
                    echo paginate_links( array(
                        'base' => add_query_arg( 'cpage', '%#%' ),
                        'format' => '',
                        'prev_text' => __('&laquo;'),
                        'next_text' => __('&raquo;'),
                        'total' => ceil($total / $items_per_page),
                        'current' => $page
                    ));
                ?>
            </div>
        </div>
    </div>
</div>
<?php require_once 'tem_footer.php' ?>
<?php require_once 'user_footer.php' ?>

<script>
$selectReview = "";
$sendContent = "";

function sendReviewBack(num, txt) {
    if(txt != "") {
        $.ajax({
            url: "<?php echo esc_url( home_url( '/review_put_api' ) ); ?>", 
            type: "POST",
            data: {
                user_id: '<?=$_SESSION["user_id"];?>',
                review_id: num,
                review_back: txt
            },
            success: function(res){
            }
        });
    }
}

function sendAllow(num, value) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/review_put_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>',
            review_id: num,
            review_allow: value
        },
        success: function(res){
            showReviews();
        }
    });
}

function showReviews() {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/review_get_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>'
        },
        success: function(res){
            var data = JSON.parse(res);
            var reviews = data['data'];
            var reviews_list = "";
            var end = reviews.length;
            for (let i = 0 + <?=$items_per_page * ($page - 1);?>; i < <?=$page * $items_per_page;?>; i++) {
                 if(i == end) break;
                 reviews_list += '<div class="review">'
                                    + '<div class="flex w-full">'
                                    + '    <div class="w-7/12">'
                                    + '        <p>' + reviews[i]["r_content"] + '</p>'
                                    + '    </div>'
                                    + '    <div class="w-5/12"></div>'
                                    + '</div>'
                                    + '<div class="flex w-full">'
                                    + '    <div class="w-5/12"></div>'
                                    + '    <div class="w-7/12">'
                                    + '     <div class="sendText">'
                                    + '         <textarea name="text" class="reviewsText" cols="" rows="">' + reviews[i]["r_back"] + '</textarea>'
                                    + '          <button class="r_send" type="button" data-r_id="' + reviews[i]["r_id"] + '"></button>'
                                    + '     </div>'
                                    + '    </div>'
                                    + '</div>'
                                    + '<button class="' + ( reviews[i]["r_allow"] == 0 ? 'not' : 'read' ) + '" type="button is_allow"' + ( reviews[i]["r_allow"] == 0 ? ('onclick="sendAllow(' + reviews[i]["r_id"] + ', 2)') : ('onclick="sendAllow(' + reviews[i]["r_id"] + ', 1)') ) + '">' + ( reviews[i]["r_allow"] == 0 ? '許可する' : '許可しません' ) + '</button>'
                                    + '<p class="text-right date"> ' + reviews[i]["create_at"] + ' </p>'
                                    + '</div>';
            }
            $(".show_box").html(reviews_list);

            $(".r_send").each(function () {
                $(this).click(function () {
                    sendReviewBack($(this).attr("data-r_id"), $(this).parent().children("textarea").val());   
                });
            });

            function adjustTextareaHeight() {
                const $this = $(this); // 'this' refers to the current textarea in the loop
                $this.css('height', 'auto');
                $this.css('height', $this.prop('scrollHeight') + 'px');
            }

            // Add event listeners to all textareas with the 'auto-expand' class
            $('.reviewsText').each(function() {
                $(this).on('input', adjustTextareaHeight);
                // Initial adjustment in case any textarea has pre-filled content
                adjustTextareaHeight.call(this);
            });
        }
    });
}

showReviews();

</script>