<?php
// Recoger los datos enviados mediante POST
$nombre = $_POST["nombre"] ?? "";
$correo = $_POST["correo"] ?? "";
$actividad = $_POST["nivel"] ?? ""; // Corregido: en el HTML es name="nivel"
$turno = $_POST["turno"] ?? "";
$observaciones = $_POST["observaciones"] ?? "";

// Las casillas no marcadas no se envían en el formulario
$portatil = isset($_POST["portatil"]);
$auriculares = isset($_POST["auriculares"]);
$escritura = isset($_POST["escritura"]);

// Evitar insertar directamente datos del usuario en el HTML
function limpiar($dato) {
    return htmlspecialchars(trim($dato), ENT_QUOTES, "UTF-8");
}

// Traducir el código del turno a un texto descriptivo
$turnos = [
    "morning"   => "Horario de mañanas",   // Corregido para que coincida con el value del HTML
    "afternoon" => "Horario de tardes",    // Corregido para que coincida con el value del HTML
];

$nombreTurno = $turnos[$turno] ?? "No especificado";

// Traducir la actividad a un texto descriptivo
$actividades = [
    "1" => "Robótica",
    "2" => "Desarrollo de videojuegos",
    "3" => "Ciberseguridad",
    "4" => "Diseño e impresión 3D",
];

$nombreActividad = $actividades[$actividad] ?? "No especificado";

$precios = [
    "portatil"    => 100,
    "auriculares" => 10,
    "escritura"   => 2
];

$totalMateriales = 0;

if ($portatil) {
    $totalMateriales += $precios["portatil"];
}
if ($auriculares) {
    $totalMateriales += $precios["auriculares"];
}
if ($escritura) {
    $totalMateriales += $precios["escritura"];
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos recibidos</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <div class="contenedor">

        <h1>Datos recibidos</h1>

        <p class="descripcion">
            El servidor ha recibido los datos enviados desde el formulario.
        </p>

        <div class="resultado">

            <div class="dato">
                <span class="etiqueta">Nombre y apellidos:</span>
                <span><?= limpiar($nombre) ?></span>
            </div>

            <div class="dato">
                <span class="etiqueta">Correo electrónico:</span>
                <span><?= limpiar($correo) ?></span>
            </div>

            <div class="dato">
                <span class="etiqueta">Actividad:</span>
                <span><?= limpiar($nombreActividad) ?></span>
            </div>

            <div class="dato">
                <span class="etiqueta">Turno:</span>
                <span><?= limpiar($nombreTurno) ?></span>
            </div>

            <div class="dato">
                <span class="etiqueta">Material:</span>
                <?php if (!$portatil && !$auriculares && !$escritura): ?>
                        Sin material adicional
                    <?php else: ?>
                        <?= $portatil ? "Dispone de portátil (" . $precios["portatil"] . "€)" : "" ?>
                        <?= $auriculares ? "Dispone de auriculares (" . $precios["auriculares"] . "€)" : "" ?>
                        <?= $escritura ? "Dispone de material de escritura (" . $precios["escritura"] . "€)" : "" ?>
                    <?php endif; ?>
            </div>

            <div class="dato">
                <span class="etiqueta">Total materiales:</span>
                <span style="font-weight: bold; color: #2c3e50;"><?= $totalMateriales ?>€</span>
            </div>

            <?php if (!empty(trim($observaciones))): ?>
            <div class="dato">
                <span class="etiqueta">Observaciones:</span>
                <span><?= limpiar($observaciones) ?></span>
            </div>
            <?php endif; ?>

        </div>

        <div class="botones">
            <a href="index.html" class="boton-enlace">
                Volver al formulario
            </a>
        </div>

        <p class="nota">
            Esta página se ha generado en el servidor mediante PHP.
        </p>

    </div>

</body>
</html>
