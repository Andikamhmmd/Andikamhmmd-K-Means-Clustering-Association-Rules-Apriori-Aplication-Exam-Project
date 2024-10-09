<?php

session_start();
session_unset(); //penghapusan session
session_destroy();

header('Location:login.php');

?>