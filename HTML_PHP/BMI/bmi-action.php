<?php

if (isset($_GET["size"]) && isset($_GET["weight"])) {
    $size = $_GET["size"];
    $weight = $_GET["weight"];

    $bmi = $weight / ($size * $size);

    echo "Votre BMI: $bmi";
}

if (isset($_GET["sizeIdeal"]) && isset($_GET["weightIdeal"])) {
    $sizeIdeal = $_GET["sizeIdeal"];
    $weightIdeal = $_GET["weightIdeal"];

    $imcIdeal = $weightIdeal / ($sizeIdeal * $sizeIdeal);
    $IdealWeight = $imcIdeal * ($sizeIdeal * $sizeIdeal);

    echo "Votre poids idéal: $IdealWeight";
}

if (isset($_GET["density"]) && isset($_GET["volume"])) {
    $density = $_GET["density"];
    $volume = $_GET["volume"];

    $Masse = $density * $volume;

    echo "La masse est de: $Masse";
}
if (isset($_GET[""]) && isset($_GET[""])) {

}