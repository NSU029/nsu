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
                                    <label for="distancia">Distância percorrida por mês (km)</label>
                                    <input type="number" id="distancia" name="distancia" placeholder="Ex: 1250"
                                        value="<?= htmlspecialchars($_POST['distancia'] ?? '') ?>" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="pessoas">Número de pessoas na tua casa</label>
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