<?php include_once("../includes/start_in.php");
$formName = "quizCreateForm";
$question = null;
if (isset($_REQUEST["id"])) {
    $formName = "quizUpdateForm";
}
?>

<body>
    <?php include("../includes/header.php") ?>
    <main class="container">
        <form action="" id=<?php echo $formName ?> class="w-50 m-auto">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Question</label>
                <input type="text" class="form-control" id="question" value="<?php echo $question ?>" required>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" id="add-answer">Add answer</button>
            </div>
            <div class="mb-3">
                <label for="answer" class="form-label">Answer - right answer</label>
                <input type="text" name="answer" id="answer" class="w-100">
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
    </main>
    <footer></footer>
</body>
<?php include("../includes/end_in.php") ?>