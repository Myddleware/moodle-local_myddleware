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
 * local_myddleware External functions unit tests
 *
 * @package    local_myddleware
 * @category   external
 * @copyright  2015 Andrew Hancox
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/webservice/tests/helpers.php');
require_once($CFG->dirroot . '/local/myddleware/externallib.php');

class local_myddleware_external_testcase extends externallib_advanced_testcase {
    public function test_get_users_completion() {
        $this->resetAfterTest(true);

        $user = $this->getDataGenerator()->create_user();
        self::setUser($user);

        // Set the required capabilities by the external function.
        $context = context_user::instance($user->id);
        $roleid = $this->assignUserCapability('moodle/user:viewdetails', $context->id);

        $param = 0;
 
        $returnvalue = local_myddleware_external::get_users_completion($param);
 
        // We need to execute the return values cleaning process to simulate the web service server.
        $returnvalue = external_api::clean_returnvalue(local_myddleware_external::get_users_completion_returns(), $returnvalue);
 
        // TODO - Ensure that the expected values are returned.
        //$this->assertEquals(EXPECTED_VALUE, RETURNED_VALUE);
 
        // Call without required capability.
        $this->unassignUserCapability('moodle/user:viewdetails', $context->id, $roleid);
        $this->setExpectedException('required_capability_exception');
        $returnvalue = local_myddleware_external::get_users_completion($param);
    }
}