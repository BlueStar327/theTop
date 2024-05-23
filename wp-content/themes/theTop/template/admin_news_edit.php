<?php
/*
Template Name: admin news edit page
*/

session_start();

if(!isset($_SESSION["admin_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

$news_id = 0;
if(empty($_GET["news_id"])) {
}
else {
    $news_id = $_GET["news_id"];

    $_SESSION["news_id"] = $news_id;
}

get_header(); 
?>

<div class="flex">
    <?php require_once 'a_nav.php' ?>
    <form action="<?php echo esc_url( home_url( '/news_put_api' ) ); ?>" method="POST" class="edit_box" id="userFormdiary" enctype="multipart/form-data">
        <h2>日記の編集</h2>
        <picture>
            <img src="" alt="img" class="image">
        </picture>
        <input type="file" name="image" id="image"  onchange="getFilechange(this)" multiple accept="image/x-png, image/gif, image/jpeg, image/jpg" />
    
        <label for="diary_title">タイトル</label>
        <input type="text" name="diary_title" id="diary_title" class="w-full" required>
        <div class="w-full content_box">
            <ul class="flex justify-between">
                <li><a onclick="add_bold()">
                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_detail_b_ico.png" alt="img">
                </a></li>
                <li><a onclick="add_italic()">
                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_detail_b_i_ico.png" alt="img">
                </a></li>
                <li><a>
                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_detail_b_link_ico.png" alt="img">
                </a></li>
            </ul>
            <textarea name="diary_content" id="diary_content" cols="30" rows="10" class="w-full" required></textarea>
        </div>            
        <div class="flex justify-center">
            <button type="button" class="cancel" onclick="cancel()">キャンセル</button>
            <button type="submit" class="save">保存</button>
        </div>
    </form>
</div>

<?php require_once 'tem_footer.php' ?>
<?php require_once 'user_footer.php' ?>

<script>
function getFilechange(elm) {
    file = elm.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
            $("img.image")
                .attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
    };
}

function cancel() {
    $(window).attr('location','<?php echo esc_url( home_url( '/admin_news' ) ); ?>');
}

$.ajax({
    url: "<?php echo esc_url( home_url( '/news_get_api' ) ); ?>", 
    type: "POST",
    data: {
        user_id: '<?=$_SESSION["user_id"];?>',
        news_id: <?=$news_id;?>
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            $("input#diary_title").val(data['data']['n_title']);
            $("textarea#diary_content").val(data['data']['n_content']);
            $("img.image").attr("src",data['data']['n_image']); 
        }
    }
});

$( "#userFormdiary" ).submit(function( event ) {
    var formData = new FormData(this);
    $.ajax({
        url: "<?php echo esc_url( home_url( '/news_put_api' ) ); ?>?news_id=<?=$news_id;?>", 
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(res){
            alert("News saved successfully.");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {
            if (!window.console) console = { log: function () { } };
            console.log(JSON.stringify(XMLHttpRequest), textStatus, errorThrown);
        }
    });

    event.preventDefault();
});
</script>