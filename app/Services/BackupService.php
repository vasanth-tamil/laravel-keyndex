<?php

namespace App\Services;

use ZipArchive;

class BackupService {

    public static function backupDatabase() {
        $backupDir = storage_path('backups');
        $backupFileName = env('DB_DATABASE') . '_' . now()->format('Y-m-d_H-i-s') . '.sql';
        $backupFile = $backupDir . '/' . $backupFileName;
        $zipFileName = env('DB_DATABASE') . '_' . now()->format('Y-m-d_H-i-s') . '.zip';
        $zipFile = $backupDir . '/' . $zipFileName;

        // Ensure the backup directory exists
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        // Construct and execute the mysqldump command to create the SQL file
        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            escapeshellarg(env('DB_USERNAME')),
            escapeshellarg(env('DB_PASSWORD')),
            escapeshellarg(env('DB_HOST')),
            escapeshellarg(env('DB_DATABASE')),
            escapeshellarg($backupFile)
        );

        $result = null;
        exec($command, $output, $result);

        // If mysqldump is successful, compress the SQL file into a ZIP archive
        if ($result === 0) {
            // Create a ZipArchive instance
            $zip = new ZipArchive();

            // Open or create the zip file
            if ($zip->open($zipFile, ZipArchive::CREATE) === TRUE) {
                // Add the SQL file to the zip archive
                $zip->addFile($backupFile, basename($backupFile));

                // Close the zip file
                $zip->close();

                // Optionally, remove the original SQL file after zipping it
                unlink($backupFile);

                // Return success response with the path of the ZIP file
                return [
                    'message' => 'Database backup successfully created and compressed!',
                    'path' => $zipFile,
                ];
            } else {
                // Return failure response if the ZIP creation fails
                return [
                    'message' => 'Failed to create ZIP file.',
                    'error' => implode("\n", $output), // Combine output lines in case of failure
                ];
            }
        } else {
            // Return failure response if mysqldump fails
            return [
                'message' => 'Database backup failed!',
                'error' => implode("\n", $output), // Combine output lines in case of failure
            ];
        }
    }

}
