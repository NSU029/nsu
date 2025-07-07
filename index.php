<?php

$seccao = $_GET['p'] ?? 'calculadora';
$resultado = null;
$totalAnual = 0;
$scrollToResults = false; 

// SCRIPT PHP DA CALCULADORA
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $energia = floatval($_POST['energia'] ?? 0);
    $gas = floatval($_POST['gas'] ?? 0);
    $combustivel = floatval($_POST['combustivel'] ?? 0);
    $transporte = $_POST['transporte'] ?? '';
    $distancia = floatval($_POST['distancia'] ?? 0);
    $pessoas = floatval($_POST['pessoas'] ?? 1);

    // Emission factors (kg CO₂/unit)
    $fatores = [
        'energia' => 0.233, // kg CO₂ per kWh
        'gas' => 1.9, // kg CO₂ per m³
        'combustivel' => 2.3, // kg CO₂ per liter
        'transporte' => [
            'carro' => 0.2, // kg CO₂ per km
            'moto' => 0.1,
            'publico' => 0.05,
            'bicicleta' => 0
        ]
    ];

    // Calculations
    $emissaoEnergia = $energia * $fatores['energia'];
    $emissaoGas = $gas * $fatores['gas'];
    $emissaoCombustivel = $combustivel * $fatores['combustivel'];
    $emissaoTransporte = $distancia * ($fatores['transporte'][$transporte] ?? 0);

    $totalMensal = ($emissaoEnergia + $emissaoGas + $emissaoCombustivel + $emissaoTransporte) / $pessoas;
    $totalAnual = $totalMensal * 12;

    // Classification
    if ($totalAnual <= 2000) {
        $classe = "Excelente! Pegada muito baixa 🌟";
        $classeCss = "excelente";
        $progressClass = "progress-20";
        $alertClass = "alert-success";
    } elseif ($totalAnual <= 4000) {
        $classe = "Boa! Pegada baixa 👍";
        $classeCss = "boa";
        $progressClass = "progress-40";
        $alertClass = "alert-info";
    } elseif ($totalAnual <= 6000) {
        $classe = "Moderada. Há margem para melhorares 🔄";
        $classeCss = "moderada";
        $progressClass = "progress-60";
        $alertClass = "alert-warning";
    } elseif ($totalAnual <= 8000) {
        $classe = "Alta. Considera mudanças significativas ⚠️";
        $classeCss = "alta";
        $progressClass = "progress-80";
        $alertClass = "alert-warning";
    } else {
        $classe = "Muito alta! Ação urgente necessária 🚨";
        $classeCss = "muito-alta";
        $progressClass = "progress-100";
        $alertClass = "alert-danger";
    }

    // Comparisons
    $arvores = ceil($totalAnual / 22);
    $kmCarro = ceil($totalAnual / 0.2);
    $lampadas = ceil($totalAnual / 0.4);

    $resultado = [
        'total' => $totalAnual,
        'classe' => $classe,
        'classeCss' => $classeCss,
        'progressClass' => $progressClass,
        'alertClass' => $alertClass,
        'arvores' => $arvores,
        'kmCarro' => $kmCarro,
        'lampadas' => $lampadas
    ];

    // SCROLL RESULTADOS
    $scrollToResults = true;
}

// CABEÇALHO
include 'cabecalho.php';
?>

<main class="mh-container">

    <?php if ($seccao !== 'sobre'): ?>

        <!-- SECÇÃO INICIAL -->
        <section id="inicio" class="inicio">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6">
                        <h1>Bem‑vindo à <br> Calculadora Ambiental</h1>
                        <p>Uma ferramenta para avaliares e reduzires a tua Pegada Ecológica</p>
                        <a href="?p=calculadora" class="cta-button">Calcular a Minha Pegada</a>
                    </div>
                </div>
            </div>
        </section>

    <?php endif; ?>

    <?php if ($seccao == 'calculadora'): ?>
        <!-- SECÇÃO CALCULADORA -->
        <section id="calculadora" class="content-section">
            <div class="container">
                <?php include_once 'calculadora.php'; ?>
            </div>
        </section>

    <?php elseif ($seccao == 'dicas'): ?>
        <!-- SECÇÃO DICAS -->
        <section id="dicas" class="content-section">
            <div class="container">
                <?php include 'dicas.php'; ?>
            </div>
        </section>

    <?php elseif ($seccao == 'contactos'): ?>
        <!-- SECÇÃO CONTACTOS -->
        <section id="contactos" class="content-section">
            <div class="container">
                <?php include 'contactos.php'; ?>
            </div>
        </section>

    <?php elseif ($seccao == 'sobre'): ?>
        <!-- SECÇÃO SOBRE -->
        <section id="sobre" class="content-section">
            <div class="container">
                <?php include 'sobre.php'; ?>
            </div>
        </section>

    <?php endif; ?>

</main>

<!-- RODAPÉ -->
<?php include 'rodape.php'; ?>

<!-- SCROLL RESULTADOS -->
<?php if ($scrollToResults): ?>

    <script src="js/scroll_to_results.js"></script>

<?php endif; ?>

