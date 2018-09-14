<?php
// 连主库
$dbc=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS) or die("error connection");

// 连从库
// $link=mysql_connect(SAE_MYSQL_HOST_S.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);

if($dbc)
{
    mysql_select_db(SAE_MYSQL_DB,$dbc);
    //your code goes here
}
?>