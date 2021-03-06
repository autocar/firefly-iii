<?php
use League\FactoryMuffin\Facade as f;

/**
 * Class AccountTest
 */
class UserTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    // tests

    public function testPreference()
    {
        $pref = f::create('Preference');
        $this->assertEquals($pref->user_id, $pref->user->id);
        $this->assertCount(1, $pref->user->preferences()->get());
    }

    public function testReminder()
    {
        $reminder = f::create('Reminder');
        $this->assertEquals($reminder->user_id, $reminder->user->id);
        $this->assertCount(1, $reminder->user->reminders()->get());
    }

}
