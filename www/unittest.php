<?php
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/../app/Tomoe_Controller.php';

Tomoe_Controller::main('Tomoe_Controller', array(
    '__ethna_unittest__',
    )
);
?>
