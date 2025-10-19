<?php

/**
 * Clase encargada de retornar los parametros necesarios para establecer la conexión a la base de datos indicada.
 */
final class DBConfig
{
    /** Protocolo para MySQL */
    const PROTOCOL = "mysql:host=";

    /** Host de la base de datos */
    const HOST = "localhost;";

    /** Puerto de conexión a la base de datos */
    const PORT = "port=3306;";

    /** Nombre de la base de datos */
    const DATABASE = "dbname=soundSnack";

    /** Usuario de la base de datos */
    const USER = "root";

    /** Contraseña del usuario de la base de datos */
    const PASSWORD = "";

    /**
     * Constructor privado para evitar instanciación de esta clase.
     */
    private function __construct() {}

    /**
     * Método que retorna la DSN completa para realizar la conexión con PDO
     */
    public static function getDSN(): string
    {
        return self::PROTOCOL . self::HOST . self::PORT . self::DATABASE;
    }
}
