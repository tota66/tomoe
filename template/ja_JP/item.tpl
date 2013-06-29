{include file='inc/pre_settings.tpl' title='部屋'}

{include file='inc/header.tpl'}
<div id="wrapper">
    <h1>取得アイテム</h1>
    <div class="item_list">
        {foreach from=$app.items item=item}
        <div class="item clearfix">
            <ul>
                <li>{$item.id}</li>
                <li>{$item.name}</li>
                <li>{$item.count}</li>
                <li><a href="{$app.link}?action_item_result=true&id={$item.id}">
                    使う</a></li>
            </ul>
        </div>
        {/foreach}
    </div>
    <a href="{$app.link}?action_item_do=true"><button>アイテムゲット</button></a>
    <tr>
        <td>{message name="itemError"}</td>
    </tr>
    <div class="link">
        <p><a href="{$app.link}?action_index=true">トップへ</a></p>
    </div>
</div>
{include file='inc/footer.tpl'}
