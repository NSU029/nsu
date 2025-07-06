<footer>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>&copy; 2025 - Calculadora da tua Pegada Ecológica <br> Juntos por um planeta mais sustentável 🌍
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- BOOTSTRAP JAVASCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous">
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateActiveFromHash() {
            const hash = window.location.hash || '#inicio';
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === hash) {
                    link.classList.add('active');
                }
            });
        }
        updateActiveFromHash();
        window.addEventListener('hashchange', updateActiveFromHash);
    });
</script>

<script>
    function scrollToElement(element, duration = 1500) {
    const start = window.scrollY;
    const end = element.getBoundingClientRect().top + window.scrollY - 150; // margem no topo
    const distance = end - start;
    let startTime = null;

    function animation(currentTime) {
        if (!startTime) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const progress = Math.min(timeElapsed / duration, 1);
        window.scrollTo(0, start + distance * easeInOutQuad(progress));

        if (timeElapsed < duration) {
        requestAnimationFrame(animation);
        }
    }

    function easeInOutQuad(t) {
        return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
    }

    requestAnimationFrame(animation);
    }

    document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('p') === 'calculadora') {
        const seccaoCalculadora = document.getElementById('calculadora');
        if (seccaoCalculadora) {
        scrollToElement(seccaoCalculadora, 1000); // 1000 ms = 1 segundos
        }
    }
    });
</script>

</body>

</html>