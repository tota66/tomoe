{include file='inc/pre_settings.tpl' title='ホーム'}

{include file='inc/header.tpl'}
<div id="wrapper">
    <div class="battle clearfix">
        <img src="img/mami_0.png" />
        <div class="result">
{if $app.rt.win == 1}
        <h1>たおした！やったわ！</h1>
            <ul>
                <li>HP: {$app.rt.user.HP}</li>
                <li>敵に{$app.rt.attack}のダメージを与えた！</li>
                <li>{$app.rt.damage}のダメージを受けた！</li>
                <li>{$app.rt.exp}の経験値を得た！</li>
                <li>{$app.rt.money}のお金を得た！</li>
                <li>{$app.rt.SJ}だけソウルジェムが浄化された！</li>
            </ul>
{else}
        <h1>負けてしまった…。</h1>
            <ul>
                <li>{$app.rt.SJ}だけソウルジェムが濁った</li>
            </ul>
{/if}
        </div>
        <a href="{$app.link}?action_index=true">帰りましょう</a>
    </div>
</div>
{include file='inc/footer.tpl'}
