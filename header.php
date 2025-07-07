<?php
$seccaoAtual = $_GET['p'] ?? 'calculator';
?>

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
    </style>

</head>

<body>

    <!-- RESPONSIVE BOOTSTRAP NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <!-- LOGO -->
            <a class="navbar-brand" href="index-en.php">
                🌱 Environmental Calculator
            </a>

            <!-- HAMBURGER BUTTON FOR MOBILE -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- NAVIGATION LINKS -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($seccaoAtual == 'tips') ? 'active' : ''; ?>"
                            href="?p=tips">Tips</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($seccaoAtual == 'contacts') ? 'active' : ''; ?>"
                            href="?p=contacts">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($seccaoAtual == 'about') ? 'active' : ''; ?>"
                            href="?p=about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link align-items-center" href="index.php" title="Português">
                            <span class="me-2">Português</span>
                            <img src="https://flagcdn.com/pt.svg" alt="Português" width="24" height="16"
                                class="d-inline-block align-middle">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>