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

use core_privacy\local\metadata\collection;


/**
 * Privacy provider for local_myddleware implementing null provider
 *
 * @package    local_myddleware
 * @copyright  2017 Myddleware
 * @author     Myddleware ltd
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
        // This plugin export data to external systems.
        \core_privacy\local\metadata\provider {

    /**
     * Provides metadata about the user data stored by this plugin.
     * This function defines the personal data that is shared with Myddleware,
     * such as user email and full name, to ensure compliance with privacy regulations.
     * @param collection $collection The initialized collection to add metadata items to.
     * @return collection The updated collection containing metadata about stored user data.
     */
    public static function get_metadata(collection $collection): collection {
        // Personal information has to be passed to Myddleware.
        // This includes the user email, fullname...
        $collection->add_external_location_link('myddleware', [
            'userid' => 'privacy:metadata:myddleware:userid',
            'fullname' => 'privacy:metadata:myddleware:fullname',
            'email' => 'privacy:metadata:myddleware:email',
            'username' => 'privacy:metadata:myddleware:username',
            'id' => 'privacy:metadata:myddleware:id',
            'password' => 'privacy:metadata:myddleware:password',
            'createpassword' => 'privacy:metadata:myddleware:createpassword',
            'firstname' => 'privacy:metadata:myddleware:firstname',
            'lastname' => 'privacy:metadata:myddleware:lastname',
            'auth' => 'privacy:metadata:myddleware:auth',
            'idnumber' => 'privacy:metadata:myddleware:idnumber',
            'lang' => 'privacy:metadata:myddleware:lang',
            'calendartype' => 'privacy:metadata:myddleware:calendartype',
            'theme' => 'privacy:metadata:myddleware:theme',
            'timezone' => 'privacy:metadata:myddleware:timezone',
            'mailformat' => 'privacy:metadata:myddleware:mailformat',
            'description' => 'privacy:metadata:myddleware:description',
            'city' => 'privacy:metadata:myddleware:city',
            'country' => 'privacy:metadata:myddleware:country',
            'firstnamephonetic' => 'privacy:metadata:myddleware:firstnamephonetic',
            'lastnamephonetic' => 'privacy:metadata:myddleware:lastnamephonetic',
            'middlename' => 'privacy:metadata:myddleware:middlename',
            'alternatename' => 'privacy:metadata:myddleware:alternatename',
            'address' => 'privacy:metadata:myddleware:address',
            'phone1' => 'privacy:metadata:myddleware:phone1',
            'phone2' => 'privacy:metadata:myddleware:phone2',
            'icq' => 'privacy:metadata:myddleware:icq',
            'skype' => 'privacy:metadata:myddleware:skype',
            'yahoo' => 'privacy:metadata:myddleware:yahoo',
            'aim' => 'privacy:metadata:myddleware:aim',
            'msn' => 'privacy:metadata:myddleware:msn',
            'department' => 'privacy:metadata:myddleware:department',
            'institution' => 'privacy:metadata:myddleware:institution',
            'interests' => 'privacy:metadata:myddleware:interests',
            'firstaccess' => 'privacy:metadata:myddleware:firstaccess',
            'lastaccess' => 'privacy:metadata:myddleware:lastaccess',
            'suspended' => 'privacy:metadata:myddleware:suspended',
            'confirmed' => 'privacy:metadata:myddleware:confirmed',
            'descriptionformat' => 'privacy:metadata:myddleware:descriptionformat',
            'url' => 'privacy:metadata:myddleware:url',
            'profileimageurlsmall' => 'privacy:metadata:myddleware:profileimageurlsmall',
            'profileimageurl' => 'privacy:metadata:myddleware:profileimageurl',
            'preferences' => 'privacy:metadata:myddleware:preferences',
            'customfields' => 'privacy:metadata:myddleware:customfields',
            'timemodified' => 'privacy:metadata:myddleware:timemodified',
            ], 'privacy:metadata:myddleware');
        return $collection;
    }
}
