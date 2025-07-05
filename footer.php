<footer>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>&copy; 2025 - Your Ecological Footprint Calculator <br> Together for a more sustainable planet 🌍
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- BOOTSTRAP JAVASCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

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

</body>

</html>