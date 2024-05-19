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
  $films = $rows;

  // per ogni film, prendo gli attori
  foreach ($films as $index => $movie) {
    $films[$index]["Actors"] = [];
    $films[$index]["Directors"] = [];
    $sql = "SELECT Attore.id, Attore.nome, Attore.cognome, Attore.data_di_nascita from Film_Attore JOIN Attore ON film_id = '" . $movie["id"] . "' AND attore_id = id";
    //$sql = "SELECT * FROM Film_Attore WHERE film_id = '$movie["id"]'";
    $result = mysqli_query($conn, $sql);
    $coppia = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sql = "SELECT Regista.* from Regista JOIN Film_Regista ON film_id = '" . $movie["id"] . "' AND regista_id = Regista.id";
    $result = mysqli_query($conn, $sql);
    $directors = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sql = "SELECT nome FROM Genere JOIN Film_Genere ON film_id = '" . $movie["id"] . "' AND genere_id = nome";
    $result = mysqli_query($conn, $sql);
    $genres = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // per ogni riga prendo l'id dell'attore
    foreach ($coppia as $key) {
      $films[$index]["Actors"] = $coppia;
      // array_push($films[$index]["Actors"], $coppia);
    }

    foreach ($directors as $key) {
      $films[$index]["Directors"] = $directors;
    }

    foreach ($genres as $key) {
      $films[$index]["Genres"] = $genres;
    }
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

function get_users($user_input)
{
  global $conn;
  $sql = "";
  if ($user_input == null) {
    $sql = "SELECT * FROM Utenti";
  } else {
    $sql = "SELECT * FROM Utenti WHERE nome like '%$user_input%' OR cognome like '%$user_input%' OR email like '%$user_input%' OR id = '$user_input'";
  }
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows;
}

function create_user($nome, $cognome, $email, $password)
{
  global $conn;
  $sql = "SELECT * FROM Utenti WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (count($rows) > 0) {
    return "Utente già esistente";
  }
  $sql = "INSERT INTO Utenti (nome, last_name, email, hashedPSW, reg_date) VALUES ('$nome', '$cognome', '$email', '$password', NOW())";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function get_film_users($user_id)
{
  global $conn;
  $sql = "SELECT * FROM Film_Utente WHERE id_utente = '$user_id'";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $rows;
}

function get_film_by_id($movie_id)
{

  global $conn;
  $sql = "SELECT * FROM Film WHERE id='$movie_id'";
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
