<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait FileUploadTrait
{
    public function uploadFile($file, $folder, $existingFile = null)
    {
        if ($file) {
            try {
                // Define the target directory
                $targetFolder = public_path("upload/{$folder}");

                // Ensure the folder exists
                if (!file_exists($targetFolder)) {
                    mkdir($targetFolder, 0755, true);
                }

                // Delete existing file if present
                if ($existingFile) {
                    // Handle both full URLs and relative paths
                    $existingPath = str_replace(url('/'), '', $existingFile);
                    $existingFullPath = public_path($existingPath);
                    if (file_exists($existingFullPath)) {
                        @unlink($existingFullPath);
                    }
                }

                // Generate a unique filename
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

                // Move the uploaded file to the target folder
                if (!$file->move($targetFolder, $fileName)) {
                    Log::error('Failed to move uploaded file', [
                        'folder' => $folder,
                        'filename' => $fileName,
                        'target' => $targetFolder
                    ]);
                    throw new \Exception('Failed to move uploaded file');
                }

                // Return the full public URL
                return url("upload/{$folder}/{$fileName}");
            } catch (\Exception $e) {
                Log::error('File upload error: ' . $e->getMessage(), [
                    'folder' => $folder,
                    'file' => $file ? $file->getClientOriginalName() : null,
                    'error' => $e->getMessage()
                ]);
                throw $e;
            }
        }

        return $existingFile;
    }
}
