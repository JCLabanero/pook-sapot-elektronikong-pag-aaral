<?php
include_once("../includes/start_in.php");
?>

<body>
    <?php
    include_once("../includes/header.php");
    ?>
    <main class="containter">
        <div class="">
            <form action="" id="lessonCreateForm" class="w-50 m-auto">
                <div class="mb-3">
                    <label for="lessonTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="lessonTitle" required>
                </div>
                <div class="mb-3">
                    <label for="lessonDesc" class="form-label">Description</label>
                    <textarea class="form-control" id="lessonDesc" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>

    </main>
</body>

<?php
include_once("../includes/end_in.php");
?>