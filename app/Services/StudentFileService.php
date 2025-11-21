<?php

namespace App\Services;

use App\Models\Student;
use App\Models\StudentFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentFileService
{
    private $disk;

    public function __construct()
    {
        $this->disk = 'local';
    }

    private function getBasePath(): string
    {
        return 'private/students';
    }

    public function createStudentFolder(Student $student): string
    {
        $folderPath = $this->getStudentFolderPath($student);

        if (!Storage::disk($this->disk)->exists($folderPath)) {
            Storage::disk($this->disk)->makeDirectory($folderPath);

            $this->createProtectionFiles($folderPath);
        }

        return $folderPath;
    }

    private function createProtectionFiles(string $folderPath): void
    {
        $htaccessContent = "Order Deny,Allow\nDeny from all";
        Storage::disk($this->disk)->put($folderPath . '/.htaccess', $htaccessContent);

        $webConfigContent = '<?xml version="1.0" encoding="UTF-8"?>
<configuration>
    <system.webServer>
        <security>
            <requestFiltering>
                <hiddenSegments>
                    <add segment="private" />
                </hiddenSegments>
            </requestFiltering>
        </security>
    </system.webServer>
</configuration>';
        Storage::disk($this->disk)->put($folderPath . '/web.config', $webConfigContent);
    }

    public function getStudentFolderPath(Student $student): string
    {
        return $this->getBasePath() . "/{$student->academic_no}";
    }
    public function uploadFile(Student $student, UploadedFile $file, string $fileType, string $name, $uploadedBy, ?string
    $description = null): StudentFile
    {
        $this->validateFileType($file, $fileType);

        $folderPath = $this->createStudentFolder($student);

        $fileName = $this->generateSecureFileName($file, $fileType);
        $filePath = $folderPath . '/' . $fileName;

        Storage::disk($this->disk)->putFileAs($folderPath, $file, $fileName);

        return $student->files()->create([
            'file_type' => $fileType,
            'file_name' => $name,
            'file_path' => $filePath,
            'description' => $description,
            'uploaded_by' => $uploadedBy,
        ]);
    }
    private function validateFileType(UploadedFile $file, string $fileType): void
    {
        $allowedMimeTypes = [
            'photo' => ['image/jpeg', 'image/png', 'image/gif'],
            'document' => ['image/jpeg', 'image/png', 'application/pdf'],
            'report' => ['application/pdf', 'image/jpeg', 'image/png'],
            'other' => [
                'application/pdf',
                'image/jpeg',
                'image/png',
                'text/plain',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ],
        ];

        if (isset($allowedMimeTypes[$fileType])) {
            if (!in_array($file->getMimeType(), $allowedMimeTypes[$fileType])) {
                throw new \Exception('نوع الملف غير مسموح به لهذا النوع من الملفات');
            }
        }
    }

    private function generateSecureFileName(UploadedFile $file, string $fileType): string
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $timestamp = time();
        $random = Str::random(8);

        return Str::slug($fileType) . '_' . Str::slug($originalName) . '_' . $timestamp . '_' . $random . '.' . $extension;
    }

    public function downloadFile(StudentFile $studentFile)
    {
        if (!Storage::disk($this->disk)->exists($studentFile->file_path)) {
            throw new \Exception('الملف غير موجود');
        }

        $filePath = Storage::disk($this->disk)->path($studentFile->file_path);

        return [
            'path' => $filePath,
            'name' => $studentFile->file_name,
        ];
    }

    public function getFileInfo(StudentFile $studentFile): array
    {
        $fileExists = Storage::disk($this->disk)->exists($studentFile->file_path);
        $fileSize = $fileExists ? Storage::disk($this->disk)->size($studentFile->file_path) : 0;

        return [
            'id' => $studentFile->id,
            'file_type' => $studentFile->file_type,
            'file_name' => $studentFile->file_name,
            'file_size' => $fileSize,
            'file_size_formatted' => $this->formatFileSize($fileSize),
            'description' => $studentFile->description,
            'exists' => $fileExists,
            'uploaded_at' => $studentFile->created_at->format('Y-m-d H:i'),
            'uploaded_by' => $studentFile->uploader->name ?? 'غير معروف',
            'file_path' => $studentFile->file_path,
        ];
    }

    private function formatFileSize($bytes): string
    {
        if ($bytes == 0) return '0 B';

        $units = ['B', 'KB', 'MB', 'GB'];
        $base = log($bytes) / log(1024);
        $unit = $units[floor($base)];

        return round(pow(1024, $base - floor($base)), 2) . ' ' . $unit;
    }

    public function getStudentFiles(Student $student): array
    {
        $files = $student->files()->with('uploader')->orderBy('created_at', 'desc')->get();

        return $files->map(function ($file) {
            return $this->getFileInfo($file);
        })->toArray();
    }

    public function deleteFile(StudentFile $studentFile): bool
    {
        try {
            if (Storage::disk($this->disk)->exists($studentFile->file_path)) {
                Storage::disk($this->disk)->delete($studentFile->file_path);
            }

            return $studentFile->delete();
        } catch (\Exception $e) {
            throw new \Exception('فشل في حذف الملف: ' . $e->getMessage());
        }
    }

    public function fileExists(StudentFile $studentFile): bool
    {
        return Storage::disk($this->disk)->exists($studentFile->file_path);
    }
}
