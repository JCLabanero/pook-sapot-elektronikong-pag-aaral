<?php include_once("../includes/start_in.php");
$formName = "quizCreateForm";
$formButton = "Create";
$question = null;
if (isset($_REQUEST["id"])) {
    $formName = "quizUpdateForm";
    $formButton = "Update";
}
?>

<body>
    <?php include("../includes/header.php") ?>
    <main class="container">
        <form action="" id=<?php echo $formName ?> class="w-50 w-lg-100 m-auto">
            <!-- <input type="hidden" name="id" value="<?php echo $id; ?>"> -->
            <?php
            include "../php/lesson_retrieve.php";
            ?>
            <div class="mb-3">
                <label for="lessonId" class="form-label">Lesson Selection</label>
                <input class="form-control" list="lessonListOptions" id="lessonId" placeholder="Type to search lesson title/id" required>
                <datalist id="lessonListOptions">
                    <?php foreach ($lessons as $lesson) {
                        $lessonId = $lesson->getElementsByTagName("id")->item(0)->nodeValue;
                        $lessonTitle = $lesson->getElementsByTagName("title")->item(0)->nodeValue;
                        echo "<option value='$lessonId'>$lessonTitle</option>";
                    } ?>
                </datalist>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Question</label>
                <input type="text" class="form-control" id="question" value="<?php echo $question ?>" required>
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary" id="add-answer" data-cnt="1">Add answer</button>
                <button type="button" class="btn btn-primary" id="add-answer-3">Add 3 answer</button>
            </div>
            <div class="mb-3" id="answer-holder">
                <label for="answer" class="form-label">Answer - right answer</label>
                <input type="text" name="answer" id="answer" class="w-100" placeholder="Answer #1 - right answer">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary"><?php echo $formButton ?></button>
                <!-- <button type="button" data-id="<?php echo $lessonId ?>" data-inside="true" class="btn btn-danger lesson-delete">Delete</button> -->
            </div>
        </form>
    </main>
    <footer></footer>
</body>
<?php include("../includes/end_in.php") ?>