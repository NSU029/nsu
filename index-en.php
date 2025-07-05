<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Environmental Calculator</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="css/estilos.css">


    <style>
        body {background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; line-height: 1.6; color: #333;}
        .inicio {margin-top: 5rem; padding: 3rem 0;}
        .inicio p {font-size: 1rem; margin-bottom: 1.5rem;}
        .navbar-custom {background: rgba(255, 255, 255, 0.95) !important; backdrop-filter: blur(10px); box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 0.5rem 0;}
        .navbar-brand {font-size: 1.8rem;font-weight: bold; color: #2d5a27 !important; text-decoration: none;}
        .navbar-nav .nav-link {position: relative; display: inline-block; color: #333 !important; font-weight: 500; margin-left: 1rem; 
            padding: 0.5rem 1rem !important; text-decoration: none; transition: color 0.3s ease;}
        .navbar-nav .nav-link::after {content: ""; position: absolute; bottom: 0; left: 0; height: 2px; width: 0; background-color: currentColor; transition: width 0.3s ease;}
        .navbar-nav .nav-link:hover::after {width: 100%;}
        .navbar-nav .nav-link:hover {color: #2d5a27 !important;}
        .navbar-toggler {border: none; padding: 0.2rem 0.4rem;}
        .navbar-toggler:focus { box-shadow: none;}
        .progress-container { display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;}
        footer {background: rgba(45, 90, 39, 0.9); color: white; text-align: center; padding: 1.5rem 0;}
        #inicio, #calculadora, #dicas { scroll-margin-top: 100px;}
        #contacts { scroll-margin-top: 150px;}

        /* Telemóveis até 480px */
        @media (max-width: 480px) {

            .calculator { padding: 1.5rem;margin: 1.5rem 0;}

            .container {
                padding: 0 8px;
            }

            .navbar-brand {
                font-size: 1.13rem;
            }

            .inicio h1 {font-size: 2rem; padding-bottom: 0.5rem}


            .calculator {
                padding: 1.2rem;
                margin: 1.5rem 0;
            }

            .tips,
            .comparison {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .comparison-item {
                margin: 0.5rem 0rem;
            }

            .section h2 {
                font-size: 1.3rem;
            }

            .result h3 {
                font-size: 1.5rem;
            }

            .result .value {
                font-size: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }

            .form-group input,
            .form-group select {
                padding: 0.6rem;
                font-size: 0.95rem;
            }

            .contact-form input::placeholder {
                font-size: 0.8rem;
            }

            footer {
                font-size: 0.8rem;
                padding: 1.5rem 0;
            }
        }

        /* Telemóveis de 481px - 768px */
        @media (min-width: 481px) and (max-width: 768px) {
            .calculator {padding: 1.2rem; margin: 1.5rem 0;}
            .navbar-brand {font-size: 1.5rem;}
            .inicio h1 {font-size: 2rem; padding-bottom: 0.5rem}
            .comparison-item {margin: 0.5rem 0rem;}
            .comparison-item .icon {font-size: 1.7rem;}
            .contact-form input::placeholder {font-size: 0.9rem;}
        }

        /* Tablets de 769px - 1024px */
        @media (min-width: 769px) and (max-width: 1024px) {
            .calculator {padding: 1.5rem; margin: 1.5rem 0;}
            .comparison-item {padding: 0.8rem;}
            .comparison-item .icon {font-size: 1.7rem;}
        }

        /* Pouco abaixo de 319px - Perdi tempo, sim */
        @media (max-width: 319px) {
            .calculator { padding: 1.5rem;margin: 1.5rem 0;}
            .navbar-brand {font-size: 0.8rem;}
            .inicio h1 {font-size: 2rem; padding-bottom: 0.5rem}
            .contact-form input::placeholder {font-size: 0.7rem;}
            ul.social {gap: 0;}
            footer {font-size: 0.7rem; padding: 1.5rem 0;}
        }
    </style>

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
            $classe = "Excellent! Very low footprint 🌟";
            $classeCss = "excelente";
            $progressClass = "progress-20";
            $alertClass = "alert-success";
        } elseif ($totalAnual <= 4000) {
            $classe = "Good! Low footprint 👍";
            $classeCss = "boa";
            $progressClass = "progress-40";
            $alertClass = "alert-info";
        } elseif ($totalAnual <= 6000) {
            $classe = "Moderate. Room for improvement 🔄";
            $classeCss = "moderada";
            $progressClass = "progress-60";
            $alertClass = "alert-warning";
        } elseif ($totalAnual <= 8000) {
            $classe = "High. Consider significant changes ⚠️";
            $classeCss = "alta";
            $progressClass = "progress-80";
            $alertClass = "alert-warning";
        } else {
            $classe = "Very high! Urgent action needed 🚨";
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
    }
    ?>

    <!-- NAVBAR BOOTSTRAP RESPONSIVA -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <!-- LOGO/BRAND -->
            <a class="navbar-brand" href="#inicio">
                🌱 Environmental Calculator
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
                        <a class="nav-link" href="#calculadora">Calculator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#dicas">Tips</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacts">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link flag-link" href="index.php" title="Portuguese">
                            <img src="https://flagcdn.com/pt.svg" alt="Flag PT" width="24" height="16">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>

        <!-- SECÇÃO INICIAL -->
        <section id="inicio" class="inicio">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6">
                        <h1>Welcome to the <br> Environmental Calculator</h1>
                        <p>A tool to assess and reduce your Ecological Footprint</p>
                        <a href="#calculadora" class="cta-button">Calculate My Footprint</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECÇÃO CALCULADORA -->
        <section id="calculadora" class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <h2>Calculator</h2>
                        <p class="calculator-sobre">
                            Fill in the following fields with your monthly data to calculate your annual Carbon
                            Footprint
                        </p>

                        <div class="calculator">
                            <form method="POST" action="#calculadora">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="energia">Electricity Consumption (kWh/month)</label>
                                            <input type="number" id="energia" name="energia" placeholder="Ex: 300"
                                                value="<?= htmlspecialchars($_POST['energia'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="gas">Gas Consumption (m³/month)</label>
                                            <input type="number" id="gas" name="gas" placeholder="Ex: 60"
                                                value="<?= htmlspecialchars($_POST['gas'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="combustivel">Fuel Consumption (liters/month)</label>
                                            <input type="number" id="combustivel" name="combustivel"
                                                placeholder="Ex: 80"
                                                value="<?= htmlspecialchars($_POST['combustivel'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="transporte">Main Type of Transport</label>
                                            <select id="transporte" name="transporte" required>
                                                <option value="">Select...</option>
                                                <option value="carro" <?= ($_POST['transporte'] ?? '') === 'carro' ? 'selected' : '' ?>>
                                                    Car</option>
                                                <option value="moto" <?= ($_POST['transporte'] ?? '') === 'moto' ? 'selected' : '' ?>>
                                                    Motorcycle</option>
                                                <option value="publico" <?= ($_POST['transporte'] ?? '') === 'publico' ? 'selected' : '' ?>>
                                                    Public Transport</option>
                                                <option value="bicicleta" <?= ($_POST['transporte'] ?? '') === 'bicicleta' ? 'selected' : '' ?>>
                                                    Bicycle or Walking</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="distancia">Distance traveled per month (km)</label>
                                            <input type="number" id="distancia" name="distancia" placeholder="Ex: 1250"
                                                value="<?= htmlspecialchars($_POST['distancia'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="pessoas">Number of people in your household</label>
                                            <input type="number" id="pessoas" name="pessoas" placeholder="Ex: 3" min="1"
                                                value="<?= htmlspecialchars($_POST['pessoas'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="calculate-btn">Calculate Carbon Footprint</button>
                            </form>

                            <?php if ($resultado): ?>
                                <div class="result">
                                    <h3>Your Carbon Footprint</h3>
                                    <div class="value"><?= number_format($resultado['total'], 1) ?> kg CO₂/year</div>

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
                                                    <div>Trees needed</div>
                                                    <strong><?= $resultado['arvores'] ?></strong>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="comparison-item">
                                                    <span class="icon">🚗</span>
                                                    <div>Car km</div>
                                                    <strong><?= number_format($resultado['kmCarro']) ?></strong>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="comparison-item">
                                                    <span class="icon">💡</span>
                                                    <div>60W lightbulb (h)</div>
                                                    <strong><?= number_format($resultado['lampadas']) ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert <?= $resultado['alertClass'] ?>">
                                        <?php if ($resultado['total'] <= 2000): ?>
                                            Congratulations! You are on the right path for a sustainable future.
                                        <?php elseif ($resultado['total'] <= 4000): ?>
                                            Good job! Keep improving to reduce your footprint even further.
                                        <?php elseif ($resultado['total'] <= 6000): ?>
                                            Try to reduce your energy and transport consumption to lower your footprint.
                                        <?php elseif ($resultado['total'] <= 8000): ?>
                                            Consider adopting renewable energy and more sustainable travel methods.
                                        <?php else: ?>
                                            Urgent action is necessary. Your carbon footprint is very high.
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECÇÃO DICAS -->
        <section id="dicas" class="section">
            <div class="container">
                <h2>Tips to Reduce Your Carbon Footprint</h2>
                <div class="tips">
                    <div class="tip-card">
                        <span class="icon">⚡</span>
                        <h3>Efficient Energy</h3>
                        <p>Replace incandescent bulbs with LEDs, unplug devices when not in use, and invest in
                            energy-efficient appliances.</p>

                    </div>

                    <div class="tip-card">
                        <span class="icon">🚲</span>
                        <h3>Sustainable Transport</h3>
                        <p>Use public transport, ride a bicycle, or walk for short distances.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">♻️</span>
                        <h3>Recycling</h3>
                        <p>Sort your waste correctly, reuse materials whenever possible, and choose products with
                            recyclable packaging.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">🍎</span>
                        <h3>Conscious Consumption</h3>
                        <p>Choose local products, reduce meat consumption, avoid food waste, and prioritise sustainable
                            products.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">🏠</span>
                        <h3>Sustainable Home</h3>
                        <p>Improve thermal insulation, use solar heating for hot water, and consider renewable energy
                            sources like solar panels.</p>
                    </div>

                    <div class="tip-card">
                        <span class="icon">💧</span>
                        <h3>Water Conservation</h3>
                        <p>Take shorter showers, fix leaks promptly, and collect rainwater to water plants.</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- SECÇÃO CONTACTOS -->
        <?php include 'contacts.php'; ?>

    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>&copy; 2025 - Your Ecological Footprint Calculator <br> Together for a more sustainable planet 🌍
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- BOOTSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>