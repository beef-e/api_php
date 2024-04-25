<?php
include_once 'db.php';

//creiamo entrypoint

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_SERVER['PATH_INFO'] == '/movies') {
        if (isset($_GET['titolo'])) {
            $film = json_encode(get_film($_GET['titolo']));
            // TODO: Aggiungere al film anche gli attori
            // facendo una query riguardante quel coso
            $attori = json_encode(get_attori_by_film($film));

            $json_film = json_decode($film);

            $json_film["attori"]=json_decode($attori);
      
            echo json_encode($json_film);   

            // echo $film;
        } else {
            echo json_encode(get_film(null));
        }
    } elseif ($_SERVER['PATH_INFO'] == '/actors') {
        if (isset($_GET['attore'])) {
            echo json_encode(get_attori($_GET['attore']));
        } else {
            echo json_encode(get_attori(null));
        }
    } elseif ($_SERVER['PATH_INFO'] == '/genres') {
        if (isset($_GET['genere'])) {
            echo json_encode(get_generi($_GET['genere']));
        } else {
            echo json_encode(get_generi(null));
        }
    } elseif ($_SERVER['PATH_INFO'] == '/directors') {
        if (isset($_GET['regista'])) {
            echo json_encode(get_registi($_GET['regista']));
        } else {
            echo json_encode(get_registi(null));
        }
    }
} else {
    http_response_code(404);
}
