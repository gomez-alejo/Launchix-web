<!-- resources/views/include/footer.blade.php -->
<footer class="footer text-light py-5 ">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <h5 class="text-uppercase">Sobre Nosotros</h5>
                <p class="small">Launchix es tu plataforma ideal para emprender, vender y conectar con clientes en Timbío. Nuestra misión es impulsar tu negocio al éxito.</p>
            </div>
            <div class="col-md-3 mb-3">
                <h5 class="text-uppercase">Enlaces Útiles</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-light">Inicio</a></li>
                    <li><a href="{{ url('productos') }}" class="text-light">Productos</a></li>
                    <li><a href="{{ url('servicios') }}" class="text-light">Servicios</a></li>
                    <li><a href="{{ url('emprendimiento') }}" class="text-light">Emprendimiento</a></li>
                    <li><a href="{{ url('blog') }}" class="text-light">Blog</a></li>
                    <li><a href="{{ url('faq') }}" class="text-light">FAQ</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-3">
                <h5 class="text-uppercase">Contáctanos</h5>
                <p class="small mb-1"><i class="fas fa-envelope"></i> soporte@launchix.com</p>
                <p class="small mb-1"><i class="fas fa-phone"></i> +57 320 123 4567</p>
                <p class="small"><i class="fas fa-map-marker-alt"></i> Timbío, Cauca, Colombia</p>
            </div>
            <div class="col-md-3 mb-3">
                <h5 class="text-uppercase">Síguenos</h5>
                <div class="d-flex">
                    <a href="#" class="text-light me-3 icon-hover"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="text-light me-3 icon-hover"><i class="fab fa-twitter fa-2x"></i></a>
                    <a href="#" class="text-light me-3 icon-hover"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-light icon-hover"><i class="fab fa-linkedin fa-2x"></i></a>
                </div>
            </div>
        </div>
        <hr class="my-4 text-secondary">
        <div class="row">
            <div class="col text-center">
                <p class="small mb-0">&copy; 2024 Launchix. Todos los derechos reservados</p>
                <p class="small mb-0">Política de Privacidad | Términos de Uso</p>
            </div>
        </div>
    </div>
</footer>
