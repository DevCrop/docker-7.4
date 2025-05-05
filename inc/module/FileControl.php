<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/lib/base.php';

class FileControl
{
    private static $allowsExtension = [
        'jpg',
        'jpeg',
        'png',
        'gif',
        'webp',
        'pdf',
        'doc',
        'docx',
        'hwp',
        'zip',
        'rar',
        'mp4',
        'mov',
        'mp3',
        'wav'
    ];

    public static function uploadFile(string $fileName): array
    {
        $file = $_FILES[$fileName];

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, self::$allowsExtension)) {
            return ['error' => '허용되지 않은 파일 형식입니다.'];
        }

        if (!is_dir(UPLOAD_PATH)) {
            mkdir(UPLOAD_PATH, 0777, true);
        }

        $savedName = uniqid() . '_' . basename($file['name']);
        $targetPath = UPLOAD_PATH . '/' . $savedName;

        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            return ['error' => '파일 저장에 실패했습니다.'];
        }

        return [
            'success' => true,
            'filename' => $savedName,
            'original' => $file['name'],
            'upload_path' => UPLOAD_PATH,
        ];
    }

    public static function deleteFile(string $filename): bool
    {
        $path = UPLOAD_PATH . '/' . basename($filename);
        return file_exists($path) ? unlink($path) : false;
    }
}
