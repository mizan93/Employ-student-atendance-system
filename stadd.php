<?php
include 'inc/header.php';
include 'lib/student.php';
?>
<?php
$student = new Student();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $ins_data = $student->insert_Student($name, $roll);
}

?>
<div class="col bg-light " style="min-height: 500px;">
    <div class=" pt-4 ">
        <h4>
            Fill in the required box to add student.
        </h4>
    </div>
    <?php
    if (isset($ins_data)) {
        echo $ins_data;
    } ?>
    <div class=" d-flex justify-content-center mt-4 py-2 ">
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Student Roll:</label>
                <input type="text" class="form-control" name="roll" id="roll">
            </div>
            <div class="form-group">
                <label for="roll">Student Name:</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">

                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
    <?php include 'inc/footer.php'; ?>