<?php
$conn = mysqli_connect("localhost", "api", "", "api_movies");

function get_film($user_input)
{
  global $conn;
  $sql = "";
  if ($user_input == null) {
    $sql = "SELECT * FROM Film";
  } else {
    $sql = "SELECT * FROM Film WHERE titolo like '%$user_input%'";
  }
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows;
}

function get_attori($user_input)
{
  global $conn;
  $sql = "";
  if ($user_input == null) {
    $sql = "SELECT * FROM Attore";
  } else {
    $sql = "SELECT * FROM Attore WHERE nome like '%$user_input%' OR cognome like '%$user_input%' OR secondo_nome like '%$user_input%'";
  }
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows;
}

function get_generi($user_input)
{
  global $conn;
  $sql = "";
  if ($user_input == null) {
    $sql = "SELECT * FROM Genere";
  } else {
    $sql = "SELECT * FROM Genere WHERE nome like '%$user_input%'";
  }
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows;
}

function get_registi($user_input)
{
  global $conn;
  $sql = "";
  if ($user_input == null) {
    $sql = "SELECT * FROM Regista";
  } else {
    $sql = "SELECT * FROM Regista WHERE nome like '%$user_input%' OR cognome like '%$user_input%' OR secondo_nome like '%$user_input%'";
  }
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows;
}
