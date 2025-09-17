<?php
require_once __DIR__ . '/models/Empleado.php';
$empleado = new Empleado();
session_start();
require_once "models/Empleado.php";

// Cargar valores previos si hubo error
$old = $_SESSION['old'] ?? [];
unset($_SESSION['old']); // limpiar después de usarlos

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
$empleadoObj = new Empleado();
$empleado = null;
$isEdit = false;
$empRoles = $id ? $empleadoObj->getRolesByEmpleado($id) : [];


// Si hay ID, estamos en modo edición
if (isset($_GET['id'])) {
    $empleado = $empleadoObj->find($_GET['id']);
    $isEdit = true;
}

// cargar áreas y roles
$areas = $empleado->allAreas();
$roles = $empleado->allRoles();
$areas = $empleadoObj->allAreas();
$roles = $empleadoObj->allRoles();



?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?= $id ? "Editar":"Crear" ?> empleado</title>
<link rel="stylesheet" href="assets/css/styles.css">
<script src="assets/js/validation.js" defer></script>
  <meta charset="UTF-8">
  <title><?= $isEdit ? "Editar Empleado" : "Nuevo Empleado" ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
<body class="bg-light">

<div class="container mt-4">
  <a href="index.php" class="btn btn-secondary mb-3">← Volver al listado</a>

  <!-- Mensajes -->
  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
  <?php endif; ?>
  <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
  <?php endif; ?>

  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0"><?= $isEdit ? "Editar Empleado" : "Registrar Empleado" ?></h4>
    </div>
    <div class="card-body">
      <p class="text-muted">Los campos con <span class="text-danger">*</span> son obligatorios.</p>
    </div>
    <div class="card-body">
      <form id="form-empleado" 
            action="controllers/EmpleadoController.php?action=<?= $isEdit ? 'update&id=' . $id : 'create' ?>"  
            method="POST" novalidate>
        
        <!-- Nombre -->
        <div class="mb-3">
          <label class="form-label">Nombre*</label>
          <input type="text" name="nombre" class="form-control" 
                 value="<?= $isEdit ? htmlspecialchars($old['nombre'] ?? $empleado['nombre']) : "" ?>" required>
            <div class="invalid-feedback">El nombre es obligatorio y solo debe contener letras.</div>
        </div>

        <!-- Descripción -->
        <div class="mb-3">
          <label class="form-label">Descripción*</label>
          <textarea name="descripcion" class="form-control" rows="3" required><?= $isEdit ? htmlspecialchars($old['descripcion'] ?? $empleado['descripcion']) : "" ?></textarea>
          <div class="invalid-feedback">La descripción es obligatoria.</div>
        </div>

        <!-- Departamento -->
        <div class="mb-3">
          <label class="form-label">Departamento*</label>
          <select name="area_id" class="form-select" required>
            <option value="">-- Seleccione --</option>
            <?php foreach($areas as $a): ?>
                <option value="<?= $a['id'] ?>" <?= ($old['area_id'] ?? $empleado['area_id']??'')==$a['id']?'selected':'' ?>>
                <?= htmlspecialchars($a['nombre']) ?>
            </option>
            <?php endforeach; ?>
          </select>
          <div class="invalid-feedback">El departamento es obligatorio.</div> 
        </div>

        <!-- Rol -->
        <div class="mb-3">
          <label class="form-label">Rol*</label>
          <select name="rol_id" class="form-select" required>
            <option value="">-- Seleccione --</option>
            <?php foreach($roles as $r): ?>
                <option value="<?= $r['id'] ?>" <?= in_array($old['rol_id'] ?? $r['id'], $empRoles) ? 'selected' : '' ?>>
                <?= htmlspecialchars($r['nombre']) ?>
            </option>
            <?php endforeach; ?>           
          </select>
          <div class="invalid-feedback">El rol es obligatorio.</div>
        </div>  

        <!-- Género -->
        <div class="mb-3">
          <label class="form-label">Género*</label><br>
          <div id="genero-group">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="sexo" value="M" 
                    <?= $isEdit && $empleado['sexo']=="M" ? "checked" : "" ?>>
              <label class="form-check-label">Masculino</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="sexo" value="F" 
                    <?= $isEdit && $empleado['sexo']=="F" ? "checked" : "" ?>>
              <label class="form-check-label">Femenino</label>
            </div>
            <div class="invalid-feedback">El género es obligatorio.</div>
          </div>
        </div>

        <!-- Boletin -->
        <div class="mb-3 form-check">
          <input type="checkbox" name="boletin" class="form-check-input" id="boletin"
                 <?= $isEdit && $empleado['boletin'] ? "checked" : "" ?>>
          <label for="boletin" class="form-check-label">Deseo recibir el boletin informativo</label>
        </div>

        <!-- Correo -->
        <div class="mb-3">
          <label class="form-label">Correo*</label>
          <input type="email" name="email" class="form-control" 
                 value="<?= $isEdit ? htmlspecialchars($old['email'] ?? $empleado['email']) : "" ?>" required>
          <div class="invalid-feedback">El correo es obligatorio y debe ser válido.</div>
        </div>

        <button type="submit" class="btn btn-success"><?= $isEdit ? "Actualizar" : "Guardar" ?></button>
      </form>
    </div>
  </div>
</div>
</body>
</html>
