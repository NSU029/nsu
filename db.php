<?php
$hostname = "sql107.infinityfree.com";
$username = "if0_39469160";
$password = "5Xpw8Wlmb4";
$database = "if0_39469160_calculadora_ambiental";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Define o charset para UTF-8 (completo) para evitar problemas com caracteres especiais
$conn->set_charset("utf8mb4");