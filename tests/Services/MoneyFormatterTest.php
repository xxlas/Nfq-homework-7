<?php


namespace App\Tests\Services;


use App\Services\MoneyFormatter;
use App\Services\NumberFormatter;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class MoneyFormatterTest extends TestCase
{
    /**
     * @var NumberFormatter
     */
    private $sut;
    private $mock;

    /**
     * @throws ReflectionException
     */
    public function setUp(): void
    {
        $this->mock = $this->getNumberFormatterMock();
        $this->sut = new MoneyFormatter($this->mock);
    }

    public function providerFormatEurData(): array
    {
        return [
            ['2835779', '2.84M €'],
            ['211.99', '211.99 €'],
        ];
    }

    /**
     * @dataProvider providerFormatEurData
     * @param $given
     * @param $expected
     */
    public function testFormatEur($given, $expected)
    {
        $this->mock->method('formatNumber')->with($given)->willReturn($expected);
        $this->assertEquals($expected.' €', $this->sut->formatEur($given));
    }

    public function providerFormatUsdData(): array
    {
        return [
            ['2835779', '$2.84M'],
            ['211.99', '$211.99'],
        ];
    }

    /**
     * @dataProvider providerFormatUsdData
     * @param $given
     * @param $expected
     */
    public function testFormatUsd($given, $expected)
    {
        $this->mock->method('formatNumber')->with($given)->willReturn($expected);
        $this->assertEquals('$'.$expected, $this->sut->formatUsd($given));
    }

    /**
     * @return MockObject
     * @throws ReflectionException
     */
    public function getNumberFormatterMock()
    {
        return $this->getMockBuilder(NumberFormatter::class)->getMock();
    }
}