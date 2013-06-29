{include file='inc/pre_settings.tpl' title='ホーム'}

{include file='inc/header.tpl'}
<div id="wrapper">
    <div class="status">
        <ul>
            <li>体力が{$app.item.HP}回復した！</li>
            <li>ソウルジェムが{$app.item.SJ}浄化された！</li>
            <li>経験値が{$app.item.exp}増加した！</li>
        </ul>
    </div>
    <p><a href="{$app.link}?action_index=true">トップへ</a></p>
</div>
{include file='inc/footer.tpl'}
