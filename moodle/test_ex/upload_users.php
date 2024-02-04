<?php
define('CLI_SCRIPT', true);
$currentDirectory = __DIR__; 
$parentDirectory = dirname($currentDirectory);

$config_path = $parentDirectory . '/config.php';
require_once($config_path);
require_once($CFG->dirroot.'/user/lib.php');

// Define the path to the CSV file
$csvFile = 'example.csv';

// Read the CSV file
if (($handle = fopen($csvFile, 'r')) !== false) {
    while (($data = fgetcsv($handle, 1000, ',')) !== false) {
        // Define the user data from CSV columns
        $userData = array(
            'username' => $data[0],
            'password' => $data[1],
            'firstname' => $data[2],
            'lastname' => $data[3],
            'email' => $data[4],
            'auth' => 'manual',
            'idnumber' => '',
            'lang' => 'en',
            'timezone' => '99',
            'mailformat' => 1,
            'description' => '',
            'city' => '',
            'country' => '',
        );

        // Create the user
        $user = new stdClass();
        $user->username = $userData['username'];
        $user->password = hash_internal_user_password($userData['password']);
        $user->firstname = $userData['firstname'];
        $user->lastname = $userData['lastname'];
        $user->email = $userData['email'];
        $user->auth = $userData['auth'];
        $user->idnumber = $userData['idnumber'];
        $user->lang = $userData['lang'];
        $user->timezone = $userData['timezone'];
        $user->mailformat = $userData['mailformat'];
        $user->description = $userData['description'];
        $user->city = $userData['city'];
        $user->country = $userData['country'];

        $userid = user_create_user($user);

        if ($userid) {
            echo "User created successfully with ID: " . $userid . "<br>";
            $role = $DB->get_record('role', array('shortname' => 'student'));

            // Assign the role to the user
            $context = context_user::instance($userid);
            role_assign($role->id, $userid, $context->id);
        } else {
            echo "Failed to create user." . "<br>";
        }
    }
    fclose($handle);
} else {
    echo "Failed to open CSV file." . "<br>";
}