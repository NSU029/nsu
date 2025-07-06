<?php

$seccao = $_GET['p'] ?? 'calculator';
$resultado = null;
$totalAnual = 0;
$scrollToResults = false; 

// CALCULATOR SCRIPT PHP 
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

    // RESULTS SCROLL
    $scrollToResults = true;
}

// HEADER
include 'header.php';
?>

<main class="mh-container">

    <?php if($seccao !== 'about'): ?>

    <!-- INITIAL SECTION -->
    <section id="inicio" class="inicio">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <h1>Welcome to the <br> Environmental Calculator</h1>
                    <p>A tool to assess and reduce your Carbon Footprint</p>
                    <a href="?p=calculator" class="cta-button">Calculate My Footprint</a>
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>

    <?php if($seccao == 'calculator'): ?>
        <!-- CALCULATOR SECTION -->
        <section id="calculadora" class="content-section">
            <div class="container">
                <?php include_once 'calculator.php'; ?>
            </div>
        </section>

    <?php elseif($seccao == 'tips'): ?>
        <!-- TIPS SECTION -->
        <section id="dicas" class="content-section">
            <div class="container">
                <?php include 'tips.php'; ?>
            </div>
        </section>

    <?php elseif($seccao == 'contacts'): ?>
        <!-- CONTACT SECTION -->
        <section id="contactos" class="content-section">
            <div class="container">
                <?php include 'contacts.php'; ?>
            </div>
        </section>

    <?php elseif($seccao == 'about'): ?>
        <!-- ABOUT SECTION -->
        <section id="sobre" class="content-section">
            <div class="container">
                <?php include 'about.php'; ?>
            </div>
        </section>

    <?php endif; ?>

</main>

<!-- FOOTER -->
<?php include 'footer.php'; ?>

<!-- RESULTS SCROLL -->
<?php if ($scrollToResults): ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                const resultElement = document.querySelector('.result');
                if (resultElement) {
                    // Animação personalizada com easing
                    function easeInOutQuad(t) {
                        return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
                    }

                    const targetPosition = resultElement.getBoundingClientRect().top + window.pageYOffset - 200;
                    const startPosition = window.pageYOffset;
                    const distance = targetPosition - startPosition;
                    const duration = 1000; // 1 segundo
                    let startTime = null;

                    function animation(currentTime) {
                        if (startTime === null) startTime = currentTime;
                        const timeElapsed = currentTime - startTime;
                        const progress = Math.min(timeElapsed / duration, 1);
                        const easedProgress = easeInOutQuad(progress);

                        window.scrollTo(0, startPosition + distance * easedProgress);

                        if (timeElapsed < duration) {
                            requestAnimationFrame(animation);
                        }
                    }

                    requestAnimationFrame(animation);
                }
            }, 100);
        });
    </script>

<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('p') === 'calculator') {
    const seccaoCalculadora = document.getElementById('calculadora');
    if (seccaoCalculadora) {
      seccaoCalculadora.style.scrollMarginTop = '150px';
      seccaoCalculadora.scrollIntoView({ behavior: 'smooth' });
    }
  }
});
</script>
