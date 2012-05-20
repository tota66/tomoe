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
    
    <h2>ステータス</h2>
    <table border="0">
    <tr>
        <td>レベル</td><td>{$form.LV}</td>
    </tr>
    <tr>
        <td>ソウルジェム値</td><td>{$form.SJ}</td>
    </tr>
    <tr>
        <td>経験値</td><td>{$form.EXP}</td>
    </tr>
    <tr>
        <td>目標経験値</td><td>{$form.nextEXP}</td>
    </tr>
    <tr>
        <td>所持金</td><td>{$form.money}</td>
    </tr>
    <tr>
        <td>挨拶</td><td>{$form.message}</td>
    </tr>
    <tr>
        <td>攻撃力</td><td>{$form.attack}</td>
    </tr>
    <tr>
        <td>防御力</td><td>{$form.defence}</td>
    </tr>
    </table>

    
    <h2>アイテムガチャ</h2>
    <a href="{$app.link}?action_item_do=true">アイテムガチャへ</a>

    <h2>イベント</h2>
    <a href="{$app.link}?action_event=true">イベントへ</a>
    
    <h2>さまよう</h2>
    <a href="{$app.link}?action_wander=true">魔女さがしへ</a>
    
    <h2>ヘルプ</h2>
    <a href="{$app.link}?action_help=true">ヘルプへ</a>

    <!--<p>{$app_ne.foo}</p>-->
    <!--<h2>投稿</h2>
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
    {$form.comment}-->
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>

</body>
</html>
