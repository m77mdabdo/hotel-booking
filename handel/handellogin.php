<?php 
require_once "../APP/APP.php" ;




if(isset($_POST['submit'])){
    var_dump($_POST);
    $email= trim(htmlspecialchars($_POST['email']));
    $password= trim(htmlspecialchars($_POST['password']));
  
    $errors=[];
    //valition 
    if(empty($email)){
        $errors[]="email is requerd";
    }elseif(strlen($email)<4){
     $errors[]="email is must less 4 characters";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[]="email is not valid";
    }

      //password
   if(empty($password)){
    $errors[]="password is  reqired";
    // }elseif(strlen($password)<6){
    //   $errors[]="password must be at least 6 characters";
    // }elseif(strlen($password)>100){
    //   $errors[]="password must be at less 100";
    // }else if (!preg_match('/[A-Z]/', $password)) {
    //   $errors[] = "Password must contain at least one uppercase letter (A-Z)";
    // }elseif (!preg_match('/[a-z]/', $password)) {
    //   $errors[] = "Password must contain at least one lowercase letter (a-z)";
    // }elseif (!preg_match('/[0-9]/', $password)) {
    //   $errors[] = "Password must contain at least one digit (0-9)";
    // }elseif (!preg_match('/[\W]/', $password)) {
    //   $errors[] = "Password must contain at least one special character (@, #, $, %, etc.)";
    // }    
   }

    if(empty($errors)){
        $login=$conn->prepare("select * from users where email=:email");
            $login->bindParam(":email",$email,PDO::PARAM_STR);
            if($insert->execute()){
               
            
            $fetch=$login->fetch(PDO::FETCH_ASSOC);
             //get the row count 
            if($login->rowCount()>0){
                if(password_verify($password,$fetch['mypassword'])){
                    $_SESSION['username']=$fetch['username'];
                    $_SESSION['id']=$fetch['id'];

                    // $_SESSION['success']= "$email welcome";

                     header("location:../index.php");
                     exit();
            }else{
                // echo "<script> alert('email or passwod  is worng '); </script>";
                $_SESSION['error'][]="Email or password is incorrect ";
                header("location:../auth/login.php");
            }
    }else {
        $_SESSION['error'][] = "No account found with this email!";
        header("location:../auth/login.php");
        exit();
    }

}else{
    $_SESSION['error']=$errors;
    header('location:../auth/login.php');
}
    }

}else{
    $_SESSION['error'][] = "Please fill in all required fields.";
    header("location:../auth/login.php");
    exit();
}



// if(isset($_POST['submit'])){

   

// if (empty($_POST['email']) || empty($_POST['password'])) {
//         echo "<script> alert('One or more inputs are empty'); </script>";
        
// }else{  
//     $email= trim(htmlspecialchars($_POST['email']));
//     $password= trim(htmlspecialchars($_POST['password']));

//     $login=$conn->prepare("select * from users where email=:email");
//     $login->bindParam(":email",$email,PDO::PARAM_STR);
//     $login->execute();

//     $fetch=$login->fetch(PDO::FETCH_ASSOC);

//     //get the row count 
//     if($login->rowCount()>0){

//         if(password_verify($password,$fetch['mypassword'])){
//             echo "<script> alert('LOGGED IN '); </script>";
//         }else{
//             echo "<script> alert('email or passwod  is worng '); </script>";
//         }
 
//     }else{
//         echo "<script> alert('email or passwod  is worng '); </script>";
//     }

// }
// }else{
//     header("location:../index.php");
// }