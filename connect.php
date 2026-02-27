<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "business";


try {
    //Line 8 เป็นการสร้าง coonect string เพื่อเชื่อมต่อกับฐานข้อมูล MySQL โดยใช้ PDO 

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
