<?php /* Smarty version 2.6.26, created on 2012-04-30 23:20:37
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', 'index.tpl', 65, false),array('function', 'message', 'index.tpl', 67, false),array('function', 'form_input', 'index.tpl', 68, false),array('function', 'form_submit', 'index.tpl', 70, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['config']['url']; ?>
css/ethna.css" type="text/css" />
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
        <td>レベル</td><td><?php echo $this->_tpl_vars['form']['LV']; ?>
</td>
    </tr>
    <tr>
        <td>ソウルジェム値</td><td><?php echo $this->_tpl_vars['form']['SJ']; ?>
</td>
    </tr>
    <tr>
        <td>経験値</td><td><?php echo $this->_tpl_vars['form']['EXP']; ?>
</td>
    </tr>
    <tr>
        <td>目標経験値</td><td><?php echo $this->_tpl_vars['form']['nextEXP']; ?>
</td>
    </tr>
    <tr>
        <td>所持金</td><td><?php echo $this->_tpl_vars['form']['money']; ?>
</td>
    </tr>
    <tr>
        <td>挨拶</td><td><?php echo $this->_tpl_vars['form']['message']; ?>
</td>
    </tr>
    <tr>
        <td>攻撃力</td><td><?php echo $this->_tpl_vars['form']['attack']; ?>
</td>
    </tr>
    <tr>
        <td>防御力</td><td><?php echo $this->_tpl_vars['form']['defence']; ?>
</td>
    </tr>
    </table>

    
    <h2>アイテムガチャ</h2>
    <a href="<?php echo $this->_tpl_vars['app']['link']; ?>
?action_item_do=true">アイテムガチャへ</a>

    <h2>イベント</h2>
    <a href="<?php echo $this->_tpl_vars['app']['link']; ?>
?action_event=true">イベントへ</a>
    
    <h2>さまよう</h2>
    <a href="<?php echo $this->_tpl_vars['app']['link']; ?>
?action_wander=true">魔女さがしへ</a>
    
    <h2>ヘルプ</h2>
    <a href="<?php echo $this->_tpl_vars['app']['link']; ?>
?action_help=true">ヘルプへ</a>

    <!--<p><?php echo $this->_tpl_vars['app_ne']['foo']; ?>
</p>-->
    <!--<h2>投稿</h2>
    <?php if (count ( $this->_tpl_vars['errors'] ) > 0): ?>
        入力内容にエラーがあります！
    <?php endif; ?>

    <?php $this->_tag_stack[] = array('form', array('name' => 'form_comment','ethna_action' => 'commit')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        投稿内容:<br />
        <?php echo smarty_function_message(array('name' => 'comment'), $this);?>
<br />
        <?php echo smarty_function_form_input(array('name' => 'comment'), $this);?>


        <?php echo smarty_function_form_submit(array(), $this);?>

    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <h2>投稿内容</h2>
    <?php echo $this->_tpl_vars['form']['comment']; ?>
-->
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-<?php echo @ETHNA_VERSION; ?>
.
</div>

</body>
</html>