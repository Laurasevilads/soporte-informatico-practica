<?php
session_start();
require 'socios.php';

if (!isset($_SESSION['email_socio'])) {
    header('Location: login.php');
    exit;
}

$emailActual = $_SESSION['email_socio'];
$socioActual = null;

foreach ($socios as $s) {
    if ($s['email'] === $emailActual) {
        $socioActual = $s;
        break;
    }
}

if (!$socioActual) {
    session_destroy();
    header('Location: login.php');
    exit;
}

$nombreSocio = htmlspecialchars($socioActual['nombre']);
$tipoCuota = htmlspecialchars(ucfirst($socioActual['tipoCuota']));
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f7f5ef">
    <meta name="description" content="Tu espacio de cuidado en Clínica Veterinaria Buenavista.">
    <title>Mi espacio | Buenavista</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="account-page">
    <header class="site-header account-header">
        <a class="brand" href="index.php" aria-label="Buenavista, inicio"><span class="brand-mark"
                aria-hidden="true">b.</span><span class="brand-name">buenavista<span>CLÍNICA
                    VETERINARIA</span></span></a>
        <nav class="account-nav" aria-label="Navegación de cuenta">
            <a href="index.php">Volver al sitio</a>
            <a class="header-cta" href="logout.php">Cerrar sesión <span aria-hidden="true">↗</span></a>
        </nav>
    </header>

    <main class="account-main">
        <section class="account-welcome" aria-labelledby="account-title">
            <div>
                <p class="eyebrow"><span class="eyebrow-dot"></span> TU ESPACIO BUENAVISTA</p>
                <h1 id="account-title">Hola, <?php echo $nombreSocio; ?><br>todo para cuidar<br>de <em>quien quieres.</em></h1>
                <p class="account-description">Consulta aquí la información y el cuidado de tu familia.</p>
            </div>
            <p class="account-demo-note">Cuenta activa<br>Cuota: <?php echo $tipoCuota; ?></p>
        </section>

        <div class="account-grid">
            <section class="account-section" aria-labelledby="appointments-title">
                <div class="account-section-heading">
                    <div>
                        <p class="account-label">AGENDA</p>
                        <h2 id="appointments-title">Próximas citas</h2>
                    </div>
                    <span class="account-count">0</span>
                </div>
                <div class="account-empty">
                    <span class="empty-symbol" aria-hidden="true">＋</span>
                    <h3>Aún no hay citas</h3>
                    <p>Llámanos y con gusto buscamos el mejor momento para verlos.</p>
                    <a class="button button-dark" href="tel:+525555555555">Solicitar una cita <span
                            aria-hidden="true">↗</span></a>
                </div>
            </section>

            <section class="account-section" aria-labelledby="pets-title">
                <div class="account-section-heading">
                    <div>
                        <p class="account-label">SU HISTORIA</p>
                        <h2 id="pets-title">Mis mascotas</h2>
                    </div>
                </div>
                <div class="account-empty pet-empty">
                    <span class="pet-mark" aria-hidden="true">b.</span>
                    <h3>Este espacio es para ellos</h3>
                    <p>Cuando nos visites, podremos ayudarte a llevar el seguimiento de su cuidado.</p>
                    <a class="text-link"
                        href="mailto:hola@clinicabuenavista.mx?subject=Registrar%20a%20mi%20mascota">Contactar a la
                        clínica <span aria-hidden="true">↗</span></a>
                </div>
            </section>
        </div>

        <section class="account-contact" aria-label="Contacto de la clínica">
            <div>
                <p class="account-label">ESTAMOS PARA AYUDARTE</p>
                <p>¿Tienes alguna duda sobre su cuidado?</p>
            </div>
            <a href="tel:+525555555555">55 5555 5555 <span aria-hidden="true">↗</span></a>
        </section>
    </main>

    <footer class="site-footer account-footer">
        <a class="brand footer-brand" href="index.php" aria-label="Buenavista, volver al inicio"><span
                class="brand-mark" aria-hidden="true">b.</span><span class="brand-name">buenavista<span>CLÍNICA
                    VETERINARIA</span></span></a>
        <span class="footer-message">Con cariño, para toda la familia.</span>
        <a class="back-top" href="#account-title">Volver arriba <span aria-hidden="true">↑</span></a>
        <span class="copyright">© 2026 Buenavista</span>
    </footer>
</body>

</html>