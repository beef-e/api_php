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
    $sql = "SELECT * FROM Attore WHERE nome like '%$user_input%' OR cognome like '%$user_input%'";
  }
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows;
}
