<?php 
session_start(); // Inicia la sesión para acceder a variables como $_SESSION['usuario']
require_once("conexion.php"); // Incluye el archivo de conexión a la base de datos
$conn = conect(); // Establece la conexión

// Verifica si se recibió una petición POST (formulario enviado que proviene de vistas/comentarios.php)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar datos del formulario
    $destino_id = isset($_POST['destino']) ? intval($_POST['destino']) : 0;
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
    $comentario_texto = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';

    $usuario_id = $_SESSION['usuario'];// Obtener el ID del usuario desde la sesión
    
    // Validamos los campos obligatorios
    if ($destino_id === 0 || $rating < 1 || $rating > 5) {
        $_SESSION['mensaje'] = [
            'tipo' => 'warning',
            'texto' => 'Por favor completa todos los campos obligatorios'
        ];
        header("Location: ../index.php?vista=comentarios");
        exit;
    }
    
    try {
        $conn->begin_transaction();// Inicia una transacción para garantizar integridad
        
        // 1. Obtener datos del destino: su ID y la provincia correspondiente
        $sql_destino = "SELECT Id_destino, PROVINCIA_Id_provincia FROM DESTINO_TURISTICO WHERE Id_destino = ?";
        $stmt_destino = $conn->prepare($sql_destino);
        $stmt_destino->bind_param("i", $destino_id);
        $stmt_destino->execute();
        $resultado_destino = $stmt_destino->get_result();
        
        // Si el destino no existe, lanza un error
        if ($resultado_destino->num_rows == 0) {
            throw new Exception("Destino no encontrado");
        }
        
        // Guarda los datos del destino y cierra el statement
        $destino_data = $resultado_destino->fetch_assoc();
        $destino_id = $destino_data['Id_destino'];
        $provincia_id = $destino_data['PROVINCIA_Id_provincia'];
        $stmt_destino->close();
        
        // 2. Verificar si el usuario ya valoró ese destino (para no permitir duplicados)
        $sql_check = "SELECT COUNT(*) as total FROM Valoracion WHERE USUARIO_idUSUARIO = ? AND DESTINO_TURISTICO_Id_destino = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("ii", $usuario_id, $destino_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $check_data = $result_check->fetch_assoc();
        $stmt_check->close();
        
        // Si ya existe una valoración, se cancela la operación
        if ($check_data['total'] > 0) {
            throw new Exception("Ya has valorado este destino anteriormente");
        }
        
        // 3. Insertar comentario (solo si el texto no está vacío)
        if (!empty($comentario_texto)) {
            $sql_comentario = "INSERT INTO COMENTARIO (
                COMENTARIO_caracteres, 
                COMENTARIO_num_Likes, 
                USUARIO_idUSUARIO, 
                DESTINO_TURISTICO_Id_destino, 
                DESTINO_TURISTICO_PROVINCIA_Id_provincia
            ) VALUES (?, 0, ?, ?, ?)";
            
            $stmt_comentario = $conn->prepare($sql_comentario);
            $stmt_comentario->bind_param("siii", $comentario_texto, $usuario_id, $destino_id, $provincia_id);
            
            // Si falla la inserción del comentario, lanza una excepción
            if (!$stmt_comentario->execute()) {
                throw new Exception("Error al insertar comentario: " . $stmt_comentario->error);
            }

            $stmt_comentario->close();
        }
        
        // 4. Insertar valoración del destino
        $sql_valoracion = "INSERT INTO Valoracion (
            puntaje, 
            acumulacion_puntaje, 
            DESTINO_TURISTICO_Id_destino, 
            DESTINO_TURISTICO_PROVINCIA_nombre_provincia, 
            USUARIO_idUSUARIO
        ) VALUES (?, ?, ?, ?, ?)";
        
        $stmt_valoracion = $conn->prepare($sql_valoracion);

        // Por ahora, acumulación = puntaje (lo voy a ajustar mas adelante)
        $stmt_valoracion->bind_param("iiiii", $rating, $rating, $destino_id, $provincia_id, $usuario_id);
        
        if (!$stmt_valoracion->execute()) {
            throw new Exception("Error al insertar valoración: " . $stmt_valoracion->error);
        }

        $stmt_valoracion->close();
        
        // Confirma toda la transacción si todo salió bien
        $conn->commit();
        
        // Guardar mensaje de éxito en sesión
        $_SESSION['mensaje'] = '
        <div class="notification is-success is-light">
            <strong>¡Comentario agregado!</strong><br>
            Los cambios se guardaron correctamente.
        </div>
        ';
        
        // Redirigir a la vista de comentarios
        header("Location: ../index.php?vista=comentarios");
        exit;
        
    } catch (Exception $e) {
        // Si algo falla, se hace rollback de la transacción
        $conn->rollback();

        // Guarda mensaje de error
        $_SESSION['mensaje'] = '
        <div class="notification is-danger is-light">
            <strong>¡Error!</strong><br>
            ' . htmlspecialchars($e->getMessage()) . '
        </div>
        ';
        
        header("Location: ../index.php?vista=comentarios");
        exit;
    }

    // Cierra la conexión
    $conn->close();
} else {
    // Si no es una solicitud POST, redirige fuera del archivo directamente
    header("Location: ../comentarios.php");
    exit;
}
?>
