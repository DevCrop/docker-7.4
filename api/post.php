<?php

require_once __DIR__ . '/../inc/lib/base.php';

header('Content-Type: application/json');

$data = [
    'result' => [],
    'success' => false
];


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {


        $uploadFields = ['formFile1', 'formFile2', 'formFile3', 'formFile4'];
        $uploadResults = FileControl::uploadFile($uploadFields);

        foreach ($uploadResults as $field => $result) {

            if (isset($result['success'])) {
                $sql = "INSERT INTO file_attachments (
                            file_name,
                            file_origin_name,
                            file_path,
                            created_at
                        ) VALUES (
                            :file_name,
                            :file_origin_name,
                            :file_path,
                            NOW()
                        )";

                DB::insert($sql, [
                    ':file_name'        => $result['filename'],
                    ':file_origin_name' => $result['original'],
                    ':file_path'        => $result['file_path']
                ]);
            }

            $data['result'][$field] = $result;

            if (isset($result['success'])) {
                $data['success'] = true;
            }
        }
    } catch (Exception $e) {
        $data['error'][] = ['message' => $e->getMessage()];
    }

    echo json_encode($data);
    exit;
}
