<?php
/*
Template Name: admin dashboard page
*/

session_start();

$_SESSION["diary_id"] = "";

if(!isset($_SESSION["admin_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

get_header(); 
?>
<div class="flex">
    <?php require_once 'a_nav.php' ?>
    <div class="flex diary_box">
        <div class="w-8/12">
            <div class="flex">
                <div class="flex w-3/12 items-center color_index total_incoming">
                    <div></div>
                    <p>合計受信</p>
                </div>
                <div class="flex w-3/12 items-center color_index purchase">
                    <div></div>
                    <p>購入</p>
                </div>
                <div class="flex w-3/12 items-center color_index customer">
                    <div></div>
                    <p>お客様</p>
                </div>
            </div>
            <canvas id="myChart"></canvas>
            <div class="flex justify-between">
                <div class="working dash_working">
                    <h3>稼働中のホスト</h3>
                    <div class="dash_working_box"></div>
                </div>
                <div class="working dash_schedule">
                    <h3>スケジュール</h3>
                    <div class="dash_schedule_box">
                    </div>
                </div>
            </div>
        </div>
        <div class="w-4/12">
            <div class="working w-full dash_newhosts">
                <h3>新しいホスト</h3>
                <div class="dash_newhosts_box"></div>
            </div>
            <div class="working w-full dash_report">
                <h3>受信レポート</h3>
                <div class="dash_repor_box"></div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'tem_footer.php' ?>
<?php require_once 'user_footer.php' ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
const xValues = [50,60,70,80,90,100,110,120,130,140,150];
const yValues = [7,8,8,9,9,9,10,11,14,14,15];
const zValues = [10,8,8,7,9,10,11,13,14,15,17];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0.3,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    },
    {
      fill: false,
      lineTension: 0.3,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,255,0,0.1)",
      data: zValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 0, max:100000}}],
    }
  }
});
</script>
<script>

$.ajax({
    url: "<?php echo esc_url( home_url( '/hosts_get_api' ) ); ?>", 
    type: "POST",
    data: {
        new_hosts: 1
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var diarys = data['data'];
            var htmltext = "";
            $.each(diarys, function(index, value ) {
                htmltext += '<div class="flex items-center justify-between">'
                            + '    <div class="flex items-center">'
                            + '     <img src="' + (value["uf_image"] ? value["uf_image"] : "<?php echo get_template_directory_uri(); ?>/image/cast_detail_img.png") + '" alt="img">'
                            + '     <p>' + (value["uf_image"] ? value["uf_firstname"] : "キャスト名") + (value["uf_image"] ? value["uf_lastname"] : "") + '</p>'
                            + ' </div>'
                            + ' <p>' + value["create_at"] + '</p>'
                            + '</div>';
                $(".dash_newhosts_box").html(htmltext);
            });
        }
    }
});

$.ajax({
    url: "<?php echo esc_url( home_url( '/orders_get_api' ) ); ?>",  
    type: "POST",
    data: {
        user_id: <?=$_SESSION["user_id"];?>,
        admin_id: <?=$_SESSION["user_id"];?>
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var diarys = data['data'];
            var htmltext = "";
            var coursetype = ["デートコース", "ホテルコース", "通話コース", "長期的な関係"];
            $.each(diarys, function(index, value ) {
                htmltext += '<p>' + value["o_start"] + " ~ " + value["o_end"] + ", " + value["o_name"] + ", " + value["o_address"] + ", " + coursetype[value["o_coursetype"]] + '</p>';
            });
            $(".dash_schedule_box").html(htmltext);
        }
    }
});

$.ajax({
    url: "<?php echo esc_url( home_url( '/orders_get_api' ) ); ?>",  
    type: "POST",
    data: {
        user_id: <?=$_SESSION["user_id"];?>,
        admin_id: <?=$_SESSION["user_id"];?>,
        search_work: 1,
        now_working: 1
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var diarys = data['data'];
            var htmltext = "";
            var coursetype = ["デートコース", "ホテルコース", "通話コース", "長期的な関係"];
            $.each(diarys, function(index, value ) {
                htmltext += '<p>' + value["uf_firstname"] + " " + value["uf_lastname"] + ", " + value["o_address"] + ", " + coursetype[value["o_coursetype"]] + '</p>';
            });
            $(".dash_working_box").html(htmltext);
        }
    }
});

$.ajax({
    url: "<?php echo esc_url( home_url( '/orders_get_api' ) ); ?>",  
    type: "POST",
    data: {
        user_id: <?=$_SESSION["user_id"];?>,
        admin_id: <?=$_SESSION["user_id"];?>,
        report: 1,
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var diarys = data['data'];
            var htmltext = "";
            var coursetype = ["デートコース", "ホテルコース", "通話コース", "長期的な関係"];
            $.each(diarys, function(index, value ) {
                htmltext += '<p>' + value["uf_firstname"] + " " + value["uf_lastname"] + " report: " + value["o_name"]  + " pay." + '</p>';
            });
            $(".dash_repor_box").html(htmltext);
        }
    }
});
</script>