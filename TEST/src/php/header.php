<?php
echo '
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>

<div class="navbar bg-base-100">
    <div class="flex-1">
        <form action="index.php">
            <button type="submit" class="btn btn-ghost text-xl">Netflix</button>
        </form>
    </div>
</div>

<body>
<form method="get" action="actor.php">
    <div class="flex-none gap-2">
        <div class="form-control">
            <input type="text" name="search" placeholder="Que cherchez-vous ?" class="input input-bordered w-24 md:w-auto" />
            <input type="hidden" value="">
        </div>
    </div>
</form>
</body>
</html>
</div>';
?>