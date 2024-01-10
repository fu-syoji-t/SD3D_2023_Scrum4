<?php

session_start();
$_SESSION['replyform'] = $_POST['replyreply'];

header('Location:04_detail_post.php');

?>