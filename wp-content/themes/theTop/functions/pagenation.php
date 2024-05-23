<?php

//Pagenation
/* $rangeの値で出力されるページナンバーの範囲を設定 */
function pagination($pages = '', $range = 2){
  $showitems = ($range * 2)+1;  

  global $paged;
  if(empty($paged)) $paged = 1;

  /* ここで全体のページ数を取得 */
  if($pages == ''){
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages){
      $pages = 1;
    }
  }

 /* ページ数が1じゃなければ */
  if(1 != $pages){
    echo '<div class="pager"><ul class="pagination">';

    /* 1番最初のページに戻るボタン */
    //if($paged > 2 && $paged > $range+1 && $showitems < $pages){
      //echo "<li class=\"pagerPrevAll\"><a href=\"".get_pagenum_link(1)."\">First</a></li>";
    //}

    /* 1つ前のページへボタン */
    if($paged > 1){
      echo '<li class="pre"><a href="'.get_pagenum_link($paged - 1).'"><span>«</span></a></li>';
    }

    /* ページナンバーの出力。$pagedが一致した場合はcurrentを、一致しない場合はリンクを生成 */
    for ($i=1; $i <= $pages; $i++){
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
        echo ($paged == $i)? '<li><a href="'.get_pagenum_link($i).'" class="active"><span>'.$i.'</span></a></li>':'<li><a href="'.get_pagenum_link($i).'"><span>'.$i.'</span></a></li>';
      }
    }

    /* ページ数が続くことを示す３点リーダー */
    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
      echo '<li><a class="dot" href="'.get_pagenum_link($paged + 1).'"><span>...</span></a></li>';
    }

    /* 1つ次のページへボタン */
    if($paged < $pages){
      echo '<li class="next"><a href="'.get_pagenum_link($paged + 1).'"><span>»</span></a></li>';
    }

    /* 最後のページへ進むボタン */
    //if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
     // echo "<li class=\"pagerNextAll\"><a href=\"".get_pagenum_link($pages)."\">Last</a></li>";
    //}

    echo "</ul></div>";
  }
}
