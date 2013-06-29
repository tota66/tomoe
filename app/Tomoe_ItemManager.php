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

    /** @var    int     possibility_sum     アイテムの出現頻度の和 */
    var $possibility_sum;
    
    
    /**      
     *  コンストラクタ
     *
     *  @access public
     *  @param  object  $_backend   backendオブジェクト 
     */
    public function __construct(&$_backend)
    {
        $this->item_count = 0;
        $this->possibility_sum = 0;
        parent::__construct($_backend);
    }

    
    /**
     * アイテムテーブルを初期化 
     * 
     * @return 成功したらDB_OK, 失敗したらDB_Errorを返す 
     */
    public function initItem()
    {
        $itemlist = array(
            array('ケーキ',
                '100',
                '30',
                '0',
                '0',
                '1',
                '40',
                '体力が少し回復します',
            ),
            array('紅茶',
                '200',
                '0',
                '0',
                '5',
                '1',
                '40',
                'ソウルジェムが少し浄化します',
            ),
            array('髪飾り',
                '500',
                '0',
                '10',
                '0',
                '1',
                '20',
                '経験値が少し増えます',
            ),
        ); 
        $sql = "INSERT INTO item (name, money, HP, exp, SJ, level, possibility, message)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        foreach ($itemlist as $item) {
            $stt = $this->db->db->prepare($sql);
            $rc = $this->db->db->execute($stt, $item);
        }
        return $rc; 
    }
    
    /**
     *  IDに対応するアイテムを獲得 
     */
    public function addItem($user_id, $item_id, $num)
    {
        $count = $this->getCount($user_id, $item_id);
        if ($count == 0) {
            // 新規アイテム
            $sql = "INSERT INTO possession (user_id, item_id, count) VALUES (?, ?, ?)";
            $stt = $this->db->db->prepare($sql);
            $rc = $this->db->db->execute($stt, array($user_id, $item_id, $num));
        } else {
            // すでにいくつか持ってるアイテム
            $sql = "UPDATE possession SET count=? WHERE user_id=? AND item_id=?";
            $stt = $this->db->db->prepare($sql);
            $rc = $this->db->db->execute($stt, array($count+$num, $user_id, $item_id));
        }
        return $rc; 
    }
    
    /**
     *  所持してるアイテム数を返す 
     *  なければ0を返す
     */
    public function getCount($user_id, $item_id)
    {
        $sql = "SELECT count FROM possession WHERE user_id=" . $user_id . " AND item_id=" . $item_id;
        $rt = $this->db->query($sql);
        $item = $rt->fetchRow(DB_FETCHMODE_ASSOC);
        if (empty($item))
            return 0;
        return $item['count'];
    }
    
    /**
     *  指定ユーザが所持してるアイテムのリストを返す 
     */
    public function getPossessionById($user_id)
    {
        $sql = "SELECT * FROM possession WHERE user_id=" . $user_id;
        return $this->db->db->getAll($sql, DB_FETCHMODE_ASSOC);
    }
    
    /**
     *  所持アイテムリストを取得 
     */
    public function getPossessionList($user_id)
    {
        $item_list = array();
        $possess = $this->getPossessionById($user_id);
        foreach ($possess as $item) {
            $elem = array();
            $elem['id'] = $item['item_id'];
            $elem['count'] = $item['count'];
            $elem += $this->getItemById($item['item_id']);
            $item_list[] = $elem;
        }
        return $item_list;
    }
            
    /**      
     *  IDに対応するアイテム情報を取得する
     *
     *  @access public
     *  @return array  item  アイテムの連想配列
     */
    public function getItemById($id)
    {
        $sql = "SELECT * FROM item WHERE id='" . $id . "'";
        $r =& $this->db->query($sql);
        return $r->fetchRow(DB_FETCHMODE_ASSOC);
    }
    
    /**      
     *  アイテムテーブルからランダムにアイテムを１つ抽選する
     *
     *  @access public
     *  @param  int     user_id      ユーザID
     *  @return array   item  (失敗したら Ethna_Error   エラーオブジェクト)
     */
     public function lotItem($user_id)
     {
        // ユーザIDに対応するステータス取得
        $sql = "SELECT * FROM status WHERE user_id='" . $user_id . "'";
        $r =& $this->db->query($sql);
        $status =& $r->fetchRow(DB_FETCHMODE_ASSOC);

        // 所持金が足りなかったらエラー
        if ($status['money'] < 0) {
            return Ethna::raiseNotice('所持金が足りません', E_TOMOE_MONEYLESS);
        } 

        // ガチャ抽選
        $sql = "SELECT * FROM item";
        $itemlist = $this->db->db->getAll($sql, null, DB_FETCHMODE_ASSOC);
        foreach ($itemlist as $item) {
            $this->item_count++;
            $this->possibility_sum += $item['possibility'];
        }
        $val = mt_rand(1, $this->possibility_sum);
        $base_val = 0;
        for ($i = 0; $i < $this->item_count; $i++) {
            $item = $itemlist[$i];
            if ($base_val + 1 <= $val && $val <= $base_val + $item['possibility']) {
                break;
            }
            $base_val += $item['possibility'];
        }
            
        return $item;
     }
    
    /**
     *  指定アイテムを指定数消す 
     */
    public function deleteItem($user_id, $item_id, $num)
    {
        $count = $this->getCount($user_id, $item_id);
        if ($count == 0)
            return null;

        $new_count = $count - $num;
        if ($new_count < 0)
            $new_count = 0;

        return $this->updatePossession($user_id, $item_id, $new_count);
    }
        
    /**
     *  アイテム所有数を更新 
     */
    public function updatePossession($user_id, $item_id, $count)
    {
        if ($count > 0) {
            $sql = "UPDATE possession SET count=? WHERE user_id=? AND item_id=?";
            $stt = $this->db->db->prepare($sql);
            return $this->db->db->execute($stt, array($count, $user_id, $item_id));
        } else {
            // 所持数0なのでカラムを消す
            $sql = "DELETE FROM possession WHERE user_id=? AND item_id=?";
            $stt = $this->db->db->prepare($sql);
            return $this->db->db->execute($stt, array($user_id, $item_id));
        }
    } 
    
    
    /**
     *  アイテムを使う 
     */
    public function useItem($user_id, $item_id)
    {
        $item = $this->getItemById($item_id); 
        
        // アイテム消去
        $rc = $this->deleteItem($user_id, $item_id, 1);
        if ($rc == null)
            return null;
        
        // ユーザIDに対応するステータス取得
        $sql = "SELECT * FROM status WHERE user_id='" . $user_id . "'";
        $r =& $this->db->query($sql);
        $status =& $r->fetchRow(DB_FETCHMODE_ASSOC);
        
        // ステータス更新
        $newHP = $status['HP'] + $item['HP'];
        $newSJ = $status['SJ'] + $item['SJ'];
        $newExp = $status['exp'] + $item['exp'];
        $sql = "UPDATE status SET HP=?, SJ=?, exp=? WHERE user_id=?";  
        $stt = $this->db->db->prepare($sql);
        return $this->db->db->execute($stt, array($newHP, $newSJ, $newExp, $user_id));
    }
    

    /**      
     *  アイテムの名前を取得する
     *
     *  @access public
     *  @return string  アイテム名
     */
    public function getNameById($id)
    {
        $item = $this->getItemById($id);
        return $item['name'];
    }

}

