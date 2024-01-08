<?php

session_start();
$_SESSION['replyform'] = $_POST['replyreply'];

header('Location:04_投稿詳細.php');

?>