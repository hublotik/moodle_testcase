<?php

use core\analytics\analyser\courses;

define('CLI_SCRIPT', true);
$currentDirectory = __DIR__;
$parentDirectory = dirname($currentDirectory);

$config_path = $parentDirectory . '/config.php';
require_once($config_path);
// require_once($CFG->libdir.'/lib.php');

require_once($CFG->libdir.'/phpmailer/moodle_phpmailer.php');

// send email notifications
function sendScheduleChangeNotification($userEmail, $subject, $message) {
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

$courses = get_courses();
$courseIds = array();
for ($i = 1; $i < count($courses) + 1; $i++) {
    $courseIds[] = $courses[$i]->id;
}
var_dump($courses);
foreach ($courseIds as $ids) {
    $students = get_enrolled_users(context_course::instance($ids));

    // Get the list of students from Moodle database

    // var_dump($students);
    // check all students and sent
    $course_curr = get_course($ids); 
    foreach ($students as $student) {
        $userEmail = $student->email;
        $subject = "Уведомление об изменениях в расписании, в курсе";
        $message = 'Дорогой ' . $student->firstname . ',<br><br>';
        $message .= '.<br><br>';
        $message .= 'Спасибо!,<br>';
        $message .= 'Название курса: ' . $course_curr->fullname;

        sendScheduleChangeNotification($userEmail, $subject, $message);
    }

}

// echo $userEmail;