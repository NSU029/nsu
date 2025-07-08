<section class="section">
    <div class="container">
        <section id="contacts">
            <h2>Contacts</h2>

            <div class="contact-form">
                <form action="process.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">
                                <i class="bi bi-person-fill"></i>Full Name *
                            </label>
                            <input type="text" id="name" name="name" required placeholder="Enter your full name"
                                minlength="2" pattern="[A-Za-zÀ-ÿ\s]+" title="Only letters and spaces are allowed"
                                autocomplete="name">
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <i class="bi bi-envelope-fill"></i>Email *
                            </label>
                            <input type="email" id="email" name="email" required placeholder="your_email@example.com"
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

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">
                                <i class="bi bi-telephone-fill"></i>Phone
                            </label>
                            <input type="tel" id="phone" name="phone" placeholder="912345678 or 212345678"
                                pattern="((\+351)?[9][1236][0-9]{7})|([2][0-9]{8})"
                                title="Mobile: 912345678 or +351912345678 | Landline: 212345678" autocomplete="tel">
                        </div>

                        <div class="form-group">
                            <label for="website">
                                <i class="bi bi-globe"></i>Website
                            </label>
                            <input type="url" id="website" name="website" placeholder="https://www.example.com"
                                autocomplete="url">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="preferreddate">
                                <i class="bi bi-calendar-event"></i>Preferred Contact Date
                            </label>
                            <input type="date" id="preferreddate" name="preferreddate"
                                min="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="company">
                                <i class="bi bi-building"></i>Company/Organization
                            </label>
                            <input type="text" id="company" name="company" placeholder="Your company name"
                                list="company-suggestions" autocomplete="organization">
                            <datalist id="company-suggestions">
                                <option value="Altri">
                                <option value="APA - Portuguese Environment Agency">
                                <option value="Independent Consultant">
                                <option value="CTT - Portuguese Postal Service">
                                <option value="Ecoprogresso">
                                <option value="EDP Renováveis">
                                <option value="Galp Energia">
                                <option value="Greenvolt">
                                <option value="Jerónimo Martins">
                                <option value="Lipor">
                                <option value="QUERCUS">
                                <option value="Sonae">
                                <option value="The Navigator Company">
                                <option value="Zero - Terrestrial Sustainable System Association">
                                <option value="Other / Freelancer">
                            </datalist>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="category">
                                <i class="bi bi-tags-fill"></i>Contact Category *
                            </label>
                            <select id="category" name="category" required>
                                <option value=""disabled selected>Select a category</option>
                                <option value="carbon-footprint-calculation">Carbon Footprint Calculation</option>
                                <option value="environmental-audit">Environmental Audit</option>
                                <option value="environmental-certification">Environmental Certification</option>
                                <option value="environmental-training">Environmental Training</option>
                                <option value="green-project-partnership">Green Project Partnership</option>
                                <option value="green-technology">Green Technology</option>
                                <option value="sustainable-investment">Sustainable Investment</option>
                                <option value="sustainability-consulting">Sustainability Consulting</option>
                                <option value="sustainability-report">Sustainability Report</option>

                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="budget">
                                <i class="bi bi-currency-euro"></i>Estimated Budget
                            </label>
                            <input type="range" id="budget" name="budget" min="0" max="10000" value="100" step="50"
                                oninput="this.nextElementSibling.textContent = this.value + '€'">
                            <output>0€</output>
                        </div>

                    </div>

                    <div class="form-group full-width">
                        <label for="subject">
                            <i class="bi bi-chat-square-text-fill"></i>Subject *
                        </label>
                        <input type="text" id="subject" name="subject" required
                            placeholder="What is your message about?" minlength="5" maxlength="100">
                    </div>

                    <div class="form-group full-width">
                        <label for="message">
                            <i class="bi bi-card-text"></i>Message *
                        </label>
                        <textarea id="message" name="message" required
                            placeholder="Tell us how we can help with your sustainability project... (minimum 20 characters)"
                            minlength="20" maxlength="1000"></textarea>
                        <div class="datalist-info">
                            <i class="bi bi-info-circle"></i>
                            Maximum 1000 characters. Be specific about your environmental needs.
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="bi bi-send"></i>
                        Send Message
                    </button>
                </form>
            </div>
        </section>
    </div>

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