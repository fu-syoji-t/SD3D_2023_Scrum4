<?php
session_start();
$ff_back = $_SESSION['ff_transition'];
if(strpos($ff_back,'06')){
    header($ff_back);
}else if(strpos($ff_back,'07')){
    header($ff_back);
}
$_SESSION['ff_transition'] = array();
?>