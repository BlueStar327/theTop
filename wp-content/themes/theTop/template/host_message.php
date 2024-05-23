<?php
/*
Template Name: host message page
*/

session_start();

if(!isset($_SESSION["host_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

get_header(); 
?>
<div class="flex">
    <?php require_once 'c_nav.php' ?>
    <div class="flex justify-between message_box">
        <div class="userList">
        </div>
        <div class="w-9/12 showMessage">
            <div class="show_box"></div>
            <div class="sendText">
                <textarea name="text" id="messageText" cols="" rows=""></textarea>
                <button type="button" onclick="sendMessage()"></button>
            </div>
        </div>
    </div>
</div>
<?php require_once 'tem_footer.php' ?>
<?php require_once 'user_footer.php' ?>

<script>
$selectuser = "";
$sendContent = "";

function sendMessage() {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/message_put_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>',
            to_id: $selectuser,
            content: $("textarea#messageText").val()
        },
        success: function(res){
            var data = JSON.parse(res);
            var message = data['data'];
            var message_list = $(".show_box").html();
            message_list += '<div class="flex w-full">'
                            + '<div class="w-5/12"></div>'
                            + '<div class="w-7/12">'
                            +     '<p>' + message["m_content"] + '</p>'
                            +     '<p class="text-right">' + message["create_at"] + '</p>'
                            + '</div>'
                        + '</div>';
            $(".show_box").html(message_list);
            $("textarea#messageText").val("");
        }
    });
}

setInterval(function() {
    showMessage($selectuser);
}, 5000);

function showMessage(value) {
    $selectuser = value;
    $.ajax({
        url: "<?php echo esc_url( home_url( '/message_get_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>',
            link_id: value
        },
        success: function(res){
            var data = JSON.parse(res);
            var message = data['data'];
            var message_list = "";
            $.each(message, function(index, value ) {
                message_list += '<div class="flex w-full ' + (value["m_to_uid"] == '<?=$_SESSION["user_id"];?>' ? 'receiveBox' : '') + '">'
                                + '<div class="w-5/12"></div>'
                                + '<div class="w-7/12">'
                                +     '<p>' + value["m_content"] + '</p>'
                                +     '<p class="text-right">' + value["update_at"] + '</p>'
                                + '</div>'
                            + '</div>';
                    });
            $(".show_box").html(message_list);
        }
    });
}

$.ajax({
    url: "<?php echo esc_url( home_url( '/users_list_get_api' ) ); ?>", 
    type: "POST",
    data: {
        user_id: '<?=$_SESSION["user_id"];?>'
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data1'] != [])  {
            var users = data['data1'];
            var user_list = "";
            $.each(users, function(index, value ) {
                user_list += '<div class="flex items-center person" data-uid="' + value['a_uid'] + '">'
                        +'<img src="' + ( value['uf_image'] ? value['uf_image'] : '<?=get_home_url() . "/wp-content/themes/theTop/image/top_human_g_ico.png";?>' )+ '" alt="img">'
                        +'<span>admin ' + (value['uf_firstname'] ? value['uf_firstname']: "") + " " + (value['uf_lastname']? value['uf_lastname']:"") + '</span>'
                        +'</div>';
                    });
            $(".userList").html(user_list);
        }

        if(data['data2'] != [])  {
            var users = data['data2'];
            var user_list = $(".userList").html();
            $.each(users, function(index, value ) {
                user_list += '<div class="flex items-center person" data-uid="' + value['h_uid'] + '">'
                        +'<img src="' + ( value['uf_image'] ? value['uf_image'] : '<?=get_home_url() . "/wp-content/themes/theTop/image/top_human_g_ico.png";?>' )+ '" alt="img">'
                        +'<span>' + (value['uf_firstname'] ? value['uf_firstname']: "") + " " + (value['uf_lastname']? value['uf_lastname']:"") + '</span>'
                        +'</div>';
                    });
            $(".userList").html(user_list);
        }

        $(".person").each(function () {
            $(this).click(function () {
                $(".person").removeClass("sel_bg");
                $(this).addClass("sel_bg"); 
                showMessage($(this).attr("data-uid"));   
            });
        });
    }
});
</script>