<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Estudiantes</title>
    <style>
        /* Estilo general del cuerpo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #2c3e50;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Estilo del contenedor del formulario */
        .form-container {
            background-color: #ffffff;
            padding: 40px 50px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            border: 2px solid #3498db;
        }

        /* Estilo del título */
        h2 {
            text-align: center;
            color: #2980b9;
            margin-bottom: 20px;
        }

        /* Estilo de las etiquetas */
        label {
            display: block;
            margin-bottom: 8px;
            color: #000;
            font-weight: bold;
        }

        /* Estilo de los campos de entrada */
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Estilo del botón de envío */
        input[type="submit"] {
            background-color: #e67e22;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        /* Efecto hover en el botón de envío */
        input[type="submit"]:hover {
            background-color: #1f6391;
        }

        /* Estilo del botón Ver Estudiantes */
        .view-students {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 15px; /* Tamaño más pequeño */
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px; /* Tamaño de texto más pequeño */
            transition: background-color 0.3s ease;
            margin-top: 20px; /* Separación entre los botones */
            width: 100%; /* Hacerlo del mismo ancho */
        }

        /* Efecto hover en el botón Ver Estudiantes */
        .view-students:hover {
            background-color: #1f6391;
        }

        /* Mensaje de confirmación */
        h3 {
            color: #2c3e50;
            text-align: center;
        }

        /* Para el contenedor de los datos recibidos */
        .data-container {
            margin-top: 20px;
            padding: 20px;
            background-color: #3498db;
            color: #fff;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Formulario de Estudiantes</h2>

        <?php
        // Verificar si se enviaron los datos
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recoger los datos enviados
            $nombre = $_POST['nombre'] ?? '';
            $carnet = $_POST['carnet'] ?? '';
            $carrera = $_POST['carrera'] ?? '';

            // Mostrar los datos recogidos
            echo "<div class='data-container'>";
            echo "<h3>Datos recibidos:</h3>";
            echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
            echo "Carnet: " . htmlspecialchars($carnet) . "<br>";
            echo "Carrera: " . htmlspecialchars($carrera) . "<br>";
            echo "</div>";
        }
        ?>

        <form method="post" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="carnet">Carnet:</label>
            <input type="text" id="carnet" name="carnet" required>

            <label for="carrera">Carrera:</label>
            <input type="text" id="carrera" name="carrera" required>

            <input type="submit" value="Enviar">
        </form>

        <!-- Botón Ver Estudiantes con margen superior para separarlo -->
        <form method="get" action="ver_estudiante.php">
            <button type="submit" class="view-students">Ver Estudiantes</button>
        </form>
    </div>

</body>
</html>
