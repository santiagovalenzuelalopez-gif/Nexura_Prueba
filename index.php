<?php
require_once __DIR__ . '/models/Empleado.php';
$empleado = new Empleado();

// eliminar
if (isset($_GET['delete'])) {
    $empleado->delete((int)$_GET['delete']);
    header("Location: index.php");
    exit;
}
session_start();
require_once "models/Empleado.php";

// listar
$empleado = new Empleado();
$empleados = $empleado->all();

?>
<!doctype html>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Empleados</title>
<link rel="stylesheet" href="assets/css/styles.css">
  <meta charset="UTF-8">
  <title>Gestión de Empleados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    td.nombre-col{ white-space: nowrap; }
  </style>
</head>
<body>
<h1>Empleados</h1>
<a href="form.php">Crear nuevo empleado</a>
<table>
<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Sexo</th><th>Área</th><th>Boletín</th><th>Acciones</th></tr>
<?php foreach($empleados as $e): ?>
<tr>
  <td><?= $e['id'] ?></td>
  <td><?= htmlspecialchars($e['nombre']) ?></td>
  <td><?= htmlspecialchars($e['email']) ?></td>
  <td><?= $e['sexo'] ?></td>
  <td><?= htmlspecialchars($e['area_nombre']) ?></td>
  <td><?= $e['boletin'] ? 'Sí':'No' ?></td>
  <td>
    <a href="form.php?id=<?= $e['id'] ?>">Editar</a> |
    <a href="index.php?delete=<?= $e['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
  </td>
</tr>
<?php endforeach; ?>
</table>
<body class="bg-light">

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lista de Empleados</h2>
    <a href="form.php" class="btn btn-primary" >+ Nuevo Empleado</a>
  </div>

  <!-- Mensajes de sesión -->
  <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
  <?php endif; ?>
  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
  <?php endif; ?>

  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>Correo</th>
            <th>Boletin</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($empleados) > 0): ?>
            <?php foreach ($empleados as $emp): ?>
              <tr>
                <td><?= $emp['id'] ?></td>
                <td class="nombre-col"><?= htmlspecialchars(str_replace(["\r", "\n"], ' ', $emp['nombre'])) ?></td>
                <td><?= htmlspecialchars($emp['area_nombre']) ?></td>
                <td><?= htmlspecialchars($emp['email']) ?></td>
                <td>
                  <?php if ($emp['boletin']): ?>
                    <span class="badge bg-success">Si</span>
                  <?php else: ?>
                    <span class="badge bg-secondary">No</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="form.php?id=<?= $emp['id'] ?>" class="btn btn-sm btn-warning">✏️ Editar</a>
                  <a href="controllers/EmpleadoController.php?action=delete&id=<?= $emp['id'] ?>"
                     class="btn btn-sm btn-danger" 
                     onclick="return confirm('¿Seguro que quieres eliminar a <?= htmlspecialchars($emp['nombre']) ?>?')">🗑️ Eliminar</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="7" class="text-center">No hay empleados registrados</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>

