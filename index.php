<?php
// Inicializa variáveis
$resultado = null;
$totalAnual = 0;

// Verifica se o formulário foi submetido via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém e converte os valores do formulário
    $energia = floatval($_POST['energia'] ?? 0);
    $gas = floatval($_POST['gas'] ?? 0);
    $combustivel = floatval($_POST['combustivel'] ?? 0);
    $transporte = $_POST['transporte'] ?? '';
    $distancia = floatval($_POST['distancia'] ?? 0);
    $pessoas = floatval($_POST['pessoas'] ?? 1);

    // Define os fatores de emissão (valores em kg de CO₂ por unidade)
    $fatores = [
        'energia' => 0.233,        // por kWh
        'gas' => 1.9,              // por m³
        'combustivel' => 2.3,      // por litro
        'transporte' => [          // por km, conforme o meio de transporte
            'carro' => 0.2,
            'moto' => 0.1,
            'publico' => 0.05,
            'bicicleta' => 0
        ]
    ];

    // Cálculo das emissões por categoria
    $emissaoEnergia = $energia * $fatores['energia'];
    $emissaoGas = $gas * $fatores['gas'];
    $emissaoCombustivel = $combustivel * $fatores['combustivel'];
    $emissaoTransporte = $distancia * ($fatores['transporte'][$transporte] ?? 0);

    // Cálculo total mensal por pessoa e anual
    $totalMensal = ($emissaoEnergia + $emissaoGas + $emissaoCombustivel + $emissaoTransporte) / $pessoas;
    $totalAnual = $totalMensal * 12;

    // Classificação da pegada com base no total anual
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
        $classe = "Moderada. Há espaço para melhorias 🔄";
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

    // Comparações visuais para melhor compreensão do impacto
    $arvores = ceil($totalAnual / 22);     // Cada árvore compensa ~22 kg CO₂/ano
    $kmCarro = ceil($totalAnual / 0.2);    // Equivalente em km percorridos de carro
    $lampadas = ceil($totalAnual / 0.4);   // Equivalente em lâmpadas incandescentes

    // Armazena o resultado para uso no HTML
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
}

// Inclui o cabeçalho do site
include 'cabecalho.php';
?>

<main>
    <!-- Secção de introdução -->
    <section id="inicio" class="inicio">
        <div class="container">
            <h1>Bem-vindo à Calculadora Ambiental</h1>
            <p>Uma ferramenta para avaliares e reduzires a tua Pegada Ecológica</p>

            <a href="#calculadora" class="cta-button">Calcular a minha Pegada</a>
        </div>
    </section>

    <!-- Inclui a calculadora propriamente dita -->
    <?php include 'calculadora.php'; ?>

    <!-- Inclui as dicas de sustentabilidade -->
    <?php include 'dicas.php'; ?>

    <!-- Inclui a secção de contactos -->
    <?php include 'contactos.php'; ?>
</main>

<!-- Inclui o rodapé do site -->
<?php include 'rodape.php'; ?>
