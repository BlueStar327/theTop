<?php
/*
Template Name: host profile page
*/

session_start();

if(!isset($_SESSION["host_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

 get_header(); 
?>
<div class="flex">
    <?php require_once 'c_nav.php' ?>
    <form action="<?php echo esc_url( home_url( '/profile_put_api' ) ); ?>" method="POST" class="flex edit_box" id="userFormprofile" enctype="multipart/form-data">
        <div class="img_box">
            <h2>プロファイル編集</h2>
            <picture>
                <img src="" alt="img" class="face">
            </picture>
            <input type="file" name="image" id="image"  onchange="getFilechange(this)" multiple accept="image/x-png, image/gif, image/jpeg, image/jpg" />
        </div>
        <div class="inform_box">
            <div class="flex justify-between w-full">
                <div class="w-5/12">
                    <label for="fir_name">ファーストネーム</label>
                    <input type="text" name="fir_name" id="fir_name" class="w-full">
                </div>
                <div class="w-5/12">
                    <label for="last_name">苗字</label>
                    <input type="text" name="last_name" id="last_name" class="w-full">
                </div>
            </div>
            <div class="w-full">
                <label for="email">Eメール</label>
                <input type="text" name="email" id="email" class="w-full" value="<?php echo $_SESSION["user_email"]?>" readonly>
            </div>
            <div class="w-full">
                <label for="number">連絡先番号</label>
                <input type="tel" name="number" id="number" class="w-full">
            </div>
            <div class="flex justify-between w-full">
                <div class="w-3/12">
                    <label for="age">年齢</label>
                    <input type="number" name="age" id="age" class="w-full">
                </div>
                <div class="w-3/12">
                    <label for="tall">高い</label>
                    <input type="number" name="tall" id="tall" class="w-full">
                </div>
                <div class="w-3/12">
                    <label for="weight">重さ</label>
                    <input type="text" name="weight" id="weight" class="w-full">
                </div>
            </div>
            <div class="flex justify-between w-full">
                <div class="w-3/12">
                    <label for="ranking">ランキング</label>
                    <input type="number" name="ranking" id="ranking" class="w-full">
                </div>
                <div class="w-3/12">
                    <label for="level">レベル</label>
                    <!-- <input type="text" name="level" id="level" class="w-full"> -->
                    <select name="level" id="level" class="w-full">
                        <option value="1">Rookie</option>
                        <option value="2">Bronze</option>
                        <option value="3">Silver</option>
                        <option value="4">Gold</option>
                        <option value="5">Legend</option>
                    </select>
                </div>
                <div class="w-3/12">
                    <label for="point">ポイント</label>
                    <input type="number" name="point" id="point" class="w-full">
                </div>
            </div>
            <div class="flex justify-between w-full">
                <div class="w-5/12">
                    <label for="body_type">肉体型</label>
                    <input type="text" name="body_type" id="body_type" class="w-full">
                </div>
                <div class="w-5/12">
                    <label for="state">州</label>
                    <input type="text" name="state" id="state" class="w-full">
                </div>
            </div>
            <div class="flex w-full">
                <button type="button" class="cancel">キャンセル</button>
                <button type="submit" class="save">保存</button>
            </div>
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
            $("img.face")
                .attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
    };
}
$.ajax({
    url: "<?php echo esc_url( home_url( '/profile_get_api' ) ); ?>", 
    type: "POST",
    data: {
        user_id: '<?=$_SESSION["user_id"];?>'
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            $("input#fir_name").val(data['data']['uf_firstname']);
            $("input#last_name").val(data['data']['uf_lastname']);
            $("input#number").val(data['data']['uf_contact_number']);
            $("input#age").val(data['data']['uf_age']);
            $("input#tall").val(data['data']['uf_tall']);
            $("input#weight").val(data['data']['uf_weight']);
            $("input#body_type").val(data['data']['uf_bodytype']);
            $("input#state").val(data['data']['uf_state']);
            $("img.face").attr("src",data['data']['uf_image']); 
            $("input#ranking").val(data['data']['h_ranking']);
            $("input#point").val(data['data']['h_point']);
            $("#level").val(data['data']['h_level']);
        }
    }
});

$( "#userFormprofile" ).submit(function( event ) {
    var formData = new FormData(this);
    $.ajax({
        url: "<?php echo esc_url( home_url( '/profile_put_api' ) ); ?>", 
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(res){
            alert("Profile saved successfully.");
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