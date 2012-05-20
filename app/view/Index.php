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

        $status = new Tomoe_StatusManager($this->backend, $this->session->get('userid'));

        // ステータスをセット
        $this->af->set('LV', $status->getLV());
        $this->af->set('SJ', $status->getSJ());
        $this->af->set('EXP', $status->getEXP());
        $this->af->set('nextEXP', $status->getNextEXP());
        $this->af->set('money', $status->getMoneyPossess());
        $this->af->set('message', $status->getMessage());
        $this->af->set('attack', $status->getAttackValue());
        $this->af->set('defence', $status->getDefenceValue());
        $this->af->set('continue', $status->getContinueCount());
        
         // ゲーム内で使う値を格納
//        $this->af->setApp('link', 'localhost/tomoe');
    }
}

?>
