<?php
    //change the string input into lowercase
$role=strtolower($_SESSION["userrole"]);
$menu="users/menu/$role.php";
include $menu;
?>