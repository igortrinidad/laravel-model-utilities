<?php

namespace IgorTrinidad\ModelUtilities\Tests;

use Ramsey\Uuid\Uuid;
use IgorTrinidad\ModelUtilities\ModelUtilities;

use IgorTrinidad\ModelUtilities\Tests\Models\Actor;
use IgorTrinidad\ModelUtilities\Tests\Models\Product;


class ModelUtilitiesTest extends TestCase
{

    const TEST_ACTOR = [
        'name' => 'arNOld',
        'last_name' => 'SchwarzeNEgger',
        'email' => 'arnold@terMINATOR.com',
        'bday' => '30/07/1947',
        'payroll' => 15000000.00
    ];

    const TEST_PRODUCT = [
        'name' => 'yeLLOW fun board',
        'value' => 1200.99
    ];

    /**
    * @testdox It should format a date using the ModelUtilities::formatDate
    */
    public function testFormatDate()
    {

        $unformattedDate = '1947-07-30';

        $formattedDate = ModelUtilities::formatDate($unformattedDate);

        $this->assertEquals('30/07/1947', $formattedDate);

    }

    /**
    * @testdox It should unformat date using the ModelUtilities::unformatDate
    */
    public function testUnformatDate()
    {

        $formattedDate = '30/07/1947';

        $unformattedDate = ModelUtilities::unformatDate($formattedDate);

        $this->assertEquals('1947-07-30', $unformattedDate);

    }

    /**
    * @testdox It should format currency using ModelUtilities::formatCurrency
    */
    public function testFormatCurrency()
    {
        $unformattedValue = 145.92;

        $formattedValue = ModelUtilities::formatCurrency($unformattedValue);

        $this->assertEquals('US$ 145,92', $formattedValue);
    }

    /**
    * @testdox It should sanitize email string
    */
    public function testSanitizeEmailFunction()
    {

        $unformattedEmail = 'TheEmail@DOmaiN.COM';

        $formatted = ModelUtilities::sanitizeEmail($unformattedEmail);

        $this->assertEquals('theemail@domain.com', $formatted);
    }

    /**
    * @testdox It should Title Case the String
    */
    public function testTitleCase()
    {

        $unformattedString = 'igOR TRINDade';

        $formatted = ModelUtilities::titleCase($unformattedString);

        $this->assertEquals('Igor Trindade', $formatted);
    }

    /**
    * @testdox It should Upper case the first char of the String
    */
    public function testUpperCaseFirst()
    {

        $unformattedString = 'INDEPENDENT TRUCKS STD 149mm';

        $formatted = ModelUtilities::upperCaseFirst($unformattedString);

        $this->assertEquals('Independent trucks std 149mm', $formatted);
    }

    /**
    * @testdox It should create and format the fullName using the FullName function
    */
    public function testFullName()
    {

        $first = 'igOR';
        $lastName = 'TrINDADE';

        $fullName = ModelUtilities::fullName($first, $lastName);

        $this->assertEquals('Igor Trindade', $fullName);
    }

    /**
    * @testdox It should create a new Actor model and validate the UUID primary key
    */
    public function testUuidModelGeneration()
    {

        $actor = Actor::create(self::TEST_ACTOR);

        $this->assertTrue(Uuid::isValid($actor->id));

    }

    /**
    * @testdox It should format the currency of the Actor model using the FormatCurrency trait
    */
    public function testFormattedCurrencyTrait()
    {

        Actor::create(self::TEST_ACTOR);

        $actor = Actor::first();

        $this->assertEquals('US$ 15.000.000,00', $actor->formatted_payroll);
    }

    /**
    * @testdox It should sanitize the email string with SanitizeEmail trait
    */
    public function testSanitizeEmailTrait()
    {

        Actor::create(self::TEST_ACTOR);

        $actor = Actor::first();

        $this->assertEquals('arnold@terminator.com', $actor->email);
    }

    /**
    * @testdox It should Title Case using the TitleCase trait
    */
    public function testTitleCaseTrait()
    {

        Actor::create(self::TEST_ACTOR);

        $actor = Actor::first();

        $this->assertEquals('Arnold', $actor->name);
    }

    /**
    * @testdox It should create the full_name attribute using FullName Trait
    */
    public function testFullNameTrait()
    {

        Actor::create(self::TEST_ACTOR);

        $actor = Actor::first();

        $this->assertEquals('Arnold Schwarzenegger', $actor->full_name);
    }

    /**
    * @testdox It should format a date column with FormatDate trait
    *
    */
    public function testFormattedDateTrait()
    {

        Actor::create(self::TEST_ACTOR);

        $actor = Actor::first();

        $this->assertEquals('30/07/1947', $actor->bday);
    }

    /**
    * @testdox It should update model and check if the formatted value updated matches
    */
    public function testUpdateModel()
    {
        Actor::create(self::TEST_ACTOR);

        $actor = Actor::first();

        $update = $actor->update(['payroll' => 1000000]);

        $this->assertTrue($update);

        $actor = $actor->fresh();

        $this->assertEquals('US$ 1.000.000,00', $actor->formatted_payroll);
    }

    /**
    * @testdox It create a new Product Model and test the formatted value and upperCaseFirst
    */
    public function testCreateNewProduct()
    {
        Product::create(self::TEST_PRODUCT);

        $product = Product::first();

        $this->assertEquals('Yellow fun board', $product->name);
        $this->assertEquals('R$ 1.200,99', $product->formatted_value);
    }

    /**
    * @testdox It update the Product Model and test the formatted value and upperCaseFirst
    */
    public function testUpdateNewProduct()
    {
        Product::create(self::TEST_PRODUCT);

        $product = tap(Product::first())->update(['name' => 'RED FUN BOARD', 'value' => 1199.99]);

        $product = $product->fresh();

        $this->assertEquals('Red fun board', $product->name);
        $this->assertEquals('R$ 1.199,99', $product->formatted_value);
    }

}
