{include file='inc/pre_settings.tpl' title='新規登録'}

{include file='inc/header.tpl'}
<div id="wrapper">
    <div class="home_img">
        <img src="img/mami_0.png" />
    </div>
    <div class="form">
        {form ethna_action="register_do"}
        <dl>
            <dt>ユーザID</dt><dd>{form_input name="userid"}</dd>
        </dl>
        <dl>
            <dt>パスワード</dt><dd>{form_input name="password"}</dd>
        </dl>
        <dl>
            <dt>パスワード(確認)</dt><dd>{form_input name="password_conf"}</dd>
        </dl>
        {if count($errors)}
        <ul class="error">
            {foreach from=$errors item=error}
                <li>{$error}</li>
            {/foreach}
        </ul>
        {/if}
        <input type="submit" value="送信" />
        {/form}
    </div>
    <div class="link">
        <a href="?action_login=true">ログイン画面</a>
    </div>
</div>
{include file='inc/footer.tpl}
