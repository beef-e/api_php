<?php
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
