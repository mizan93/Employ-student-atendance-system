<?php
include 'inc/header.php';
include 'lib/student.php';
?>
<script>
    $(document).ready(function() {
        $(form).submit(function(e) {
            var roll = true;
            $(':radio').each(function() {
                name = $(this).attr('name');
                if (roll && !$(':radio[name=' + name + ']:checked').length) {
                    alert(name + 'Roll Missing ! ');
                    roll = false;
                }
            });
            return roll
        });
    });
</script>
<?php
error_reporting(0);
$student = new Student();
$cr_date = date("Y/m/d");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $attend = $_POST['attend'];
    $ins_atnd = $student->insert_Attendance($attend, $cr_date);
}
if (isset($ins_atnd)) {
    echo $ins_atnd;
}
?>

<div class="col bg-light " style="min-height: 500px;">
    <div class=" pt-4">
        <h4>
           Take Attendance from here 
        </h4>
    </div>
    <div class="mt-4 py-2">
        <div class="col py-2">
            <h4 class="">Date: <?php echo $cr_date; ?></h4>
        </div>
        <form action="" method="post">
            <table class="table table-striped ">
                <thead>
                    <tr>

                        <th>Roll</th>
                        <th>Name</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getdate = $student->getStudents();
                    if ($getdate) {
                        $i = 0;
                        while ($data = $getdate->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>

                                <td><?php echo $data['roll']; ?></td>
                                <td><?php echo $data['name']; ?></td>
                                <td>
                                    <input type="radio" name="attend[<?php echo $data['roll']; ?>]" id="" value="present">P
                                    <input type="radio" name="attend[<?php echo $data['roll']; ?>]" id="" value="absent">A
                                </td>

                            </tr>

                    <?php }
                    } ?>

                </tbody>
            </table>
            <tr>
                <td colspan="">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </td>
            </tr>
        </form>
    </div>
    <?php include 'inc/footer.php'; ?>