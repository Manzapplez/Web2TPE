<?php
require_once __DIR__ . '/DBConfig.php';

/* Clase encargada de manejar conexiones a la base de datos. */
final class DBConnection
{
    // patron Singleton 
    private static ?DBConnection $instance = null;
    private ?PDO $db = null;

    // Este constructor establece la conexión PDO y ejecuta el autodeploy si es necesario. */
    private function __construct()
    {
        try {
            $this->db = new PDO(
                DBConfig::getDSN(),
                DBConfig::USER,
                DBConfig::PASSWORD,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            $this->deploy();
        } catch (PDOException $e) {
            error_log("No se pudo conectar a la base de datos: " . $e->getMessage());
        }
    }

    public static function getInstance(): DBConnection
    {
        if (self::$instance === null) {
            self::$instance = new DBConnection();
        }
        return self::$instance;
    }

    //Inicia una conexión a la base de datos y retorna un objeto PDO.
    public static function openConnection(): ?PDO
    {
        return self::getInstance()->db;
    }

    //PHP cierra la conexión PDO automáticamente al destruir el objeto, no se requiere un método closeConnection

    // Autodeploy: crea las tablas si la base de datos está vacía.
    private function deploy(): void
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll(PDO::FETCH_COLUMN);

        if (count($tables) === 0) {
            $sqlFile = __DIR__ . '/../soundSnack.sql';
            if (!file_exists($sqlFile)) {
                error_log("Archivo SQL no encontrado: $sqlFile");
                return;
            }

            $sql = file_get_contents($sqlFile);  // Lee todo el contenido del archivo SQL como un string.
            $statements = explode(';', $sql); // Cada comando SQL termina con ';', se separan las sentencias.

            foreach ($statements as $stmt) { // Itera sobre cada comando SQL.
                $stmt = trim($stmt); // Elimina espacios en blanco para evitar errores.
                if ($stmt) { // Evalúa que el string no esté vacío.
                    try {
                        $this->db->exec($stmt); // Ejecuta el comando en la base de datos.
                    } catch (PDOException $e) {
                        error_log("Error ejecutando SQL: " . $e->getMessage());
                    }
                }
            }
            error_log("Base de datos desplegada automáticamente.");
        }
    }
}
