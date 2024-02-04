<?php
define('CLI_SCRIPT', true);
$currentDirectory = __DIR__;
$parentDirectory = dirname($currentDirectory);

$config_path = $parentDirectory . '/config.php';
require_once($config_path);
require_once($CFG->dirroot . '/user/lib.php');

function outputUserQuizResults($courseName, $quizName)
{
    global $DB;

    // Get the course ID based on the course name
    $course = $DB->get_record('course', array('fullname' => $courseName));

    if (!$course) {
        echo "Course not found.";
        return;
    }

    // Get the quiz ID based on the quiz name and course ID
    $quiz = $DB->get_record('quiz', array('name' => $quizName, 'course' => $course->id));
    if (!$quiz) {
        echo "Quiz not found in course.";
        return;
    }

    // Get the user and quiz results
    $sql = "SELECT u.id, u.firstname, u.lastname, qg.grade 
            FROM {user} u
            JOIN {quiz_attempts} qa ON qa.userid = u.id
            JOIN {quiz_grades} qg ON qg.quiz = qa.quiz
            WHERE qa.quiz = :quizid";
    $params = array('quizid' => $quiz->id);
    $results = $DB->get_records_sql($sql, $params);

    // Output the user and quiz results
    if ($results) {
        echo "Quiz Results for $quizName in $courseName: ";
        foreach ($results as $result) {
            echo $result->firstname . ' ' . $result->grade;
        }
    } else {
        echo "No results found for quiz.";
    }
}

outputUserQuizResults('TEST_COURSE', 'test_quiz');
