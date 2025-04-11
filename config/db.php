<?php
function getDbConnection()
{
    $host = 'localhost';
    $user = 'root';
    $pass_word = '';
    $db_name = 'todolist';

    $conn = mysqli_connect($host, $user, $pass_word, $db_name);

    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
    return $conn;
}
