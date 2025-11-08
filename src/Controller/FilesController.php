<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;

/**
 * FilesController
 * 
 * Handles serving uploaded files (profile pictures, documents, etc.)
 */
class FilesController extends AppController
{
    /**
     * Serve files from uploads directory
     * 
     * @param string $category Category of file (e.g., 'volunteer_signups', 'volunteers')
     * @param string $type Type of file (e.g., 'profile_picture', 'documents')
     * @param string $filename Filename (may contain full path like 'uploads/profiles/filename.jpg')
     * @return \Cake\Http\Response|null
     */
    public function serve($category = null, $type = null, $filename = null)
    {
        // Map category and type to actual upload paths
        $pathMap = [
            'volunteer_signups' => [
                'profile_picture' => 'uploads/profiles',
                'documents' => 'uploads/documents'
            ],
            'volunteers' => [
                'profile_picture' => 'uploads/volunteers/profiles',
                'documents' => 'uploads/volunteers/documents'
            ]
        ];

        // Validate category and type
        if (!$category || !$type || !$filename) {
            throw new NotFoundException('Invalid file path');
        }

        if (!isset($pathMap[$category][$type])) {
            throw new NotFoundException('Invalid file category or type');
        }

        // Handle filename that may contain full path (e.g., 'uploads/profiles/filename.jpg')
        // Extract just the filename if it contains path
        $actualFilename = $filename;
        if (strpos($filename, '/') !== false) {
            // If filename contains path, extract just the filename
            $actualFilename = basename($filename);
        }

        // Build file path
        $basePath = $pathMap[$category][$type];
        $filePath = WWW_ROOT . $basePath . DS . $actualFilename;

        // Also try with full path if filename contains path
        if (strpos($filename, 'uploads/') === 0) {
            $fullPath = WWW_ROOT . $filename;
            if (file_exists($fullPath) && is_file($fullPath)) {
                $filePath = $fullPath;
            }
        }

        // Security: prevent directory traversal
        $realPath = realpath($filePath);
        $baseRealPath = realpath(WWW_ROOT);
        
        if (!$realPath) {
            throw new NotFoundException('File not found');
        }

        // Ensure file is within webroot
        if (strpos($realPath, $baseRealPath) !== 0) {
            throw new NotFoundException('File not found');
        }

        // Check if file exists
        if (!file_exists($realPath) || !is_file($realPath)) {
            throw new NotFoundException('File not found');
        }

        // Get file info
        $fileInfo = pathinfo($realPath);
        $mimeType = $this->getMimeType($fileInfo['extension'] ?? '');

        // Create response with file
        $response = $this->response
            ->withType($mimeType)
            ->withFile($realPath);

        // Set appropriate headers
        $response = $response->withHeader(
            'Content-Disposition',
            'inline; filename="' . basename($realPath) . '"'
        );

        return $response;
    }

    /**
     * Get MIME type based on file extension
     * 
     * @param string $extension File extension
     * @return string MIME type
     */
    private function getMimeType(string $extension): string
    {
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'txt' => 'text/plain'
        ];

        $extension = strtolower($extension);
        return $mimeTypes[$extension] ?? 'application/octet-stream';
    }
}

