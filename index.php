<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <title>EcoCalculadora - Pegada de Carbono</title>
	
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
        
        // Fatores de emissão (kg CO2/unidade)
        $fatores = [
            'energia' => 0.233, // kg CO2 por kWh
            'gas' => 1.9, // kg CO2 por m³
            'combustivel' => 2.3, // kg CO2 por litro
            'transporte' => [
                'carro' => 0.2, // kg CO2 por km
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
            <div class="logo">EcoCalculadora</div>
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
                <h1>Bem-vindo à EcoCalculadora</h1>
                <p>A sua ferramenta para medir e reduzir o impacto ambiental</p>
                
                <div class="intro-content">
                    <div class="intro-section">
                        <h2>O que é a Pegada de Carbono?</h2>
                        <p>A pegada de carbono é a quantidade total de gases de efeito estufa produzidos direta e indiretamente pelas suas atividades diárias. É medida em quilogramas de dióxido de carbono equivalente (CO2e) e inclui emissões de energia, transporte, alimentação e consumo em geral.</p>
                    </div>
                    
                    <div class="stats-grid">
                        <div class="stat-card">
                            <span class="stat-icon">🌍</span>
                            <h3>Pegada Global</h3>
                            <p>A pegada média mundial é de <strong>4,8 toneladas</strong> de CO2 por pessoa por ano</p>
                        </div>
                        
                        <div class="stat-card">
                            <span class="stat-icon">🎯</span>
                            <h3>Meta Ideal</h3>
                            <p>Para combater as alterações climáticas, devemos reduzir para <strong>2,3 toneladas</strong> por pessoa</p>
                        </div>
                        
                        <div class="stat-card">
                            <span class="stat-icon">🇵🇹</span>
                            <h3>Portugal</h3>
                            <p>A pegada média em Portugal é de aproximadamente <strong>5,4 toneladas</strong> de CO2 por pessoa</p>
                        </div>
                        
                        <div class="stat-card">
                            <span class="stat-icon">⚡</span>
                            <h3>Principais Fontes</h3>
                            <p><strong>Energia (25%)</strong>, Transporte (14%), Agricultura (24%), Indústria (21%)</p>
                        </div>
                    </div>
                    
                    <div class="intro-section">
                        <h2>Por que é Importante Calcular?</h2>
                        <div class="importance-grid">
                            <div class="importance-item">
                                <span class="importance-icon">🔍</span>
                                <h4>Consciencialização</h4>
                                <p>Compreender o seu impacto real no ambiente e identificar áreas de melhoria</p>
                            </div>
                            
                            <div class="importance-item">
                                <span class="importance-icon">📊</span>
                                <h4>Monitorização</h4>
                                <p>Acompanhar o progresso das suas ações sustentáveis ao longo do tempo</p>
                            </div>
                            
                            <div class="importance-item">
                                <span class="importance-icon">💡</span>
                                <h4>Ação Direcionada</h4>
                                <p>Focar os esforços nas atividades que mais contribuem para as suas emissões</p>
                            </div>
                            
                            <div class="importance-item">
                                <span class="importance-icon">🌱</span>
                                <h4>Futuro Sustentável</h4>
                                <p>Contribuir ativamente para um planeta mais saudável para as próximas gerações</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <a href="#calculadora" class="cta-button">Calcular Minha Pegada de Carbono</a>
            </div>
        </section>

        <section id="calculadora" class="section">
            <div class="container">
                <h2>Calculadora de Pegada de Carbono</h2>
                <p style="text-align: center; margin-bottom: 2rem; color: #666;">Preencha os campos abaixo com os seus dados mensais para calcular a sua pegada de carbono anual</p>
                
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
                                    <option value="moto" <?= ($_POST['transporte'] ?? '') === 'moto' ? 'selected' : '' ?>>Motocicleta</option>
                                    <option value="publico" <?= ($_POST['transporte'] ?? '') === 'publico' ? 'selected' : '' ?>>Transporte Público</option>
                                    <option value="bicicleta" <?= ($_POST['transporte'] ?? '') === 'bicicleta' ? 'selected' : '' ?>>Bicicleta/Caminhada</option>
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
                                <label for="pessoas">Número de pessoas na residência</label>
                                <input type="number" id="pessoas" name="pessoas" placeholder="Ex: 3" min="1"
                                       value="<?= htmlspecialchars($_POST['pessoas'] ?? '') ?>" required>
                            </div>
                        </div>

                        <button type="submit" class="calculate-btn">Calcular Pegada de Carbono</button>
                    </form>

                    <?php if ($resultado): ?>
                    <div class="result">
                        <h3>Sua Pegada de Carbono</h3>
                        <div class="value"><?= number_format($resultado['total'], 1) ?> kg CO2/ano</div>
                        
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
                                Parabéns! Você está no caminho certo para um futuro sustentável.
                            <?php elseif ($resultado['total'] <= 4000): ?>
                                Bom trabalho! Com pequenos ajustes você pode melhorar ainda mais.
                            <?php elseif ($resultado['total'] <= 6000): ?>
                                Há várias oportunidades para reduzir sua pegada de carbono.
                            <?php else: ?>
                                Considere implementar mudanças significativas em seus hábitos.
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section id="dicas" class="section">
            <div class="container">
                <h2>Dicas para Reduzir sua Pegada de Carbono</h2>
                <div class="tips">
                    <div class="tip-card">
                        <span class="icon">💡</span>
                        <h3>Energia Eficiente</h3>
                        <p>Substitua lâmpadas incandescentes por LED, desligue aparelhos da tomada quando não estiver usando e invista em eletrodomésticos eficientes.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">🚲</span>
                        <h3>Transporte Sustentável</h3>
                        <p>Use transporte público, bicicleta ou caminhe para distâncias curtas. Considere carros elétricos ou híbridos para longas distâncias.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">♻️</span>
                        <h3>Reciclagem</h3>
                        <p>Separe corretamente o lixo, reutilize materiais sempre que possível e prefira produtos com embalagens recicláveis.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">🌱</span>
                        <h3>Consumo Consciente</h3>
                        <p>Compre produtos locais, reduza o consumo de carne, evite desperdício de alimentos e escolha produtos sustentáveis.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">🏠</span>
                        <h3>Casa Sustentável</h3>
                        <p>Melhore o isolamento térmico, use aquecimento solar para água quente e considere energia renovável como painéis solares.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">💧</span>
                        <h3>Economia de Água</h3>
                        <p>Tome banhos mais curtos, conserte vazamentos rapidamente e colete água da chuva para regar plantas.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="sobre" class="section">
            <div class="container">
                <h2>Sobre a Pegada de Carbono</h2>
                <p style="text-align: center; font-size: 1.1rem; line-height: 1.8; max-width: 800px; margin: 0 auto;">
                    A pegada de carbono é a quantidade total de gases de efeito estufa produzidos direta e indiretamente pelas atividades humanas. É medida em toneladas de dióxido de carbono equivalente (CO2e). Compreender e reduzir nossa pegada de carbono é essencial para combater as mudanças climáticas e preservar o planeta para as futuras gerações.
                </p>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 EcoCalculadora. Todos os direitos reservados. | Juntos por um planeta mais sustentável! 🌍</p>
        </div>
    </footer>
</body>
</html>