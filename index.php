<?php
require_once __DIR__ . '/inc/lib/base.php';

require_once LAYOUTS_PATH . '/head.php';
require_once LAYOUTS_PATH . '/header.php';

?>

<form id="frm" action="./api/post.php" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend style="display: none;">FILE CONTROL</legend>
        <div class="mb-3">
            <label for="formFile" class="form-label">파일 선택</label>
            <input class="form-control" type="file" id="formFile" name="formFile">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">파일 선택</label>
            <input class="form-control" type="file" id="formFile" name="formFile2">
        </div>


        <button type="submit" class="btn btn-primary">업로드</button>
        <div id="uploadResult" style="margin-top: 10px;"></div>
    </fieldset>
</form>

<?php
$files = DB::select("SELECT * FROM file_attachments ORDER BY id DESC");
?>

<div class="mt-4">
    <h4>파일 업로드 리스트</h4>
    <ul>
        <?php if (count($files) === 0): ?>
            <li>등록된 파일이 없습니다.</li>
        <?php else: ?>

            <?php foreach ($files as $file): ?>
                <li>
                    <a href="<?= htmlspecialchars($file['file_path']) ?>" target="_blank">
                        <?= htmlspecialchars($file['file_origin_name']) ?>
                    </a>
                    <small style="color: gray;">(<?= $file['created_at'] ?>)</small>
                </li>
            <?php endforeach; ?>

        <?php endif; ?>
    </ul>
</div>


<script src="/api/post.js"></script>


<?php
require_once LAYOUTS_PATH . '/footer.php';
?>