<div class="logonmodal hidden">
    <form action="<?php echo esc_url( home_url( '/log_on_api' ) ); ?>" method="POST" id="userFormOn">
        <div>
            <label for="on_email">Eメール</label>
            <input type="text" name="email" id="on_email" class="on_email" autocomplete="off">
        </div>
        <div>
            <label for="on_password">パスワード</label>
            <input type="password" name="on_password" id="on_password" class="on_password" autocomplete="off">
        </div>
        <div>
            <label for="on_confirm_password">確認する</label>
            <input type="password" name="on_confirm_password" id="on_confirm_password" class="on_confirm" autocomplete="off">
        </div>
        <div>
            <label for="job">仕事</label>
            <select name="job" class="job" id="job">
                <option value='0' selected="selected">お客様</option>
                <option value='1'>ホスト</option>
                <option value='2'>管理者</option>
            </select>
        </div>
        <div class="btn">
            <button type="submit">ログオン</button>
            <button type="button" onclick="logon()">キャンセル</button>
        </div>
    </form>
</div>