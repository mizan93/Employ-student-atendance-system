<?php
include 'inc/header.php';
include 'lib/student.php';
?>
<?php
$student = new Student();
if (isset($_GET['del_id']) != '') {
    $del_id = $_GET['del_id'];
    $deldata=$student->deleteAttandance($del_id);
}

?>
<div class="col bg-light " style="min-height: 500px;">
    <div class=" pt-2 ">
        <div class=" pt-4 ">
            <h4>
                ------Attandance list--------
            </h4>
        </div>
    </div>
    <?php 
    if (isset($deldata)) {
        echo $deldata;
    }
     ?>
    <div class="mt-4 py-2">

       
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getst = $student->getAttedancelist();
                    if ($getst) {
                        $i = 0;
                        while ($data = $getst->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data['date']; ?></td>
                                <td> <a class="btn btn-primary" href="view.php?v_date=<?php echo $data['date']; ?>">View</a>

                                    <a class="btn btn-primary" href="edit.php?v_date=<?php echo $data['date']; ?>">Edit</a>
                                    <a onclick="return confirm('Are you sure to delete?');" class="btn btn-danger" href="?del_id=<?php echo $data['date']; ?>">Delete</a>

                                </td>

                            </tr>
                    <?php }
                    } ?>

                </tbody>
            </table>
        
    </div>
    <?php include 'inc/footer.php'; ?>