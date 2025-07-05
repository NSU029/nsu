<!-- SECÇÃO CALCULADORA -->
<section id="calculadora" class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <h2>Calculator</h2>
                        <p class="calculator-sobre">
                            Fill in the following fields with your monthly data to calculate your annual Carbon Footprint
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
                                                placeholder="Ex: 80" value="<?= htmlspecialchars($_POST['combustivel'] ?? '') ?>" required>
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