<?php
/**
 *  Tomoe_EnemyManager.php
 *
 *  @author     {$author}
 *  @package    Tomoe
 *  @version    $Id$
 */

require_once('Tomoe_DBManager.php');

class Tomoe_EnemyManager extends Tomoe_DBManager
{
    /** @var    object  Ethna_Backend       backendオブジェクト */
    //var $backend;

    /** @var    object  Ethna_DB            DBオブジェクト */
    //var $db;


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
     *  IDに対応する敵情報を取得する
     *
     *  @access public
     *  @return array  enemy  敵の連想配列
     */
    public function getEnemyById($id)
    {
        $sql = "SELECT * FROM enemy WHERE id='" . $id . "'";
        $r =& $this->db->query($sql);
        return $r->fetchRow(DB_FETCHMODE_ASSOC);
    }
    
    /**      
     *  レベルを基準にランダムに敵Idを１つ抽選する
     *
     *  @access public
     *  @param  int     level      ユーザのレベル
     *  @param  int     range      出現する敵レベルの範囲
     *  @return int   enemy_id  (失敗したら null)
     */
     public function getRandomEnemyId($level, $range)
     {
        // 抽選
        if ($range < 0)
            $range = 0; 
        $sql = "SELECT id, possibility FROM enemy WHERE level>=" . ($level-$range) . " AND level<=" . ($level+$range) . ";";
        $enemys = $this->db->db->getAll($sql, DB_FETCHMODE_ASSOC);
        if (empty($enemys)) {
            // 該当する敵がいない
            return null;
        }
        
        $possibility_sum = 0;
        foreach ($enemys as $enemy) {
            $possibility_sum += $enemy['possibility'];
        }
        $val = mt_rand(1, $possibility_sum);
        $base_val = 0;
        for ($i = 0; $i < count($enemys); $i++) {
            $enemy = $enemys[$i];
            if ($base_val + 1 <= $val && $val <= $base_val + $enemy['possibility']) {
                break;
            }
            $base_val += $enemy['possibility'];
        }
            
        return $enemy['id'];
     }


    /**      
     *  敵の名前を取得する
     *
     *  @access public
     *  @return string  敵の名前
     */
    public function getNameById($id)
    {
        $enemy = $this->getEnemyById($id);
        return $enemy['name'];
    }
    
        
    
}

