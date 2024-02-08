<?php
$numbers = array(
    $_GET['Number1'],
    $_GET['Number2'],
    $_GET['Number3'],
    $_GET['Number4'],
    $_GET['Number5']
);

$stars = array(
    $_GET['Stars1'],
    $_GET['Stars2']
);

$drawNumbers = array();
$drawStars = array();

while (count($drawNumbers) < 5) {
    $randomNumber = rand(1, 50);
    if (!in_array($randomNumber, $drawNumbers)) {
        $drawNumbers[] = $randomNumber;
    }
}

while (count($drawStars) < 2) {
    $randomStar = rand(1, 12);
    if (!in_array($randomStar, $drawStars)) {
        $drawStars[] = $randomStar;
    }
}

$matchingNumbers = array_intersect($numbers, $drawNumbers);
$matchingStars = array_intersect($stars, $drawStars);

if (count($matchingNumbers) == 5 && count($matchingStars) == 2) {
    $result = "Fantastique !";
} elseif (count($matchingNumbers) == 4 && count($matchingStars) == 2) {
    $result = "Bravo !";
} elseif (count($matchingNumbers) == 3 && count($matchingStars) == 2) {
    $result = "Peut faire mieux !";
} else {
    $result = "Pas de chance, réessayez";
}

echo "$result";
?>