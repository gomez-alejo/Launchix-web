@extends('layout.app')
@section('title', 'Página Principal')
@section('content')
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }

    .hero-section {
      background: linear-gradient(135deg, #007bff, #00bcd4);
      color: white;
      text-align: center;
      padding: 80px 20px;
    }

    .hero-section h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .hero-section p {
      font-size: 1.2rem;
      margin-bottom: 30px;
    }

    .cta-button {
      background-color: #ffffff;
      color: #007bff;
      font-weight: bold;
      padding: 12px 25px;
      border-radius: 30px;
      text-decoration: none;
      transition: background-color 0.3s;
    }

    .cta-button:hover {
      background-color: #e3f2fd;
    }

    .section-title {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 20px;
      color: #007bff;
    }

    .feature-icon {
      font-size: 3rem;
      color: #00bcd4;
      margin-bottom: 15px;
    }

    .card {
      border: none;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }
    .card-img-top {
    width: 300px !important;
    height: 300px !important;
    object-fit: cover;
    display: block;
    margin: 0 auto;
} 

    .video-container {
      position: relative;
      padding-bottom: 56.25%;
      height: 0;
      overflow: hidden;
    }

    .video-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    aside {
      background-color: #e9f7fe;
      padding: 30px;
      border-radius: 8px;
      margin-top: 40px;
    }

    aside h3 {
      color: #007bff;
      margin-bottom: 15px;
    }

    aside ul {
      padding-left: 20px;
    }

    aside ul li {
      margin-bottom: 10px;
    }

    footer {
      color: white;
    }

    footer h5 {
      font-weight: bold;
    }

    .icon-hover:hover {
      color: #ffc107 !important;
      transform: scale(1.1);
      transition: 0.3s;
    }
  </style>




<!-- Inicio -->
<main class="container mt-5 pt-5 my-5">
  <section id="inicio" class="mb-5">
    <h2 class="section-title" data-aos="fade-right">Explora Launchix</h2>
    <p data-aos="fade-left">En Launchix, te conectamos con un mundo de emprendedores y productos únicos en Timbío. Explora nuestra plataforma para descubrir cómo puedes vender, comprar y promover tus negocios. ¡Únete a nosotros y empieza tu viaje hacia el éxito hoy mismo!</p>
  </section>

  <!-- Características Principales -->
  <section class="container mb-5">
    <div class="row text-center">
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <i class="fas fa-rocket feature-icon"></i>
        <h3>Crecimiento Rápido</h3>
        <p>Impulsa tu negocio con herramientas diseñadas para el crecimiento rápido y eficiente.</p>
      </div>
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <i class="fas fa-users feature-icon"></i>
        <h3>Comunidad Activa</h3>
        <p>Únete a una comunidad de emprendedores que comparten tus objetivos y desafíos.</p>
      </div>
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <i class="fas fa-shield-alt feature-icon"></i>
        <h3>Seguridad y Confianza</h3>
        <p>Tu información está segura con nosotros. Priorizamos la confianza y la transparencia.</p>
      </div>
    </div>
  </section>

  <!-- Emprendimiento -->
  <section id="emprendimiento" class="container my-5">
    <h2 class="section-title" data-aos="fade-right">Emprendimiento</h2>
    <p data-aos="fade-left">En Launchix, brindamos las herramientas y el soporte necesario para ayudar a los emprendedores a hacer crecer su negocio. Descubre historias inspiradoras, videos educativos y cursos diseñados para impulsar tu éxito.</p>

    <!-- Historias de Éxito -->
    <div class="row mb-5">
      <h3 class="mb-4" data-aos="fade-right">Historias de Éxito</h3>
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <div class="card h-100">
          <img src="juanperez.jpg" alt="Historia 1" class="card-img-top img-fluid">
          <div class="card-body">
            <h5 class="card-title">Historia de Juan Pérez</h5>
            <p class="card-text">Juan Pérez comenzó su negocio con Launchix y ahora vende sus productos en todo el país.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <div class="card h-100">
          <img src="marialopez.jpg" alt="Historia 2" class="card-img-top img-fluid">
          <div class="card-body">
            <h5 class="card-title">Historia de María López</h5>
            <p class="card-text">María López utilizó nuestras herramientas de marketing para aumentar sus ventas un 200%.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <div class="card h-100">
          <img src="carlosgomez.jpg" alt="Historia 3" class="card-img-top img-fluid">
          <div class="card-body">
            <h5 class="card-title">Historia de Carlos Gómez</h5>
            <p class="card-text">Carlos Gómez encontró en Launchix la plataforma ideal para expandir su negocio local.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Videos Educativos -->
    <div class="row mb-5">
      <h3 class="mb-4" data-aos="fade-right">Videos Educativos</h3>
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <div class="card h-100">
          <div class="video-container">
            <iframe src="https://www.youtube.com/embed/I0wFA4WNxnc" frameborder="0" allowfullscreen></iframe>
          </div>
          <div class="card-body text-center">
            <h5 class="card-title">Cómo Empezar tu Negocio</h5>
            <p class="card-text">Aprende los pasos básicos para iniciar tu propio negocio con éxito.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <div class="card h-100">
          <div class="video-container">
            <iframe src="https://www.youtube.com/embed/qNeemzXJQUc" frameborder="0" allowfullscreen></iframe>
          </div>
          <div class="card-body text-center">
            <h5 class="card-title">Estrategias de Marketing Digital</h5>
            <p class="card-text">Descubre cómo utilizar el marketing digital para impulsar tu negocio.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <div class="card h-100">
          <div class="video-container">
            <iframe src="https://www.youtube.com/embed/iBulhCtSgzA" frameborder="0" allowfullscreen></iframe>
          </div>
          <div class="card-body text-center">
            <h5 class="card-title">Gestión Financiera para Emprendedores</h5>
            <p class="card-text">Aprende a manejar las finanzas de tu negocio de manera efectiva.</p>
          </div>
        </div>
      </div>
    </div>


   <div class="container my-5">
  <h3 class="fw-bold mb-4 text-center" data-aos="fade-right">Cursos</h3>

  <div class="row justify-content-center gap-3">

    <!-- Curso 1 -->
    <div class="card col-md-3 p-0 shadow-sm rounded" data-aos="fade-up">
      <a href="curso-emprendimiento.html">
        <img src="FAUSTO.jpg" alt="Curso de Emprendimiento" class="card-img-top img-fluid">
      </a>
      <div class="card-body">
        <h5 class="card-title fw-bold">Curso de Emprendimiento</h5>
        <p class="card-text">Aprende a desarrollar tu idea de negocio desde cero.</p>
      </div>
    </div>

    

    <!-- Curso 2 -->
    <div class="card col-md-3 p-0 shadow-sm rounded" data-aos="fade-up">
      <a href="curso-marketing.html">
        <img src="kikos.jpg" alt="Curso de Marketing Digital" class="card-img-top img-fluid">
      </a>
      <div class="card-body">
        <h5 class="card-title fw-bold">Curso de Marketing Digital</h5>
        <p class="card-text">Domina las estrategias de marketing digital para atraer más clientes.</p>
      </div>
    </div>

    <!-- Curso 3 -->
    <div class="card col-md-3 p-0 shadow-sm rounded" data-aos="fade-up">
      <a href="curso-finanzas.html">
        <img src="KILOS.webp" alt="Curso de Gestión Financiera" class="card-img-top img-fluid">
      </a>
      <div class="card-body">
        <h5 class="card-title fw-bold">Curso de Gestión Financiera</h5>
        <p class="card-text">Mejora tus habilidades financieras para gestionar mejor tu negocio.</p>
      </div>
    </div>

  </div>
</div>
  </aside>
  </section>


</main>

@endsection