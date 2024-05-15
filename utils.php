<?php
include_once 'db.php';

function cosine_similarity($user_vector1, $user_vector2)
{

    $dist = 0;
    $numerator = 0;
    $denom1 = 0;
    $denom2 = 0;
    $denom = 0;


    foreach ($user_vector1 as $film => $value) {
        $numerator += $value * $user_vector2[$film];
    }

    foreach ($user_vector1 as $film => $value) {
        $denom1 += pow($value, 2);
    }

    foreach ($user_vector2 as $film => $value) {
        $denom2 += pow($value, 2);
    }

    $denom1 = sqrt($denom1);
    $denom2 = sqrt($denom2);

    $denom = $denom1 * $denom2;

    if ($denom != 0) {
        $dist = $numerator / $denom;
    } elseif ($denom == 0) {
        $dist = -2;
    }

    return $dist;
}

function build_matrix()
{

    $matrix = array();
    $films = get_film(null);
    $users = get_users(null);

    $filmNumber = count($films);

    /*
      * Per ogni utente devo controllare se è presente quel film associato al suo id. Se sì metto uno, altrimenti 0
    */


    foreach ($users as $user) {
        $userid = $user['id'];
        $filmVisti = get_film_users($userid);
        $matrix[$userid] = array_fill(1, $filmNumber, 0); //inizializzo l'array di film di user[userid] con tutti zeri
        foreach ($filmVisti as $row) {
            $matrix[$userid][$row['id_film']] = 1;
        }
    }
    /*foreach ($users as $user) {
        $matrix[$user] = array();
        foreach ($films as $film) {
            $matrix[$user][$film] = 0;
        }
    }*/
    return $matrix;
}
