<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Environmental Calculator</title>

    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/mobile.css">
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

    <header>
        <nav class="container">
            <div class="logo">Environmental Calculator</div>
            <ul class="nav-links">
                <li><a href="index-en.php#calculadora">Calculator</a></li>
                <li><a href="#dicas">Tips</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="#contactos">Contacts</a></li>
                <li><a href="index.php" title="Portuguese">
                        <img src="https://flagcdn.com/pt.svg" alt="Flag PT" width="24" height="16">
                    </a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="sobre" class="sobre">
            <div class="container">
                <h1>Welcome to the Environmental Calculator</h1>
                <p>A tool to assess and reduce your Ecological Footprint</p>

                <a href="#calculadora" class="cta-button">Calculate My Footprint</a>
            </div>
        </section>

        <section id="calculadora" class="section">
            <div class="container">
                <h2>Calculator</h2>
                <p class="calculator-intro">
                    Fill in the following fields with your monthly data to calculate your annual Carbon Footprint
                </p>

                <div class="calculator">
                    <form method="POST" action="#calculadora">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="energia">Electricity Consumption (kWh/month)</label>
                                <input type="number" id="energia" name="energia" placeholder="Ex: 300"
                                    value="<?= htmlspecialchars($_POST['energia'] ?? '') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="gas">Gas Consumption (m³/month)</label>
                                <input type="number" id="gas" name="gas" placeholder="Ex: 60"
                                    value="<?= htmlspecialchars($_POST['gas'] ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="combustivel">Fuel Consumption (liters/month)</label>
                                <input type="number" id="combustivel" name="combustivel" placeholder="Ex: 80"
                                    value="<?= htmlspecialchars($_POST['combustivel'] ?? '') ?>" required>
                            </div>
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
                                    <option value="bicicleta" <?= ($_POST['transporte'] ?? '') === 'bicicleta' ? 'selected' : '' ?>>Bicycle or Walking</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="distancia">Distance traveled per month (km)</label>
                                <input type="number" id="distancia" name="distancia" placeholder="Ex: 1250"
                                    value="<?= htmlspecialchars($_POST['distancia'] ?? '') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="pessoas">Number of people in your household</label>
                                <input type="number" id="pessoas" name="pessoas" placeholder="Ex: 3" min="1"
                                    value="<?= htmlspecialchars($_POST['pessoas'] ?? '') ?>" required>
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
                                <div class="comparison-item">
                                    <span class="icon">🌳</span>
                                    <div>Trees needed</div>
                                    <strong><?= $resultado['arvores'] ?></strong>
                                </div>
                                <div class="comparison-item">
                                    <span class="icon">🚗</span>
                                    <div>Car km</div>
                                    <strong><?= number_format($resultado['kmCarro']) ?></strong>
                                </div>
                                <div class="comparison-item">
                                    <span class="icon">⚡</span>
                                    <div>60W lightbulb (hours)</div>
                                    <strong><?= number_format($resultado['lampadas']) ?></strong>
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
        </section>

        <section id="dicas" class="section">
            <div class="container">
                <h2>Tips to Reduce Your Carbon Footprint</h2>
                <div class="tips">
                    <div class="tip-card">
                        <span class="icon">💡</span>
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
                        <span class="icon">🌱</span>
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

        <section id="contactos" class="section">
            <div class="container">
                <h2>Contacts</h2>

                <ul class="social">
                    <li><a href="https://mail.google.com/mail/?view=cm&fs=1&to=ruiribeiro29@gmail.com"
                            target="_blank"><img src="img/gmail.png" alt="Linkedin"></a></li>
                    <li><a href="https://www.linkedin.com/in/rui-ribeiro-2b9628228" target="_blank"><img
                                src="img/linkedin.png" alt="Linkedin"></a></li>
                    <li><a href="https://www.instagram.com/nsu.29" target="_blank"><img src="img/instagram.png"
                                alt="Instagram"></a></li>
                    <li><a href="https://wa.me/351964098927" target="_blank"><img src="img/Whatsapp.png"
                                alt="Whatsapp"></a>
                    </li>
                </ul>
            </div>
        </section>

    </main>


    <footer>
        <div class="container">
            <p>&copy; 2025 - Your Ecological Footprint Calculator <br> Together for a more sustainable planet 🌍</p>
        </div>
    </footer>

</body>

</html>