<?php
// This file is part of Moodle - http://moodle.org/.
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
 * External Web Service Template
 *
 * @package    mod_localmyddleware
 * @copyright  2017 Myddleware
 * @author     Myddleware ltd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . "/externallib.php");

/**
 * Class with custom function used by Myddleware
 */
class local_myddleware_external extends external_api {

    /**
     * Returns description of method parameters.
     * @return external_function_parameters.
     */
    public static function get_users_completion_parameters() {
        return new external_function_parameters(
            array(
                'time_modified' => new external_value(
                                           PARAM_INT, get_string('param_timemodified', 'local_myddleware'), VALUE_DEFAULT, 0),
                'id' => new external_value(PARAM_INT, get_string('param_id'), VALUE_DEFAULT, 0),
            )
        );
    }
   
    /**
     * This function search completion created after the date $timemodified in parameters.
     * @param int $timemodified 
     * @param int $id 
     * @return an array with the detail of each completion (id,userid,completionstate,timemodified,moduletype,instance,courseid).
     */
    public static function get_users_completion($timemodified, $id) {
        global $USER, $DB;

        // Parameter validation.
        $params = self::validate_parameters(
            self::get_users_completion_parameters(),
            array('time_modified' => $timemodified, 'id' => $id)
        );

        // Context validation.
        $context = context_user::instance($USER->id);
        self::validate_context($context);

        require_capability('moodle/user:viewdetails', $context);
       
        // Prepare the query condition.
        if (!empty($id)) {
            $where = ' cmc.id = '.$params['id'];
        } else {
            $where = ' cmc.timemodified > '.$params['time_modified'];
        } 

        // Retrieve token list (including linked users firstname/lastname and linked services name).
        $sql = "
                SELECT
                    cmc.id,
                    cmc.userid,
                    cmc.completionstate,
                    cmc.timemodified,
                    cm.module moduletype,
                    cm.instance,
                    cm.course courseid
                FROM {course_modules_completion} cmc
                INNER JOIN {course_modules} cm
                    ON cm.id = cmc.coursemoduleid
                WHERE
                    ".$where."
                ORDER BY timemodified ASC
                    ";
        $rs = $DB->get_recordset_sql($sql);

        $completions = array();
        if (!empty($rs)) {
            foreach ($rs as $completionrecords) {
                foreach ($completionrecords as $key => $value) {
                    $completion[$key] = $value;
                }
                $completions[] = $completion;
            }
        }
        return $completions;
    }

    /**
     * Returns description of method result value.
     * @return external_description.
     */
    public static function get_users_completion_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, get_string('return_id', 'local_myddleware')),
                    'userid' => new external_value(PARAM_INT, get_string('return_userid', 'local_myddleware')),
                    'instance' => new external_value(PARAM_INT, get_string('return_instance', 'local_myddleware')),
                    'courseid' => new external_value(PARAM_INT, get_string('return_courseid', 'local_myddleware')),
                    'moduletype' => new external_value(PARAM_INT, get_string('return_moduletype', 'local_myddleware')),
                    'completionstate' => new external_value(PARAM_INT, get_string('return_completionstate', 'local_myddleware')),
                    'timemodified' => new external_value(PARAM_INT, get_string('return_timemodified', 'local_myddleware'))
                )
            )
        );
    }


    /**
     * Returns description of method parameters.
     * @return external_function_parameters.
     */
    public static function get_users_last_access_parameters() {
        return new external_function_parameters(
            array(
                'time_modified' => new external_value(
                                           PARAM_INT, get_string('param_timemodified', 'local_myddleware'), VALUE_DEFAULT, 0),
                'id' => new external_value(PARAM_INT, get_string('param_id'), VALUE_DEFAULT, 0),
            )
        );
    }


  
    /**
     * This function search the last access for all users and courses. 
     * Only access after the $timemodified are returned.
     * @param int $timemodified 
     * @param int $id 
     * @return an array with the detail of each access (id, userid, access time and courseid).
     */
    public static function get_users_last_access($timemodified, $id) {
        global $USER, $DB;
        // Parameter validation.
        $params = self::validate_parameters(
            self::get_users_last_access_parameters(),
            array('time_modified' => $timemodified, 'id' => $id)
        );

        // Context validation.
        $context = context_user::instance($USER->id);
        self::validate_context($context);

        require_capability('moodle/user:viewdetails', $context);
       
        // Prepare the query condition.
        if (!empty($id)) {
            $where = ' la.id = '.$params['id'];
        } else {
            $where = ' la.timeaccess > '.$params['time_modified'];
        } 

        $sql = "
                SELECT
                    la.id,
                    la.userid,
                    la.courseid,
                    la.timeaccess lastaccess
                FROM {user_lastaccess} la
                WHERE
                    ".$where."
                ";
        $rs = $DB->get_recordset_sql($sql);

        $lastaccess = array();
        if (!empty($rs)) {
            foreach ($rs as $lastaccessrecords) {
                foreach ($lastaccessrecords as $key => $value) {
                    $access[$key] = $value;
                }
                $lastaccess[] = $access;
            }
        }
        return $lastaccess;
    }



    /**
     * Returns description of method result value.
     * @return external_description.
     */
    public static function get_users_last_access_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, get_string('return_id', 'local_myddleware')),
                    'userid' => new external_value(PARAM_INT, get_string('return_userid', 'local_myddleware')),
                    'courseid' => new external_value(PARAM_INT, get_string('return_courseid', 'local_myddleware')),
                    'lastaccess' => new external_value(PARAM_INT, get_string('return_lastaccess', 'local_myddleware'))
                )
            )
        );
    }
   
    /**
     * Returns description of method parameters.
     * @return external_function_parameters.
     */
    public static function get_courses_by_date_parameters() {
        return new external_function_parameters(
            array(
                'time_modified' => new external_value(
                                           PARAM_INT, get_string('param_timemodified', 'local_myddleware'), VALUE_DEFAULT, 0),
                'id' => new external_value(PARAM_INT, get_string('param_id'), VALUE_DEFAULT, 0),
            )
        );
    }

    /**
     * This function search the courses created or modified after after the datime $timemodified.
     * @param int $timemodified 
     * @param int $id 
     * @return the list of course.
     */
    public static function get_courses_by_date($timemodified, $id) {
        global $USER, $DB, $CFG;
        require_once($CFG->dirroot . "/course/externallib.php");
       
        // Parameter validation.
        $params = self::validate_parameters(
            self::get_courses_by_date_parameters(),
            array('time_modified' => $timemodified, 'id' => $id)
        );
       
        // Prepare the query condition.
        if (!empty($id)) {
            $where = ' id = '.$params['id'];
        } else {
            $where = ' timemodified > '.$params['time_modified'];
        }    

        // Select the courses modified after the datime $timemodified. We select them order by timemodified ascending.
        $selected_courses = $DB->get_records_select('course', $where, array(), ' timemodified ASC ', 'id');   

        $returned courses = array();
        if (!empty($selected_courses)) {
            $course_list = array();
            // Call the function get_courses for each course to keep the timemodified order.
            foreach ($selected_courses as $key => $value) {
                // Call the standard API function to return the course detail.
                $course_details = core_course_external::get_courses(array('ids' => array($value->id)));
                $returned courses[] = $course_details[0];
            }
        }
        return $returned courses;   
    }

   
    /**
     * Returns description of method result value.
     * @return external_description.
     */
    public static function get_courses_by_date_returns() {
        global $USER, $DB, $CFG;
        require_once($CFG->dirroot . "/course/externallib.php");
        // We use the same result than the function get_courses.
        return core_course_external::get_courses_returns();      
    }
   
   
   
   
    /**
     * Returns description of method parameters.
     * @return external_function_parameters.
     */
    public static function get_users_by_date_parameters() {
        return new external_function_parameters(
            array(
                'time_modified' => new external_value(
                                           PARAM_INT, get_string('param_timemodified', 'local_myddleware'), VALUE_DEFAULT, 0),
                'id' => new external_value(PARAM_INT, get_string('param_id'), VALUE_DEFAULT, 0),
            )
        );
    }

    /**
     * This function search the users created or modified after after the datime $timemodified.
     * @param int $timemodified 
     * @param int $id 
     * @return the list of user.
     */
    public static function get_users_by_date($timemodified, $id) {
        global $USER, $DB, $CFG;
        require_once($CFG->dirroot . "/user/externallib.php");
       
        // Parameter validation.
        $params = self::validate_parameters(
            self::get_users_by_date_parameters(),
            array('time_modified' => $timemodified, 'id' => $id)
        );
       
        // Prepare the query condition.
        if (!empty($id)) {
            $where = ' deleted = 0 AND id = '.$params['id'];
        } else {
            $where = ' deleted = 0 AND timemodified > '.$params['time_modified'];
        }    
       
        // Select the users modified after the datime $timemodified.
        $selected_users = $DB->get_records_select('user', $where, array(), ' timemodified ASC ', 'id, timemodified');           
        $returned _users = array();
        if (!empty($selected_users)) {                       
            // Call function get_users for each user found.
            foreach ($selected_users as $user) {
                $user_details = array();
                $user_details = core_user_external::get_users(array( 'criteria' => array( 'key' => 'id', 'value' => $user->id ) ));
                // Add timemodified because this field is requiered by Myddleware.
                $user_details['users'][0]['timemodified'] = $user->timemodified;
                $returned _users[] = $user_details['users'][0];
            }
        }
        return $returned _users; 
    }

   
    /**
     * Returns description of method result value.
     * @return external_description.
     */
    public static function get_users_by_date_returns() {
        global $USER, $DB, $CFG;
        require_once($CFG->dirroot . "/user/externallib.php");
        // Add field timemodified because it doesn't exist in the standard structure (even if exists in the database, table user).
        $timemodified = array(
                'timemodified' => new external_value(
                    PARAM_INT,
                    get_string('param_timemodified', 'local_myddleware'),
                    VALUE_DEFAULT,
                    0,
                    NULL_NOT_ALLOWED
                ));
        // We use the same structure than in the function get_users.
        $userfields = core_user_external::user_description($timemodified);
        return new external_multiple_structure($userfields);
    }
   
   
    /**
     * Returns description of method parameters.
     * @return external_function_parameters.
     */
    public static function get_enrolments_by_date_parameters() {
        return new external_function_parameters(
            array(
                'time_modified' => new external_value(
                                           PARAM_INT, get_string('param_timemodified', 'local_myddleware'), VALUE_DEFAULT, 0),
                'id' => new external_value(PARAM_INT, get_string('param_id'), VALUE_DEFAULT, 0),
            )
        );
    }

    /**
     * This function search the enrolments modified after after the datime $timemodified.
     * @param int $timemodified 
     * @param int $id 
     * @return the list of course.
     */
    public static function get_enrolments_by_date($timemodified, $id) {
        global $USER, $DB, $CFG;
        require_once($CFG->dirroot . "/course/externallib.php");
       
        // Parameter validation.
        $params = self::validate_parameters(
            self::get_enrolments_by_date_parameters(),
            array('time_modified' => $timemodified, 'id' => $id)
        );
       
        // Prepare the query condition.
        if (!empty($id)) {
            $where = ' id = '.$params['id'];
        } else {
            $where = ' timemodified > '.$params['time_modified'];
        } 
       
        $return_enrolments = array();
        // Select enrolment modified after the date in input.
        $userenrolments = $DB->get_records_select('user_enrolments', $where, array(),  ' timemodified ASC ', '*');
        if (!empty($userenrolments)) {
            foreach ($userenrolments as $userenrolment) {
                $instance = array();
                // Get the enrolement detail (course, role and method).
                $instance = $DB->get_record('enrol', ['id' => $userenrolment->enrolid], '*', MUST_EXIST);
                // Prepare result.
                if (!empty($instance)) {
                    $userenroldata = [
                        'id'             => $userenrolment->id,
                        'userid'         => $userenrolment->userid,
                        'courseid'         => $instance->courseid,
                        'roleid'         => $instance->roleid,
                        'status'         => $userenrolment->status,
                        'enrol'         => $instance->enrol,
                        'timestart'     => $userenrolment->timestart,
                        'timeend'         => $userenrolment->timeend,
                        'timecreated'    => $userenrolment->timecreated,
                        'timemodified'     => $userenrolment->timemodified,
                    ];
                    $return_enrolments[] = $userenroldata;
                }
            }
        }    
       
        return $return_enrolments;
    }

   
    /**
     * Returns description of method result value.
     * @return external_description.
     */
    public static function get_enrolments_by_date_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, get_string('return_id', 'local_myddleware')),
                    'userid' => new external_value(PARAM_INT, get_string('return_userid', 'local_myddleware')),
                    'courseid' => new external_value(PARAM_INT, get_string('return_courseid', 'local_myddleware')),
                    'roleid' => new external_value(PARAM_INT, get_string('return_roleid', 'local_myddleware')),
                    'status' => new external_value(PARAM_TEXT, get_string('return_status', 'local_myddleware')),
                    'enrol' => new external_value(PARAM_TEXT, get_string('return_enrol', 'local_myddleware')),
                    'timestart' => new external_value(PARAM_INT, get_string('return_timestart', 'local_myddleware')),
                    'timeend' => new external_value(PARAM_INT, get_string('return_timeend', 'local_myddleware')),
                    'timecreated' => new external_value(PARAM_INT, get_string('return_timecreated', 'local_myddleware')),
                    'timemodified' => new external_value(PARAM_INT, get_string('return_timemodified', 'local_myddleware'))
                )
            )
        );
    }
   
   
    /**
     * Returns description of method parameters.
     * @return external_function_parameters.
     */
    public static function get_course_completion_by_date_parameters() {
        return new external_function_parameters(
            array(
                'time_modified' => new external_value(
                                           PARAM_INT, get_string('param_timemodified', 'local_myddleware'), VALUE_DEFAULT, 0),
                'id' => new external_value(PARAM_INT, get_string('param_id'), VALUE_DEFAULT, 0),
            )
        );
    }
   
    /**
     * This function search completion created after the date $timemodified in parameters.
     * @param int $timemodified 
     * @param int $id 
     * @return an array with the detail of each completion (id,userid,completionstate,timemodified,moduletype,instance,courseid).
     */
    public static function get_course_completion_by_date($timemodified, $id) {
        global $USER, $DB, $CFG;
        require_once($CFG->dirroot . "/course/externallib.php");
       
        // Parameter validation.
        $params = self::validate_parameters(
            self::get_course_completion_by_date_parameters(),
            array('time_modified' => $timemodified, 'id' => $id)
        );
       
        // Prepare the query condition.
        if (!empty($id)) {
            $where = ' id = '.$params['id'];
        } else {
            $where = ' timecompleted > '.$params['time_modified']. ' OR reaggregate > 0 ';
        } 
       
        $return_completions = array();
        // Select enrolment modified after the date in input.
        $selected_completions = $DB->get_records_select('course_completions', $where, array(),  ' timecompleted ASC ', '*');
        if (!empty($selected_completions)) {
            // Date ref management : date ref is usually the timecompleted.
            // But if reaggregate is not empty we have to keep the smaller value of this field.
            $date_ref_override = -1;
            // Reaggregate could be set.
            // In this case, the timecompleted will be updated with the time in reaggregate field the next time the cron job runs.
            // So we have to keep reaggregate as the reference date.
            // Because we have to read the completion after the next cron job runs.
            foreach ($selected_completions as $selected_completion) {
                // Keep the smaller value of reaggregateif it exists.
                if (
               
                        $selected_completion->reaggregate > 0
                    AND (   
                            $selected_completion->reaggregate < $date_ref_override
                         OR $date_ref_override == -1   
                    )
                ) {
                    $date_ref_override = $selected_completion->reaggregate;
                }
            }
       
            // Prepare result.
            foreach ($selected_completions as $selected_completion) {
                // We keep only completion with timecompleted not null.
                // Ssome completion could have reaggregate not null and timecompleted null.
                if (empty($selected_completion->timecompleted)) {
                    continue;
                }
                // Set date_ref_override if there is at least one reaggregate value (-1 second because we use > in Myddleware, not >= ).
                $completiondata = [
                    'id'                 => $selected_completion->id,
                    'userid'             => $selected_completion->userid,
                    'courseid'             => $selected_completion->course,
                    'timeenrolled'         => $selected_completion->timeenrolled,
                    'timestarted'         => $selected_completion->timestarted,
                    'timecompleted'     => $selected_completion->timecompleted,
                    'date_ref_override' => ($date_ref_override != -1 ? $date_ref_override - 1 : 0)
                ];
                // Prepare result.
                $return_completions[] = $completiondata;
            }    
        }    
        return $return_completions;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function get_course_completion_by_date_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, get_string('return_id', 'local_myddleware')),
                    'userid' => new external_value(PARAM_INT, get_string('return_userid', 'local_myddleware')),
                    'courseid' => new external_value(PARAM_INT, get_string('return_courseid', 'local_myddleware')),
                    'timeenrolled' => new external_value(PARAM_INT, get_string('return_timeenrolled', 'local_myddleware')),
                    'timestarted' => new external_value(PARAM_INT, get_string('return_timestarted', 'local_myddleware')),
                    'timecompleted' => new external_value(PARAM_INT, get_string('return_timecompleted', 'local_myddleware')),
                    'date_ref_override' => new external_value(PARAM_INT, get_string('return_date_ref_override', 'local_myddleware'))
                )
            )
        );
    }

   
}
