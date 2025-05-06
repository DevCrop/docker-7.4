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

    public static function uploadFile(array $fields): array
    {
        $results = [];

        foreach ($fields as $field) {
            if (!isset($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
                $results[$field] = ['error' => '파일이 전송되지 않았습니다.'];
                continue;
            }

            $file = $_FILES[$field];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, self::$allowsExtension)) {
                $results[$field] = ['error' => '허용되지 않은 파일 형식입니다.'];
                continue;
            }

            if (!is_dir(UPLOAD_PATH)) {
                mkdir(UPLOAD_PATH, 0777, true);
            }

            $savedName = uniqid() . '_' . basename($file['name']);
            $targetPath = UPLOAD_PATH . '/' . $savedName;

            if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
                $results[$field] = ['error' => '파일 저장에 실패했습니다.'];
                continue;
            }

            $results[$field] = [
                'success'  => true,
                'filename' => $savedName,
                'original' => $file['name'],
                'file_path' => $targetPath
            ];
        }
        return $results;
    }



    public static function deleteFile(string $filename): bool
    {
        $path = UPLOAD_PATH . '/' . basename($filename);
        return file_exists($path) ? unlink($path) : false;
    }
}
