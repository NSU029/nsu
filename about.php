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
        body{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%)!important;line-height:1.6;color:#333}
        .navbar-custom{background:rgba(255,255,255,.95)!important;backdrop-filter:blur(10px);box-shadow:0 2px 10px rgba(0,0,0,.1);padding:.5rem 0}
        .navbar-brand{font-size:1.8rem;font-weight:bold;color:#2d5a27!important;text-decoration:none}
        .navbar-nav .nav-link{position:relative;display:inline-block;color:#333!important;font-weight:500;margin-left:1rem;padding:.5rem 1rem!important;transition:color .3s}
        .navbar-nav .nav-link::after{content:"";position:absolute;bottom:0;left:0;height:2px;width:0;background:currentColor;transition:width .3s}
        .navbar-nav .nav-link:hover{color:#2d5a27!important}
        .navbar-nav .nav-link:hover::after{width:100%}
        .navbar-toggler{border:none;padding:.2rem .4rem}
        .navbar-toggler:focus{box-shadow:none}
        footer{background:rgba(45,90,39,.9);color:#fff;text-align:center;padding:1.5rem 0}
        #inicio,#calculadora,#dicas,#about{scroll-margin-top:100px}
        #contacts{scroll-margin-top:150px}
        .inicio{margin-top:5rem;padding:3rem 0}
        .inicio p{font-size:1rem;margin-bottom:1.5rem}
        .sobre-section table th,.sobre-section table td{text-transform:none;text-align:center;vertical-align:middle;padding:8px}
       
        @media (max-width:480px) {
        .calculator{padding:1.1rem;margin:1.5rem 0}
        .container{padding:0 8px}
        .navbar-brand{font-size:1.13rem}
        .inicio h1{font-size:2rem;padding-bottom:.5rem}
        .section h2{font-size:1.3rem}
        .sobre-section table th,.sobre-section table td{font-size:.8rem;line-height:1.4;padding:4px 6px}
        .sobre-section { padding: 1.2rem; margin: 1.5rem 0; }
        .sobre-section h2 { font-size: 0.89em; }
        .sobre-section p { font-size: 0.9rem; line-height: 1.7; }
        footer{font-size:.8rem;padding:1.5rem 0}
        .transport-table th:nth-child(2),.transport-table td:nth-child(2),
        .transport-table th:nth-child(3),.transport-table td:nth-child(3),
        .transport-table th:nth-child(4),.transport-table td:nth-child(4),
        .energy-table th:nth-child(2),.energy-table td:nth-child(2),
        .energy-table th:nth-child(3),.energy-table td:nth-child(3),
        .energy-table th:nth-child(4),.energy-table td:nth-child(4),
        .energy-table th:nth-child(5),.energy-table td:nth-child(5),
        .tips-table th:nth-child(2),.tips-table td:nth-child(2),
        .tips-table th:nth-child(4),.tips-table td:nth-child(4),
        .tips-table th:nth-child(5),.tips-table td:nth-child(5){display:none}
        }
        
        @media (min-width:481px) and (max-width:768px) {
        .calculator{padding:1.2rem;margin:1.5rem 0}
        .navbar-brand{font-size:1.5rem}
        .inicio h1{font-size:2rem;padding-bottom:.5rem}
        .sobre-section { padding: 1.2rem; margin: 1.5rem 0; }
        .sobre-section h2 { font-size: 1.4rem; }
        .sobre-section p { font-size: 0.95rem; line-height: 1.7; }
        .transport-table th:nth-child(3),.transport-table td:nth-child(3),
        .transport-table th:nth-child(4),.transport-table td:nth-child(4),
        .energy-table th:nth-child(2),.energy-table td:nth-child(2),
        .energy-table th:nth-child(3),.energy-table td:nth-child(3),
        .energy-table th:nth-child(5),.energy-table td:nth-child(5),
        .tips-table th:nth-child(4),.tips-table td:nth-child(4),
        .tips-table th:nth-child(5),.tips-table td:nth-child(5){display:none}
        }
        
        @media (min-width:769px) and (max-width:1024px) {
        .calculator{padding:1.5rem;margin:1.5rem 0}
        .inicio h1{font-size:2rem;padding-bottom:.5rem}
        .sobre-section { padding: 1.5rem; margin: 1.5rem 0; }
        .sobre-section h2 { font-size: 1.7rem; }
        .sobre-section p { font-size: 1rem; line-height: 1.7; }
        .transport-table th:nth-child(4),.transport-table td:nth-child(4),
        .energy-table th:nth-child(2),.energy-table td:nth-child(2),
        .energy-table th:nth-child(3),.energy-table td:nth-child(3),
        .tips-table th:nth-child(4),.tips-table td:nth-child(4){display:none}
        }
       
        @media (max-width:319px) {
        .calculator{padding:1.5rem;margin:1.5rem 0}
        .navbar-brand{font-size:.8rem}
        footer{font-size:.7rem}
        }
    </style>

</head>

<body>
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
                        <a class="nav-link" href="index-en.php#calculadora">Calculator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index-en.php#dicas">Tips</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index-en.php#contacts">Contacts</a>
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
                        <h1>About the <br> Environmental Calculator</h1>
                        <p>A tool to assess and reduce your Ecological Footprint</p>
                        <a href="index-en.php#calculadora" class="cta-button">Calculate My Footprint</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="inicio" class="">
            <div class="sobre-content">
                <div class="sobre-section">
                    <h2>What is the Carbon Footprint?</h2>
                    <p>The Carbon Footprint represents the total amount of greenhouse gases emitted directly
                        or indirectly by our daily activities. It is measured in kilograms of CO₂ equivalent
                        (CO₂e) and includes emissions related to energy, transport, food, and consumption.

                        This footprint covers:

                        Direct emissions: such as burning fossil fuels (e.g., in cars or building heating);

                        Indirect emissions: such as using electricity generated from non-renewable sources.

                        Although CO₂ is the unit used, the footprint also includes other gases like methane,
                        nitrous oxide, and CFCs, which have a high global warming potential.
                        A smaller footprint represents a more positive contribution to slowing climate change.
                    </p>
                </div>

                <div class="sobre-section">
                    <h2>Calculation Methods</h2>
                    <p>The Carbon Footprint is estimated based on data such as fossil fuel consumption,
                        industrial production, land use, and livestock farming, also considering carbon sinks
                        (e.g., planted trees). It can be adjusted to the necessary level of detail.
                    </p>
                </div>

                <div class="sobre-section">
                    <h2>Environmental Impact</h2>
                    <p>Increasing CO₂ intensifies the greenhouse effect and raises global temperatures,
                        causing extreme weather events. International agreements seek to limit warming to
                        1.5–2 °C to avoid severe consequences like polar ice melting, ocean acidification, and food
                        crises.
                    </p>
                </div>

                <div class="sobre-section">
                    <h2>Sectors with the Largest Footprint</h2>
                    <p>The energy sector is the largest emitter, followed by industry, transport, and construction.
                        The growth of renewable energy helps reduce emissions. Some industrial sectors, like steel
                        and cement, are harder to decarbonize, but green hydrogen appears promising.
                    </p>
                </div>

                <div class="sobre-section">
                    <h2>Global Initiatives</h2>
                    <p>
                        The Paris Agreement, signed on December 12, 2015, by the United Nations, serves as a global
                        reference for emission reduction and defines three main goals: to keep the global average
                        temperature increase well below 2 °C above pre-industrial levels, aiming for 1.5 °C;
                        strengthen adaptation capacity to climate impacts and resilience; and ensure financing for
                        low-emission, climate-friendly development. It also highlights regional and national policies,
                        including the European Green Deal, aiming for carbon neutrality in Europe by 2050, i.e., a
                        balance between emitted and absorbed CO₂.
                    </p>
                </div>

                <div class="sobre-section">
                    <h2>🚗 CO₂ Emissions by Mode of Transport</h2>
                    <div class="table-container">
                        <table class="transport-table">
                            <thead>
                                <tr>
                                    <th>Mode of Transport</th>
                                    <th>CO₂ Emissions (g/km)</th>
                                    <th>Rating</th>
                                    <th>Example Distance</th>
                                    <th>Total CO₂ (kg/year)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="eco-indicator">🚶‍♂️ On Foot</span></td>
                                    <td><span class="co2-value co2-low">0</span></td>
                                    <td class="highlight-green">Excellent</td>
                                    <td>5 km/day</td>
                                    <td class="highlight-green">0.0</td>
                                </tr>
                                <tr>
                                    <td><span class="eco-indicator">🚲 Bicycle</span></td>
                                    <td><span class="co2-value co2-low">0</span></td>
                                    <td class="highlight-green">Excellent</td>
                                    <td>10 km/day</td>
                                    <td class="highlight-green">0.0</td>
                                </tr>
                                <tr>
                                    <td><span class="eco-indicator">🚌 Bus</span></td>
                                    <td><span class="co2-value co2-medium">89</span></td>
                                    <td>Good</td>
                                    <td>20 km/day</td>
                                    <td>0.65</td>
                                </tr>
                                <tr>
                                    <td><span class="eco-indicator">🚊 Tram/Metro</span></td>
                                    <td><span class="co2-value co2-low">45</span></td>
                                    <td class="highlight-green">Very Good</td>
                                    <td>15 km/day</td>
                                    <td>0.25</td>
                                </tr>
                                <tr>
                                    <td><span class="eco-indicator">🚗 Car (petrol)</span></td>
                                    <td><span class="co2-value co2-high">180</span></td>
                                    <td class="highlight-red">High</td>
                                    <td>30 km/day</td>
                                    <td class="highlight-red">1.97</td>
                                </tr>
                                <tr>
                                    <td><span class="eco-indicator">✈️ Plane (domestic)</span></td>
                                    <td><span class="co2-value co2-high">285</span></td>
                                    <td class="highlight-red">Very High</td>
                                    <td>500 km/month</td>
                                    <td class="highlight-red">1.71</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="sobre-section">
                    <h2>⚡Household Energy Consumption</h2>
                    <div class="table-container">
                        <table class="energy-table">
                            <thead>
                                <tr>
                                    <th>Appliance</th>
                                    <th>Power (W)</th>
                                    <th>Hours/Day</th>
                                    <th>Consumption (kWh/month)</th>
                                    <th>Efficiency</th>
                                    <th>CO₂/month (kg)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>💡 LED Bulb</td>
                                    <td class="consumption">9</td>
                                    <td>5</td>
                                    <td>1.35</td>
                                    <td><span class="efficiency alta">High</span></td>
                                    <td class="highlight-green">0.54</td>
                                </tr>
                                <tr>
                                    <td>❄️ Fridge A+++</td>
                                    <td class="consumption">150</td>
                                    <td>24</td>
                                    <td>108</td>
                                    <td><span class="efficiency alta">High</span></td>
                                    <td>43.2</td>
                                </tr>
                                <tr>
                                    <td>🖥️ Computer</td>
                                    <td class="consumption">300</td>
                                    <td>8</td>
                                    <td>72</td>
                                    <td><span class="efficiency media">Medium</span></td>
                                    <td>28.8</td>
                                </tr>
                                <tr>
                                    <td>📺 50" LED TV</td>
                                    <td class="consumption">120</td>
                                    <td>6</td>
                                    <td>21.6</td>
                                    <td><span class="efficiency alta">High</span></td>
                                    <td>8.64</td>
                                </tr>
                                <tr>
                                    <td>🔥 Electric Heater</td>
                                    <td class="consumption">2000</td>
                                    <td>4</td>
                                    <td>240</td>
                                    <td><span class="efficiency baixa">Low</span></td>
                                    <td class="highlight-red">96.0</td>
                                </tr>
                                <tr>
                                    <td>👕 Washing Machine</td>
                                    <td class="consumption">500</td>
                                    <td>1</td>
                                    <td>15</td>
                                    <td><span class="efficiency media">Medium</span></td>
                                    <td>6.0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="sobre-section">
                    <h2>💡Tips to Reduce Your Ecological Footprint</h2>
                    <div class="table-container">
                        <table class="tips-table">
                            <thead>
                                <tr>
                                    <th>Sustainable Action</th>
                                    <th>Environmental Impact</th>
                                    <th>CO₂ Savings/year</th>
                                    <th>Difficulty</th>
                                    <th>€ Savings/year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>🚲 Use a bicycle</td>
                                    <td><span class="impact alto">High</span></td>
                                    <td class="highlight-green">1,500 kg</td>
                                    <td class="difficulty">Easy</td>
                                    <td class="highlight-green">€1,200</td>
                                </tr>
                                <tr>
                                    <td>💡 Replace bulbs with LEDs</td>
                                    <td><span class="impact medio">Medium</span></td>
                                    <td>200 kg</td>
                                    <td class="difficulty">Very Easy</td>
                                    <td>€150</td>
                                </tr>
                                <tr>
                                    <td>🌱 Vegetarian diet 3x/week</td>
                                    <td><span class="impact alto">High</span></td>
                                    <td class="highlight-green">800 kg</td>
                                    <td class="difficulty">Moderate</td>
                                    <td>€400</td>
                                </tr>
                                <tr>
                                    <td>♻️ Recycle all waste</td>
                                    <td><span class="impact medio">Medium</span></td>
                                    <td>300 kg</td>
                                    <td class="difficulty">Easy</td>
                                    <td>€50</td>
                                </tr>
                                <tr>
                                    <td>🏠 Thermally insulate your home</td>
                                    <td><span class="impact alto">High</span></td>
                                    <td class="highlight-green">2,000 kg</td>
                                    <td class="difficulty">Difficult</td>
                                    <td class="highlight-green">€800</td>
                                </tr>
                                <tr>
                                    <td>☀️ Install solar panels</td>
                                    <td><span class="impact alto">High</span></td>
                                    <td class="highlight-green">3,500 kg</td>
                                    <td class="difficulty">Very Difficult</td>
                                    <td class="highlight-green">€1,500</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </section>

    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 - Your Ecological Footprint Calculator <br> Together for a more sustainable planet 🌍</p>
        </div>
    </footer>

    <!-- BOOTSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>