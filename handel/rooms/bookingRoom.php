<?php
// ob_start(); // تشغيل الـ Output Buffering
// require_once "../../APP/APP.php";

// // التأكد من أن المستخدم مسجّل دخول
// if (!isset($_SESSION['id'])) {
//     $_SESSION['error'] = ["You must login first."];
//     header("location:../../auth/login.php");
//     exit();
// }

// if (isset($_POST['submit'])) {
//     $email = trim(htmlspecialchars($_POST['email']));
//     $phone_number = trim(htmlspecialchars($_POST['phone_number']));
//     $full_name = trim(htmlspecialchars($_POST['full_name']));
//     $check_in = trim($_POST['check_in']);
//     $check_out = trim($_POST['check_out']);
//     $user_id = $_SESSION['id'];
//     $room_id = $_GET['id'] ?? null;

//     $errors = [];

//     // التأكد من وجود ID
//     if (!$room_id) {
//         $errors[] = "Room ID is missing.";
//     }

//     // جلب بيانات الغرفة المرتبطة بالفندق
//     if (empty($errors)) {
//         $stmt = $conn->prepare("SELECT rooms.name AS room_name, hotels.name AS hotel_name 
//                                 FROM rooms 
//                                 JOIN hotels ON rooms.hotel_id = hotels.id 
//                                 WHERE rooms.id = :id");
//         $stmt->bindParam(':id', $room_id);
//         $stmt->execute();
//         $roomData = $stmt->fetch(PDO::FETCH_ASSOC);

//         if (!$roomData) {
//             $errors[] = "Room not found.";
//         } else {
//             $room_name = $roomData['room_name'];
//             $hotel_name = $roomData['hotel_name'];
//         }
//     }

//     // التحقق من صحة البيانات
//     if (empty($email)) {
//         $errors[] = "Email is required.";
//     } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         $errors[] = "Invalid email format.";
//     }

//     if (empty($phone_number)) {
//         $errors[] = "Phone number is required.";
//     } elseif (!preg_match('/^[0-9]+$/', $phone_number)) {
//         $errors[] = "Phone must contain only numbers.";
//     }

//     if (empty($full_name)) {
//         $errors[] = "Full name is required.";
//     } elseif (strlen($full_name) < 6) {
//         $errors[] = "Full name must be at least 6 characters.";
//     }

//     $today = date("Y-m-d");

//     if (empty($check_in)) {
//         $errors[] = "Check-in is required.";
//     } elseif ($check_in <= $today) {
//         $errors[] = "Check-in must be after today.";
//     }

//     if (empty($check_out)) {
//         $errors[] = "Check-out is required.";
//     } elseif ($check_out <= $check_in) {
//         $errors[] = "Check-out must be after check-in.";
//     }

//     // حفظ الحجز في قاعدة البيانات
//     if (empty($errors)) {
//         $insert = $conn->prepare("INSERT INTO bookings (email, phone_number, full_name, check_in, check_out, hotel_name, room_name, user_id)
//                                   VALUES (:email, :phone_number, :full_name, :check_in, :check_out, :hotel_name, :room_name, :user_id)");
//         $insert->bindParam(':email', $email);
//         $insert->bindParam(':phone_number', $phone_number);
//         $insert->bindParam(':full_name', $full_name);
//         $insert->bindParam(':check_in', $check_in);
//         $insert->bindParam(':check_out', $check_out);
//         $insert->bindParam(':hotel_name', $hotel_name);
//         $insert->bindParam(':room_name', $room_name);
//         $insert->bindParam(':user_id', $user_id);

//         if ($insert->execute()) {
//             $_SESSION['success'] = "Room booked successfully.";
//             header("location:../../rooms/room-single.php?id=$room_id");
//             exit();
//         } else {
//             $errors[] = "Something went wrong while booking.";
//         }
//     }

//     $_SESSION['error'] = $errors;
//     header("location:../../rooms/room-single.php?id=$room_id");
//     exit();
// }

// ob_end_flush(); // إنهاء Output Buffering

// require_once  "../../APP/APP.php";
// session_start();
require_once "selecteAllSinglerooms.php";


if (isset($_POST['submit'])) {
    $email = trim(htmlspecialchars($_POST['email']));
    $phone_number = trim(htmlspecialchars($_POST['phone_number']));
    $full_name = trim(htmlspecialchars($_POST['full_name']));
    $check_in = trim(htmlspecialchars($_POST['check_in']));
    $check_out = trim(htmlspecialchars($_POST['check_out']));
    $hotel_name = $singleRoom->hotel_name;
    $room_name = $singleRoom->name;
    $user_id = $_SESSION['id'];


    var_dump($_POST);
    $errors = [];
    //valiton 

    // email
    if (empty($email)) {
        $errors[] = "email is  reqired";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "email is not valid";
    } elseif (strlen($email) > 100) {
        $errors[] = "email must be at less 100";
    }

    if (empty($phone_number)) {
        $errors[] = "phone_number is requerd";
    } elseif (strlen($phone_number) < 3) {
        $errors[] = "phone_number must be at least 3 characters";
    } elseif (strlen($phone_number) > 50) {
        $errors[] = "phone_number must be at less 50";
    } elseif (!preg_match('/^[0-9]+$/', $phone_number)) {
        $errors[] = "Phone number must contain only digits.";
    }



    // full_name
    if (empty($full_name)) {
        $errors[] = "full_name is  reqired";
    } elseif (strlen($full_name) < 6) {
        $errors[] = "full_name must be at least 6 characters";
    } elseif (strlen($full_name) > 100) {
        $errors[] = "full_name must be at less 100";
    }

    //check_in 
    if (empty($check_in)) {
        $errors[] = "check_in is requred ";
    } elseif (date("Y/m/d") > $check_in) {
        $errors[] = "pick a date that not in the past , pick starting from tomorrow ";
    } elseif ($check_in > $check_out or $check_in == date("Y/m/d")) {
        $errors[] = "pick a date that not today for check_in date that less that check_out date ";
    }

    //check_out 
    if (empty($check_out)) {
        $errors[] = "$check_out is requred ";
    } elseif (date("Y/m/d") > $check_out) {
        $errors[] = "pick a date that not in the past , pick starting from tomorrow ";
    } elseif ($check_in > $check_out or $check_in == date("Y/m/d")) {
        $errors[] = "pick a date that not today for check_in date that less that check_out date ";



        if (empty($errors)) {

            $insert = $conn->prepare("INSERT INTO bookings (email,phone_number,  myfull_name,check_in,check_out,hotel_name,room_name,user_id) 
                VALUES (:email, :phone_number,  :myfull_name,:check_in,:check_out,:hotel_name,:room_name,:user_id)");

            $insert->bindParam(':email', $email, PDO::PARAM_STR);
            $insert->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
            $insert->bindParam(':myfull_name', $full_name, PDO::PARAM_STR);
            $insert->bindParam(':check_in', $check_in, PDO::PARAM_STR);
            $insert->bindParam(':check_out', $check_out, PDO::PARAM_STR);
            $insert->bindParam(':hotel_name', $hotel_name, PDO::PARAM_STR);
            $insert->bindParam(':room_name', $room_name, PDO::PARAM_STR);
            $insert->bindParam(':user_id', $user_id, PDO::PARAM_STR);


            if ($insert->execute()) {
                header("location:../../rooms/room-single.php");
                exit();
            } else {
                $_SESSION['error'] = $errors;
                header("location:../../rooms/room-single.php");
                exit();
            }
        } else {
            $_SESSION['error'] = $errors;
            header("location:../../rooms/room-single.php");
            exit();
        }
    }
}