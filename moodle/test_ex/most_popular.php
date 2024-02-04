<?php
define('CLI_SCRIPT', true);
$currentDirectory = __DIR__; 
$parentDirectory = dirname($currentDirectory);

$config_path = $parentDirectory . '/config.php';
require_once($config_path);
require_once($CFG->dirroot.'/user/lib.php');

// Query to get the count of students in each course
$sql = "SELECT c.id, c.fullname, COUNT(DISTINCT ue.userid) AS enrol_count
        FROM {course} c
        JOIN {enrol} e ON e.courseid = c.id
        JOIN {user_enrolments} ue ON ue.enrolid = e.id
        GROUP BY c.id, c.fullname
        ORDER BY enrol_count DESC
        LIMIT 1";

$mostPopularCourse = $DB->get_record_sql($sql);

if ($mostPopularCourse) {
    echo "Самый популярный курс: " . $mostPopularCourse->fullname;
} else {
    echo "Ошибка";
}