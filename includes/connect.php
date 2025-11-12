<?php
    $url = 'localhost';
    $username = 'root';
    $database = 'bd_bayak';
    if(!$con = mysqli_connect($url,$username,'',$database)){
        echo "não foi possivel conectar ao banco de dados";
    }
    mysqli_query($con,"SET NAMES utf8");