<?php
include_once("../includes/start_in.php");
include("../php/lesson_retrieve.php");
$formName = "lessonCreateForm";
$formButton = "Create";
$title = null;
$content = null;
$lessonId = null;
$id = null;
$link = null;
$pdf = null;
if (isset($_REQUEST["id"])) {
    $formName = "lessonUpdateForm";
    $formButton = "Update";
    $id = $_REQUEST["id"];
    foreach ($lessons as $lesson) {
        $lessonId = $lesson->getElementsByTagName("id")->item(0)->nodeValue;
        if ($id == $lessonId) {
            $title = $lesson->getElementsByTagName("title")->item(0)->nodeValue;
            $content = $lesson->getElementsByTagName("content")->item(0)->nodeValue;
            $link = $lesson->getElementsByTagName("videoLink")->item(0);
            $pdf = $lesson->getElementsByTagName("pdfSource")->item(0);
        }
    }
}
$link = $link ? $link->nodeValue : null;
$pdf = $pdf ? $pdf->nodeValue : null;
?>

<body>
    <?php
    include_once("../includes/header.php");
    ?>
    <main class="containter">
        <div class="">
            <form action="" id=<?php echo $formName ?> class="w-50 m-auto">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" value="<?php echo $title ?>" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Description</label>
                    <textarea class="form-control" id="content" rows="5" required><?php echo $content ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="videoLink">Video Link (Optional):</label>
                    <input type="url" id="videoLink" class="w-100" value="<?php echo $link ?>">
                </div>
                <div class="mb-3">
                    <label for="pdfSource">PDF Source (Optional): <?php echo basename($pdf) ?></label>
                    <input type="file" id="pdfSource" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary"><?php echo $formButton ?></button>
                    <?php if (!empty($id)) { ?>
                        <button type="button" data-id="<?php echo $lessonId ?>" data-inside="true" class="btn btn-danger lesson-delete">Delete</button>
                    <?php } ?>
                </div>
            </form>
        </div>

    </main>
</body>

<?php
include_once("../includes/end_in.php");
?>