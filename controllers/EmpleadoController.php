<?php
session_start();
include "../models/Empleado.php";

$empleado = new Empleado();
$action = $_GET['action'] ?? '';

try {
    if ($action === 'create' || $action === 'update') {
        // Validaciones
        $nombre      = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $area_id     = $_POST['area_id'] ?? '';
        $rol_id      = $_POST['rol_id'] ?? '';
        $sexo      = $_POST['sexo'] ?? '';
        $boletin      = isset($_POST['boletin']) ? 1 : 0;
        $email      = trim($_POST['email']);

        $regexNombre = "/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/u";

        if (!preg_match($regexNombre, $nombre)) throw new Exception("El nombre solo puede contener letras");
        if (strlen($descripcion) < 10) throw new Exception("La descripción debe tener al menos 10 caracteres");
        if (empty($area_id)) throw new Exception("Debe seleccionar un área");
        if (empty($rol_id)) throw new Exception("Debe seleccionar un rol");
        if (empty($sexo)) throw new Exception("Debe seleccionar un género");
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception("El correo no es válido");

        $data = [
            'nombre'      => $nombre,
            'descripcion' => $descripcion,
            'area_id'     => $area_id,
            'rol_id'      => $rol_id,
            'sexo'        => $sexo,
            'boletin'     => $boletin,
            'email'       => $email
        ];

        if ($action === 'create') {
            $empleado->create($data);
            $_SESSION['success'] = "✅ Empleado registrado correctamente";
        } else {
            $id = intval($_GET['id']);
            $empleado->update($id, $data);
            $_SESSION['success'] = "✅ Empleado actualizado correctamente";
        }

        header("Location: ../index.php");
        exit();
    }

    if ($action === 'delete') {
        $id = intval($_GET['id']);
        if ($id <= 0) throw new Exception("ID inválido para eliminar");

        $empleado->delete($id);
        $_SESSION['success'] = "🗑️ Empleado eliminado correctamente";

        header("Location: ../index.php");
        exit();
    }

} catch (Exception $e) {
    // Guardar datos para que no se pierdan
    $_SESSION['error'] = "❌ " . $e->getMessage();
    $_SESSION['old'] = $_POST; 

    // Si es update, redirigimos con id
    if ($action === 'update') {
        header("Location: ../form.php?id=" . intval($_GET['id']));
    } else {
        header("Location: ../form.php");
    }
    exit();
}
