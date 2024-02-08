<?php
// OBTENTION DES DONNEES (ETOILE)
$numbers = array(
    $_GET['Number1'],
    $_GET['Number2'],
    $_GET['Number3'],
    $_GET['Number4'],
    $_GET['Number5']
);

//OBTENTION DES DONNEES (ETOILE)
$stars = array(
    $_GET['Stars1'],
    $_GET['Stars2']
);

// CREATION D'UNE LISTE
$drawNumbers = array();
$drawStars = array();

// CONTRÔLE DES DOUBLONS
if (count(array_unique($numbers)) < 5 || count(array_unique($stars)) < 2) {
    echo "Erreur : veuillez ne pas saisir de nombres ou d'étoiles en double.";
}

// TIRAGE AU SORT D'UN NOMBRE ALEATOIRE
while (count($drawNumbers) < 5) {
    $randomNumber = rand(1, 10);
    if (!in_array($randomNumber, $drawNumbers)) {
        $drawNumbers[] = $randomNumber;
    }
}

// TIRAGE AU SORT D'UNE ETOILE ALEATOIRE
while (count($drawStars) < 2) {
    $randomStar = rand(1, 10);
    if (!in_array($randomStar, $drawStars)) {
        $drawStars[] = $randomStar;
    }
}

// COMPARER LES DONNEES DES LISTES ET DU TIRAGE MANUEL
$matchingNumbers = array_intersect($numbers, $drawNumbers);
$matchingStars = array_intersect($stars, $drawStars);

// MATCHER LES DONNEES
if (count($matchingNumbers) == 4 && count($matchingStars) == 2) {
    $result = "Fantastique !";
} elseif (count($matchingNumbers) == 3 && count($matchingStars) == 2) {
    $result = "Bravo !";
} elseif (count($matchingNumbers) == 2 && count($matchingStars) == 1) {
    $result = "Peut faire mieux !";
} else {
    $result = "Pas de chance, réessayez";
}

// AFFICHAGE DU RESULTATS
echo "$result";
?>