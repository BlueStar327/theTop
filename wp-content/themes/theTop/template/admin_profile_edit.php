<?php
/*
Template Name: admin profile edit page
*/

session_start();

if(!isset($_SESSION["admin_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

$h_id = 0;

if(empty($_GET["host_id"])) {
    $h_id = 0;
} else {
    $h_id = $_GET["host_id"];
}

 get_header(); 
?>
<div class="flex">
    <?php require_once 'a_nav.php' ?>
    <form action="<?php echo esc_url( home_url( '/profile_put_api' ) ); ?>" method="POST" class="flex edit_box" id="userFormprofile" enctype="multipart/form-data">
        <div class="img_box">
            <h2>プロファイル編集</h2>
            <picture>
                <img src="" alt="img" class="face1">
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
                <input type="text" name="email" id="email" class="w-full" readonly>
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
            <div>
            	<label for="host_content">追加の説明</label>
                <textarea name="host_content" id="host_content"  rows="10"></textarea>
            </div>
            <div class="flex w-full">
                <button type="button" class="cancel" onclick="closepage()">キャンセル</button>
                <button type="submit" class="save">保存</button>
            </div>
            <div class="diary_box">
                <button type="button" onclick="change_gone()" class="add_diary">出勤情報追加</button>
                <div class="con_schedule"></div>
                <script>
                    var week_name = ['日', '月', '火', '水', '木', '金', '土'];
                    var date = new Date();
                    var now_week = date.getDay();
                    var html = "";
                    for (let i = 0; i < week_name.length; i++) {
                        html +=  '<div class="flex justify-between">'
                                +'   <p class="th">' + (date.getMonth() + 1) + '/' + (date.getDate() + i) + ' (' + week_name[(date.getDay() + i) % 7] + ')</p>'
                                +'   <p class="flex justify-between td">'
                                + '    <input type="time" name="from" id="from' + ((date.getDay() + i) % 7) + '">'
                                +'     <span>~</span>'
                                + '    <input type="time" name="to" id="to' + ((date.getDay() + i) % 7) + '">'
                                +'   </p>'
                                +' </div>'
                    }
                    $(".con_schedule").html(html);
                </script>
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
            $("img.face1")
                .attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
    };
}

function closepage() {
    $(window).attr('location','<?php echo esc_url( home_url('/admin_hosts_profile')); ?>');
}

$.ajax({
    url: "<?php echo esc_url( home_url( '/profile_get_api' ) ); ?>", 
    type: "POST",
    data: {
        user_id: '<?=$h_id;?>'
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
            $("img.face1").attr("src",data['data']['uf_image']); 
            $("input#ranking").val(data['data']['h_ranking']);
            $("input#point").val(data['data']['h_point']);
            $("#level").val(data['data']['h_level']);
            $("input#email").val(data['data']['u_email']);
            $("#host_content").val(data['data']['uf_content']);
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

$.ajax({
    url: "<?php echo esc_url( home_url( '/profile_get_api' ) ); ?>", 
    type: "POST",
    data: {
        type: 'gone',
        user_id: "<?php echo $h_id; ?>", 
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            $("input#from0").val(data['data']['g_from0']);
            $("input#to0").val(data['data']['g_to0']);
            $("input#from1").val(data['data']['g_from1']);
            $("input#to1").val(data['data']['g_to1']);
            $("input#from2").val(data['data']['g_from2']);
            $("input#to2").val(data['data']['g_to2']);
            $("input#from3").val(data['data']['g_from3']);
            $("input#to3").val(data['data']['g_to3']);
            $("input#from4").val(data['data']['g_from4']);
            $("input#to4").val(data['data']['g_to4']);
            $("input#from5").val(data['data']['g_from5']);
            $("input#to5").val(data['data']['g_to5']);
            $("input#from6").val(data['data']['g_from6']);
            $("input#to6").val(data['data']['g_to6']);
        }
    }
});

function change_gone() {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/profile_put_api' ) ); ?>",  
        type: "POST",
        data: {
            type: 'gone',
            user_id: "<?php echo $h_id; ?>", 
            from0: $("input#from0").val(),
            to0: $("input#to0").val(),
            from1: $("input#from1").val(),
            to1: $("input#to1").val(),
            from2: $("input#from2").val(),
            to2: $("input#to2").val(),
            from3: $("input#from3").val(),
            to3: $("input#to3").val(),
            from4: $("input#from4").val(),
            to4: $("input#to4").val(),
            from5: $("input#from5").val(),
            to5: $("input#to5").val(),
            from6: $("input#from6").val(),
            to6: $("input#to6").val(),
        },
        success: function(res){
            alert("Profile saved successfully.");
        },
    });
}
</script>