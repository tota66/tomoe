<?php
/**
 *  Tomoe_StatusManager.php
 *
 *  @author     {$author}
 *  @package    Tomoe
 *  @version    $Id$
 */

require_once('Tomoe_DBManager.php');

class Tomoe_StatusManager extends Tomoe_DBManager
{
    /** @var    object  Ethna_Backend       backendオブジェクト */
    //var $backend;

    /** @var    object  Ethna_DB            DBオブジェクト */
    //var $db;

    /** @var    array   status              ステータス値 */
    var $status = array();

    
    /** @var    array   sidx                ステータスインデックス */
    var $sidx = array('user_id'        => 0,
                      'level'          => 1,
                      'SJ'             => 2,
                      'exp'            => 3,
                      'nextexp'        => 4,
                      'money'          => 5,
                      'message'        => 6,
                      'attack'         => 7,
                      'defence'        => 8,
                      'continue_count' => 9,);
    
    /**      
     *  コンストラクタ
     *
     *  @access public
     *  @param  object  $_backend   backendオブジェクト 
     */
    public function __construct(&$_backend, $_userid)
    {
        parent::__construct($_backend);
        $sql = "SELECT * FROM status WHERE user_id='" . $_userid . "'";
        $r =& $this->db->query($sql);
        $this->status =& $r->fetchRow();
    }

    
    /**      
     *  レベルを取得する
     *
     *  @access public
     *  @return int  レベル値
     */
    public function getLV()
    {
        return $this->status[1];
    }

    /**      
     *  ソルルジェム値を取得する
     *
     *  @access public
     *  @return int  ソウルジェム値
     */
    public function getSJ()
    {
        return $this->status[2];
    }

    /**      
     *  経験値を取得する
     *
     *  @access public
     *  @return int  経験値
     */
    public function getEXP()
    {
        return $this->status[3];
    }

    /**      
     *  目標経験値を取得する
     *
     *  @access public
     *  @return int  目標経験値
     */
    public function getNextEXP()
    {
        return $this->status[4];
    }

    /**      
     *  所持金を取得する
     *
     *  @access public
     *  @return int  所持金額
     */
    public function getMoneyPossess()
    {
        return $this->status[5];
    }

    /**      
     *  マミさん名言を取得する
     *
     *  @access public
     *  @return string  メッセージ
     */
    public function getMessage()
    {
        return $this->status[6];
    }

    /**      
     *  攻撃力値を取得する
     *
     *  @access public
     *  @return int  攻撃力値
     */
    public function getAttackValue()
    {
        return $this->status[7];
    }

    /**      
     *  防御力値を取得する
     *
     *  @access public
     *  @return int  防御力値
     */
    public function getDefenceValue()
    {
        return $this->status[8];
    }

    /**      
     *  コンティニュー回数を取得する
     *
     *  @access public
     *  @return int  コンティニュー回数
     */
    public function getContinueCount()
    {
        return $this->status[9];
    }

}

