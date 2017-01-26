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
 * @package    localmyddleware
 * @copyright  2017 Myddleware
 * @author     Myddleware ltd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// We defined the web service functions to install.
$functions = array(
    'local_myddleware_get_users_last_access' => array(
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_users_last_access',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return last access of users',
            'type'        => 'read',
    ),
    'local_myddleware_get_users_completion' => array(
            'classname'   => 'local_myddleware_external',
            'methodname'  => 'get_users_completion',
            'classpath'   => 'local/myddleware/externallib.php',
            'description' => 'Return completion of users',
            'type'        => 'read',
    )
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
    'Myddleware service' => array(
                'functions' => array (
                        'local_myddleware_get_users_last_access',
                        'local_myddleware_get_users_completion'
                ),
                'restrictedusers' => 0,
                'enabled' => 1,
            ),
);
