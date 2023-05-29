<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'vendor/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'vendor/PHPMailer-master/PHPMailer-master/src/SMTP.php';

function guimailCamOn($eamailnguoinhan,$tennguoinhan)
{
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();  
    //Send using SMTP
    $mail->Host       = 'smtp.elasticemail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true; //Enable SMTP authentication
    $mail->Username   = 'vonguyenduytan08022002@gmail.com';                     //SMTP username
    $mail->Password   = '7118D8069C739AC29E5840921CE0E35B244E';                               //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


  
    $mail->setFrom('vonguyenduytan08022002@gmail.com', 'VNDT');
    
    $mail->addAddress($eamailnguoinhan,$tennguoinhan); 
    

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'thu cam on';
    $mail->Body    = 'xin chao: '.$tennguoinhan.'!</b>Đơn hàng của bạn đã đặt thành công. CẢM ƠN BẠN ĐÃ ỦNG HỘ';
    $mail->AltBody =  'Cảm ơn ban đã liên hệ.';

    $mail->send();
    $kq= 'Message has been sent';
    return $kq;
} catch (Exception $e) {
    $kq= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return $kq;
}

}
function guimailXinLoi($eamailnguoinhan,$tennguoinhan)
{
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();  
    //Send using SMTP
    $mail->Host       = 'smtp.elasticemail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true; //Enable SMTP authentication
    $mail->Username   = 'vonguyenduytan08022002@gmail.com';                     //SMTP username
    $mail->Password   = '7118D8069C739AC29E5840921CE0E35B244E';                               //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


  
    $mail->setFrom('vonguyenduytan08022002@gmail.com', 'VNDT');
    
    $mail->addAddress($eamailnguoinhan,$tennguoinhan); 
    

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'thu cam on';
    $mail->Body    = 'xin chao: '.$tennguoinhan.'!</b>Đơn hàng của bạn đã bị shop hủy vì một số lý do đáng tiếc. XIN LỖI VÌ SỰ CỐ NÀY.';
    $mail->AltBody =  'Cảm ơn ban đã liên hệ.';

    $mail->send();
    $kq= 'Message has been sent';
    return $kq;
} catch (Exception $e) {
    $kq= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return $kq;
}
}
function guimailRessetPass($eamailnguoinhan,$tennguoinhan,$MatKhau)
{
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();  
    //Send using SMTP
    $mail->Host       = 'smtp.elasticemail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true; //Enable SMTP authentication
    $mail->Username   = 'vonguyenduytan08022002@gmail.com';                     //SMTP username
    $mail->Password   = '7118D8069C739AC29E5840921CE0E35B244E';                               //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


  
    $mail->setFrom('vonguyenduytan08022002@gmail.com', 'VNDT');
    
    $mail->addAddress($eamailnguoinhan,$tennguoinhan); 
    

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Cấp lại mật khẩu';
    $mail->Body    = 'xin chao: '.$tennguoinhan.'!</b> Mật khẩu reset là:'.$MatKhau;
    $mail->AltBody =  'Cảm ơn ban đã liên hệ.';

    $mail->send();
    $kq= 'Message has been sent';
    return $kq;
} catch (Exception $e) {
    $kq= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return $kq;
}
}
?>