<?php

/**
 *  Index.php
 *
 *  @author    {$author}
 *  @package   Tomoe
 *  @version   $Id$
 */

/**
 *  Index form implementation
 *
 *  @author    {$author}
 *  @access    public
 *  @package   Tomoe
 */

class Tomoe_Form_Index extends Tomoe_ActionForm
{
    /**
     *  @access   private
     *  @var      array   form definition.
     */
    var $form = array(
       /*
        *  TODO: Write form definition which this action uses.
        *  @see http://ethna.jp/ethna-document-dev_guide-form.html
        *
        *  Example(You can omit all elements except for "type" one) :
        *
        *  'sample' => array(
        *      // Form definition
        *      'type'        => VAR_TYPE_INT,    // Input type
        *      'form_type'   => FORM_TYPE_TEXT,  // Form type
        *      'name'        => 'Sample',        // Display name
        *  
        *      //  Validator (executes Validator by written order.)
        *      'required'    => true,            // Required Option(true/false)
        *      'min'         => null,            // Minimum value
        *      'max'         => null,            // Maximum value
        *      'regexp'      => null,            // String by Regexp
        *      'mbregexp'    => null,            // Multibype string by Regexp
        *      'mbregexp_encoding' => 'UTF-8',   // Matching encoding when using mbregexp 
        *
        *      //  Filter
        *      'filter'      => 'sample',        // Optional Input filter to convert input
        *      'custom'      => null,            // Optional method name which
        *                                        // is defined in this(parent) class.
        *  ),
        */
        'LV' => array(
            'name' => 'レベル',
            'type' => VAR_TYPE_INT,        ),
        'SJ' => array(
            'name' => 'ソウルジェム浄化度',
            'type' => VAR_TYPE_INT,        ),
        'EXP' => array(
            'name' => '経験値',
            'type' => VAR_TYPE_INT,        ),
        'nextEXP' => array(
            'name' => '目標経験値',
            'type' => VAR_TYPE_INT,        ),
        'money' => array(
            'name' => '所持金',
            'type' => VAR_TYPE_INT,        ),
        'message' => array(
            'name' => 'マミさん名言',
            'type' => VAR_TYPE_STRING,        ),
        'attack' => array(
            'name' => '攻撃力',
            'type' => VAR_TYPE_INT,        ),
        'defence' => array(
            'name' => '防御力',
            'type' => VAR_TYPE_INT,        ),
        'continue' => array(
            'name' => 'コンティニュー回数',
            'type' => VAR_TYPE_INT,        ),
    );

    /**
     *  Form input value convert filter : sample
     *
     *  @access protected
     *  @param  mixed   $value  Form Input Value
     *  @return mixed           Converted result.
     */
    /*
    function _filter_sample($value)
    {
        //  convert to upper case.
        return strtoupper($value);
    }
    */
}

/**
 *  Index action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Tomoe
 */
class Tomoe_Action_Index extends Tomoe_AuthActionClass
{

    /**
     *  preprocess Index action.
     *
     *  @access    public
     *  @return    string  Forward name (null if no errors.)
     */
    function prepare()
    {
        
        if ($this->af->validate() > 0) {
            return 'error';
        }
        $this->session->regenerateId();

        return null;
    }

    /**
     *  Index action implementation.
     *
     *  @access    public
     *  @return    string  Forward Name.
     */
    function perform()
    {
        /*$status = new Tomoe_StatusManager($this->backend, $this->session->get('userid'));
        
        // ステータスをセット
        $this->af->set('LV', $status->getLV());
        $this->af->set('SJ', $status->getSJ());
        $this->af->set('EXP', $status->getEXP());
        $this->af->set('nextEXP', $status->getNextEXP());
        $this->af->set('money', $status->getMoneyPossess());
        $this->af->set('message', $status->getMessage());
        $this->af->set('attack', $status->getAttackValue());
        $this->af->set('defence', $status->getDefenceValue());
        $this->af->set('continue', $status->getContinueCount());*/
        
        return 'index';
    }
}

?>
