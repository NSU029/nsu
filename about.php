<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Calculadora Ambiental</title>

    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/mobile.css">
</head>

<body>
    <header>
        <nav class="container">
            <div class="logo">Environmental Calculator</div>
            <ul class="nav-links">
                <li><a href="index-en.php#calculator">Calculator</a></li>
                <li><a href="index-en.php#tips">Tips</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="#contacts">Contacts</a></li>
                <li><a href="index.php" title="Portuguese">
                        <img src="https://flagcdn.com/pt.svg" alt="Flag PT" width="24" height="16">
                    </a></li>
            </ul>
        </nav>
    </header>
</body>

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

        <h2>⚡ Household Energy Consumption</h2>
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

        <h2>💡 Tips to Reduce Your Ecological Footprint</h2>
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


    <?php include 'contacts.php'; ?>
    
</section>

    <footer>
        <div class="container">
            <p>&copy; 2025 - Your Ecological Footprint Calculator <br> Together for a more sustainable planet 🌍</p>
        </div>
    </footer>

</html>