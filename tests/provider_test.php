<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/local/myddleware/classes/privacy/provider.php');
require_once($CFG->dirroot . '/local/myddleware/externallib.php');

use myddleware\privacy\provider;
use core_privacy\local\metadata\collection;
use core_privacy\local\metadata\types\external_location;

class provider_test extends advanced_testcase
{
    public function test_get_metadata_part2()
    {
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
