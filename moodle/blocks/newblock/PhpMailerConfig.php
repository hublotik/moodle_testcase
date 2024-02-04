<?php
trait PHP_Mailer_config
{
    protected static function PHP_Mailer_config($userEmail, $subject, $message)
    {
        require_once($CFG->libdir . '/phpmailer/moodle_phpmailer.php');
        //adding passowrds sending logic to form:
        global $CFG;

        // Configure email settings
        $mail = new \PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = $CFG->smtphosts;
        $mail->SMTPAuth = $CFG->smtpuser ? true : false;
        $mail->Username = $CFG->smtpuser;
        $mail->Password = $CFG->smtppass;
        $mail->SMTPSecure = $CFG->smtpsecure;
        $mail->Port = $CFG->smtpport;
        $mail->setFrom($CFG->noreplyaddress, $CFG->sitefullname);
        $mail->addAddress($userEmail);

        // Set email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->CharSet  = 'UTF-8';


        // Send the email
        if (!$mail->send()) {
            echo 'Error sending email: ' . $mail->ErrorInfo;
        }
    }
    protected static function generatePassword($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        $characterCount = strlen($characters);
    
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $characterCount - 1)];
        }
    
        return $password;
    }
    
}
