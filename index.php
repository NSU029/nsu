<?php
$resultado = null;
$totalAnual = 0;

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

// Incluir o cabeçalho
include 'cabecalho.php';
?>

<main>
    <section id="inicio" class="introducao">
        <div class="container">
            <h1>Bem-vindo à Calculadora da tua Pegada Ecológica</h1>
            <p>Uma ferramenta para avaliar e reduzir o teu impacto ambiental</p>

            <a href="#calculadora" class="cta-button">Calcular a minha Pegada de Carbono</a>

            <div class="intro-content">
                <div class="intro-section">
                    <h2>O que é a Pegada de Carbono?</h2>
                    <p>A Pegada de Carbono representa a quantidade total de gases com efeito de estufa emitidos
                        direta ou indiretamente pelas nossas atividades diárias. É medida em quilogramas de CO₂
                        equivalente (CO₂e) e inclui emissões associadas à energia, transporte, alimentação e
                        consumo.

                        Esta pegada abrange:

                        Emissões diretas: como a queima de combustíveis fósseis (ex: no carro ou no aquecimento de
                        edifícios) e Emissões indiretas: como o uso de eletricidade gerada a partir de fontes não
                        renováveis.

                        Embora a unidade usada seja o CO₂, a pegada inclui também outros gases como o metano, o
                        óxido nitroso e os CFCs, que têm elevado potencial de aquecimento global.

                        Uma pegada menor significa uma contribuição mais positiva para a desaceleração das
                        alterações climáticas.
                    </p>
                </div>

                <div class="intro-section">
                    <h2>Métodos de cálculo</h2>
                    <p> A Pegada de Carbono é estimada com base em dados como consumo de combustíveis fósseis,
                        produção industrial, uso do solo e criação de animais, considerando também sumidouros de
                        carbono (ex: árvores plantadas). Pode ser ajustada ao nível de detalhe necessário.
                    </p>
                </div>

                <div class="intro-section">
                    <h2> Impacto Ambiental</h2>
                    <p> O aumento de CO₂ intensifica o efeito de estufa e eleva as temperaturas globais, provocando
                        eventos climáticos extremos. Os acordos internacionais tentam limitar o aquecimento a
                        1,5–2 °C para evitar consequências graves como derretimento polar, acidificação dos oceanos
                        e crises alimentares.
                    </p>
                </div>

                <div class="intro-section">
                    <h2> Setores com a maior Pegada</h2>
                    <p> O setor energético é o maior emissor, seguido pela indústria, transportes e construção. O
                        crescimento das energias renováveis ajuda a reduzir emissões. Alguns setores industriais,
                        como aço e cimento, são mais difíceis de descarbonizar, mas o hidrogénio verde surge como
                        alternativa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="calculadora" class="section">
        <div class="container">
            <h2>Calculadora da tua Pegada de Carbono</h2>
            <p class="calculator-intro">
                Preencha os campos seguintes com os seus dados mensais para calcular a tua Pegada de Carbono anual
            </p>

            <div class="calculator">
                <form method="POST" action="#calculadora">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="energia">Consumo de Energia Elétrica (kWh/mês)</label>
                            <input type="number" id="energia" name="energia" placeholder="Ex: 250"
                                value="<?= htmlspecialchars($_POST['energia'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="gas">Consumo de Gás (m³/mês)</label>
                            <input type="number" id="gas" name="gas" placeholder="Ex: 15"
                                value="<?= htmlspecialchars($_POST['gas'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="combustivel">Consumo de Combustível (litros/mês)</label>
                            <input type="number" id="combustivel" name="combustivel" placeholder="Ex: 80"
                                value="<?= htmlspecialchars($_POST['combustivel'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="transporte">Tipo de Transporte Principal</label>
                            <select id="transporte" name="transporte" required>
                                <option value="">Selecione...</option>
                                <option value="carro" <?= ($_POST['transporte'] ?? '') === 'carro' ? 'selected' : '' ?>>
                                    Carro</option>
                                <option value="moto" <?= ($_POST['transporte'] ?? '') === 'moto' ? 'selected' : '' ?>>
                                    Moto</option>
                                <option value="publico" <?= ($_POST['transporte'] ?? '') === 'publico' ? 'selected' : '' ?>>Transporte Público</option>
                                <option value="bicicleta" <?= ($_POST['transporte'] ?? '') === 'bicicleta' ? 'selected' : '' ?>>Bicicleta / Caminhada</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="distancia">Distância percorrida por mês (km)</label>
                            <input type="number" id="distancia" name="distancia" placeholder="Ex: 1000"
                                value="<?= htmlspecialchars($_POST['distancia'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pessoas">Número de pessoas na tua casa</label>
                            <input type="number" id="pessoas" name="pessoas" placeholder="Ex: 3" min="1"
                                value="<?= htmlspecialchars($_POST['pessoas'] ?? '') ?>" required>
                        </div>
                    </div>

                    <button type="submit" class="calculate-btn">Calcular Pegada de Carbono</button>
                </form>

                <?php if ($resultado): ?>
                    <div class="result">
                        <h3>A tua Pegada de Carbono</h3>
                        <div class="value"><?= number_format($resultado['total'], 1) ?> kg CO₂/ano</div>

                        <div class="progress-container">
                            <div class="progress-bar <?= $resultado['progressClass'] ?>">
                                <?= $resultado['progressClass'] === 'progress-20' ? '20%' :
                                    ($resultado['progressClass'] === 'progress-40' ? '40%' :
                                        ($resultado['progressClass'] === 'progress-60' ? '60%' :
                                            ($resultado['progressClass'] === 'progress-80' ? '80%' : '100%'))) ?>
                            </div>
                        </div>

                        <div class="classification <?= $resultado['classeCss'] ?>">
                            <?= $resultado['classe'] ?>
                        </div>

                        <div class="comparison">
                            <div class="comparison-item">
                                <span class="icon">🌳</span>
                                <div>Árvores necessárias</div>
                                <strong><?= $resultado['arvores'] ?></strong>
                            </div>
                            <div class="comparison-item">
                                <span class="icon">🚗</span>
                                <div>Km de carro</div>
                                <strong><?= number_format($resultado['kmCarro']) ?></strong>
                            </div>
                            <div class="comparison-item">
                                <span class="icon">⚡</span>
                                <div>Lâmpadas 60W (horas)</div>
                                <strong><?= number_format($resultado['lampadas']) ?></strong>
                            </div>
                        </div>

                        <div class="alert <?= $resultado['alertClass'] ?>">
                            <?php if ($resultado['total'] <= 2000): ?>
                                Parabéns! Estás no caminho certo para um futuro sustentável.
                            <?php elseif ($resultado['total'] <= 4000): ?>
                                Bom trabalho! Com pequenos ajustes poderás melhorar ainda mais.
                            <?php elseif ($resultado['total'] <= 6000): ?>
                                Há várias oportunidades para reduzir a tua Pegada de Carbono.
                            <?php else: ?>
                                Considera implementar mudanças significativas nos teus hábitos.
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="dicas" class="section">
        <div class="container">
            <h2>Dicas para reduzir a tua Pegada de Carbono</h2>
            <div class="tips">
                <div class="tip-card">
                    <span class="icon">💡</span>
                    <h3>Energia Eficiente</h3>
                    <p>Substitui lâmpadas incandescentes por LED, desliga aparelhos da tomada quando não estiveres
                        a usar e investe em eletrodomésticos eficientes.</p>
                </div>

                <div class="tip-card">
                    <span class="icon">🚲</span>
                    <h3>Transporte Sustentável</h3>
                    <p>Usa transporte público, bicicleta ou caminha para distâncias curtas. </p>
                </div>

                <div class="tip-card">
                    <span class="icon">♻️</span>
                    <h3>Reciclagem</h3>
                    <p>Separa corretamente o lixo, reutiliza materiais sempre que possível e tenta utilizar produtos
                        com
                        embalagens recicláveis.</p>
                </div>

                <div class="tip-card">
                    <span class="icon">🌱</span>
                    <h3>Consumo Consciente</h3>
                    <p>Opta por produtos locais, reduz o consumo de carne, evita o desperdício de alimentos e
                        escolhe produtos sustentáveis.</p>
                </div>

                <div class="tip-card">
                    <span class="icon">🏠</span>
                    <h3>Casa Sustentável</h3>
                    <p>Melhora o isolamento térmico, usa aquecimento solar para água quente e considera energia
                        renovável como painéis solares.</p>
                </div>

                <div class="tip-card">
                    <span class="icon">💧</span>
                    <h3>Economia de Água</h3>
                    <p>Toma banhos mais curtos, conserta vazamentos rapidamente e coleta água da chuva para regar
                        plantas.</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'sobre.php'; ?>

    <?php include 'contactos.php'; ?>

</main>

<?php include 'rodape.php'; ?>