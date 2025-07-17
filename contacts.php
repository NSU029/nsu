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
                                <i class="bi bi-globe"></i>Website/Portfolio
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
                                <i class="bi bi-building"></i>Company/University
                            </label>
                            <input type="text" id="company" name="company" placeholder="Your company name"
                                list="company-suggestions" autocomplete="organization">
                            <datalist id="company-suggestions">
                                <option value="APA - Portuguese Environment Agency">
                                <option value="Independent Consultant">
                                <option value="EDP Renováveis">
                                <option value="FCUP">
                                <option value="FEP">
                                <option value="FEUP">
                                <option value="FMUP">
                                <option value="Galp Energia">
                                <option value="ICBAS">
                                <option value="Jerónimo Martins">
                                <option value="Lipor">
                                <option value="QUERCUS">
                                <option value="Sonae">
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
                                <option value="" disabled selected>Select contact type</option>
                                <option value="duvida-projeto">Question about the Project</option>
                                <option value="colaboracao-academica">Academic Collaboration</option>
                                <option value="partilha-dados">Data/Results Sharing</option>
                                <option value="feedback-calculadora">Calculator Feedback</option>
                                <option value="sugestao-melhoria">Improvement Suggestion</option>
                                <option value="pedido-apresentacao">Presentation Request</option>
                                <option value="questao-tecnica">Technical Question</option>
                                <option value="oportunidade-estagio">Internship Opportunity</option>
                                <option value="networking-estudantes">Student Networking</option>
                                <option value="outro">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="budget">
                                <i class="bi bi-calendar-week"></i> Academic Background
                            </label>
                            <input type="range" id="budget" name="budget" min="0" max="5" value="5" step="1"
                                oninput="updateYearDisplay(this.value)">
                            <output id="year-output">Worker</output>

                            <script>
                                function updateYearDisplay(value) {
                                    const years = {
                                        '0': 'No Academic Background',
                                        '1': 'Bachelor’s Degree',
                                        '2': 'Master’s/Postgraduate',
                                        '3': 'PhD',
                                        '4': 'Postdoctoral',
                                        '5': 'Worker'
                                    };
                                    document.getElementById('year-output').textContent = years[value];
                                }
                            </script>
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
        <li><a href="mailto:ruiribeiro29@gmail.com" target="_blank"><img
                    src="data:image/png;base64,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"
                    alt="Gmail"></a></li>
        <li><a href="https://www.linkedin.com/in/rui-ribeiro-2b9628228" target="_blank"><img
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAAIGNIUk0AAHomAACAhAAA+gAAAIDoAAB1MAAA6mAAADqYAAAXcJy6UTwAAAFWUExURS54ti13tS94ti14tQAAAC55ti53ti54ty94uDZouix5sy54uCx6si53uC55tS14tjB4ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti53ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti94ti94ti54ti54ti54ti94ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54tS54ti54ti54ti54ti55ti55ti54ti54ti54ti53tS54ti54ti54ti54ti54ti54ti54ti54ti54ti94ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54ti54tv///631rGsAAABwdFJOUwAAAAAAAAAAAAAAAAAAAAAA8K2J72cKZu6rCaqFg6cHCKbtYAdf7KN9/v3yw73VvL/o4KF2bHzd0SUOD8/7aAwVqa80Bi6kF8xeB1sdGLQBB0zxJgECVsVaqCnZ0yEBj/rzRnP4gHn5elmQhOey/MJRnnfvAAAAAWJLR0Rxrwdc4gAAAAlwSFlzAAAHYgAAB2IBOHqZ2wAAAAd0SU1FB+kGGgoTDsa7S/IAAAE5SURBVEjH7dJXV8IwGAbg18pwo4io2IoLkFEFnFCqiNWiWDeIey/q6P+/MhVuoYm39rtJzps8JydfAoO5YBOb/J0MeAe9PibiG/LDPzzCQkYDAAJjLIQH2rh2gYWMB8kpE5MsZGp6BsFQmKlj4chsxEpYvUs0ZkHiCVEUE3EjOjcvismUkV5YXFqOrLQiq5mslM3kDHltXZLyG4VNhbRD2dqWm5OcCg5q0ZB3yLhb2kO9tP0WRIMDGiEhOJwHhy5zv8vdgaNjOuJEZ/5EO/09pkhFHChXztLFaplEyjkV6cLFJYmurtGNm1sq0oPSHYnuH9ALCFSkD49m9FSBG3imIpznxYxeq+b96Ui/5+0fEjQIOEqikuX6TwYaTX5vTVI1nddrH0bsU+B5PWlGXwVz+t2U0JVNbMJUP6sdxzfApu9oAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDI1LTA2LTI2VDEwOjE4OjUyKzAwOjAwzU0CDQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyNS0wNi0yNlQxMDoxODo1MiswMDowMLwQurEAAAAodEVYdGRhdGU6dGltZXN0YW1wADIwMjUtMDYtMjZUMTA6MTk6MTQrMDA6MDDjXcuQAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAABJRU5ErkJggg=="
                    alt="Linkedin"></a></li>
        <li><a href="https://www.instagram.com/nsu.29" target="_blank"><img
                    src="data:image/png;base64,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"
                    alt="Instagram"></a>
        </li>
        <li><a href="https://wa.me/351964098927" target="_blank"><img
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAAIGNIUk0AAHomAACAhAAA+gAAAIDoAAB1MAAA6mAAADqYAAAXcJy6UTwAAAGwUExURSXTZiTTZSLSZCHSYzTWcVDchG7imYTmqZDpsSvUaljdip3rutP24PD89f3//f////3+/VndiirUalfdibXwy/L89rPwyibTZiPTZTLWb4/osOz78un678Dy05fqtnvkonvko8Dy0u378pDosSPTZD3Yd/7//tj344jnrEjaf4rnrdn35bTwy8Hy05jqtz7Yd+T57GzhmCbTZ+T67F7ejiPSZCnUaXPjnaftwn/lpSrUaXnkofb9+fD89FLchtj35DrXddn35JrruF3ejff9+d345z/YeOn77yHSZGbgk/r+/Pv+/GTgkk/bg+/89Mj02CTTZi7VbMLz1Grhl/j++nTjnabtwd/56U7bg8313EjafinUaN746NX24mLfkSfTZ3zlo+H56qzuxZjqtvz+/VvejKbtwFPchmnhluv78fH89bLvyUbafULZeqzuxPT9+Fnei2fglLvxz/j9+pnqt4vorlLchYzorrrxzsbz16/vx2rhlofnqizUa7DvyPf9+mDfkDnXdNr45TzYdlrejPX9+GHfkD7YeInnrMz127nxzun78P3//mPgkvH89kzbgTT0NHkAAAABYktHRA8YugDZAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH6QYaChMOxrtL8gAAAsJJREFUSMftVflbElEUnXkDA8N2EAYdlC19gwIKgUblXtleRmWRbWR72l62uuRWZln/co/BpYEZo+/r+/rF+xPDe+fd886971yO243/EzwRCAuB8HUCCG+xija73SZaLTypByA5nC63Byy8bpezwfcnEM/55UB5OzwaCoFGf9OO9JRgcwvbFwpHoqIYi+wJsY/WtqBijqCqHAfaOxISFVhQKZFMAfFOlZrmULsYk7RKtnZQmkkznl2qSR4+2AnszeZ0y0ou2w10Bo3v09QWR3fPvhq2Pd2INxur629FIMs4UV5Pg2YDaPEbae1rBNI5jsvvP3CwV7eSSwOyZJCkIYBURuH4vn4MDOrOVNQhBBy1aXgnkKQcP3yI1eKw/rakA3DWCMBbXAglKEeOjDDI0WO669DEcbgs1RhidSPM+J44eYpBTp/R05DCcFurmQmiFxEmFzk7yiDnhvVH0gi8olCdxQbE2J+F8xeA0WpJhShgq85C7PBo55CLIxi7VA0RPbCbQgq+y0DxSmVd2RHCiEWFShXGgfGrbEOhV71W2SfEDIiVz4lUOpgMXgdu3CwR5dbE7YbeciZ6B3drr78hsqbPvSLgvv/g4SNgcuqxYiLyZikrGL+LKT0wqT3lPoGVMmRQSq1hOjYPok+e9qMSz54TjiaNGoYjjgDaM5sSKb4XL8s1xavXEqdkUoZtyUkyML3VWgUivXn77v2HjxKvNX+jrxbBCTPQa09IfrZECtoTazV8YqU5zH8yWNAecluTAYJfWERxiTmxUrddkOUVyLNLn+3TX+i2KRF1B1Miq8BXuTgGpJLb1rc6xKxPNrG+/Bq2ghlsTBSjkfA39tHSbGKwSmaCLa8szs1MVWz8+4aNy37OxMbJ+o+JtdXlhZLgKw8Lr2b+bFg4JNNhwf9cz+SJNrbqHkk8UX77/ZeDbzf+dfwC9+peyEFGFEcAAAAldEVYdGRhdGU6Y3JlYXRlADIwMjUtMDYtMjZUMTA6MTg6NTIrMDA6MDDNTQINAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDI1LTA2LTI2VDEwOjE4OjUyKzAwOjAwvBC6sQAAACh0RVh0ZGF0ZTp0aW1lc3RhbXAAMjAyNS0wNi0yNlQxMDoxOToxNCswMDowMONdy5AAAAAASUVORK5CYII="
                    alt="Whatsapp"></a>
        </li>
    </ul>

</section>