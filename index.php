<?php include('layouts/header.php'); ?>
<body>
    <div class="container py-5">
        <h1 class="text-center">Descubra seu signo:</h1>

    <form id ="signo-form" method="POST" action="show_zodiac_sign.php">
        <label for="data_nascimento" class="form-label">Data de nascimento</label>
        <input type="text" class="form-control" id="data_nascimento"
            name="data_nascimento" placeholder="Ex.: 21/05/1992" required>
    <button type="submit" class="btn btn-primary mt-3">Descobrir</button>
     </form>
    </div>
</body>
</html>