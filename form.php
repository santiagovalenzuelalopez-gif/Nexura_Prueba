<?php
require_once __DIR__ . '/models/Empleado.php';
$empleado = new Empleado();

$id = $_GET['id'] ?? null;
$emp = $id ? $empleado->find($id) : null;
$empRoles = $id ? $empleado->getRolesByEmpleado($id) : [];

// guardar
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $data = $_POST;
    if ($id) $empleado->update($id,$data);
    else $empleado->create($data);
    header("Location: index.php");
    exit;
}

// cargar áreas y roles
$areas = $empleado->allAreas();
$roles = $empleado->allRoles();
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?= $id ? "Editar":"Crear" ?> empleado</title>
<link rel="stylesheet" href="assets/css/styles.css">
<script src="assets/js/validation.js" defer></script>
</head>
<body>
<h1><?= $id ? "Editar":"Crear" ?> empleado</h1>


<form id="empleadoForm" method="post">
  <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($emp['nombre'] ?? '') ?>"></label>
  <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($emp['email'] ?? '') ?>"></label>
  <label>Sexo:
    <input type="radio" name="sexo" value="M" <?= ($emp['sexo']??'')==='M'?'checked':'' ?>> M
    <input type="radio" name="sexo" value="F" <?= ($emp['sexo']??'')==='F'?'checked':'' ?>> F
  </label>
  <label>Área:
    <select name="area_id">
      <option value="">--Selecciona--</option>
      <?php foreach($areas as $a): ?>
        <option value="<?= $a['id'] ?>" <?= ($emp['area_id']??'')==$a['id']?'selected':'' ?>>
          <?= htmlspecialchars($a['nombre']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>
    </label>
  <label>Rol:
    <select name="rol_id">
      <option value="">--Selecciona--</option>
      <?php foreach($roles as $r): ?>
        <option value="<?= $r['id'] ?>" <?= in_array($r['id'], $empRoles) ? 'selected' : '' ?>>
            <?= htmlspecialchars($r['nombre']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Boletín: <input type="checkbox" name="boletin" <?= ($emp['boletin']??0)?'checked':'' ?>></label>
  <label>Descripción:<br>
    <textarea name="descripcion"><?= htmlspecialchars($emp['descripcion'] ?? '') ?></textarea>
  </label>
  <button type="submit">Guardar</button>
  <a href="index.php">Volver</a>
</form>
</body>
</html>
