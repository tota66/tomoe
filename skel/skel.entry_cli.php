<?php
/**
 *  {$action_name}.php
 *
 *  @author     {$author}
 *  @package    Tomoe
 *  @version    $Id$
 */
chdir(dirname(__FILE__));
require_once '{$dir_app}/Tomoe_Controller.php';

ini_set('max_execution_time', 0);

Tomoe_Controller::main_CLI('Tomoe_Controller', '{$action_name}');
?>
