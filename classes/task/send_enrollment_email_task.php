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
 * Local plugin "enrollment_email" - Synchronous email task
 *
 * @package    local_enrollment_email
 * @copyright  2025 Your Name <your.email@example.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_enrollment_email\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Adhoc task to send enrollment emails synchronously
 */
class send_enrollment_email_task extends \core\task\adhoc_task {

    /**
     * Constructor
     *
     * @param array $eventdata Event data from the enrollment event
     */
    public function __construct($eventdata = null) {
        if ($eventdata) {
            $this->set_custom_data($eventdata);
        }
    }

    /**
     * Execute the task to send enrollment email
     */
    public function execute() {
        global $DB, $CFG;
        
        require_once($CFG->dirroot . '/course/lib.php');
        require_once($CFG->libdir . '/messagelib.php');
        
        $eventdata = $this->get_custom_data();
        
        if (empty($eventdata)) {
            mtrace('No event data provided for enrollment email task');
            return;
        }
        
        // Get the user who was enrolled
        $userid = $eventdata->relateduserid;
        $user = $DB->get_record('user', array('id' => $userid));
        
        if (!$user) {
            mtrace('User not found for enrollment email');
            return;
        }
        
        // Get the course the user was enrolled in
        $courseid = $eventdata->courseid;
        $course = $DB->get_record('course', array('id' => $courseid));
        
        if (!$course) {
            mtrace('Course not found for enrollment email');
            return;
        }
        
        // Log the event
        mtrace("Processing synchronous email: User {$user->firstname} {$user->lastname} ({$user->id}) was enrolled in course {$course->fullname} ({$course->id})");
        
        // Prepare email message
        $subject = get_string('email_subject', 'local_enrollment_email', $course->fullname);
        $courseurl = new \moodle_url('/course/view.php', array('id' => $course->id));
        
        // Plain text version
        $messagetext = get_string('email_body', 'local_enrollment_email', array(
            'firstname' => $user->firstname,
            'coursename' => $course->fullname,
            'courseurl' => $courseurl
        ));
        
        // HTML version
        $messagehtml = get_string('email_body_html', 'local_enrollment_email', array(
            'firstname' => $user->firstname,
            'coursename' => $course->fullname,
            'courseurl' => $courseurl,
            'courseurltext' => $courseurl
        ));
        
        // Force synchronous email sending with immediate priority
        $mailresult = email_to_user($user, \core_user::get_support_user(), $subject, $messagetext, $messagehtml, '', '', true);
        
        if ($mailresult) {
            mtrace("Enrollment notification email sent successfully to {$user->email}");
        } else {
            mtrace("Failed to send enrollment notification email to {$user->email}");
        }
    }
}