<?php get_header(); ?>
<div class="flex justify-center items-center flex-col error_box">
    <h2>お探しのページは見つかりませんでした…</h2>
    <p>アドレスが変更になったか、ページが削除された可能性があります。
        <br>お手数ですが、トップページから対象のページをお探しください。
    </p>
    <div class="flex justify-center items-center sc_btn">
        <a class="red_btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">トップページへ戻る</a>
    </div>
</div>
<?php get_footer(); ?>