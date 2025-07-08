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
                            <input type="date" id="preferreddate" name="preferreddate" min="<?php echo date('Y-m-d'); ?>">
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
                                <option value=""disabled selected>Selecione uma categoria</option>
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
                    src="img/gmail.png" alt="Gmail"></a></li>
        <li><a href="https://www.linkedin.com/in/rui-ribeiro-2b9628228" target="_blank"><img src="img/linkedin.png"
                    alt="Linkedin"></a></li>
        <li><a href="https://www.instagram.com/nsu.29" target="_blank"><img src="img/instagram.png" alt="Instagram"></a>
        </li>
        <li><a href="https://wa.me/351964098927" target="_blank"><img src="img/Whatsapp.png" alt="Whatsapp"></a>
        </li>
    </ul>

</section>