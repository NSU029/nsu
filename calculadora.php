<section id="calculadora" class="section">
    <div class="container"> <!-- Container principal da secção da calculadora -->
        <h2>Calculadora</h2>
        <p class="calculator-intro">
            Preenche os campos seguintes com os seus dados mensais para calcular a tua Pegada de Carbono anual
        </p>

        <div class="calculator"> <!-- Wrapper da calculadora -->
            <form method="POST" action="#calculadora"> <!-- Formulário principal -->
                
                <!-- Linha 1 do formulário: Energia elétrica e Gás -->
                <div class="form-row">
                    <div class="form-group"> <!-- Campo: Energia elétrica -->
                        <label for="energia">Consumo de Energia Elétrica (kWh/mês)</label>
                        <input type="number" id="energia" name="energia" placeholder="Ex: 300"
                            value="<?= htmlspecialchars($_POST['energia'] ?? '') ?>" required>
                    </div>
                    <div class="form-group"> <!-- Campo: Gás natural -->
                        <label for="gas">Consumo de Gás (m³/mês)</label>
                        <input type="number" id="gas" name="gas" placeholder="Ex: 60"
                            value="<?= htmlspecialchars($_POST['gas'] ?? '') ?>" required>
                    </div>
                </div>

                <!-- Linha 2 do formulário: Combustível e Tipo de Transporte -->
                <div class="form-row">
                    <div class="form-group"> <!-- Campo: Combustível -->
                        <label for="combustivel">Consumo de Combustível (litros/mês)</label>
                        <input type="number" id="combustivel" name="combustivel" placeholder="Ex: 80"
                            value="<?= htmlspecialchars($_POST['combustivel'] ?? '') ?>" required>
                    </div>
                    <div class="form-group"> <!-- Campo: Transporte principal -->
                        <label for="transporte">Tipo de Transporte Principal</label>
                        <select id="transporte" name="transporte" required>
                            <option value="">Selecione...</option>
                            <option value="carro" <?= ($_POST['transporte'] ?? '') === 'carro' ? 'selected' : '' ?>>Carro</option>
                            <option value="moto" <?= ($_POST['transporte'] ?? '') === 'moto' ? 'selected' : '' ?>>Moto</option>
                            <option value="publico" <?= ($_POST['transporte'] ?? '') === 'publico' ? 'selected' : '' ?>>Transporte Público</option>
                            <option value="bicicleta" <?= ($_POST['transporte'] ?? '') === 'bicicleta' ? 'selected' : '' ?>>Bicicleta ou a pé</option>
                        </select>
                    </div>
                </div>

                <!-- Linha 3 do formulário: Distância mensal e número de pessoas -->
                <div class="form-row">
                    <div class="form-group"> <!-- Campo: Distância -->
                        <label for="distancia">Distância percorrida por mês (km)</label>
                        <input type="number" id="distancia" name="distancia" placeholder="Ex: 1250"
                            value="<?= htmlspecialchars($_POST['distancia'] ?? '') ?>" required>
                    </div>
                    <div class="form-group"> <!-- Campo: Número de pessoas -->
                        <label for="pessoas">Número de pessoas na tua casa</label>
                        <input type="number" id="pessoas" name="pessoas" placeholder="Ex: 3" min="1"
                            value="<?= htmlspecialchars($_POST['pessoas'] ?? '') ?>" required>
                    </div>
                </div>

                <!-- Botão de submissão -->
                <button type="submit" class="calculate-btn">Calcular a Pegada de Carbono</button>
            </form>

            <!-- Resultado da calculadora (só aparece após submissão) -->
            <?php if ($resultado): ?>
                <div class="result"> <!-- Bloco de resultado final -->
                    <h3>A tua Pegada de Carbono</h3>
                    <div class="value"><?= number_format($resultado['total'], 1) ?> kg CO₂/ano</div>

                    <!-- Barra de progresso -->
                    <div class="progress-container">
                        <div class="progress-bar <?= $resultado['progressClass'] ?>">
                            <?= $resultado['progressClass'] === 'progress-20' ? '20%' :
                                ($resultado['progressClass'] === 'progress-40' ? '40%' :
                                    ($resultado['progressClass'] === 'progress-60' ? '60%' :
                                        ($resultado['progressClass'] === 'progress-80' ? '80%' : '100%'))) ?>
                        </div>
                    </div>

                    <!-- Classificação visual -->
                    <div class="classification <?= $resultado['classeCss'] ?>">
                        <?= $resultado['classe'] ?>
                    </div>

                    <!-- Comparações visuais com outras métricas -->
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

                    <!-- Mensagem final de feedback -->
                    <div class="alert <?= $resultado['alertClass'] ?>">
                        <?php if ($resultado['total'] <= 2000): ?>
                            Parabéns! Estás no caminho certo para um futuro sustentável.
                        <?php elseif ($resultado['total'] <= 4000): ?>
                            Bom trabalho! Com pequenos ajustes poderás melhorar ainda mais.
                        <?php elseif ($resultado['total'] <= 6000): ?>
                            Há várias oportunidades para reduzir a tua Pegada de Carbono.
                        <?php else: ?>
                            Considera implementar mudanças significativas nos teus hábitos.
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div> <!-- Fim da calculadora -->
    </div> <!-- Fim do container -->
</section>
