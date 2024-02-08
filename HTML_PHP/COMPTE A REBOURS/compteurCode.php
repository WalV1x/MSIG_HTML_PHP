<?php
$newYear = new DateTime("2024-01-01 00:00:00");
$now = new DateTime();

$interval = $newYear->diff($now);

$days = $interval->format("%a");
$hours = $interval->format("%h");
$minutes = $interval->format("%i");
$seconds = $interval->format("%s");
?>

<link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.20/dist/full.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>

<html>
<div class="grid grid-cols-3 mt-12">

  <div></div>

  <div>

  <div class="grid grid-flow-col gap-5 text-center auto-cols-max">

  <div class="flex gap-5">
      <script language ="JavaScript">
          setInterval("update()", 100)

          var time = "<?="$days:$hours:$minutes:$seconds"?>";

          function update()
          {
              fetch("countdown.php")
                  .then(resp=>resp.text())
                  .then(text=>window.time=text);

              let timeParts = time.split(":");
              let parts=["days", "hours", "minutes", "seconds"];

              for(let i =0; i<4; i++)
              {
                  document
                      .querySelector("#"+parts[i])
                      .style
                      .setProperty("--value",timeParts[i]);
              }
          }
      </script>
    <div>
      <span class="countdown font-mono text-4xl">
        <span id="days" style="--value:<?=$days; ?>;"></span>
      </span>
      jours
    </div>
    <div>
      <span class="countdown font-mono text-4xl">
        <span id="hours" style="--value:<?=$hours; ?>;"></span>
      </span>
      heures
    </div>
    <div>
      <span class="countdown font-mono text-4xl">
        <span id="minutes" style="--value:<?=$minutes; ?>;"></span>
      </span>
      min
    </div>
    <div>
      <span class="countdown font-mono text-4xl">
        <span id="seconds" style="--value:<?=$seconds; ?>;"></span>
      </span>
      sec
    </div>
  </div>
</html>