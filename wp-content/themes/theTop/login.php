<div class="loginmodal hidden">
    <form action="<?php echo esc_url( home_url( '/log_in_api' ) ); ?>" method="POST" id="userForm">
        <div>
            <label for="in_email">Eメール</label>
            <input type="text" name="in_email" id="in_email" class="in_email" autocomplete="off">
        </div>
        <div>
            <label for="in_password">パスワード</label>
            <input type="password" name="in_password" id="in_password" class="in_password" autocomplete="off">
        </div>
        <div class="btn">
            <button type="submit">ログイン</button>
            <button type="button" onclick="login()">キャンセル</button>
        </div>

        <a onclick="logon()">ログオン</a>
    </form>
</div>