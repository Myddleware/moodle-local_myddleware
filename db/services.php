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
 * Web service local plugin template external functions and service definitions.
 *
 * @package    local_myddleware
 * @copyright  2017 Myddleware
 * @author     Myddleware ltd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// We defined the web service functions to install.
$functions = [
    'local_myddleware_get_users_last_access' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_users_last_access',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return last access of users',
            'type'        => 'read',
    ],
    'local_myddleware_get_users_completion' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_users_completion',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return completion of users',
            'type'        => 'read',
    ],
    'local_myddleware_get_courses_by_date' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_courses_by_date',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return course list',
            'type'        => 'read',
    ],
    'local_myddleware_get_groups_by_date' => [
        'classname'   => 'local_myddleware_external',
        'methodname'  => 'get_groups_by_date',
        'classpath'   => 'local/myddleware/externallib.php',
        'description' => 'Return group list',
        'type'        => 'read',
    ],
    'local_myddleware_get_group_members_by_date' => [
        'classname'   => 'local_myddleware_external',
        'methodname'  => 'get_group_members_by_date',
        'classpath'   => 'local/myddleware/externallib.php',
        'description' => 'Return group member list',
        'type'        => 'read',
    ],
    'local_myddleware_get_users_by_date' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_users_by_date',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return user list',
            'type'        => 'read',
    ],
    'local_myddleware_get_enrolments_by_date' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_enrolments_by_date',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return enrolment list',
            'type'        => 'read',
    ],
    'local_myddleware_search_enrolment' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'search_enrolment',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return enrolment list',
            'type'        => 'read',
    ],
    'local_myddleware_get_course_completion_by_date' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_course_completion_by_date',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return course completion list',
            'type'        => 'read',
    ],
    'local_myddleware_get_user_compentencies_by_date' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_user_compentencies_by_date',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return user compencies list',
            'type'        => 'read',
    ],
    'local_myddleware_get_competency_module_completion_by_date' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_competency_module_completion_by_date',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return competency module completion list',
            'type'        => 'read',
    ],
    'local_myddleware_get_user_grades' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_user_grades',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return grades of users',
            'type'        => 'read',
    ],
    'local_myddleware_get_users_statistics_by_date' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_users_statistics_by_date',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return statistics of users',
            'type'        => 'read',
    ],
    'local_myddleware_get_quiz_attempts' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_quiz_attempts',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return quizzes of users',
            'type'        => 'read',
    ],
    'local_myddleware_get_course_completion_percentage' => [
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_course_completion_percentage',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return percentage completion of users and courses',
            'type'        => 'read',
    ],
];

// We define the services to install as pre-build services.
// A pre-build service is not editable by administrator.
$services = [
    'Myddleware service' => [
                'functions' => [
                        'local_myddleware_get_users_last_access',
                        'local_myddleware_get_users_completion',
                        'local_myddleware_get_courses_by_date',
                        'local_myddleware_get_groups_by_date',
                        'local_myddleware_get_group_members_by_date',
                        'local_myddleware_get_users_by_date',
                        'local_myddleware_get_enrolments_by_date',
                        'local_myddleware_search_enrolment',
                        'local_myddleware_get_course_completion_by_date',
                        'local_myddleware_get_user_compentencies_by_date',
                        'local_myddleware_get_competency_module_completion_by_date',
                        'local_myddleware_get_user_grades',
                        'local_myddleware_get_users_statistics_by_date',
                        'local_myddleware_get_quiz_attempts',
                        'local_myddleware_get_course_completion_percentage',
                        'core_course_create_courses',
                        'core_course_get_categories',
                        'core_course_get_courses_by_field',
                        'core_course_update_courses',
                        'core_group_add_group_members',
                        'core_group_create_groups',
                        'core_user_create_users',
                        'core_user_get_users',
                        'core_user_update_users',
                        'core_webservice_get_site_info',
                        'enrol_manual_enrol_users',
                        'enrol_manual_unenrol_users',
                ],
                'restrictedusers' => 1,
                'enabled' => 1,
            ],
];
