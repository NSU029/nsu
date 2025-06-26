<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Calculadora da tua Pegada Ecológica - Pegada de Carbono</title>

    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
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
            $classe = "Alta. Considere mudanças significativas ⚠️";
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
    ?>

    <header>
        <nav class="container">
            <div class="logo">Calculadora da tua Pegada Ecológica</div>
            <ul class="nav-links">
                <li><a href="#inicio">Início</a></li>
                <li><a href="#calculadora">Calculadora</a></li>
                <li><a href="#dicas">Dicas</a></li>
                <li><a href="#sobre">Sobre</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="inicio" class="hero">
            <div class="container">
                <h1>Bem-vindo à Calculadora da tua Pegada Ecológica</h1>
                <p>Uma ferramenta para avaliar e reduzir o teu impacto ambiental</p>

                <div class="intro-content">
                    <div class="intro-section">
                        <h2>O que é a Pegada de Carbono?</h2>
                        <p>A Pegada de Carbono representa a quantidade total de gases com efeito de estufa emitidos
                            direta ou indiretamente pelas nossas atividades diárias. É medida em quilogramas de CO₂
                            equivalente (CO₂e) e inclui emissões associadas à energia, transporte, alimentação e
                            consumo.

                            Esta pegada abrange:

                            Emissões diretas: como a queima de combustíveis fósseis (ex: no carro ou no aquecimento de
                            edifícios) e Emissões indiretas: como o uso de eletricidade gerada a partir de fontes não renováveis.

                            Embora a unidade usada seja o CO₂, a pegada inclui também outros gases como o metano, o
                            óxido nitroso e os CFCs, que têm elevado potencial de aquecimento global.

                            Uma pegada menor significa uma contribuição mais positiva para a desaceleração das
                            alterações climáticas.
                        </p>
                    </div>

                    <div class="intro-section">
                        <h2>Pegada de Carbono e Pegada Ecológica</h2>
                        <p> Na literatura científica sobre sustentabilidade, o conceito de Pegada de Carbono foi
                            precedido
                            pelo de Pegada Ecológica, introduzido no início da década de 1990 pelos ecologistas William
                            Rees
                            e Mathis Wackernagel. Esse conceito está mais próximo do que entendemos na linguagem
                            cotidiana
                            como "pegada", ou seja, uma porção de terra na qual uma marca visível é impressa. A pegada
                            ecológica é, na verdade, a área total de terra (ou mar) necessária para sustentar uma
                            população
                            e, portanto, seu cálculo também considera a água consumida e a terra usada para plantações e
                            criação de animais.

                            Quando o aquecimento global e as emissões de CO₂ se tornaram o foco dos estudos de
                            sustentabilidade ambiental, a medida da Pegada Ecológica caiu em desuso em comparação com a
                            Pegada de Carbono, que se tornou uma ferramenta fundamental para monitorar a conformidade
                            com os
                            acordos internacionais de redução de emissões.
                        </p>
                    </div>

                    <div class="intro-section">
                        <h2>Métodos de cálculo</h2>
                        <p> Não existe um método único para calcular a Pegada de Carbono, pois envolve diversos factores
                            e diferentes escalas. Normalmente, a pegada é estimada, com base em orientações
                            internacionais, como as do IPCC (Painel Intergovernamental sobre Alterações Climáticas da
                            ONU).

                            Essas orientações utilizam indicadores estatísticos e económicos (ex.: consumo de
                            combustíveis fósseis, produção industrial, uso do solo, número de animais criados) para
                            calcular as emissões de gases com efeito de estufa, expressas em CO₂e (equivalente de
                            dióxido de carbono).

                            É igualmente importante considerar os sumidouros de carbono, como árvores plantadas, que
                            reduzem o total de emissões.

                            A Pegada de Carbono pode ser ajustada ao nível de detalhe necessário, devendo também ter em
                            conta o impacto comparativo. Por exemplo, uma obra como uma ponte pode gerar emissões, mas
                            reduzir outras no futuro, resultando numa pegada líquida menor ou até negativa.
                        </p>
                    </div>

                    <div class="intro-section">
                        <h2> O impacto da Pegada de Carbono no meio ambiente</h2>
                        <p> O esforço para calcular e reduzir a Pegada de Carbono deve-se ao facto de que cada
                            quilograma adicional de CO₂ na atmosfera agrava o efeito de estufa, retendo o calor solar e
                            provocando o aumento das temperaturas médias globais.

                            Segundo o IPCC, entre 2011 e 2020, a temperatura média da Terra foi 1,09 °C superior à da
                            era pré-industrial, continuando a subir cerca de 0,2 °C por década. Este aquecimento já está
                            a causar eventos climáticos extremos com mais frequência, como inundações, secas, ondas de
                            calor e chuvas intensas.

                            Os actuais compromissos internacionais procuram limitar o aquecimento global a entre 1,5 e
                            2 °C. Ultrapassar esse limite pode provocar impactos irreversíveis, como o derretimento das
                            calotes polares, acidificação dos oceanos, colapso dos recifes de corais, perda de
                            biodiversidade marinha, recuo das geleiras e desertificação.

                            As consequências para os seres humanos incluem crises alimentares, devido à quebra na
                            produção de culturas como trigo, arroz e milho, e o aumento da propagação de doenças
                            infecciosas, favorecidas por climas mais quentes.
                        </p>
                    </div>

                    <div class="intro-section">
                        <h2> Setores com a maior Pegada de Carbono</h2>
                        <p> Num mundo ainda fortemente dependente de combustíveis fósseis, o sector da energia continua
                            a ser o principal responsável pelas emissões de gases com efeito de estufa. Em 2022, segundo
                            a Agência Internacional de Energia, a produção de energia emitiu cerca de 15 gigatoneladas
                            de CO₂, seguida pela indústria (9 Gt), transportes (8 Gt) e construção (5 Gt).

                            Apesar destes valores, há sinais positivos: o crescimento das energias renováveis evitou
                            cerca de 600 megatoneladas de CO₂ entre 2021 e 2022. O mesmo se verifica nos transportes,
                            com o aumento dos veículos eléctricos e a melhoria na eficiência dos carros a combustão.

                            Na indústria, os sectores mais difíceis de descarbonizar – como a produção de aço, cimento e
                            petroquímicos – representam cerca de 30% das emissões globais, devido à sua elevada
                            necessidade energética. Nestes casos, soluções como o hidrogénio verde, produzido com
                            energia renovável, podem ser uma alternativa viável aos combustíveis fósseis, especialmente
                            em contextos industriais.
                        </p>
                    </div>
                </div>

                <a href="#calculadora" class="cta-button">Calcular a minha Pegada de Carbono</a>
            </div>
        </section>

        <section id="calculadora" class="section">
            <div class="container">
                <h2>Calculadora da tua Pegada de Carbono</h2>
                <p style="text-align: center; margin-bottom: 2rem; color: #666;">Preencha os campos seguintes com os
                    seus
                    dados mensais para calcular a tua Pegada de Carbono anual</p>

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
                                    <option value="carro" <?= ($_POST['transporte'] ?? '') === 'carro' ? 'selected' : '' ?>>Carro</option>
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
                        <p>Substitua lâmpadas incandescentes por LED, desligue aparelhos da tomada quando não estiver
                            usando e invista em eletrodomésticos eficientes.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">🚲</span>
                        <h3>Transporte Sustentável</h3>
                        <p>Use transporte público, bicicleta ou caminhe para distâncias curtas. Considere carros
                            elétricos ou híbridos para longas distâncias.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">♻️</span>
                        <h3>Reciclagem</h3>
                        <p>Separe corretamente o lixo, reutilize materiais sempre que possível e prefira produtos com
                            embalagens recicláveis.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">🌱</span>
                        <h3>Consumo Consciente</h3>
                        <p>Prefira produtos locais, reduza o consumo de carne, evite o desperdício de alimentos e
                            escolha
                            produtos sustentáveis.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">🏠</span>
                        <h3>Casa Sustentável</h3>
                        <p>Melhore o isolamento térmico, use aquecimento solar para água quente e considere energia
                            renovável como painéis solares.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">💧</span>
                        <h3>Economia de Água</h3>
                        <p>Tome banhos mais curtos, conserte vazamentos rapidamente e colete água da chuva para regar
                            plantas.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="sobre" class="section">
            <div class="container">
                <h2>Sobre a Pegada de Carbono</h2>
                <p style="text-align: center; font-size: 1.1rem; line-height: 1.8; max-width: 800px; margin: 0 auto;">
                    Compreender e reduzir nossa Pegada de Carbono é essencial para combater as mudanças climáticas e
                    preservar o planeta para as futuras gerações.
                    O Acordo de Paris, assinado pelas Nações Unidas em 12 de dezembro de 2015, é a referência
                            fundamental para todas as políticas globais de redução de emissões. Ele propõe, em
                            particular, manter o aumento da temperatura média global abaixo de 2 °C em comparação com os níveis
                            pré-industriais, fazendo todo o possível para limitá-lo a 1,5 °C; aumentar a capacidade de
                            adaptação aos efeitos adversos das mudanças climáticas e promover a resiliência climática; e
                            garantir o financiamento necessário para um desenvolvimento de baixa emissão e favorável ao
                            clima.

                            É do Acordo de Paris que derivam as políticas em escala continental ou nacional, como o
                            Acordo Verde Europeu, que visa alcançar a neutralidade climática na Europa até 2050 (ou seja, um
                            equilíbrio zero entre o CO₂ emitido e absorvido); ou o recente plano Build Back Better nos
                            Estados Unidos, que estabelece metas ambiciosas para a produção de energia renovável,
                            eficiência energética em edifícios e eletrificação da frota de automóveis.
                </p>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Calculadora da tua Pegada Ecológica. | Juntos por um planeta mais sustentável, pois chama-me
                meio-ambiente por
                algum motivo! 🌍</p>
        </div>
    </footer>
</body>

</html>