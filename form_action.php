<?php require_once("config.php");
if(isset($_POST['form_submit']))
{
    $name=trim($_POST['name']);
        $fname=trim($_POST['fname']);
        $mname=trim($_POST['mname']);
        $gender=trim($_POST['gender']);
        $dob=trim($_POST['dob']);
        $address=trim($_POST['address']);
        $category=trim($_POST['category']);
        $course=trim($_POST['course']);
        $email=trim($_POST['email']);
        $email=trim($_POST['mobile']);
        $pay_status='PAID';
        $course_fees='6000';
        $reg_no='TS'.rand(99,10).time();
        $folder="uploads/";
        //Photo
        $image_file=$_FILES['image']['name'];
        $file=$_FILES['image']['tmp_name'];
        $path=$folder.$image_file;
        $file_name_array=explode(".",$image_file);
        $extension= end($file_name_array);
        $snew_image_name = 'sign_'.rand() . '.' . $extension;
        if($file=!'')
        {
        move_uploaded_file($file, $folder .$snew_image_name);
        }
        if($file!='')
        {
        move_uploaded_file($sfile, $folder . $snew_image_name);
        }
        $sql="INSERT INTO registrations(name,fname,mname,gender,dob,address,category,course,email,
        mobile,pay_status,course_fees,reg_no,image,sign) VALUES(:name,:fname,:mname,:gender,:dob,:address,
        :category,:course,:email,:mobile,:pay_status,:course_fees,:reg_no,:image,:sign)";
        $stmt=$db->prepare($sql);
        $stmt->bindParam(':name',$name, PDO::PARAM_STR);
        $stmt->bindParam(':fname',$fname, PDO::PARAM_STR);
        $stmt->bindParam(':mname',$mname, PDO::PARAM_STR);
        $stmt->bindParam(':gender',$gender, PDO::PARAM_STR);
        $stmt->bindParam(':dob',$dob, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':course',$course, PDO::PARAM_STR);
        $stmt->bindParam(':email',$email, PDO::PARAM_STR);
        $stmt->bindParam(':mobile',$mobile, PDO::PARAM_STR);
        $stmt->bindParam(':pay_status',$pay_status, PDO::PARAM_STR);
        $stmt->bindParam(':course_fees',$course_fees, PDO::PARAM_STR);
        $stmt->bindParam(':reg_no',$reg_no, PDO::PARAM_STR);
        $stmt->bindParam(':image',$new_image_name, PDO::PARAM_STR);
        $stmt->bindParam(':sign',$snew_image_name, PDO::PARAM_STR);
        $stmt->execute();
        $last_id=$db->lastInsertId();
        if($last_id=!'')
        {
            header("location:preview.php?id=".$reg_no);
        }
        else{
            echo 'Something went wrong';
        }
}
?>