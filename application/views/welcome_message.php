<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>

웰컴~

session : <?= $this->session->userdata('email') ?>
<br/>
<a href="/board">게시판</a>

</body>
</html>
