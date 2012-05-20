<?php
// vim: foldmethod=marker
/**
 *  Tomoe_AuthActionClass.php
 *
 *  @author     {$author}
 *  @package    Tomoe
 *  @version    $Id$
 */

// {{{ Tomoe_AuthActionClass
/**
 *  action execution class
 *
 *  @author     {$author}
 *  @package    Tomoe
 *  @access     public
 */
class Tomoe_AuthActionClass extends Tomoe_ActionClass
{
    /**
     *  authenticate before executing action.
     *
     *  @access public
     *  @return string  セッション開始されていなかった場合'login'を返し、ログイン画面へ
     */
    function authenticate()
    {
        if (!$this->session->isStart()) {
            return 'login';
        }
    }
    /**
     *  Preparation for executing action. (Form input check, etc.)
     *
     *  @access public
     *  @return string  Forward name.
     *                  (null if no errors. false if we have something wrong.)
     */
    function prepare()
    {
        return parent::prepare();
    }

    /**
     *  execute action.
     *
     *  @access public
     *  @return string  Forward name.
     *                  (we does not forward if returns null.)
     */
    function perform()
    {
        return parent::perform();
    }
}
// }}}

?>
