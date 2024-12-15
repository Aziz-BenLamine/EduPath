<?php
session_start();


session_destroy();


header("Location: /Edupath/views/home.php");
exit();
