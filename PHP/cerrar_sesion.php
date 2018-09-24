<?php 
session_start();
$_SESSION['usuar']='';
session_destroy();
header('location: ../login') ?>