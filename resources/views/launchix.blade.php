<!-- resources/views/layout/welcome.blade.php -->
@extends('layout.app')

@section('title', 'Página Principal')

@section('content')
   <div class="container my-5 ">
     <!-- Sección Hero -->
     <br>
     <section class="hero-section">
        <div >
            <h1 data-aos="fade-up">Bienvenidos a Launchix</h1>
            <p data-aos="fade-up">Tu Plataforma de Oportunidades para Emprendedores en Timbío</p>
            <a href="{{ url('/Launchix/html/e-commerce/html/productos.html') }}" class="cta-button" data-aos="fade-up">Explora Ahora</a>
        </div>
    </section>

    <!-- Sección de Inicio -->
    <section id="inicio" class="mt-5">
        <h2 class="section-title" data-aos="fade-right">Explora Launchix</h2>
        <p data-aos="fade-left">
            En Launchix, te conectamos con un mundo de emprendedores y productos únicos en Timbío. Explora nuestra plataforma para descubrir cómo puedes vender, comprar y promover tus negocios. ¡Únete a nosotros y empieza tu viaje hacia el éxito hoy mismo!
        </p>
    </section>

    <!-- Sección de Productos y Servicios -->
    <section class="sectiontres container py-5">
        <h2 class="section-title" data-aos="fade-right">Nuestros Productos y Servicios</h2>
        <div class="row">
            <!-- Tarjeta: Tienda en Línea -->
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="https://i.pinimg.com/736x/e1/83/7b/e1837b5c08889d523ce525f24abc7d2a.jpg" alt="Tienda en Línea" class="card-img-top img-fluid">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Tienda en Línea</h3>
                        <p class="card-text">Crea y personaliza tu tienda en línea para llegar a una audiencia más amplia.</p>
                    </div>
                </div>
            </div>

            <!-- Tarjeta: Publicación de Productos -->
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="https://i.pinimg.com/736x/89/7f/b4/897fb4e86c2b4716049dae2720179221.jpg" alt="Publicación de Productos" class="card-img-top img-fluid">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Publicación de Productos</h3>
                        <p class="card-text">Lista tus productos con descripciones detalladas, fotos y videos.</p>
                    </div>
                </div>
            </div>

            <!-- Tarjeta: Carrito de Compras -->
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="https://i.pinimg.com/736x/82/6f/d5/826fd53165985939be5b7e29938b3fe3.jpg" alt="Carrito de Compras" class="card-img-top img-fluid">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Carrito de Compras</h3>
                        <p class="card-text">Facilita las compras con un carrito de compras intuitivo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Emprendimiento -->
    <section id="emprendimiento" class="mb-5">
        <h2 class="section-title" data-aos="fade-right">Inicia Tu Emprendimiento</h2>
        <p data-aos="fade-left">Brindamos las herramientas y el soporte necesario para ayudar a los emprendedores a hacer crecer su negocio. ¡Tu éxito es nuestra misión!</p>
    </section>

    <!-- Sección de Testimonios -->
    <section id="testimonios" class="mb-5">
        <h2 class="section-title" data-aos="fade-right">Testimonios</h2>
        <div class="row">
            <!-- Tarjeta de Testimonio -->
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100">
                    <div class="card-body">
                        <p>"Launchix ha sido fundamental para el crecimiento de mi negocio. ¡Gracias!"</p>
                        <h5>- Juan Pérez</h5>
                    </div>
                </div>
            </div>
            <!-- Repetir para otros testimonios -->
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100">
                    <div class="card-body">
                        <p>"La plataforma es muy fácil de usar y ha aumentado mis ventas significativamente."</p>
                        <h5>- María López</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100">
                    <div class="card-body">
                        <p>"Excelente servicio al cliente y herramientas útiles para emprendedores."</p>
                        <h5>- Carlos Gómez</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección del Blog -->
    <section id="blog" class="mb-5">
        <h2 class="section-title" data-aos="fade-right">Blog</h2>
        <div class="row">
            <!-- Tarjeta de Blog: Cómo empezar tu propio negocio -->
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="https://i.pinimg.com/736x/77/d4/30/77d430a161a18188f02a884573683eb2.jpg" alt="Cómo empezar tu propio negocio" class="card-img-top img-fluid">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Cómo empezar tu propio negocio</h5>
                        <p class="card-text">Consejos y estrategias para lanzar tu emprendimiento.</p>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Blog: La importancia del marketing digital -->
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="https://i.pinimg.com/736x/a3/5c/b5/a35cb5b1d317adcd7a18c8b098883168.jpg" alt="La importancia del marketing digital" class="card-img-top img-fluid">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">La importancia del marketing digital</h5>
                        <p class="card-text">Descubre cómo el marketing digital puede impulsar tu negocio.</p>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Blog: Historias de éxito de emprendedores -->
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="https://i.pinimg.com/736x/48/82/01/488201e10a9b11a5eaa764efe8e26fae.jpg" alt="Historias de éxito de emprendedores" class="card-img-top img-fluid">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Historias de éxito de emprendedores</h5>
                        <p class="card-text">Inspírate con las historias de otros emprendedores.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección del Equipo -->
    <section id="equipo" class="mb-5">
        <h2 class="section-title" data-aos="fade-right">Nuestro Equipo</h2>
        <div class="row">
            <!-- Tarjeta de Miembro del Equipo -->
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card text-center h-100">
                    <div class="image-container">
                        <img src="https://i.pinimg.com/736x/fe/d1/2a/fed12af4d53900865e32bc1820e858d7.jpg" alt="Alejandro Gómez" class="card-img-top img-fluid rounded-circle mx-auto mt-3">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Alejandro Gómez</h5>
                        <p class="card-text">CEO & Fundador</p>
                    </div>
                </div>
            </div>
            <!-- Repetir para otros miembros del equipo -->

            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card text-center h-100">
                    <div class="image-container">
                        <img src="https://i.ytimg.com/vi/TJbY74Y49FM/maxresdefault.jpg?sqp=-oaymwEmCIAKENAF8quKqQMa8AEB-AGaBIAC0AWKAgwIABABGF0gXShdMA8=&rs=AOn4CLDvvVHJdDyg_XrfNur3BMSC-G1KMg" alt="Manzano Manzano" class="card-img-top img-fluid rounded-circle mx-auto mt-3">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sebastian Manzano</h5>
                        <p class="card-text">Desarrollador Principal</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card text-center h-100">
                    <div class="image-container">
                        <img src="https://i.pinimg.com/736x/2e/26/50/2e2650de2b1e66917a3ca3ca502279e0.jpg" alt="Julián Domínguez" class="card-img-top img-fluid rounded-circle mx-auto mt-3">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Julián Domínguez</h5>
                        <p class="card-text">Diseñador UX/UI</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card text-center h-100">
                    <div class="image-container">
                        <img src="https://ekosnegocios.com/image/posts/October2022/V3Pyk1Yd4bjnqyVU9VIj.jpg" alt="Guillermo Gómez" class="card-img-top img-fluid rounded-circle mx-auto mt-3">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Guillermo Gómez</h5>
                        <p class="card-text">Gerente de Producto</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Preguntas Frecuentes (FAQ) -->
    <section id="faq" class="mb-5">
        <h2 class="section-title" data-aos="fade-right">Preguntas Frecuentes</h2>
        <div class="accordion" id="faqAccordion">
            <!-- Pregunta: Registro en Launchix -->
            <div class="accordion-item" data-aos="fade-up">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        ¿Cómo puedo registrarme en Launchix?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Registrarse en Launchix es fácil. Simplemente haz clic en "Iniciar Sesión / Registro" y sigue las instrucciones.
                    </div>
                </div>
            </div>
            <!-- Repetir para otras preguntas -->
            <div class="accordion-item" data-aos="fade-up">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        ¿Qué métodos de pago aceptan?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Aceptamos tarjetas de crédito, débito, transferencias y más.
                    </div>
                </div>
            </div>
            <div class="accordion-item" data-aos="fade-up">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        ¿Cómo puedo contactar al soporte técnico?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Puedes contactarnos a través de soporte@launchix.com o llamando al +57 320 123 4567.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Aside con noticias recientes -->
    <aside data-aos="fade-left">
        <h3>Noticias Recientes</h3>
        <p>Mantente actualizado con las últimas noticias y tendencias en el mundo del emprendimiento.</p>
        <ul>
            <li><a href="#">Nueva actualización de la plataforma</a></li>
            <li><a href="#">Evento de networking para emprendedores</a></li>
            <li><a href="#">Consejos para mejorar tu estrategia de marketing</a></li>
        </ul>
    </aside>
   </div>
@endsection
