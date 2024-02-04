<?php
require_once($CFG->libdir . '/formslib.php');
require_once('PhpMailerConfig.php');
class CreateUsersForm extends moodleform
{
    use PHP_Mailer_config;
    public function definition()
    {
        $mform = $this->_form;
        $mform->addElement('static',  'description',  'Задание:', 'Форма регистрации и отправки сгенерированных паролей');
        $mform->addElement('text', 'username', 'Username');
        $mform->setType('username', PARAM_TEXT);
        $mform->addRule('username', get_string('required'), 'required');

        $mform->addElement('password', 'password', 'Пароль');
        $mform->setType('password', PARAM_TEXT);
        $mform->addRule('password', get_string('required'), 'required');

        $mform->addElement('text', 'firstname', 'Имя');
        $mform->setType('firstname', PARAM_TEXT);
        $mform->addRule('firstname', get_string('required'), 'required');

        $mform->addElement('text', 'lastname', 'Фамилия');
        $mform->setType('lastname', PARAM_TEXT);
        $mform->addRule('lastname', get_string('required'), 'required');

        $mform->addElement('text', 'email', 'Почта');
        $mform->setType('email', PARAM_EMAIL);
        $mform->addRule('email', get_string('required'), 'required');

        $mform->addElement('text', 'role', 'Роль пользователя');
        $mform->setType('role', PARAM_EMAIL);
        $mform->addRule('role', get_string('required'), 'required');
        // Add more elements for other user information
        $mform->addElement('advcheckbox',  'generate',  'Генерация паролей',  '', array('group' => 1),  array(0, 1));

        $this->add_action_buttons(true, 'Create User');
    }

    public function validation($data, $files)
    {
        
        global $CFG, $DB;
        
        //generate password and send it to email if checkbox was selected
        if(isset($data->generate)){
            $rand_password = self::generatePassword(8);

            $userEmail = $data->email;
            $subject = "Уведомление об регистрации, в курсе";
            $message = 'Дорогой ' . $data->firstname . ',<br><br>';
            $message .= '.<br><br>';
            $message .= 'Для Вас был создан логин и пароль на нашем ресурсе:,<br>';
            $message .= 'Логин: ' . $data->username;
            $message .= 'Пароль: ' . $rand_password;
    
            self::PHP_Mailer_config($userEmail, $subject, $message);
    
            $data->password = $rand_password; 
        }
    
        $newuserid = $DB->insert_record('user', $data);

        $userid = user_create_user($data);
        if ($userid) {
            echo "User created successfully with ID: " . $userid . "<br>";
            $role = $DB->get_record('role', array('shortname' => $data->role));

            // Assign the role to the user
            $context = context_user::instance($userid);
            role_assign($role->id, $userid, $context->id);
        } else {
            echo "Failed to create user." . "<br>";
        }

        // Perform the desired action upon form submission
        // For example, let's display a success message with the submitted data
        $message = 'Form submitted successfully! Data: ' . print_r($data, true);
        \core\notification::success($message);

        return true;

        // Create the user
    }
    
}
