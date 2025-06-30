<section class="section">

    <section id="contacts" class="">

        <h2>Contacts</h2>
        <div class="contact-form">
            <form action="process.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required placeholder="Write your full name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required placeholder="your_email@example.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="subject">Subject *</label>
                    <input type="text" id="subject" name="subject" required placeholder="What is this message about?">
                </div>

                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" required
                        placeholder="What can we help you with..."></textarea>
                </div>

                <button type="submit" class="submit-btn">Send message</button>
            </form>
        </div>
    </section>

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