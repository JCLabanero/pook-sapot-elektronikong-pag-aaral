<?php
include_once("../includes/start_in.php");
?>

<body>
    <?php
    include_once("../includes/header.php");
    ?>
    <main class="container">
        <div>
            <h1>Lessons</h1>
        </div>
        <div class="row">
            <div class="col bg-warning">
                <h1 class="b">Lesson</h1>
                <div class="accordion accordion-flush" id="accordionExample">
                    <?php include "../php/lesson_retrieve.php";
                    foreach ($lessons as $lesson) {
                        $title = $lesson->getElementsByTagName("title")->item(0)->nodeValue;
                        $content = $lesson->getElementsByTagName("content")->item(0)->nodeValue;
                        $id = $lesson->getElementsByTagName("id")->item(0)->nodeValue;
                    ?>
                        <div id="<?php echo $id ?>" class="accordion-item mb-1">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#data<?php echo $id ?>" aria-expanded="true" aria-controls="data<?php echo $id ?>">
                                    <?php echo $title ?>
                                </button>
                            </h2>
                            <div id="data<?php echo $id ?>" class="accordion-collapse collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php echo $content ?>
                                </div>
                                <div class="accordion-footer d-flex justify-content-end m-1">
                                    <button data-id="<?php echo $id ?>" class="btn-primary btn mx-1 lesson-update">Edit</button>
                                    <button data-id="<?php echo $id ?>" class="btn-danger btn mx-1 lesson-delete">Delete</button>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-3 bg-success ">Sidebar
                <div class="row">
                    <a href="adminlessoncreate.php" class="btn btn-primary">Create Lesson</a>
                </div>
            </div>
        </div>
    </main>
</body>

<?php
include_once("../includes/end_in.php");
?>