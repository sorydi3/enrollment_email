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
 * Local plugin "enrollment_email" - Event observer
 *
 * @package    local_enrollment_email
 * @copyright  2025 Your Name <your.email@example.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Event observer class for handling user enrollment events
 */
class local_enrollment_email_observer {

    /**
     * Triggered when a user is enrolled in a course.
     *
     * @param \core\event\user_enrolment_created $event The event.
     * @return bool True on success.
     */
    public static function user_enrolled(\core\event\user_enrolment_created $event) {
        global $DB, $CFG;
        
        require_once($CFG->dirroot . '/course/lib.php');
        require_once($CFG->libdir . '/messagelib.php');
        
        // Get the user who was enrolled
        \core\task\manager::queue_adhoc_task(new \local_enrollment_email\task\send_enrollment_email_task($event->get_data()),true);
        
        return true;
    }
}