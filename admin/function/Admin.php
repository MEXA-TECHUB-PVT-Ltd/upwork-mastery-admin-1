<?php 
require_once "../../Library/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
function searchByEmail($data){
$query = "SELECT * FROM admin WHERE email='$data->email'";
$result = pg_query($data->conn, $query);
if ($result) {
    return pg_fetch_assoc($result);
}
return array();
}
function resetPassword($data){
$query = "UPDATE admin SET
password = '$data->password'
WHERE email = '$data->email'";
$upload = pg_query($data->conn, $query);
if($upload){
    return true;
}
    return false;
}
function updateTermsAndCondition($data){
    $query = "INSERT INTO terms_conditions (terms_and_condition,status) VALUES ('$data->terms_and_condition','active')";
    $insert = pg_query($data->conn, $query);
        if($insert){
            return true;
        }
        return false;
}
function updatePrivacyPolicy($data){
$query = "UPDATE admin SET
privacy_policy = '$data->terms_and_condition'
WHERE email = '$data->email'";
$upload = pg_query($data->conn, $query);
if($upload){
    return true;
}
    return false;
}
function createVideo($data){
    $query = "INSERT INTO videos (description,title,link) VALUES ('$data->description','$data->title','$data->link')";
    $insert = pg_query($data->conn, $query);
        if($insert){
            return true;
        }
        return false;
}

function UpdateVideo($data){
    $query = "UPDATE videos SET
    description = '$data->description',
    title = '$data->title',
    link = '$data->link'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}
function deleteVideo($data){
    $query = "DELETE FROM videos WHERE id =" . $data->id;
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
    return false;
}
// Manage User
function createUser($data){
    $query = "INSERT INTO users (email,password,city,country,referral_code) VALUES ('$data->email','$data->password','$data->city','$data->country','$data->referral_code')";
    $insert = pg_query($data->conn, $query);
        if($insert){
            return true;
        }
        return false;
}
function UpdateUser($data){
    $query = "UPDATE users SET
    email = '$data->email',
    referral_code = '$data->referral_code',
    city = '$data->city',
    country = '$data->country'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}
function deleteUser($data){
    $query = "DELETE FROM users WHERE id =" . $data->id;
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
    return false;
}
function blockUser($data){
    $query = "UPDATE users SET
    status = 'block'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}
function activeUser($data){
    $query = "UPDATE users SET
    status = 'active'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}
// promo code
function createPromo($data){
    $query = "INSERT INTO promo_codes (code,expire_date,discount,status) VALUES ('$data->code','$data->date','$data->discount','active')";
    $insert = pg_query($data->conn, $query);
        if($insert){
            return true;
        }
        return false;
}
function EditPromo($data){
    $query = "UPDATE promo_codes SET
    code = '$data->code',
    expire_date = '$data->date',
    discount = '$data->discount'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}
function sendMail($data){
    //SMTP Settings
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "ventureoffical123@gmail.com"; //enter you email address
    $mail->Password = 'bpvlxqxuetmtregm'; //enter you email password
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";
    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom("noreply@gmail.com");
    $mail->addAddress($data->email); //enter you email address
    $mail->Subject = ("$data->subject");
    $mail->Body = $data->body;
    if ($mail->send()) {
       return true;
   }
}
function blockPromo($data){
    $query = "UPDATE promo_codes SET
    status = 'block'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}
?>