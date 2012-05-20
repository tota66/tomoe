<?php
/**
 *  Tomoe_DBManager.php
 *
 *  @author     {$author}
 *  @package    Tomoe
 *  @version    $Id$
 */


class Tomoe_DBManager
{
    /** @var    object  Ethna_Backend       backendオブジェクト */
    protected $backend;

    /** @var    object  Ethna_DB            DBオブジェクト */
    protected $db;

    public function __construct(&$_backend)
    {
        $this->backend =& $_backend;
        $this->db =& $this->backend->getDB('v5');
        if (Ethna::isError($this->db)) {
            // DBconnent Error
            Ethna::raiseNotice('DBに接続できません', E_TOMOE_DBCONNECT);
        }
    }

}

