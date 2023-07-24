<?php
include_once("../includes/start_in.php");
include("../php/lesson_retrieve.php");
$formName = "lessonCreateForm";
$formButton = "Create";
$title = null;
$content = null;
if (isset($_REQUEST["id"])) {
    $formName = "lessonUpdateForm";
    $formButton = "Update";
    $id = $_REQUEST["id"];
    foreach ($lessons as $lesson) {
        $lessonId = $lesson->getElementsByTagName("id")->item(0)->nodeValue;
        if ($id == $lessonId) {
            $title = $lesson->getElementsByTagName("title")->item(0)->nodeValue;
            $content = $lesson->getElementsByTagName("content")->item(0)->nodeValue;
        }
    }
}
?>

<body>
    <?php
    include_once("../includes/header.php");
    ?>
    <main class="containter">
        <div class="">
            <form action="" id=<?php echo $formName ?> class="w-50 m-auto">
                <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" value="<?php echo $title ?>" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Description</label>
                    <textarea class="form-control" id="content" rows="5" required><?php echo $content ?></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary"><?php echo $formButton ?></button>
                </div>
            </form>
        </div>

    </main>
</body>

<?php
include_once("../includes/end_in.php");
?>