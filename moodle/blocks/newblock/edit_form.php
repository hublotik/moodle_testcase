<?php


class block_newblock_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        
        // A sample string variable with a default value.
        $mform->addElement('text', 'config_text', get_string('blockstring', 'block_newblock'));
        $mform->setDefault('config_text', 'default value');
        $mform->setType('config_text', PARAM_TEXT);   

    }
}
