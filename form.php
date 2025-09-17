<?php
session_start();
require_once "models/Empleado.php";

// Cargar valores previos si hubo error
$old = $_SESSION['old'] ?? [];
unset($_SESSION['old']); // limpiar después de usarlos

$id = $_GET['id'] ?? null;
$empleadoObj = new Empleado();
$empleado = null;
$isEdit = false;
$empRoles = $id ? $empleadoObj->getRolesByEmpleado($id) : [];


// Si hay ID, estamos en modo edición
if (isset($_GET['id'])) {
    $empleado = $empleadoObj->find($_GET['id']);
    $isEdit = true;
}

$areas = $empleadoObj->allAreas();
$roles = $empleadoObj->allRoles();



?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= $isEdit ? "Editar Empleado" : "Nuevo Empleado" ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="assets/js/validation.js" defer></script>
</head>
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
