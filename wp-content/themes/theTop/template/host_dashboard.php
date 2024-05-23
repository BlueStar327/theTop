<?php
/*
Template Name: host dashboard page
*/

session_start();

if(!isset($_SESSION["host_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

 get_header(); 
?>
<div class="flex">
    <?php require_once 'c_nav.php' ?>
    <div class="flex diary_box">
        <div class="w-8/12">
            <canvas id="myChart"></canvas>
            <div class="flex justify-between">
                <div class="working dash_working">
                    <h3>レビュー</h3>
                    <div class="dash_working_box"></div>
                </div>
                <div class="working dash_schedule">
                    <h3>予定</h3>
                    <div class="dash_schedule_box">
                    </div>
                </div>
            </div>
        </div>
        <div class="w-4/12">
            <div class="working w-full dash_newhosts">
                <h3>現在の仕事</h3>
                <div class="dash_newhosts_box"></div>
            </div>
            <div class="working w-full dash_report dash_report_c">
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
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: "rgba(0,0,255,1.0)",
      data: yValues
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
    url: "<?php echo esc_url( home_url( '/orders_get_api' ) ); ?>",  
    type: "POST",
    data: {
        user_id: <?=$_SESSION["user_id"];?>,
        host_id: <?=$_SESSION["user_id"];?>,
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
                htmltext += '<p class="mb-4">' + value["o_start"] + " ~ " + value["o_end"] + ", " + value["o_name"] + ", " + value["o_address"] + ", " + coursetype[value["o_coursetype"]] + '</p>';
                $(".dash_newhosts_box").html(htmltext);
            });
        }
    }
});

var course = [0, 0, 0, 0];

$.ajax({
    url: "<?php echo esc_url( home_url( '/orders_get_api' ) ); ?>",  
    type: "POST",
    data: {
        user_id: <?=$_SESSION["user_id"];?>,
        host_id: <?=$_SESSION["user_id"];?>
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var diarys = data['data'];
            var htmltext = "";
            var coursetype = ["デートコース", "ホテルコース", "通話コース", "長期的な関係"];
            $.each(diarys, function(index, value ) {
                htmltext += '<p>' + value["o_start"] + " ~ " + value["o_end"] + ", " + value["o_name"] + ", " + value["o_address"] + ", " + coursetype[value["o_coursetype"]] + '</p>';
                if(value["o_coursetype"] == 0) course[0] = course[0] + 1;
                if(value["o_coursetype"] == 1) course[1] = course[1] + 1;
                if(value["o_coursetype"] == 2) course[2] = course[2] + 1;
                if(value["o_coursetype"] == 3) course[3] = course[3] + 1;
            });
            $(".dash_schedule_box").html(htmltext);
        }
    }
});

$.ajax({
    url: "<?php echo esc_url( home_url( '/review_get_api' ) ); ?>",  
    type: "POST",
    data: {
        user_id: <?=$_SESSION["user_id"];?>,
        host_id: <?=$_SESSION["user_id"];?>
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var diarys = data['data'];
            var htmltext = "";
            $.each(diarys, function(index, value ) {
                htmltext += '<p>' + value["r_content"] + '</p>'
                        + '<p class="text-right">' + value["create_at"] + '</p>';
            });
            $(".dash_working_box").html(htmltext);
        }
    }
});

$.ajax({
    url: "<?php echo esc_url( home_url( '/hosts_get_api' ) ); ?>",  
    type: "POST",
    data: {
        user_id: <?=$_SESSION["user_id"];?>,
        host_id_d: <?=$_SESSION["user_id"];?>
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var diarys = data['data'];
            var htmltext = '<h3><span>Ranking</span>: ' + diarys[0]["h_ranking"] + '</h3><div class="dash_repor_box">';
            htmltext += '<p class="mt-8"><span>Level</span>: ' + diarys[0]["h_level"] + '</p>';
            htmltext += '<p class="mt-8"><span>Orders</span>: ' + (course[0] + course[1]  + course[2] + course[3]) + '</p>';
            htmltext += '<div class="flex mt-4">'
            htmltext += '<p class="pl-4">Date: ' + course[0] + '</p>';
            htmltext += '<p>Hotel: ' + course[1] + '</p>';
            htmltext += '<p>Calling: ' + course[2] + '</p>';
            htmltext += '</div>'
            htmltext += '</div>';
            $(".dash_report").html(htmltext);
        }
    }
});
</script>