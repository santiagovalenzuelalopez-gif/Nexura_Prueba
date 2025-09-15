<?php
require_once __DIR__ . '/models/Empleado.php';
$empleado = new Empleado();

// eliminar
if (isset($_GET['delete'])) {
    $empleado->delete((int)$_GET['delete']);
    header("Location: index.php");
    exit;
}

// listar
$empleados = $empleado->all();
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Empleados</title>
<link rel="stylesheet" href="assets/css/styles.css">
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
</body>
</html>

