<?php
/**
 *  Register/Do.php
 *
 *  @author     {$author}
 *  @package    Tomoe
 *  @version    $Id$
 */

/**
 *  register_do Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Tomoe
 */
class Tomoe_Form_RegisterDo extends Tomoe_ActionForm
{
    /**
     *  @access private
     *  @var    array   form definition.
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
        'userid' => array(
            'name' => 'ユーザID',
            'required' => true,
            'max' => 255,
            'filter' => FILTER_HW,
            //'custom' => 'checkMailaddress',
            'form_type' => FORM_TYPE_TEXT,
            'type' => VAR_TYPE_STRING,        ),
        'password' => array(
            'name' => 'パスワード',
            'required' => true,
            'max' => 255,
            'form_type' => FORM_TYPE_PASSWORD,
            'type' => VAR_TYPE_STRING,
        ),
        'password_conf' => array(
            'name' => 'パスワード(確認)',
            'required' => true,
            'max' => 255,
            'custom' => 'checkPassword',
            'form_type' => FORM_TYPE_PASSWORD,
            'type' => VAR_TYPE_STRING,
        ),
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
 *  register_do action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Tomoe
 */
class Tomoe_Action_RegisterDo extends Tomoe_ActionClass
{
    /**
     *  preprocess of register_do Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'register';  // 入力にエラーがある場合再びRegister画面へ
        }
        // セッションスタート
        $this->session->start();
        return null;
    }

    /**
     *  register_do action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    function perform()
    {
        $user = $this->af->get('userid');
        $pass = $this->af->get('password');
        
        // マネージャオブジェクト生成
        $this->userMng   = new Tomoe_UserManager($this->backend);
        $this->statusMng = new Tomoe_StatusManager($this->backend);

        // ユーザ情報をDBに追加
        $rc = $this->userMng->insertUser($user, $pass);
        if (Ethna::isError($rc)) {
            $error_msg = "ユーザ情報を追加できませんでした。";
            $this->ae->add(null, $error_msg);
            return 'register';
        }    
        $user_id = $this->userMng->getIdByName($user);

        // ステータス情報をDBに追加
        $rc = $this->statusMng->insertInitStatus($user_id);
        if (Ethna::isError($rc)) {
            $error_msg = "ステータス情報を追加できませんでした。";
            $this->ae->add(null, $error_msg);
            return 'register';
        }    

        // ユーザIDをセッションに保持
        $this->session->set('userid', $user_id);
        
        return 'index';
    }
}

?>
