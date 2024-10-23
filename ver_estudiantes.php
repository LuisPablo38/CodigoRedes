<?php
// Conectar a la base de datos
$servername = "192.168.58.139";  // Cambia a tu servidor
$username = "conexion_remota";     // Cambia a tu usuario
$password = "Landivar123$";  // Cambia a tu contraseña
$dbname = "Estudiante"; // Cambia a tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario si se han enviado datos desde index.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $carnet = $_POST['carnet'] ?? '';
    $carrera = $_POST['carrera'] ?? '';

    // Validar que el carnet no tenga más de 15 caracteres
    if (strlen($carnet) > 15) {
        echo "El carnet no puede tener más de 15 dígitos.";
        exit;
    }

    // Insertar los datos en la base de datos
    $stmt = $conn->prepare("INSERT INTO estudiantes (nombre, apellido, carnet, carrera) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $apellido, $carnet, $carrera);
    
    if ($stmt->execute()) {
        echo "Estudiante ingresado con éxito.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            border: 2px solid #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        td {
            text-align: center;
        }

        .back-button {
            margin-top: 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #1f6391;
        }
    </style>
</head>
<body>

    <div class="table-container">
        <h2>Lista de Estudiantes</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Carnet</th>
                <th>Carrera</th>
                <th>Acción</th>
            </tr>

            <?php
            // Obtener los estudiantes de la base de datos
            $sql = "SELECT nombre, apellido, carnet, carrera FROM estudiantes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Mostrar los datos de cada fila
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["nombre"]) . "</td>
                            <td>" . htmlspecialchars($row["apellido"]) . "</td>
                            <td>" . htmlspecialchars($row["carnet"]) . "</td>
                            <td>" . htmlspecialchars($row["carrera"]) . "</td>
                            <td><button>Editar</button></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay estudiantes registrados</td></tr>";
            }

            $conn->close();
            ?>
        </table>

        <form action="index.php">
            <button type="submit" class="back-button">Regresar</button>
        </form>
    </div>

</body>
</html>
