<?php
/**
 *  Tomoe_UserManager.php
 *
 *  @author     {$author}
 *  @package    Tomoe
 *  @version    $Id$
 */

require_once('Tomoe_DBManager.php');

class Tomoe_UserManager extends Tomoe_DBManager
{
    /** @var    object  Ethna_Backend       backendオブジェクト */
    // var $backend;

    /** @var    object  Ethna_DB            DBオブジェクト */
    // var $db;

    /** @var    int     userid              userid */
    var $userid;

    public function __construct(&$_backend)
    {
        parent::__construct($_backend);
    }

    public function auth($userid, $password)
    {
        // DBからユーザデータを取得
        $sql = "SELECT * FROM member WHERE name='" . $userid . "' AND password='" . $password . "'";
        $result =& $this->db->query($sql);
        $data =& $result->fetchRow();
        
        // 合致するデータがなかったらエラー
        if (empty($data)) {
            return Ethna::raiseNotice('ユーザIDまたはパスワードが正しくありません', E_TOMOE_AUTH);
        }
        $this->userid = $data[0];
        return 0;
    }

    public function getUserID()
    {
        return $this->userid;
    }
}

