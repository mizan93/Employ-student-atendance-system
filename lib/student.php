<?php 
include_once 'lib/database.php';

class Student{
private $db;
public function __construct()
{
  $this->db=new Database();  
}
private function validation($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data=mysqli_real_escape_string($this->db->link,$data);
    return $data;
}
public function getStudents(){
$sql="SELECT * FROM student";
$data=$this->db->select($sql);
return $data;
}
public function insert_Student($name, $roll){
  $name=$this->validation($name);
  $roll=$this->validation($roll);
  if ($name==''|| $roll=='') {
  $msg="<div class='alert alert-danger'>Error ! field must not be empty. </div>";
  return $msg;
  }else{
      $sql = "INSERT INTO  student(name,roll)VALUES ('$name','$roll')";
      $data = $this->db->insert($sql);
      $sql = "INSERT INTO  attend(roll)VALUES ('$roll')";
      $data = $this->db->insert($sql);
      if ($data) {
        $msg = "<div class='alert alert-success'>Success ! Student's data inserted. </div>";
        return $msg;
      } else {
        $msg = "<div class='alert alert-danger'>Error ! Student's data not inserted. </div>";
        return $msg;
      }
      
  }
   
}
public function insert_Attendance($attend, $cr_date){
    $attend=array();
    $cr_date = $this->validation($cr_date);
    
    $sql="SELECT DISTINCT date FROM attend ";
    $insdata = $this->db->select($sql);
    while ($data= $insdata->fetch_assoc()) {
     $db_date=$data['date'];
     if ($cr_date==$db_date) {
        $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Attendance alreadey taken. </div>";
        return $msg;
     }
    }
    foreach ($attend as $roll => $value) {
      if ($roll=='present') {
        $sql = "INSERT INTO attend(roll,attend,date) VALUES('$roll','present',now())";
        $data = $this->db->insert($sql);
      
        
      }elseif ($roll == 'absent') {
        $sql = "INSERT INTO attend(roll,attend,date) VALUES('$roll','absent',now())";
        $data = $this->db->insert($sql);
      }
      
    }
    if ($data) {
      $msg = "<div class='alert alert-success'><strong>Success ! </strong> Attendance data inserted. </div>";
      return $msg;
    } else {
      $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Attendance data not inserted. </div>";
      return $msg;
    }
   
  }

public function getAttedancelist(){
    $sql = "SELECT DISTINCT date FROM attend ORDER BY date DESC";
    $data = $this->db->select($sql);
    return $data;
}
public function getStudentsByDate($v_date){

    $sql = "SELECT student.name, attend.* FROM student
    INNER JOIN  attend   
    ON student.roll=attend.roll WHERE date='$v_date' ";
    $data = $this->db->select(
      $sql);
    return $data;
  }
  public function update_Attendance($attend, $v_date){
    $attend = $this->validation($attend);
    $v_date = $this->validation($v_date);
    foreach ($attend as $roll => $value) {
      if ($roll == 'present') {
        $sql = "UPDATE  attend
         SET
        attend='present'
        WHERE roll=$roll
        AND date='$v_date'";
        $data = $this->db->update($sql);
      } elseif ($roll == 'absent') {
        $sql = "UPDATE  attend
         SET
        attend='absent'
        WHERE roll=$roll
        AND date='$v_date'";
        $data = $this->db->update($sql);
      }
    }
    if ($data) {
      $msg = "<div class='alert alert-success'><strong>Success ! </strong> Attendance data updated. </div>";
      return $msg;
    } else {
      $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Attendance data not updated. </div>";
      return $msg;
    }
  }
  public function deleteAttandance($del_id){
    $del_id = $this->validation($del_id);

    $sql = "DELETE  FROM attend WHERE date='$del_id'";
    $data = $this->db->delete($sql);
    if ($data) {
      $msg = "<div class='alert alert-success'><strong>Success ! </strong>Attendance  data deleted. </div>";
      return $msg;
    } else {
      $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Attendance data not deleted. </div>";
      return $msg;
    }
  }
}

?>