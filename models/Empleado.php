
<?php
require_once __DIR__ . '/../db/Database.php';

class Empleado {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Sincronizar roles de un empleado
    private function syncRoles($empleado_id, $roles) {
        // Eliminar cualquier rol previo
        $stmt = $this->db->prepare("DELETE FROM empleado_rol WHERE empleado_id=?");
        $stmt->execute([$empleado_id]);

        // Insertar el nuevo rol (si existe)
        if (!empty($roles)) {
            $stmt = $this->db->prepare("INSERT INTO empleado_rol (empleado_id, rol_id) VALUES (?, ?)");
            foreach ($roles as $rol_id) {
                $stmt->execute([$empleado_id, $rol_id]);
            }
        }
    }


    // Listar todos
    public function all() {
        $sql = "SELECT e.*, a.nombre AS area_nombre
                FROM empleados e
                LEFT JOIN areas a ON a.id=e.area_id
                ORDER BY e.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    // Buscar por id
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM empleados WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Crear
    public function create($data) {
        $sql = "INSERT INTO empleados (nombre,email,sexo,area_id,boletin,descripcion)
                VALUES (?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['nombre'],
            $data['email'],
            $data['sexo'],
            $data['area_id'],
            isset($data['boletin']) ? 1 : 0,
            $data['descripcion']            
        ]);
        $id = $this->db->lastInsertId();

        if (!empty($data['rol_id'])) {
            $this->syncRoles($id, [$data['rol_id']]); 
        }
    }

    // Actualizar
    public function update($id,$data) {
        $sql = "UPDATE empleados SET nombre=?,email=?,sexo=?,area_id=?, boletin=?,descripcion=? WHERE id=?";
        $sql = "UPDATE empleados SET nombre=?,email=?,sexo=?,area_id=?,boletin=?,descripcion=? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['nombre'],
            $data['email'],
            $data['sexo'],
            $data['area_id'],
            isset($data['boletin']) ? 1 : 0,
            $data['boletin'],
            $data['descripcion'],
            $id           
        ]);
        if (!empty($data['rol_id'])) {
        $this->syncRoles($id, [$data['rol_id']]); 
        }
    }
    // Eliminar
    public function delete($id) {
        $this->db->prepare("DELETE FROM empleado_rol WHERE empleado_id=?")->execute([$id]);
        $this->db->prepare("DELETE FROM empleados WHERE id=?")->execute([$id]);
    }

    // Listar áreas
    public function allAreas() {
        return $this->db->query("SELECT * FROM areas ORDER BY nombre")->fetchAll();
    }

    // Listar roles
    public function allRoles() {
        return $this->db->query("SELECT * FROM roles ORDER BY nombre")->fetchAll();
    }

    // Obtener roles de un empleado
    public function getRolesByEmpleado($id) {
    $stmt = $this->db->prepare("SELECT rol_id FROM empleado_rol WHERE empleado_id=?");
    $stmt->execute([$id]);
    return array_column($stmt->fetchAll(), 'rol_id');
    }

}

        // Obtener Area de un empleado
    public function getAreasByEmpleado($id) {
    $stmt = $this->db->prepare("SELECT area_id FROM empleados WHERE id=?");
    $stmt->execute([$id]);
    return $stmt->fetchColumn();
    }

}
