{include file='inc/pre_settings.tpl' title='ホーム'}

{include file='inc/header.tpl'}
<div id="wrapper">
<div id="home" class="clearfix">
    <img src="img/mami_0.png" />
    <div class="message">
        {$form.message}
    </div>
    <div class="status">
        <table border="0">
        <tr>
            <td>レベル</td><td>{$form.LV}</td>
        </tr>
        <tr>
            <td>体力</td><td>{$form.HP}</td>
        </tr>
        <tr>
            <td>ソウルジェム値</td><td>{$form.SJ}</td>
        </tr>
        <tr>
            <td>経験値</td><td>{$form.EXP} / {$form.nextEXP}</td>
        </tr>
        <tr>
            <td>所持金</td><td>{$form.money}</td>
        </tr>
        <tr>
            <td>攻撃力</td><td>{$form.attack}</td>
        </tr>
        <tr>
            <td>防御力</td><td>{$form.defence}</td>
        </tr>
        </table>
    </div>
    <div class="command"> 
        <a href="{$app.link}?action_item=true"><button>部屋へ</button></a>
        <a href="{$app.link}?action_wander=true"><button>街へ</button></a>
        <a href="{$app.link}?action_help=true"><button>ヘルプへ</button></a>
    </div>
    <div class="logout">
        <a href="{$app.link}?action_logout=true"><button>ログアウト</button></a>
    </div>
</div>        
</div>
{include file='inc/footer.tpl'}
