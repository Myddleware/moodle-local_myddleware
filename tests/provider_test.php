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
 * @package    local_myddleware
 * @copyright  2017 Myddleware
 * @author     Myddleware ltd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_myddleware;

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/local/myddleware/classes/privacy/provider.php');
require_once($CFG->dirroot . '/local/myddleware/externallib.php');

use myddleware\privacy\provider;
use core_privacy\local\metadata\collection;
use core_privacy\local\metadata\types\external_location;

/**
 * Myddleware provider test
 *
 * @package    local_myddleware
 * @category   test
 * @copyright  2017 Myddleware
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @coversNothing
 */
final class provider_test extends advanced_testcase {

    /**
     * Test get_metadata function.
     * Function that test metadata.
     * @return bool
     */
    public function test_get_metadata(): void {
        $this->resetAfterTest();
        $provider = new provider();
        $collection = new collection('local_myddleware');

        $metadata = $provider::get_metadata($collection);
        $items = $metadata->get_collection();

        $this->assertInstanceOf(collection::class, $metadata);
        $this->assertEquals('local_myddleware', $metadata->get_component());
        $this->assertCount(1, $items);
        $this->assertInstanceOf(external_location::class, $items[0]);
    }
}
