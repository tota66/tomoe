<?php
/**
 *  Tomoe_Error.php
 *
 *  @package   Tomoe
 *
 *  $Id$
 */

/*--- Application Error Definition ---*/
/*
 *  TODO: Write application error definition here.
 *        Error codes 255 and below are reserved 
 *        by Ethna, so use over 256 value for error code.
 *
 *  Example:
 *  define('E_LOGIN_INVALID', 256);
 */
 /** エラーコード： ユーザ認証エラー */
 define ('E_TOMOE_AUTH', 300);

 /** エラーコード： DB接続エラー */
 define ('E_TOMOE_DBCONNECT', 301);

?>
