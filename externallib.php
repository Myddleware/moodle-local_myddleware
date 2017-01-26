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
 * External Web Service Template
 *
 * @package    localmyddleware
 * @copyright  2017 Myddleware
 * @author     Myddleware ltd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . "/externallib.php");

class local_myddleware_external extends external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_users_completion_parameters() {
        return new external_function_parameters(
            array(
                'time_modified' => new external_value(
                    PARAM_INT,
                    get_string('param_timemodified', 'local_myddleware'),
                    VALUE_OPTIONAL,
                    0,
                    NULL_NOT_ALLOWED
                )
            )
        );
    }

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_users_last_access_parameters() {
        return new external_function_parameters(
            array(
                'time_modified' => new external_value(
                    PARAM_INT,
                    get_string('param_timemodified', 'local_myddleware'),
                    VALUE_OPTIONAL,
                    0,
                    NULL_NOT_ALLOWED
                )
            )
        );
    }


    /**
     * Returns welcome message
     * @return string welcome message
     */
    public static function get_users_completion($timemodified) {
        global $USER, $DB;

        // Parameter validation.
        $params = self::validate_parameters(
            self::get_users_completion_parameters(),
            array('time_modified' => $timemodified)
        );

        // Context validation.
        $context = context_user::instance($USER->id);
        self::validate_context($context);

        require_capability('moodle/user:viewdetails', $context);

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
                    cmc.timemodified > $timemodified
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
     * Returns welcome message
     * @return string welcome message
     */
    public static function get_users_last_access($timemodified) {
        global $USER, $DB;
        // Parameter validation.
        $params = self::validate_parameters(
            self::get_users_completion_parameters(),
            array('time_modified' => $timemodified)
        );

        // Context validation.
        $context = context_user::instance($USER->id);
        self::validate_context($context);

        require_capability('moodle/user:viewdetails', $context);

        $sql = "
                SELECT
                    la.id,
                    la.userid,
                    la.courseid,
                    la.timeaccess lastaccess
                FROM {user_lastaccess} la
                WHERE
                    la.timeaccess > $timemodified
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
     * Returns description of method result value
     * @return external_description
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
     * Returns description of method result value
     * @return external_description
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
}