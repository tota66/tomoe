{include file='inc/pre_settings.tpl' title='街'}

{include file='inc/header.tpl'}
<div id="wrapper">
    <div class="battle clearfix">
        <img src="img/mami_0.png" />
        <div class="enemy">
            <h1>{$app.enemy.name}があらわれた！</h1>
        </div>
        <div class="command">
            <a href="{$app.link}?action_wander_result=true">一斉攻撃！ティロ・フィナーレ！</a>
        </div>
    </div>
</div>
{include file='inc/footer.tpl'}
