<?php
require_once($CFG->libdir . '/formslib.php');
class FileUploadeForm extends moodleform
{
    public function definition()
    {
        $mform = $this->_form;
        $mform->addElement('filepicker', 'file', 'Select File');
        $mform->addElement('submit', 'submitbtn', 'Submit');
    }

    public function validation($data, $files)
    {
        global $CFG;
        // Handle the uploaded file
        $file = $data->file;
        if (!empty($file['tmp_name'])) {
            // Generate a unique filename
            $filename = $file['name'];
            $filepath = $CFG->libdir .'blocks/newblock/'. $filename;

            // Move the uploaded file to the desired location
            move_uploaded_file($file['tmp_name'], $filepath);

            // Perform any additional processing or storage operations as needed
        } 
        $message = 'Form submitted successfully! Data: ' . print_r($data->file, true);
        \core\notification::success($message);

        return true;

    }
}
