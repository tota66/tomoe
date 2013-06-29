{include file='inc/pre_settings.tpl' title='ホーム'}

{include file='inc/header.tpl'}
<div id="wrapper">
    <div class="battle clearfix">
        <img src="img/mami_0.png" />
        <div class="destination">
            <ul>
                <li><a href="{$app.link}?action_wander_battle=true">学校</a></li>
                <li><a href="{$app.link}?action_wander_battle=true">バイト</a></li>
                <li><a href="{$app.link}?action_wander_battle=true">病院</a></li>
                <li><a href="{$app.link}?action_wander_battle=true">公園</a></li>
                <li><a href="{$app.link}?action_wander_battle=true">教会</a></li>
                <li><a href="#" id="test">特訓場所</a></li>
                <li><a href="#" id="ajax_test">ajax_test</a></li>
            </ul>
        </div>
        <div class="message">
            <p>どこへ行きますか？</p>
        </div>
    </div>
</div>
{include file='inc/footer.tpl'}
