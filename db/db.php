<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../index.html");
    exit();
}

$nombre   = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$fecha    = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
$hora     = isset($_POST['hora']) ? trim($_POST['hora']) : '';
$mensaje  = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';

$errores = array();

if (strlen($nombre) < 2) {
    $errores[] = "El nombre debe tener al menos 2 caracteres.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El formato del correo electrónico no es válido.";
}

if (strlen($mensaje) < 10) {
    $errores[] = "El mensaje es demasiado corto (mínimo 10 caracteres).";
}

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $nombreArchivo = $_FILES['file']['name'];
    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    $extensionesPermitidas = array("pdf", "docx");

    if (!in_array($extension, $extensionesPermitidas)) {
        $errores[] = "El archivo adjunto no es válido. Solo se permiten formatos PDF o DOCX.";
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando Formulario - Vicente Arce</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #232020;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }
        .contenedor {
            background: #d9fc8c;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            max-width: 600px;
            width: 100%;
            border: 2px solid #232020;
        }
        h1 {
            color: #d51a1a;
            text-align: center;
            margin-top: 0;
            border-bottom: 2px solid #232020;
            padding-bottom: 15px;
        }
        .error-box {
            background-color: #ffffff;
            border-left: 5px solid #d51a1a;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .error-item {
            color: #d51a1a;
            margin: 5px 0;
            font-weight: bold;
        }
        .success-box {
            background-color: #ffffff;
            border-left: 5px solid green;
            padding: 15px;
            border-radius: 4px;
            line-height: 1.6;
        }
        .btn-volver {
            display: block;
            width: 180px;
            margin: 25px auto 0 auto;
            padding: 12px;
            background-color: #232020;
            color: #d9fc8c;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            transition: background 0.2s;
        }
        .btn-volver:hover {
            background-color: #d51a1a;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <div class="contenedor">
        
        <?php if (count($errores) > 0): ?>
            <h1>Error en la Validación</h1>
            <div class="error-box">
                <p>El servidor ha detectado los siguientes problemas con tus datos:</p>
                <?php foreach ($errores as $error): ?>
                    <p class="error-item">• <?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h1>    Validación de Servidor Correcta</h1>
            <div class="success-box">
                <p><strong>¡Los datos introducidos son válidos!</strong></p>
                <hr>
                <strong>Nombre completo:</strong> <?php echo htmlspecialchars($nombre . " " . $apellido); ?><br>
                <strong>Email:</strong> <?php echo htmlspecialchars($email); ?><br>
                <?php if(!empty($telefono)): ?> <strong>Teléfono:</strong> <?php echo htmlspecialchars($telefono); ?><br> <?php endif; ?>
                <?php if(!empty($fecha)): ?> <strong>Fecha de envío sugerida:</strong> <?php echo htmlspecialchars($fecha . " a las " . $hora); ?><br> <?php endif; ?>
                <strong>Mensaje introducido:</strong><br>
                <em><?php echo nl2br(htmlspecialchars($mensaje)); ?></em>
            </div>
        <?php endif; ?>

        <a href="../index.html#contacto" class="btn-volver">Volver Atrás</a>
        
    </div>

</body>
</html>