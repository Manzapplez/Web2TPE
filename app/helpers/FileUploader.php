<?php

class FileUploader
{
    // Sube un archivo a la carpeta indicada, creando la carpeta si no existe.
    public static function handleCoverUpload(array $file, string $entityName, string $uploadDir): ?string
    {
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return null;
        }

        // Crear carpeta si no existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Normaliza el nombre de la entidad para un nombre de archivo seguro sin caracteres especiales
        $safeName = preg_replace("/[^a-zA-Z0-9_\-]/", "_", strtolower($entityName));

        // Obtiene la extensión original del archivo
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        $filename = $safeName . '.' . $extension;

        $destination = rtrim($uploadDir, '/') . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $uploadDir . $filename;
        }
        return null;
    }

    public static function showCoverUploadError(): void {}
}
