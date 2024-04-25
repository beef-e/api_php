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
  /*global $conn;
  $sql = "";
  if ($user_input == null) {
    // $sql = "SELECT * FROM Film";
    $sql = "SELECT * from Film JOIN Film_Attore as FA on FA.film_id=Film.id JOIN Film_Regista as FR on FR.film_id=Film.id JOIN Film_Genere as FG on FG.film_id=Film.id JOIN Attore as AA on AA.id=FA.attore_id JOIN Regista as RR on RR.id=FR.regista_id GROUP BY Film.titolo;";
    } else {
  // $sql = "SELECT * FROM Film WHERE titolo like '%$user_input%'";
  $sql = "SELECT * from Film JOIN Film_Attore as FA on FA.film_id=Film.id JOIN Film_Regista as FR on FR.film_id=Film.id JOIN Film_Genere as FG on FG.film_id=Film.id JOIN Attore as AA on AA.id=FA.attore_id JOIN Regista as RR on RR.id=FR.regista_id WHERE titolo LIKE '%$user_input%' group by Film.titolo;";
  }
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows;*/
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


function get_attori_by_film($film)
{
  $film = json_decode($film, true);
  $id_attori = [];
  $attori = [];
  foreach ($film as $entry) {
    $id = $entry["id"];

    global $conn;
    $sql = "SELECT * FROM Film_Attore where film_id='$id'";
    $result = mysqli_query($conn, $sql);
    $film_attore = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($film_attore as $coppia_id) {
      array_push($id_attori, $coppia_id["attore_id"]);
    }

    foreach ($id_attori as $key) {
      $sql = "SELECT * FROM Attore WHERE id=$key";
      $result = mysqli_query($conn, $sql);
      $current_actor = mysqli_fetch_all($result, MYSQLI_ASSOC);

      array_push($attori, $current_actor);
    }
  }

  return $attori;
}
