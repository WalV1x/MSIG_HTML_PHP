<?php
date_default_timezone_set('Europe/Zurich');
$newYear = new DateTime("2024-01-01 00:00:00");
$now = new DateTime();

$interval = $newYear->diff($now);

$days = $interval->format("%a");
$hours = $interval->format("%h");
$minutes = $interval->format("%i");
$seconds = $interval->format("%s");

echo "$days:$hours:$minutes:$seconds";
?>