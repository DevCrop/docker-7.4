<?php

require_once __DIR__ . '/../inc/lib/base.php';

header('Content-Type: application/json');

$data = [
    'result' => null,
    'error' => null
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {

        $uploadResult = FileControl::uploadFile('formFile');

        if (isset($uploadResult['success'])) {
            $sql = "INSERT INTO
                    file_attachments (
                    file_name,
                    file_origin_name,
                    file_path,
                    created_at
                ) VALUES (
                    :file_name,
                    :file_origin_name,
                    :file_path,
                    NOW()
                )
            ";
            DB::insert($sql, [
                ':file_name'        => $uploadResult['filename'],
                ':file_origin_name' => $uploadResult['original'],
                ':file_path'        => $uploadResult['upload_path']
            ]);

            $data['result'] = $uploadResult;
        }
    } catch (Exception $e) {
        $data['error'] = $e->getMessage();
    }
    echo json_encode($data);
    exit;
}
