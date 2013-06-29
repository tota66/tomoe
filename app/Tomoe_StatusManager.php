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

    
    /**      
     *  コンストラクタ
     *
     *  @access public
     *  @param  object  $_backend   backendオブジェクト 
     */
    public function __construct(&$_backend)
    {
        parent::__construct($_backend);
    }

    /**
     * 初期ステータスを挿入
     * 
     * @return 成功したらDB_OK, 失敗したらDB_Errorを返す 
     */
    public function insertInitStatus($user_id)
    {
        $sql = "INSERT INTO status (user_id, SJ, nextexp, money, message, attack, defence) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stt = $this->db->db->prepare($sql);
        return $this->db->db->execute($stt, array($user_id, INIT_SJ, INIT_NEXTEXP, 
            INIT_MONEY, MESSAGE_LV1, INIT_ATTACK, INIT_DEFENCE));
    }
    
    /**      
     *  ユーザIDに対応するステータス情報を取得する
     *
     *  @access public
     *  @return array  ステータスの連想配列
     */
    public function getStatusById($user_id)
    {
        $sql = "SELECT * FROM status WHERE user_id='" . $user_id . "'";
        $r =& $this->db->query($sql);
        $this->status =& $r->fetchRow(DB_FETCHMODE_ASSOC);
        return $this->status;
    }
    
    /**      
     *  レベルを取得する
     *
     *  @access public
     *  @param  int  ユーザID
     *  @return int  レベル値
     */
    public function getLVById($user_id)
    {
        $st = $this->getStatusById($user_id);
        return $st['level'];
    }
    
    /**      
     *  HPを取得する
     *
     *  @access public
     *  @param  int  ユーザID
     *  @return int  HP値
     */
    public function getHPById($user_id)
    {
        $st = $this->getStatusById($user_id);
        return $st['HP'];
    }

    /**      
     *  ソルルジェム値を取得する
     *
     *  @access public
     *  @param  int  ユーザID
     *  @return int  ソウルジェム値
     */
    public function getSJById($user_id)
    {
        $st = $this->getStatusById($user_id);
        return $st['SJ'];
    }

    /**      
     *  経験値を取得する
     *
     *  @access public
     *  @param  int  ユーザID
     *  @return int  経験値
     */
    public function getEXPById($user_id)
    {
        $st = $this->getStatusById($user_id);
        return $st['exp'];
    }

    /**      
     *  目標経験値を取得する
     *
     *  @access public
     *  @param  int  ユーザID
     *  @return int  目標経験値
     */
    public function getNextEXPById($user_id)
    {
        $st = $this->getStatusById($user_id);
        return $st['nextexp'];
    }

    /**      
     *  所持金を取得する
     *
     *  @access public
     *  @param  int  ユーザID
     *  @return int  所持金額
     */
    public function getMoneyPossessById($user_id)
    {
        $st = $this->getStatusById($user_id);
        return $st['money'];
    }

    /**      
     *  マミさん名言を取得する
     *
     *  @access public
     *  @param  int  ユーザID
     *  @return string  メッセージ
     */
    public function getMessageById($user_id)
    {
        $st = $this->getStatusById($user_id);
        return $st['message'];
    }

    /**      
     *  攻撃力値を取得する
     *
     *  @access public
     *  @param  int  ユーザID
     *  @return int  攻撃力値
     */
    public function getAttackValueById($user_id)
    {
        $st = $this->getStatusById($user_id);
        return $st['attack'];
    }

    /**      
     *  防御力値を取得する
     *
     *  @access public
     *  @param  int  ユーザID
     *  @return int  防御力値
     */
    public function getDefenceValueById($user_id)
    {
        $st = $this->getStatusById($user_id);
        return $st['defence'];
    }

    /**      
     *  コンティニュー回数を取得する
     *
     *  @access public
     *  @param  int  ユーザID
     *  @return int  コンティニュー回数
     */
    public function getContinueCountById($user_id)
    {
        $st = $this->getStatusById($user_id);
        return $st['continue_count'];
    }
    
    /**
     *  バトル後パラメータを更新 
     */
    public function updateAfterBattle($user_id, $HP, $SJ, $money, 
        $exp, $nextexp, $level, $attack, $defence)
    {
        $sql = "UPDATE status SET HP=?, SJ=?, money=?, exp=?, 
            nextexp=?, level=?, attack=?, defence=? WHERE user_id=?";
        $stt = $this->db->db->prepare($sql);
        return $this->db->db->execute($stt, array($HP, $SJ, $money, $exp,
            $nextexp, $level, $attack, $defence, $user_id)); 
    }
        

}

