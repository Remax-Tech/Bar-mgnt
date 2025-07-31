<?php
session_start();
session_destroy();
header("Location: login.html?error=You+have+been+logged+out");
exit();
?>