<script>
function logout() {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/quit' ) ); ?>", 
        type: "POST",
        data: {
            quit: 1
        },
        success: function(res){
            alert(res);
            $(window).attr('location','');
        }
    });
}

function login() {
    $(".loginmodal").toggleClass("hidden");
};

function logon() {
    $(".logonmodal").toggleClass("hidden");
    $(".loginmodal").toggleClass("hidden");
};

function createCookie(name, value, days) {
    let expires;
 
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
 
    document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
};

$( "#userForm" ).submit(function( event ) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/log_in_api' ) ); ?>", 
        type: "POST",
        data: {
            email : $("input.in_email").val(),
            password : $("input.in_password").val()
        },
        success: function(res){
            var data = JSON.parse(res);
            createCookie("user_id", data['result']['u_id'], "30");
            createCookie("user_email", data['result']['u_email'], "30");
            createCookie("user_job", data['user_job'], "3");
            createCookie("user_image", data['profile']['uf_image'], "3");
            login();

            $(window).attr('location','');
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {
            if (!window.console) console = { log: function () { } };
            console.log(JSON.stringify(XMLHttpRequest), textStatus, errorThrown);
        }
    });
    event.preventDefault();
});

$( "#userFormOn" ).submit(function( event ) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/log_on_api' ) ); ?>", 
        type: "POST",
        data: {
            email : $("input.on_email").val(),
            password : $("input.on_password").val(),
            confirm_password : $("input.on_confirm").val(),
            job : $("select.job").val(),
        },
        success: function(res){
            alert("Congratulation.");
            logon();
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