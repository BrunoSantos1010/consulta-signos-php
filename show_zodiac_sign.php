<?php include('layouts/header.php'); ?>
<?php
$data_nascimento = $_POST['data_nascimento'];
$signos = simplexml_load_file("signos.xml");

// Converte "dd/mm" em uma data completa, usando o ano informado
function converterData($diaMes, $ano)
{
    return DateTime::createFromFormat('!d/m/Y', $diaMes . '/' . $ano);
}

// Converte o texto digitado em data (false se estiver inválida)
$nascimento = DateTime::createFromFormat('!d/m/Y', $data_nascimento);
$signoEncontrado = null;

if ($nascimento !== false) {
    $ano = $nascimento->format('Y');

    foreach ($signos->signo as $signo) {
        $inicio = converterData((string) $signo->dataInicio, $ano);
        $fim = converterData((string) $signo->dataFim, $ano);

        // Signo que atravessa a virada do ano (Capricórnio)
        if ($fim < $inicio) {
            if ($nascimento >= $inicio) {
                $fim->modify('+1 year');
            } else {
                $inicio->modify('-1 year');
            }
        }

        // A data de nascimento está dentro do intervalo?
        if ($nascimento >= $inicio && $nascimento <= $fim) {
            $signoEncontrado = $signo;
            break;
        }
    }
}
?>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <?php if ($signoEncontrado) { ?>
                    <div class="card text-center text-white resultado-card">
                        <div class="card-body py-5">
                            <h1 class="display-3 resultado-titulo"><?= $signoEncontrado->signoNome ?></h1>
                            <p class="lead mt-4"><?= $signoEncontrado->descricao ?></p>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger text-center">
                        Data inválida. Digite no formato dd/mm/aaaa.
                    </div>
                <?php } ?>

                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-outline-primary">Voltar</a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>