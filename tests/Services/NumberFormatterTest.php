<?php


namespace App\Tests\Services;


use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{
    public function providerMillionsData(): array
    {
        return [
            ['2835779', '2.84M'],
            ['999500', '1.00M'],
            ['-2835779', '-2.84M'],
            ['-999500', '-1.00M']
        ];
    }

    /**
     * @dataProvider providerMillionsData
     * @param $number
     * @param $expected
     */
    public function testFormatMillions($number, $expected)
    {
        $this->assertEquals($expected, NumberFormatter::formatMillions($number));
    }

    public function providerHundrethThousandsData(): array
    {
        return [
            ['535216', '535K'],
            ['99950', '100K'],
            ['-535216', '-535K'],
            ['-99950', '-100K']
        ];
    }

    /**
     * @dataProvider providerHundrethThousandsData
     * @param $number
     * @param $expected
     */
    public function testFormatHundrethThousands($number, $expected)
    {
        $this->assertEquals($expected, NumberFormatter::formatHundrethThousands($number));
    }

    public function providerThousandsData(): array
    {
        return [
            ['27533.78', '27 534'],
            ['999.99', '999.99'],
            ['999.9999', '1 000'],
            ['-27533.78', '-27 534'],
            ['-999.99', '-999.99'],
            ['-999.9999', '-1 000'],
        ];
    }

    /**
     * @dataProvider providerThousandsData
     * @param $number
     * @param $expected
     */
    public function testFormatThousands($number, $expected)
    {
        $this->assertEquals($expected, NumberFormatter::formatThousands($number));
    }

    public function providerBelowThousandsData(): array
    {
        return [
            ['533.1', '533.10'],
            ['66.6666', '66.67'],
            ['12.00', '12'],
            ['-533.1', '-533.10'],
            ['-66.6666', '-66.67'],
            ['-12.00', '-12']
        ];
    }

    /**
     * @dataProvider providerBelowThousandsData
     * @param $number
     * @param $expected
     */
    public function testFormatBelowThousands($number, $expected)
    {
        $this->assertEquals($expected, NumberFormatter::formatBelowThousand($number));
    }
}