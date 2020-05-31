<?php

use PHPUnit\Framework\TestCase;
use IgorTrinidad\ModelUtilities\ModelUtilities;

class ModelUtilitiesTest extends TestCase
{


    public function testFormatDate()
    {

        $unformattedDate = '1986-06-18';

        $formattedDate = ModelUtilities::formatDate($unformattedDate, 'Y-m-d', 'd/m/Y');

        $this->assertEquals('18/06/1986', $formattedDate);

    }

    public function testUnformatDate()
    {

        $formattedDate = '18/06/1986';

        $unformattedDate = ModelUtilities::formatDate($formattedDate, 'd/m/Y', 'Y-m-d');

        $this->assertEquals('1986-06-18', $unformattedDate);

    }

    /**
    * testFormatCurrency
    */
    public function testFormatCurrency()
    {
        $unformattedValue = 145.92;

        $formattedValue = ModelUtilities::formatCurrency($unformattedValue, 'R$ ', 2, ',', '.');

        $this->assertEquals('R$ 145,92', $formattedValue);
    }

    /**
    * testSanitizeEmail
    */
    public function testSanitizeEmail()
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

}
