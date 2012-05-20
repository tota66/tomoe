<?php
/**
 *  Tomoe_ItemManager.php
 *
 *  @author     {$author}
 *  @package    Tomoe
 *  @version    $Id$
 */

require_once('Tomoe_DBManager.php');

class Tomoe_ItemManager extends Tomoe_DBManager
{
    /** @var    object  Ethna_Backend       backendオブジェクト */
    //var $backend;

    /** @var    object  Ethna_DB            DBオブジェクト */
    //var $db;

    /** @var    array   item                アイテム値 */
    var $item = array();

    /** @var    int     item_count          アイテムの数 */
    var $item_count;

    /** @var    array   iidx                アイテムインデックス */
    var $iidx = array('id'          => 0,
                      'name'        => 1,
                      'money'       => 2,
                      'exp'         => 3,
                      'SJ'          => 4,
                      'level'       => 5,
                      'possibility' => 6,);
    
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
    public function __construct(&$_backend)
    {
        $this->item_count = 2;
        parent::__construct($_backend);
    }

    
    /**      
     *  アイテムテーブルからランダムにアイテムを１つ抽選する
     *
     *  @access public
     *  @param  string  $name   取得するフォーム名(nullなら全ての定義を取得)
     *  @return object  Ethna_Error   エラーオブジェクト(エラー無ければnull)
     */
     public function lotItem($_userid)
     {
        // ユーザIDに対応するステータス取得
        $sql = "SELECT * FROM status WHERE user_id='" . $_userid . "'";
        $r =& $this->db->query($sql);
        $status =& $r->fetchRow();

        // 所持金が足りなかったらエラー
        if ($status[$this->sidx['money']] < 10) {
            return Ethna::raiseNotice('所持金が足りません', E_TOMOE_MONEYLESS);
        } 

        // ガチャ抽選
        $val = rand(1, $this->item_count);
        $sql = "SELECT * FROM item WHERE id='" . $val . "'";
        $r =& $this->db->query($sql);
        $this->item =& $r->fetchRow();
        if (empty($this->item)) {
            return Ethna::raiseNotice('アイテムをDBから取得できませんでした', E_TOMOE_LOTITEM);
        }
        
        // ステータス更新
        $newSJ = $status[$this->sidx['SJ']] + $this->item[$this->iidx['SJ']];
        $newMoney = $status[$this->sidx['money']] - $this->item[$this->iidx['money']];
        $sql = "UPDATE status SET SJ='" . $newSJ . "', money='" . $newMoney . "' WHERE user_id='" . $_userid . "'";  
        $r =& $this->db->query($sql);
        
        return null;
     }


    /**      
     *  抽選したアイテムの名前を取得する
     *
     *  @access public
     *  @return string  アイテム名
     */
    public function getItemName()
    {
        return $this->item[$this->iidx['name']];
    }

}

