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
 * Privacy provider implementation for local_myddleware
 *
 * @package    local_myddleware
 * @copyright  2017 Myddleware
 * @author     Myddleware ltd
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace myddleware\privacy;

use \core_privacy\local\request\plugin\provider as plugin_provider;
use core_privacy\local\metadata\collection;


/**
 * Privacy provider for local_myddleware implementing null provider
 *
 * @package    local_myddleware
 * @copyright  2017 Myddleware
 * @author     Myddleware ltd
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements plugin_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason(): string {
        return 'privacy:metadata';
    }

    public static function get_metadata(collection $collection): collection {
        $collection->add_external_location_link('myddleware', [
                'userid' => 'privacy:metadata:myddleware_client:userid',
                'fullname' => 'privacy:metadata:myddleware_client:fullname',
                'email' => 'privacy:metadata:myddleware_client:email',
            ], 'privacy:metadata:myddleware_client');
    
        return $collection;
    }
}
