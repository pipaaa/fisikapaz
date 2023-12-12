<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $name = $_POST["name"];

    // Otros campos del formulario

    // Almacena los datos en un archivo o base de datos en el servidor
    // Aquí, simplemente se muestra la información
    echo "Compra confirmada: Nombre: $name";
} else {
    // Redireccionar si se intenta acceder directamente al script
    header("Location: index.html");
}
?>
