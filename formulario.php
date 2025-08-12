<?php
// Verificamos si se ha enviado el formulario usando POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Capturamos los datos del formulario y los almacenamos en un array asociativo
    $usuario = [
        "nombre" => $_POST["nombre"] ?? '',   // Si no hay valor, se asigna una cadena vacía
        "edad" => $_POST["edad"] ?? '',
        "correo" => $_POST["correo"] ?? ''
    ];

    // Mostramos los datos recibidos en una sección Bootstrap
    echo '<div class="container mt-4">';
    echo "<h3>✅ Datos recibidos:</h3>";
    echo "<pre>";
    print_r($usuario); // Imprime el array de forma legible
    echo "</pre>";
    echo '</div>';
}
?>

<!-- HTML con estilos Bootstrap -->
<!DOCTYPE html>
<html>
<head>
    <title>Formulario con Bootstrap y PHP</title>

    <!-- Vinculamos Bootstrap 5 desde CDN (en línea) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"><!-- Fondo gris claro -->

<!-- Contenedor principal -->
<div class="container mt-5">
    
    <!-- Tarjeta de Bootstrap para estilizar el formulario -->
    <div class="card shadow"><!-- Sombra suave -->
        
        <!-- Encabezado de la tarjeta con color azul -->
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Formulario de Registro</h4>
        </div>
        
        <!-- Cuerpo del formulario -->
        <div class="card-body">
            <form method="POST"><!-- Envío de datos al mismo archivo -->
                
                <!-- Campo de nombre -->
                <div class="mb-3">
                    <label class="form-label">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <!-- Campo de edad -->
                <div class="mb-3">
                    <label class="form-label">Edad:</label>
                    <input type="number" name="edad" class="form-control" required>
                </div>

                <!-- Campo de correo electrónico -->
                <div class="mb-3">
                    <label class="form-label">Correo:</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="btn btn-success">Enviar</button>

            </form>
        </div>
    </div>
</div>

</body>
</html>
