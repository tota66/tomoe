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
        $enc_pass = sha1($password);
        
        // DBからユーザデータを取得
        $sql = "SELECT * FROM member WHERE name='" . $userid . "' AND password='" . $enc_pass . "'";
        $result = $this->db->query($sql);
        $data = $result->fetchRow();
        
        // 合致するデータがなかったらエラー
        if (empty($data)) {
            return Ethna::raiseNotice('ユーザIDまたはパスワードが正しくありません', E_TOMOE_AUTH);
        }
        $this->userid = $data[0];
        return 0;
    }

    /**
     * ユーザ名からIDを得る
     *  
     * @param user_name ユーザ名
     * @return ユーザID。失敗したらnullを返す
     */
    public function getIdByName($user_name)
    {
        $sql = "SELECT * FROM member WHERE name='" . $user_name . "'";
        $result = $this->db->query($sql);
        $user = $result->fetchRow(DB_FETCHMODE_ASSOC);
        return $user['id'];
    }

    /**
     * ユーザの追加  
     *
     * @param name: userのID
     * @param pass: パスワード
     * @return 成功したらDB_OK，失敗したらDB_Errorを返す
     */
    public function insertUser($name, $pass)
    {
        // 暗号化して保存
        $enc_pass = sha1($pass);
        // プリペアド・ステートメントの利用
        $sql = "INSERT INTO member (name, password, last_login) VALUES (?, ?, ?)";
        $stt = $this->db->db->prepare($sql);
        return $this->db->db->execute($stt, array($name, $enc_pass, date('Y-m-d H:i:s')));
    }
        
}

