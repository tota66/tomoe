<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="{$config.url}css/ethna.css" type="text/css" />
<title>マミさんガチャ</title>
</head>
<body>

<div id="header">
    <h1>TOP</h1>
</div>

<div id="main">
    <h2>Index Page</h2>
    <p>hello, world!</p>
    <p>{$app_ne.foo}</p>
    <h2>投稿</h2>
    {if count($errors) > 0}
        入力内容にエラーがあります！
    {/if}

    {form name="form_comment" ethna_action="commit"}
        投稿内容:<br />
        {message name="comment"}<br />
        {form_input name="comment"}

        {form_submit}
    {/form}
    <h2>投稿内容</h2>
    {$form.comment}
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>

</body>
</html>
