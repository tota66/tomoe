<?php /* Smarty version 2.6.26, created on 2012-04-29 18:46:22
         compiled from login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', 'login.tpl', 14, false),array('function', 'form_input', 'login.tpl', 16, false),)), $this); ?>
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
        <?php $this->_tag_stack[] = array('form', array('ethna_action' => 'login_do')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <dl>
            <dt>ユーザID</dt><dd><?php echo smarty_function_form_input(array('name' => 'userid'), $this);?>
</dd>
        </dl>
        <dl>
            <dt>パスワード</dt><dd><?php echo smarty_function_form_input(array('name' => 'password'), $this);?>
</dd>
        </dl>
        <dl>
            <dt>パスワード(確認)</dt><dd><?php echo smarty_function_form_input(array('name' => 'password_conf'), $this);?>
</dd>
        </dl>
        <?php if (count ( $this->_tpl_vars['errors'] )): ?>
        <ul class="error">
            <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
                <li><?php echo $this->_tpl_vars['error']; ?>
</li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        <?php endif; ?>
        <input type="submit" value="送信" />
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </p>
</div>
    </body>
</html>