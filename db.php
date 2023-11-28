<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=crud;charset=utf8","root","");
    } catch (PDOException $ex) {
        die("HATA : " . $ex->getMessage());
    }


?>