<?php
include_once 'db.php';

//creiamo entrypoint

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_SERVER['PATH_INFO'] == '/movies') {
        if (isset($_GET['titolo'])) {
            echo json_encode(get_film($_GET['titolo']));
        } else {
            echo json_encode(get_film(null));
        }
    } elseif ($_SERVER['PATH_INFO'] == '/actors') {
        if (isset($_GET['attore'])) {
            echo json_encode(get_attori($_GET['attore']));
        } else {
            echo json_encode(get_attori(null));
        }
    } else {
        http_response_code(404);
    }
}
