<?php

namespace IgorTrinidad\ModelUtilities\Tests;

use Ramsey\Uuid\Uuid;
use IgorTrinidad\ModelUtilities\ModelUtilities;

use IgorTrinidad\ModelUtilities\Tests\Models\Actor;


class ModelUtilitiesTest extends TestCase
{

    const TEST_ACTOR = [
        'name' => 'arNOld SchwarzeNEgger',
        'email' => 'arnold@terMINATOR.com',
        'bday' => '30/07/1947',
        'payroll' => 15000000.00
    ];

    public function testFormatDate()
    {

        $unformattedDate = '1947-07-30';

        $formattedDate = ModelUtilities::formatDate($unformattedDate);

        $this->assertEquals('30/07/1947', $formattedDate);

    }

    public function testUnformatDate()
    {

        $formattedDate = '30/07/1947';

        $unformattedDate = ModelUtilities::unformatDate($formattedDate);

        $this->assertEquals('1947-07-30', $unformattedDate);

    }

    /**
    * testFormatCurrency
    */
    public function testFormatCurrency()
    {
        $unformattedValue = 145.92;

        $formattedValue = ModelUtilities::formatCurrency($unformattedValue);

        $this->assertEquals('US$ 145,92', $formattedValue);
    }

    /**
    * testSanitizeEmail
    */
    public function testSanitizeEmailFunction()
    {
        $unformattedEmail = 'TheEmail@DOmaiN.COM';

        $formatted = ModelUtilities::sanitizeEmail($unformattedEmail);

        $this->assertEquals('theemail@domain.com', $formatted);
    }

    /**
    * testTitleCase
    */
    public function testTitleCase()
    {
        $unformattedString = 'igOR TRINDade';

        $formatted = ModelUtilities::titleCase($unformattedString);

        $this->assertEquals('Igor Trindade', $formatted);
    }

    /**
    * Test Uuid primary key column generation
    */
    public function testUuidModelGeneration()
    {

        $actor = Actor::create(self::TEST_ACTOR);

        $this->assertTrue(Uuid::isValid($actor->id));

    }

    /**
    * Test Formatted Currency Column
    */
    public function testFormattedCurrencyTrait()
    {

        Actor::create(self::TEST_ACTOR);

        $actor = Actor::first();

        $this->assertEquals('US$ 15.000.000,00', $actor->formatted_payroll);
    }

    /**
    * Test Sanitize email Trait
    */
    public function testSanitizeEmailTrait()
    {

        Actor::create(self::TEST_ACTOR);

        $actor = Actor::first();

        $this->assertEquals('arnold@terminator.com', $actor->email);
    }

    /**
    * Test Trait Case Trait
    */
    public function testTitleCaseTrait()
    {

        Actor::create(self::TEST_ACTOR);

        $actor = Actor::first();

        $this->assertEquals('Arnold Schwarzenegger', $actor->name);
    }

    /**
    * Test Formatted Date Trait
    */
    public function testFormattedDateTrait()
    {

        Actor::create(self::TEST_ACTOR);

        $actor = Actor::first();

        $this->assertEquals('30/07/1947', $actor->bday);
    }

}
