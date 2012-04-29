<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>マミさんガチャ ログイン画面</title>
    </head>
    <body>
<div id="header">
        <h1>ログイン</h1>
</div>

<div id="main">
    <p>
        {form ethna_action="login_do"}
        <dl>
            <dt>メールアドレス</dt><dd>{form_input name="mailaddress"}</dd>
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
    </p>
</div>
    </body>
</html>
