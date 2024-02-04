<?php
//http://localhost/moodle/blocks/newblock/testpage.php?
require_once('../../config.php');
require_once('FileUploadeForm.php');
require_once('CreateUsersForm.php');
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot.'/user/lib.php');

// Ensure the user is logged in
require_login();


// Set up the page context
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Тестовый блок');
$PAGE->set_heading('Задания, связанные с формами');

// Output the header
echo $OUTPUT->header();


// Instantiate and display the form
$file_upload_form = new FileUploadeForm();
$user_create_form = new CreateUsersForm();

function forms_processing($form_declaration){
    if ($form_declaration->is_cancelled()) {
        // Handle form cancellation
        // ...
    } else if ($data = $form_declaration->get_data()) {
        // Process the form submission
        $form_declaration->validation($data, null);
    } else {
        // Display the form
        $form_declaration->display();
    }
}

forms_processing($user_create_form);
forms_processing($file_upload_form);


echo $OUTPUT->footer();

