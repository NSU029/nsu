<?php
$resultado = null;
$totalAnual = 0;

// CALCULADORA PHP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $energia = floatval($_POST['energia'] ?? 0);
    $gas = floatval($_POST['gas'] ?? 0);
    $combustivel = floatval($_POST['combustivel'] ?? 0);
    $transporte = $_POST['transporte'] ?? '';
    $distancia = floatval($_POST['distancia'] ?? 0);
    $pessoas = floatval($_POST['pessoas'] ?? 1);

    // Fatores de emissão (kg CO₂/unidade)
    $fatores = [
        'energia' => 0.233, // kg CO₂ por kWh
        'gas' => 1.9, // kg CO₂ por m³
        'combustivel' => 2.3, // kg CO₂ por litro
        'transporte' => [
            'carro' => 0.2, // kg CO₂ por km
            'moto' => 0.1,
            'publico' => 0.05,
            'bicicleta' => 0
        ]
    ];

    // Cálculos
    $emissaoEnergia = $energia * $fatores['energia'];
    $emissaoGas = $gas * $fatores['gas'];
    $emissaoCombustivel = $combustivel * $fatores['combustivel'];
    $emissaoTransporte = $distancia * ($fatores['transporte'][$transporte] ?? 0);

    $totalMensal = ($emissaoEnergia + $emissaoGas + $emissaoCombustivel + $emissaoTransporte) / $pessoas;
    $totalAnual = $totalMensal * 12;

    // Classificação
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

    // Comparações
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
}

include 'cabecalho.php';
?>

<main>
    <section id="inicio" class="introducao">
        <div class="container">
            <h1>Bem-vindo à Calculadora Ambiental</h1>
            <p>Uma ferramenta para avaliares e reduzires a tua Pegada Ecológica</p>

            <a href="#calculadora" class="cta-button">Calcular a minha Pegada</a>

            <div class="intro-content">
                <div class="intro-section">
                    <h2>O que é a Pegada de Carbono?</h2>
                    <p>A Pegada de Carbono representa a quantidade total de gases com efeito de estufa emitidos direta
                        ou indiretamente pelas nossas atividades diárias. É medida em quilogramas de CO₂ equivalente
                        (CO₂e) e inclui as emissões associadas à energia, aos transportes, à alimentação e ao consumo.

                        Esta pegada abrange:

                        Emissões diretas: como a queima de combustíveis fósseis (ex.: no carro ou no aquecimento de
                        edifícios);

                        Emissões indiretas: como o uso de eletricidade gerada a partir de fontes não renováveis.

                        Embora a unidade utilizada seja o CO₂, a pegada inclui também outros gases como o metano, o
                        óxido nitroso e os CFCs, que têm um elevado potencial de aquecimento global.

                        Uma pegada menor representa um contributo mais positivo para a desaceleração das alterações
                        climáticas.
                    </p>
                </div>

                <div class="intro-section">
                    <h2>Métodos de cálculo</h2>
                    <p> A Pegada de Carbono é estimada com base em dados como o consumo de combustíveis fósseis, a
                        produção industrial, a utilização do solo e a criação de animais, considerando também os
                        sumidouros de carbono (ex.: árvores plantadas). Pode ser ajustada ao nível de detalhe
                        necessário.
                    </p>
                </div>

                <div class="intro-section">
                    <h2> Impacto Ambiental</h2>
                    <p> O aumento do CO₂ intensifica o efeito de estufa e eleva as temperaturas globais, provocando
                        fenómenos climáticos extremos. Os acordos internacionais procuram limitar o aquecimento a
                        1,5–2 °C para evitar consequências graves, como o derretimento dos polos, a acidificação dos
                        oceanos e crises alimentares.
                    </p>
                </div>

                <div class="intro-section">
                    <h2> Setores com a maior Pegada</h2>
                    <p> O setor energético é o maior emissor, seguido pela indústria, pelos transportes e pela
                        construção. O crescimento das energias renováveis contribui para a redução das emissões. Alguns
                        setores industriais, como o do aço e o do cimento, são mais difíceis de descarbonizar, mas o
                        hidrogénio verde surge como uma alternativa promissora.
                    </p>
                </div>
                <div class="intro-section">
                    <h2> Iniciativas globais</h2>
                    <p> Compreender e reduzir a nossa Pegada de Carbono é essencial para combater as alterações
                        climáticas e
                        preservar o planeta para as gerações futuras.
                        O Acordo de Paris, assinado pelas Nações Unidas a 12 de Dezembro de 2015, é a referência
                        fundamental para
                        todas as políticas globais de redução de emissões. Propõe, em particular, manter o aumento da
                        temperatura
                        média global abaixo dos 2 °C em comparação com os níveis pré-industriais, fazendo todos os
                        esforços para
                        limitá-lo a 1,5 °C; aumentar a capacidade de adaptação aos efeitos adversos das alterações
                        climáticas e
                        promover a resiliência climática; e garantir o financiamento necessário para um desenvolvimento
                        com baixas
                        emissões e favorável ao clima.

                        É do Acordo de Paris que derivam as políticas à escala continental ou nacional, como o Pacto
                        Ecológico
                        Europeu, que visa alcançar a neutralidade carbónica na Europa até 2050 (ou seja, um equilíbrio
                        nulo entre o
                        CO₂ emitido e absorvido).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'calculadora.php'; ?>

    <?php include 'dicas.php'; ?>

    <?php include 'sobre.php'; ?>

    <?php include 'contactos.php'; ?>

</main>

<?php include 'rodape.php'; ?>