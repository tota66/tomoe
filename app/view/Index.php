<?php
/**
 *  Index.php
 *
 *  @author     {$author}
 *  @package    Tomoe
 *  @version    $Id$
 */

/**
 *  Index view implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Tomoe
 */
class Tomoe_View_Index extends Tomoe_ViewClass
{
    /**
     *  preprocess before forwarding.
     *
     *  @access public
     */
    function preforward()
    {

        $user_id = $this->session->get('userid');
        $status = new Tomoe_StatusManager($this->backend);

        // ステータスをセット
        $this->af->set('LV',       $status->getLVById($user_id));
        $this->af->set('HP',       $status->getHPById($user_id));
        $this->af->set('SJ',       $status->getSJById($user_id));
        $this->af->set('EXP',      $status->getEXPById($user_id));
        $this->af->set('nextEXP',  $status->getNextEXPById($user_id));
        $this->af->set('money',    $status->getMoneyPossessById($user_id));
        $this->af->set('message',  $status->getMessageById($user_id));
        $this->af->set('attack',   $status->getAttackValueById($user_id));
        $this->af->set('defence',  $status->getDefenceValueById($user_id));
        $this->af->set('continue', $status->getContinueCountById($user_id));
        
         // ゲーム内で使う値を格納
//        $this->af->setApp('link', 'localhost/tomoe');
    }
}

?>
