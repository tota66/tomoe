{include file='inc/pre_settings.tpl' title='ログイン'}

{include file='inc/header.tpl'}
<div id="wrapper">
<div id="main">
    <div class="home_img">
        <img src="img/mami_0.png" />
    </div>
    <div class="form">
        {form ethna_action="login_do"}
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
        <a href="{$app.link}?action_register=true">新規登録</a>
    </div>
</div>
</div>
{include file='inc/footer.tpl'}
