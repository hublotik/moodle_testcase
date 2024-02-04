<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Newblock block caps.
 *
 * @package    block_newblock
 * @copyright  Daniel Neis <danielneis@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use contenttype_h5p\form\editor;

require_once($CFG->dirroot.'/user/lib.php');
require_once('FileUploadeForm.php');
 

defined('MOODLE_INTERNAL') || die();

class block_newblock extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_newblock');
        
    }

    function get_content() {
        global $CFG, $OUTPUT; 
        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        // user/index.php expects course context, so get one if the page has module context.
        $currentcontext = $this->page->context->get_course_context(false);


        return $this->content;
    }

}
