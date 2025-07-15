<?php
$seccaoAtual = $_GET['p'] ?? 'calculadora';
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Calculadora Ambiental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="css/estilos.css">

    <style>
        body {background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; line-height: 1.6; color: #333;}
        .inicio {margin-top: 5rem; padding: 3rem 0;}
        .inicio p {font-size: 1rem; margin-bottom: 1.5rem;}
        .navbar-custom {background: rgba(255, 255, 255, 0.95) !important; backdrop-filter: blur(10px); box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 0.5rem 0;}
        .navbar-brand {font-size: 1.8rem;font-weight: bold; color: #2d5a27 !important; text-decoration: none; transition: transform 0.3s ease;}
        .navbar-brand:hover {transform: scale(1.1) translateX(8px);}    
        .navbar-nav .nav-link {position: relative; display: inline-block; color: #333 !important; font-weight: 500; margin-left: 1rem; 
        padding: 0.5rem 1rem !important; text-decoration: none; transition: color 0.3s ease, transform 0.3s ease; }
        .navbar-nav .nav-link::after {content: ""; position: absolute; bottom: 0; left: 0; height: 2px; width: 0; background-color: currentColor; transition: width 0.3s ease;}
        .navbar-nav .nav-link:hover { transform: scale(1.1);}
        .navbar-nav .nav-link:hover::after, .navbar-nav .nav-link.active::after {width: 100%;}
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active {color: #2d5a27 !important;}
        .navbar-toggler {border: none; padding: 0.2rem 0.4rem;}
        .navbar-toggler:focus { box-shadow: none;}
        .progress-container { display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;}
        footer {background: rgba(45, 90, 39, 0.9); color: white; text-align: center; padding: 1.5rem 0;}
        #inicio, #calculadora, #dicas { scroll-margin-top: 100px;}
        #contacts { scroll-margin-top: 150px;}
        .sobre-section table th,
        .sobre-section table td {
            text-transform: none;
            text-align: center;
            vertical-align: middle;
            padding: 8px;
        }
        .sobre-section { padding: 1.2rem; margin: 1.5rem 0;}
        .scroll-to-results { animation: scrollIndicator 0.5s ease-in-out;}
        
        @keyframes scrollIndicator {
            0% { 
                transform: translateY(-20px); 
                opacity: 0; 
            }
            100% { 
                transform: translateY(0); 
                opacity: 1; 
            }
        }
        
        .result:target,
        .result-highlight {
            animation: highlight 2s ease-in-out;
            scroll-margin-top: 100px;
        }
        
        @keyframes highlight {
            0% { 
                background-color: rgba(45, 90, 39, 0.1);
                transform: scale(1.02);
            }
            50% { 
                background-color: rgba(45, 90, 39, 0.05);
            }
            100% { 
                background-color: transparent;
                transform: scale(1);
            }
        }
        
        /* Mobile up to 480px */
        @media (max-width: 480px) {
            .container {padding: 0 8px;}
            .navbar-brand {font-size: 1.13rem;}
            .inicio h1 {font-size: 2rem; padding-bottom: 0.5rem}
            .calculator {padding: 1.2rem; margin: 1.5rem 0;}
            .tips, .comparison {grid-template-columns: 1fr; gap: 1rem;}
            .comparison-item {margin: 0.5rem 0rem;}
            .section h2 {font-size: 1.3rem;}
            .result h3 {font-size: 1.5rem;}
            .result .value {font-size: 2rem;}
            .form-row {grid-template-columns: 1fr; gap: 0.8rem;}
            .form-group {margin-bottom: 1rem;}
            .form-group input, .form-group select {padding: 0.6rem; font-size: 0.95rem;}
            .contact-form input::placeholder {font-size: 0.8rem;}
            .sobre-section h2 {font-size: 0.89em;}
            .sobre-section p {
                font-size: 0.9rem;
                line-height: 1.7;
            }
            .transport-table th:nth-child(2),
            .transport-table td:nth-child(2),
            .transport-table th:nth-child(3),
            .transport-table td:nth-child(3),
            .transport-table th:nth-child(4),
            .transport-table td:nth-child(4),
            .energy-table th:nth-child(2),
            .energy-table td:nth-child(2),
            .energy-table th:nth-child(3),
            .energy-table td:nth-child(3),
            .energy-table th:nth-child(4),
            .energy-table td:nth-child(4),
            .energy-table th:nth-child(5),
            .energy-table td:nth-child(5),
            .tips-table th:nth-child(2),
            .tips-table td:nth-child(2),
            .tips-table th:nth-child(4),
            .tips-table td:nth-child(4),
            .tips-table th:nth-child(5),
            .tips-table td:nth-child(5) {
                display: none;
            }
            footer {font-size: 0.8rem; padding: 1.5rem 0;}
          
        }

        /* Mobile 481px - 768px */
        @media (min-width: 481px) and (max-width: 768px) {
            .navbar-brand {font-size: 1.5rem;}
            .inicio h1 {font-size: 2rem; padding-bottom: 0.5rem}
            .comparison-item {margin: 0.5rem 0rem;}
            .comparison-item .icon {font-size: 1.7rem;}
            .contact-form input::placeholder {font-size: 0.9rem;}
            .sobre-section h2 {font-size: 1.4rem;}
            .sobre-section p {
                font-size: 0.95rem;
                line-height: 1.7;
            }
            .transport-table th:nth-child(3),
            .transport-table td:nth-child(3),
            .transport-table th:nth-child(4),
            .transport-table td:nth-child(4),
            .energy-table th:nth-child(2),
            .energy-table td:nth-child(2),
            .energy-table th:nth-child(3),
            .energy-table td:nth-child(3),
            .energy-table th:nth-child(5),
            .energy-table td:nth-child(5),
            .tips-table th:nth-child(4),
            .tips-table td:nth-child(4),
            .tips-table th:nth-child(5),
            .tips-table td:nth-child(5) {
                display: none;
            }
        }

        /* Tablets 769px - 1024px */
        @media (min-width: 769px) and (max-width: 1024px) {
            .comparison-item {padding: 0.8rem;}
            .comparison-item .icon {font-size: 1.7rem;}
            .sobre-section h2 {font-size: 1.7rem;}
            .sobre-section p {
                font-size: 1rem;
                line-height: 1.7;
            }
            .transport-table th:nth-child(4),
            .transport-table td:nth-child(4),
            .energy-table th:nth-child(2),
            .energy-table td:nth-child(2),
            .energy-table th:nth-child(3),
            .energy-table td:nth-child(3),
            .tips-table th:nth-child(4),
            .tips-table td:nth-child(4) {
                display: none;
            }
        }

        /* Just below 319px */
        @media (max-width: 319px) {
            .navbar-brand {font-size: 0.8rem;}
            .inicio h1 {font-size: 2rem; padding-bottom: 0.5rem}
            .contact-form input::placeholder {font-size: 0.7rem;}
            ul.social {gap: 0;}
            footer {font-size: 0.7rem; padding: 1.5rem 0;}
        }

        @media (max-width: 768px) {
        .video-container iframe {
            width: 100%;
            height: 315px;
        }
}
    </style>

</head>

<body class="d-flex flex-column h-100">

    <!-- NAVBAR BOOTSTRAP -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <!-- LOGO -->
            <a class="navbar-brand" href="index.php">
                🌱 Calculadora Ambiental
            </a>

            <!-- BOTÃO HAMBÚRGUER PARA MOBILE -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- LINKS DE NAVEGAÇÃO -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($seccaoAtual == 'dicas') ? 'active' : ''; ?>"
                            href="?p=dicas">Dicas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($seccaoAtual == 'contactos') ? 'active' : ''; ?>"
                            href="?p=contactos">Contactos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($seccaoAtual == 'sobre') ? 'active' : ''; ?>"
                            href="?p=sobre">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link align-items-center" href="index-en.php" title="English">
                            <span class="me-2">English</span>
                            <img src="https://flagcdn.com/gb.svg" alt="English" width="24" height="16"
                                class="d-inline-block align-middle">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                    
                <!-- SECÇÃO CALCULADORA -->
                <section id="calculadora" class="section">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-10">
                                <h2>Calculadora</h2>
                                <p class="calculator-sobre">
                                    Preenche os campos seguintes com os seus dados mensais para calcular a tua Pegada de Carbono anual
                                </p>

                                <div class="calculator">
                                    <form method="POST" action="#calculadora">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="energia">Consumo de Eletricidade (kWh/mês)</label>
                                                    <input type="number" id="energia" name="energia" placeholder="Ex: 300"
                                                        value="<?= htmlspecialchars($_POST['energia'] ?? '') ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="gas">Consumo de Gás (m³/mês)</label>
                                                    <input type="number" id="gas" name="gas" placeholder="Ex: 60"
                                                        value="<?= htmlspecialchars($_POST['gas'] ?? '') ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="combustivel">Consumo de Combustível (litros/mês)</label>
                                                    <input type="number" id="combustivel" name="combustivel" placeholder="Ex: 80"
                                                        value="<?= htmlspecialchars($_POST['combustivel'] ?? '') ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="transporte">Principal Meio de Transporte</label>
                                                    <select id="transporte" name="transporte" required>
                                                        <option value="">Selecione...</option>
                                                        <option value="carro" <?= ($_POST['transporte'] ?? '') === 'carro' ? 'selected' : '' ?>>
                                                            Carro</option>
                                                        <option value="moto" <?= ($_POST['transporte'] ?? '') === 'moto' ? 'selected' : '' ?>>
                                                            Moto</option>
                                                        <option value="publico" <?= ($_POST['transporte'] ?? '') === 'publico' ? 'selected' : '' ?>>
                                                            Transporte Público</option>
                                                        <option value="bicicleta" <?= ($_POST['transporte'] ?? '') === 'bicicleta' ? 'selected' : '' ?>>
                                                            Bicicleta ou a Pé</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="distancia">Distância Percorrida por Mês (km)</label>
                                                    <input type="number" id="distancia" name="distancia" placeholder="Ex: 1250"
                                                        value="<?= htmlspecialchars($_POST['distancia'] ?? '') ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="pessoas">Agregado Familiar</label>
                                                    <input type="number" id="pessoas" name="pessoas" placeholder="Ex: 3" min="1"
                                                        value="<?= htmlspecialchars($_POST['pessoas'] ?? '') ?>" required>
                                                </div>
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
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <div class="comparison-item">
                                                            <span class="icon">🌳</span>
                                                            <div>Árvores necessárias</div>
                                                            <strong><?= $resultado['arvores'] ?></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="comparison-item">
                                                            <span class="icon">🚗</span>
                                                            <div>Km de carro</div>
                                                            <strong><?= number_format($resultado['kmCarro']) ?></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="comparison-item">
                                                            <span class="icon">💡</span>
                                                            <div>Lâmpada 60W (h)</div>
                                                            <strong><?= number_format($resultado['lampadas']) ?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="alert <?= $resultado['alertClass'] ?>">
                                                <?php if ($resultado['total'] <= 2000): ?>
                                                    Parabéns! Estás no caminho certo para um futuro sustentável.
                                                <?php elseif ($resultado['total'] <= 4000): ?>
                                                    Bom trabalho! Continua a melhorar para reduzir ainda mais a tua pegada.
                                                <?php elseif ($resultado['total'] <= 6000): ?>
                                                    Tenta reduzir o teu consumo de energia e transporte para diminuir a tua pegada.
                                                <?php elseif ($resultado['total'] <= 8000): ?>
                                                    Considera adotar energia renovável e métodos de viagem mais sustentáveis.
                                                <?php else: ?>
                                                    É necessária ação urgente. A tua pegada de carbono está muito alta.
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                </div>
            </section>

        <?php elseif ($seccao == 'dicas'): ?>
            <!-- SECÇÃO DICAS -->
            <section id="dicas" class="content-section">
                <div class="container">
                    
                    <section id="dicas" class="section">
                        <div class="container">
                            <h2>Dicas para Reduzir a Sua Pegada de Carbono</h2>
                            <div class="tips">
                                <div class="tip-card">
                                    <span class="icon">⚡</span>
                                    <h3>Energia Eficiente</h3>
                                    <p>Substitui as lâmpadas incandescentes por LED, desliga os aparelhos da tomada quando não
                                        estiveres a usá-los e investe em eletrodomésticos eficientes.</p>

                                </div>

                                <div class="tip-card">
                                    <span class="icon">🚲</span>
                                    <h3>Transporte Sustentável</h3>
                                    <p>Utiliza os transportes públicos, a bicicleta ou desloca-te a pé para distâncias curtas.</p>
                                </div>

                                <div class="tip-card">
                                    <span class="icon">♻️</span>
                                    <h3>Reciclagem</h3>
                                    <p>Separa corretamente o lixo, reutiliza materiais sempre que possível e dá preferência a
                                        produtos com embalagens recicláveis.</p>
                                </div>

                                <div class="tip-card">
                                    <span class="icon">🍎</span>
                                    <h3>Consumo Consciente</h3>
                                    <p>Opta por produtos locais, reduz o consumo de carne, evita o desperdício alimentar e
                                        privilegia produtos sustentáveis.</p>
                                </div>

                                <div class="tip-card">
                                    <span class="icon">🏠</span>
                                    <h3>Casa Sustentável</h3>
                                    <p>Melhora o isolamento térmico, utiliza aquecimento solar para a água quente e considera fontes
                                        de energia renovável, como painéis solares.</p>
                                </div>

                                <div class="tip-card">
                                    <span class="icon">💧</span>
                                    <h3>Poupança de Água</h3>
                                    <p>Toma banhos mais curtos, repara fugas rapidamente e recolhe água da chuva para regar as
                                        plantas.</p>
                                </div>

                            </div>
                        </div>
                    </section>

                </div>
            </section>

        <?php elseif ($seccao == 'contactos'): ?>
            <!-- SECÇÃO CONTACTOS -->
            <section id="contactos" class="content-section">
                <div class="container">

                    <section class="section">
                        <div class="container">
                            <section id="contactos">
                                <h2>Contactos</h2>

                                <div class="contact-form">
                                    <form action="processar.php" method="POST">
                                        <!-- Nome -->
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="name">
                                                    <i class="bi bi-person-fill"></i>Nome Completo *
                                                </label>
                                                <input type="text" id="name" name="name" required placeholder="Digita o teu nome completo"
                                                    minlength="2" pattern="[A-Za-zÀ-ÿ\s]+" title="Apenas letras e espaços são permitidos"
                                                    autocomplete="name">
                                            </div>
                                            <!-- Email -->
                                            <div class="form-group">
                                                <label for="email">
                                                    <i class="bi bi-envelope-fill"></i>Email *
                                                </label>
                                                <input type="email" id="email" name="email" required placeholder="o_teu_email@exemplo.com"
                                                    autocomplete="email" list="email-suggestions">
                                                <datalist id="email-suggestions">
                                                    <option value="@gmail.com">
                                                    <option value="@hotmail.com">
                                                    <option value="@icloud.com">
                                                    <option value="@live.com">
                                                    <option value="@outlook.com">
                                                    <option value="@sapo.pt">
                                                    <option value="@yahoo.com">
                                                </datalist>
                                            </div>
                                        </div>
                                        <!-- Telefone -->
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="phone">
                                                    <i class="bi bi-telephone-fill"></i>Telefone
                                                </label>
                                                <input type="tel" id="phone" name="phone" placeholder="912345678 ou 212345678"
                                                    pattern="((\+351)?[9][1236][0-9]{7})|([2][0-9]{8})"
                                                    title="Telemóvel: 912345678 ou +351912345678 | Fixo: 212345678" autocomplete="tel">
                                            </div>
                                            <!-- Website -->
                                            <div class="form-group">
                                                <label for="website">
                                                    <i class="bi bi-globe"></i>Website
                                                </label>
                                                <input type="url" id="website" name="website" placeholder="https://www.exemplo.com"
                                                    autocomplete="url">
                                            </div>
                                        </div>
                                        <!-- Data de contacto -->
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="preferreddate">
                                                    <i class="bi bi-calendar-event"></i>Data Preferida para Contacto
                                                </label>
                                                <input type="date" id="preferreddate" name="preferreddate"
                                                    min="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                            <!-- Empresa -->
                                            <div class="form-group">
                                                <label for="company">
                                                    <i class="bi bi-building"></i>Empresa/Organização
                                                </label>
                                                <input type="text" id="company" name="company" placeholder="Nome da tua empresa"
                                                    list="company-suggestions" autocomplete="organization">
                                                <datalist id="company-suggestions">
                                                    <option value="Altri">
                                                    <option value="APA - Agência Portuguesa do Ambiente">
                                                    <option value="Consultor Independente">
                                                    <option value="CTT - Correios de Portugal">
                                                    <option value="Ecoprogresso">
                                                    <option value="EDP Renováveis">
                                                    <option value="Galp Energia">
                                                    <option value="Greenvolt">
                                                    <option value="Jerónimo Martins">
                                                    <option value="Lipor">
                                                    <option value="QUERCUS">
                                                    <option value="Sonae">
                                                    <option value="The Navigator Company">
                                                    <option value="Zero - Associação Sistema Terrestre Sustentável">
                                                    <option value="Outro / Freelancer">
                                                </datalist>
                                            </div>
                                        </div>

                                        <!-- Categoria -->
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="category">
                                                    <i class="bi bi-tags-fill"></i>Categoria do Contacto *
                                                </label>
                                                <select id="category" name="category" required>
                                                    <option value="" disabled selected>Selecione uma categoria</option>
                                                    <option value="auditoria-ambiental">Auditoria Ambiental</option>
                                                    <option value="calculo-pegada">Cálculo de Pegada de Carbono</option>
                                                    <option value="certificacao-ambiental">Certificação Ambiental</option>
                                                    <option value="consultoria-sustentabilidade">Consultoria em Sustentabilidade</option>
                                                    <option value="formacao-ambiental">Formação Ambiental</option>
                                                    <option value="investimento-sustentavel">Investimento Sustentável</option>
                                                    <option value="parceria-projeto">Parceria em Projeto Verde</option>
                                                    <option value="relatorio-sustentabilidade">Relatório de Sustentabilidade</option>
                                                    <option value="tecnologia-verde">Tecnologia Verde</option>

                                                    <option value="outro">Outro</option>
                                                </select>
                                            </div>
                                            <!-- Orçamento -->
                                            <div class="form-group">
                                                <label for="budget">
                                                    <i class="bi bi-currency-euro"></i>Orçamento Estimado
                                                </label>
                                                <input type="range" id="budget" name="budget" min="0" max="10000" value="100" step="50"
                                                    oninput="this.nextElementSibling.textContent = this.value + '€'">
                                                <output>0€</output>
                                            </div>

                                        </div>

                                        <!-- Assunto -->
                                        <div class="form-group full-width">
                                            <label for="subject">
                                                <i class="bi bi-chat-square-text-fill"></i>Assunto *
                                            </label>
                                            <input type="text" id="subject" name="subject" required
                                                placeholder="Sobre o que é a tua mensagem?" minlength="5" maxlength="100">
                                        </div>

                                        <!-- Mensagem -->
                                        <div class="form-group full-width">
                                            <label for="message">
                                                <i class="bi bi-card-text"></i>Mensagem *
                                            </label>
                                            <textarea id="message" name="message" required
                                                placeholder="Diz-nos como podemos ajudar com o teu projeto de sustentabilidade... (mínimo 20 caracteres)"
                                                minlength="20" maxlength="1000"></textarea>
                                            <div class="datalist-info">
                                                <i class="bi bi-info-circle"></i>
                                                Máximo 1000 caracteres. Sê específico sobre as tuas necessidades ambientais.
                                            </div>
                                        </div>

                                        <!-- Botão de submissão -->
                                        <button type="submit" class="submit-btn">
                                            <i class="bi bi-send"></i>
                                            Enviar Mensagem
                                        </button>
                                    </form>
                                </div>
                            </section>
                        </div>
                        <!-- Imagens links -->
                        <ul class="social">
                            <li><a href="https://mail.google.com/mail/?view=cm&fs=1&to=ruiribeiro29@gmail.com" target="_blank"><img
                                        src="data:image/png;base64,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"
                                        alt="Gmail"></a></li>
                            <li><a href="https://www.linkedin.com/in/rui-ribeiro-2b9628228" target="_blank"><img
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAAIGNIUk0AAHomAACAhAAA+gAAAIDoAAB1MAAA6mAAADqYAAAXcJy6UTwAAAFWUExURS54ti13tS94ti14tQAAAC55ti53ti54ty94uDZouix5sy54uCx6si53uC55tS14tjB4ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti53ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti94ti94ti54ti54ti54ti94ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54tS54ti54ti54ti54ti55ti55ti54ti54ti54ti53tS54ti54ti54ti54ti54ti54ti54ti54ti54ti94ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54tv///631rGsAAABwdFJOUwAAAAAAAAAAAAAAAAAAAAAA8K2J72cKZu6rCaqFg6cHCKbtYAdf7KN9/v3yw73VvL/o4KF2bHzd0SUOD8/7aAwVqa80Bi6kF8xeB1sdGLQBB0zxJgECVsVaqCnZ0yEBj/rzRnP4gHn5elmQhOey/MJRnnfvAAAAAWJLR0Rxrwdc4gAAAAlwSFlzAAAHYgAAB2IBOHqZ2wAAAAd0SU1FB+kGGgoTDsa7S/IAAAE5SURBVEjH7dJXV8IwGAbg18pwo4io2IoLkFEFnFCqiNWiWDeIey/q6P+/MhVuoYm39rtJzps8JydfAoO5YBOb/J0MeAe9PibiG/LDPzzCQkYDAAJjLIQH2rh2gYWMB8kpE5MsZGp6BsFQmKlj4chsxEpYvUs0ZkHiCVEUE3EjOjcvismUkV5YXFqOrLQiq5mslM3kDHltXZLyG4VNhbRD2dqWm5OcCg5q0ZB3yLhb2kO9tP0WRIMDGiEhOJwHhy5zv8vdgaNjOuJEZ/5EO/09pkhFHChXztLFaplEyjkV6cLFJYmurtGNm1sq0oPSHYnuH9ALCFSkD49m9FSBG3imIpznxYxeq+b96Ui/5+0fEjQIOEqikuX6TwYaTX5vTVI1nddrH0bsU+B5PWlGXwVz+t2U0JVNbMJUP6sdxzfApu9oAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDI1LTA2LTI2VDEwOjE4OjUyKzAwOjAwzU0CDQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyNS0wNi0yNlQxMDoxODo1MiswMDowMLwQurEAAAAodEVYdGRhdGU6dGltZXN0YW1wADIwMjUtMDYtMjZUMTA6MTk6MTQrMDA6MDDjXcuQAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAABJRU5ErkJggg=="
                                        alt="Linkedin"></a></li>
                            <li><a href="https://www.instagram.com/nsu.29" target="_blank"><img
                                        src="data:image/png;base64,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"
                                        alt="Instagram"></a>
                            </li>
                            <li><a href="https://wa.me/351964098927" target="_blank"><img
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAAIGNIUk0AAHomAACAhAAA+gAAAIDoAAB1MAAA6mAAADqYAAAXcJy6UTwAAAGwUExURSXTZiTTZSLSZCHSYzTWcVDchG7imYTmqZDpsSvUaljdip3rutP24PD89f3//f////3+/VndiirUalfdibXwy/L89rPwyibTZiPTZTLWb4/osOz78un678Dy05fqtnvkonvko8Dy0u378pDosSPTZD3Yd/7//tj344jnrEjaf4rnrdn35bTwy8Hy05jqtz7Yd+T57GzhmCbTZ+T67F7ejiPSZCnUaXPjnaftwn/lpSrUaXnkofb9+fD89FLchtj35DrXddn35JrruF3ejff9+d345z/YeOn77yHSZGbgk/r+/Pv+/GTgkk/bg+/89Mj02CTTZi7VbMLz1Grhl/j++nTjnabtwd/56U7bg8313EjafinUaN746NX24mLfkSfTZ3zlo+H56qzuxZjqtvz+/VvejKbtwFPchmnhluv78fH89bLvyUbafULZeqzuxPT9+Fnei2fglLvxz/j9+pnqt4vorlLchYzorrrxzsbz16/vx2rhlofnqizUa7DvyPf9+mDfkDnXdNr45TzYdlrejPX9+GHfkD7YeInnrMz127nxzun78P3//mPgkvH89kzbgTT0NHkAAAABYktHRA8YugDZAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH6QYaChMOxrtL8gAAAsJJREFUSMftVflbElEUnXkDA8N2EAYdlC19gwIKgUblXtleRmWRbWR72l62uuRWZln/co/BpYEZo+/r+/rF+xPDe+fd886971yO243/EzwRCAuB8HUCCG+xija73SZaLTypByA5nC63Byy8bpezwfcnEM/55UB5OzwaCoFGf9OO9JRgcwvbFwpHoqIYi+wJsY/WtqBijqCqHAfaOxISFVhQKZFMAfFOlZrmULsYk7RKtnZQmkkznl2qSR4+2AnszeZ0y0ou2w10Bo3v09QWR3fPvhq2Pd2INxur629FIMs4UV5Pg2YDaPEbae1rBNI5jsvvP3CwV7eSSwOyZJCkIYBURuH4vn4MDOrOVNQhBBy1aXgnkKQcP3yI1eKw/rakA3DWCMBbXAglKEeOjDDI0WO669DEcbgs1RhidSPM+J44eYpBTp/R05DCcFurmQmiFxEmFzk7yiDnhvVH0gi8olCdxQbE2J+F8xeA0WpJhShgq85C7PBo55CLIxi7VA0RPbCbQgq+y0DxSmVd2RHCiEWFShXGgfGrbEOhV71W2SfEDIiVz4lUOpgMXgdu3CwR5dbE7YbeciZ6B3drr78hsqbPvSLgvv/g4SNgcuqxYiLyZikrGL+LKT0wqT3lPoGVMmRQSq1hOjYPok+e9qMSz54TjiaNGoYjjgDaM5sSKb4XL8s1xavXEqdkUoZtyUkyML3VWgUivXn77v2HjxKvNX+jrxbBCTPQa09IfrZECtoTazV8YqU5zH8yWNAecluTAYJfWERxiTmxUrddkOUVyLNLn+3TX+i2KRF1B1Miq8BXuTgGpJLb1rc6xKxPNrG+/Bq2ghlsTBSjkfA39tHSbGKwSmaCLa8szs1MVWz8+4aNy37OxMbJ+o+JtdXlhZLgKw8Lr2b+bFg4JNNhwf9cz+SJNrbqHkk8UX77/ZeDbzf+dfwC9+peyEFGFEcAAAAldEVYdGRhdGU6Y3JlYXRlADIwMjUtMDYtMjZUMTA6MTg6NTIrMDA6MDDNTQINAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDI1LTA2LTI2VDEwOjE4OjUyKzAwOjAwvBC6sQAAACh0RVh0ZGF0ZTp0aW1lc3RhbXAAMjAyNS0wNi0yNlQxMDoxOToxNCswMDowMONdy5AAAAAASUVORK5CYII="
                                        alt="Whatsapp"></a>
                            </li>
                        </ul>

                    </section>

                </div>
            </section>

        <?php elseif ($seccao == 'sobre'): ?>
            <!-- SECÇÃO SOBRE -->
            <section id="sobre" class="content-section">

                <div class="container">
                   
                    <section id="inicio" class="inicio">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-8 col-lg-6">
                                    <h1>Sobre a<br> Calculadora Ambiental</h1>
                                    <p>Uma ferramenta para avaliares e reduzires a tua Pegada Ecológica</p>
                                    <a href="?p=calculadora" class="cta-button">Calcular a Minha Pegada</a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="sobre" class="">
                        <div class="sobre-content">
                            <!-- Pegada de Carbono -->
                            <div class="sobre-section">
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

                            <!-- Métodos de cálculo -->
                            <div class="sobre-section">
                                <h2>Métodos de cálculo</h2>
                                <p> A Pegada de Carbono é estimada com base em dados como o consumo de combustíveis fósseis, a
                                    produção industrial, a utilização do solo e a criação de animais, considerando também os
                                    sumidouros de carbono (ex.: árvores plantadas). Pode ser ajustada ao nível de detalhe
                                    necessário.
                                </p>
                            </div>

                            <!-- Impacto Ambiental -->
                            <div class="sobre-section">
                                <h2> Impacto Ambiental</h2>
                                <p> O aumento do CO₂ intensifica o efeito de estufa e eleva as temperaturas globais, provocando
                                    fenómenos climáticos extremos. Os acordos internacionais procuram limitar o aquecimento a
                                    1,5–2 °C para evitar consequências graves, como o derretimento dos polos, a acidificação dos
                                    oceanos e crises alimentares.
                                </p>
                            </div>

                            <!-- Setores -->
                            <div class="sobre-section">
                                <h2> Setores com a maior Pegada</h2>
                                <p> O setor energético é o maior emissor, seguido pela indústria, pelos transportes e pela
                                    construção. O crescimento das energias renováveis contribui para a redução das emissões. Alguns
                                    setores industriais, como o do aço e o do cimento, são mais difíceis de descarbonizar, mas o
                                    hidrogénio verde surge como uma alternativa promissora.
                                </p>
                            </div>

                            <!-- Iniciativas globais -->
                            <div class="sobre-section">
                                <h2> Iniciativas globais</h2>
                                <p>
                                    O Acordo de Paris, assinado em 12 de dezembro de 2015 pelas Nações Unidas, serve de referência
                                    global para a redução de emissões e define três objetivos principais: manter o aumento da
                                    temperatura média global bem abaixo dos 2 °C em relação aos níveis pré-industriais,
                                    empenhando-se para limitá-lo a 1,5 °C; reforçar a capacidade de adaptação aos efeitos adversos
                                    das alterações climáticas e promover a resiliência; e assegurar o financiamento necessário para
                                    um desenvolvimento de baixas emissões e favorável ao clima. Destaca ainda a origem de políticas
                                    regionais e nacionais, nomeadamente o Pacto Ecológico Europeu, que visa alcançar a neutralidade
                                    carbónica na Europa até 2050, ou seja, um equilíbrio entre o CO₂ emitido e absorvido.
                                </p>
                            </div>

                            <!-- Secção 1: Emissões de Transporte -->
                            <div class="sobre-section">
                                <h2>🚗 Emissões de CO₂ por Meio de Transporte</h2>
                                <div class="table-container">
                                    <table class="transport-table">
                                        <thead>
                                            <tr>
                                                <th>Meio de Transporte</th>
                                                <th>Emissões CO₂ (g/km)</th>
                                                <th>Classificação</th>
                                                <th>Distância Exemplo</th>
                                                <th>Total CO₂ (kg/ano)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="eco-indicator">🚶‍♂️ A pé</span></td>
                                                <td><span class="co2-value co2-low">0</span></td>
                                                <td class="rating">Excelente</td>
                                                <td>5 km/dia</td>
                                                <td class="highlight-green">0,00</td>
                                            </tr>
                                            <tr>
                                                <td><span class="eco-indicator">🚲 Bicicleta</span></td>
                                                <td><span class="co2-value co2-low">0</span></td>
                                                <td class="rating">Excelente</td>
                                                <td>10 km/dia</td>
                                                <td class="highlight-green">0,00</td>
                                            </tr>
                                            <tr>
                                                <td><span class="eco-indicator">🚌 Autocarro</span></td>
                                                <td><span class="co2-value co2-medium">89</span></td>
                                                <td class="rating">Bom</td>
                                                <td>20 km/dia</td>
                                                <td>0,65</td>
                                            </tr>
                                            <tr>
                                                <td><span class="eco-indicator">🚊 Elétrico/Metro</span></td>
                                                <td><span class="co2-value co2-low">45</span></td>
                                                <td class="rating">Muito Bom</td>
                                                <td>15 km/dia</td>
                                                <td>0,25</td>
                                            </tr>
                                            <tr>
                                                <td><span class="eco-indicator">🚗 Carro (gasolina)</span></td>
                                                <td><span class="co2-value co2-high">180</span></td>
                                                <td class="rating">Elevado</td>
                                                <td>30 km/dia</td>
                                                <td class="highlight-red">1,97</td>
                                            </tr>
                                            <tr>
                                                <td><span class="eco-indicator">✈️ Avião (doméstico)</span></td>
                                                <td><span class="co2-value co2-high">285</span></td>
                                                <td class="rating">Muito Elevado</td>
                                                <td>500 km/mês</td>
                                                <td class="highlight-red">1,71</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Secção 2: Consumo Energético -->
                            <div class="sobre-section">
                                <h2>⚡ Consumo Energético Doméstico</h2>
                                <div class="table-container">
                                    <table class="energy-table">
                                        <thead>
                                            <tr>
                                                <th>Equipamento</th>
                                                <th>Potência (W)</th>
                                                <th>Horas/Dia</th>
                                                <th>Consumo (kWh/mês)</th>
                                                <th>Eficiência</th>
                                                <th>CO₂/mês (kg)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>💡 Lâmpada LED</td>
                                                <td class="consumption">9</td>
                                                <td>5</td>
                                                <td>1,35</td>
                                                <td><span class="efficiency alta">Alta</span></td>
                                                <td class="highlight-green">0,54</td>
                                            </tr>
                                            <tr>
                                                <td>❄️ Frigorífico A+++</td>
                                                <td class="consumption">150</td>
                                                <td>24</td>
                                                <td>108</td>
                                                <td><span class="efficiency alta">Alta</span></td>
                                                <td>43,20</td>
                                            </tr>
                                            <tr>
                                                <td>🖥️ Computador</td>
                                                <td class="consumption">300</td>
                                                <td>8</td>
                                                <td>72</td>
                                                <td><span class="efficiency media">Média</span></td>
                                                <td>28,80</td>
                                            </tr>
                                            <tr>
                                                <td>📺 TV LED 50"</td>
                                                <td class="consumption">120</td>
                                                <td>6</td>
                                                <td>21,6</td>
                                                <td><span class="efficiency alta">Alta</span></td>
                                                <td>8,64</td>
                                            </tr>
                                            <tr>
                                                <td>🔥 Aquecedor elétrico</td>
                                                <td class="consumption">2000</td>
                                                <td>4</td>
                                                <td>240</td>
                                                <td><span class="efficiency baixa">Baixa</span></td>
                                                <td class="highlight-red">96,00</td>
                                            </tr>
                                            <tr>
                                                <td>👕 Máquina de lavar</td>
                                                <td class="consumption">500</td>
                                                <td>1</td>
                                                <td>15</td>
                                                <td><span class="efficiency media">Média</span></td>
                                                <td>6,00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Secção 3: Dicas Sustentáveis -->
                            <div class="sobre-section">
                                <h2>💡 Dicas para Reduzir a Pegada Ecológica</h2>
                                <div class="table-container">
                                    <table class="tips-table">
                                        <thead>
                                            <tr>
                                                <th>Ação Sustentável</th>
                                                <th>Impacto Ambiental</th>
                                                <th>Poupança CO₂/ano</th>
                                                <th>Dificuldade</th>
                                                <th>Poupança €/ano</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>🚲 Usar bicicleta</td>
                                                <td><span class="impact alto">Alto</span></td>
                                                <td class="highlight-green">1500 kg</td>
                                                <td class="difficulty">Fácil</td>
                                                <td class="highlight-green">1200€</td>
                                            </tr>
                                            <tr>
                                                <td>💡 Substituir lâmpadas por LED</td>
                                                <td><span class="impact medio">Médio</span></td>
                                                <td>200 kg</td>
                                                <td class="difficulty">Muito Fácil</td>
                                                <td>150€</td>
                                            </tr>
                                            <tr>
                                                <td>🌱 Dieta vegetariana 3x/semana</td>
                                                <td><span class="impact alto">Alto</span></td>
                                                <td class="highlight-green">800 kg</td>
                                                <td class="difficulty">Moderada</td>
                                                <td>400€</td>
                                            </tr>
                                            <tr>
                                                <td>♻️ Reciclar todo o lixo</td>
                                                <td><span class="impact medio">Médio</span></td>
                                                <td>300 kg</td>
                                                <td class="difficulty">Fácil</td>
                                                <td>50€</td>
                                            </tr>
                                            <tr>
                                                <td>🏠 Isolar termicamente a casa</td>
                                                <td><span class="impact alto">Alto</span></td>
                                                <td class="highlight-green">2000 kg</td>
                                                <td class="difficulty">Difícil</td>
                                                <td class="highlight-green">800€</td>
                                            </tr>
                                            <tr>
                                                <td>☀️ Instalar painéis solares</td>
                                                <td><span class="impact alto">Alto</span></td>
                                                <td class="highlight-green">3500 kg</td>
                                                <td class="difficulty">Muito Difícil</td>
                                                <td class="highlight-green">1500€</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>

            </section>

        <?php endif; ?>

    </main>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>&copy; 2025 - Calculadora da tua Pegada Ecológica <br> Juntos por um planeta mais sustentável 🌍
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

    <script src="js/nsu.js"></script>

</body>

</html>