<?php

namespace Tests\Unit;

use App\DataMapper\ClientSettings;
use App\DataMapper\CompanySettings;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * @test
 * @covers  App\DataMapper\BaseSettings
 */
class BaseSettingsTest extends TestCase
{
	
    public function setUp() :void
    {
    
    parent::setUp();
	
    $this->settings = new ClientSettings(ClientSettings::defaults());

	}

	public function testPropertyNamesExist()
	{
		$blank_object = new \stdClass;

		$updated_object = $this->migrate($blank_object);

		$this->assertTrue(property_exists($updated_object, 'language_id'));
	}

	public function testPropertyNamesNotExist()
	{
		$blank_object = new \stdClass;

		$updated_object = $this->migrate($blank_object);

		$this->assertFalse(property_exists($updated_object, 'non_existent_prop'));
	}	

	public function migrate(\stdClass $object) : \stdClass
	{

		foreach($this->settings as $property => $value)
		{
			if(!property_exists($object, $property))
				$object->{$property} = NULL;
		}

		return $object;
	}
}