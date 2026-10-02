<?php
session_start();
require 'socios.php';

if (isset($_SESSION['email_socio'])) {
    header('Location: cuenta.php');
    exit;
}

$error = '';
$email = '';
$clave = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $clave = $_POST['clave'] ?? '';

    $socioEncontrado = null;
    foreach ($socios as $s) {
        if ($s['email'] === $email) {
            $socioEncontrado = $s;
            break;
        }
    }

    if ($socioEncontrado && password_verify($clave, $socioEncontrado['clave'])) {
        session_regenerate_id(true);
        $_SESSION['email_socio'] = $email;
        header('Location: cuenta.php');
        exit;
    } else {
        $error = 'Email o contraseña incorrectos.';
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#284b3e">
    <meta name="description" content="Inicia sesión en tu cuenta de Clínica Veterinaria Buenavista.">
    <title>Iniciar sesión | Buenavista</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="login-page">
    <main class="login-layout">
        <section class="login-visual" aria-label="Bienvenida a Clínica Veterinaria Buenavista">
            <a class="brand login-brand" href="index.php" aria-label="Buenavista, volver al inicio"><span
                    class="brand-mark" aria-hidden="true">b.</span><span class="brand-name">buenavista<span>CLÍNICA
                        VETERINARIA</span></span></a>
            <div class="login-visual-copy">
                <p class="login-kicker">CUIDADO CON CALMA, SIEMPRE</p>
                <h1>Su familia<br>también es<br>la nuestra.</h1>
                <p>Un espacio para acompañarlos en cada etapa.</p>
            </div>
            <a class="login-back-link" href="index.php">← Volver al sitio</a>
        </section>
        <section class="login-panel" aria-labelledby="login-title">
            <div class="login-topline"><span>¿PRIMERA VEZ?</span><a href="mailto:hola@clinicabuenavista.mx">Contáctanos
                    <span aria-hidden="true">↗</span></a></div>
            <div class="login-content">
                <p class="eyebrow"><span class="eyebrow-dot"></span> TU ESPACIO BUENAVISTA</p>
                <h2 id="login-title">Qué gusto<br>verte <em>de nuevo.</em></h2>
                <p class="login-description">Inicia sesión para continuar a tu cuenta.</p>
                <?php if ($error): ?>
                    <p class="login-error"><?php echo htmlspecialchars($error); ?></p>
                
                
                    <?php endif; ?>




                <form class="login-form" action="#" method="post" autocomplete="on">
                    <div class="login-field"><label for="email">Correo electrónico</label><input id="email" name="email"
                            type="email" autocomplete="username" placeholder="tu@correo.com" required></div>
                    <div class="login-field"><label for="password">Contraseña</label><input id="password"
                            name="clave" type="password" autocomplete="current-password"
                            placeholder="Ingresa tu contraseña" required></div>
                    <div class="login-options"><label class="remember-option" for="remember"><input id="remember"
                                name="remember" type="checkbox"><span>Recordarme</span></label><a
                            href="mailto:hola@clinicabuenavista.mx?subject=Recuperar%20contrase%C3%B1a">¿Olvidaste tu
                            contraseña?</a></div>
                    <button class="button button-dark login-submit" type="submit">Iniciar sesión <span
                            aria-hidden="true">↗</span></button>
                </form>
                <p class="login-help">¿Necesitas ayuda? <a href="mailto:hola@clinicabuenavista.mx">Escríbenos</a></p>
            </div>
            <p class="login-footer">© 2026 Buenavista · Cuidado para toda la familia</p>
        </section>
    </main>
</body>

</html>