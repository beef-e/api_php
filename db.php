<?php
$conn = mysqli_connect("localhost", "api", "", "api_movies");

function get_film($user_input)
{
  global $conn;
  $film_id = [];
  $actors_id = [];
  $data = [];
  $sql = "";
  if ($user_input == null) {
    $sql = "SELECT * FROM Film";
  } else {
    $sql = "SELECT * FROM Film WHERE titolo like '%$user_input%'";
  }
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $films = $rows;

  // return $rows;

  /*foreach ($rows as $film) {
    array_push($data, $film["id"]);
  }*/

 /* foreach ($films as $movie) {
    $movie["Attori"] = "ciao";
    //echo $movie["Attori"];

    foreach ($movie as $key => $value) {
      echo "movie: ";
      echo $key . " " . $value . "<br>";
    }
}*/

  // per ogni film, prendo gli attori
  foreach ($films as $index => $movie) {
    $films[$index]["Actors"]=[];
    $sql = "SELECT Attore.id, Attore.nome, Attore.cognome, Attore.data_di_nascita from Film_Attore JOIN Attore ON film_id = '" . $movie["id"] . "' AND attore_id = id";
    //$sql = "SELECT * FROM Film_Attore WHERE film_id = '$movie["id"]'";
    $result = mysqli_query($conn, $sql);
    $coppia = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // per ogni riga prendo l'id dell'attore
    foreach ($coppia as $key) {
      $films[$index]["Actors"] = $coppia;
      // array_push($films[$index]["Actors"], $coppia);
    }
    // per ogni id attore, prendo effettivamente l'attore
    /*foreach ($actors_id as $actor_value) {
      $sql = "SELECT * FROM Attore WHERE id='$actor_value'";
      $result = mysqli_query($conn, $sql);
      $attore = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $actor = $attore[0];

      // per ogni film, controllo che l'id sia uguale a quello del film in questione e aggiungo l'attore
      foreach ($films as $movie) {
        if ($movie["id"] === $film_value) {
          $movie["Attori"] = $actor;
        }
      }
    }
  }*/

  /*foreach ($actors_id as $value) {
    foreach ($attore as $actor) {
      array_push($movie["Attori"], $actor);
    }
  }*/
  }
  return $films;
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
