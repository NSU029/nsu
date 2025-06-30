<section class="section">

    <section id="contactos" class="">

        <h2>Contactos</h2>
        <div class="contact-form">
            <form action="processar.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nome Completo *</label>
                        <input type="text" id="name" name="name" required placeholder="Digite o seu nome completo">
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required placeholder="o_teu_email@exemplo.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="subject">Assunto *</label>
                    <input type="text" id="subject" name="subject" required placeholder="Sobre o que é a tua mensagem?">
                </div>

                <div class="form-group">
                    <label for="message">Mensagem *</label>
                    <textarea id="message" name="message" required
                        placeholder="Diga-nos como podemos ajudar..."></textarea>
                </div>

                <button type="submit" class="submit-btn">Enviar Mensagem</button>
            </form>
        </div>
    </section>

    <ul class="social">
        <li><a href="https://mail.google.com/mail/?view=cm&fs=1&to=ruiribeiro29@gmail.com" target="_blank"><img
                    src="img/gmail.png" alt="Linkedin"></a></li>
        <li><a href="https://www.linkedin.com/in/rui-ribeiro-2b9628228" target="_blank"><img src="img/linkedin.png"
                    alt="Linkedin"></a></li>
        <li><a href="https://www.instagram.com/nsu.29" target="_blank"><img src="img/instagram.png" alt="Instagram"></a>
        </li>
        <li><a href="https://wa.me/351964098927" target="_blank"><img src="img/Whatsapp.png" alt="Whatsapp"></a>
        </li>
    </ul>

</section>