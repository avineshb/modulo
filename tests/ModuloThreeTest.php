<?php

declare(strict_types = 1);

use Modulo\ModuloThree;
use PHPUnit\Framework\TestCase;

/**
 * Unit test for ModuloThree class.
 *
 * @category Class
 * @author   Avinesh Bangar <avinesh@shaw.ca>
 */
class ModuloThreeTest extends TestCase
{
    /**
     * Test constructor with a valid binary string argument.
     *
     * @return void
     */
    public function testConstructor(): void
    {
        $this->assertInstanceOf(ModuloThree::class, ModuloThree::fromBinaryString('1010'));
    }

    /**
     * Test constructor with an invalid binary string argument.
     *
     * @return void
     */
    public function testInvalidConstructorArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->assertInstanceOf(ModuloThree::class, ModuloThree::fromBinaryString('-1010'));
    }

    /**
     * Test invalid binary number.
     *
     * @return void
     */
    public function testInvalidBinaryNumber(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ModuloThree::fromBinaryString('-1010');
    }

    /**
     * Test empty string.
     *
     * @return void
     */
    public function testEmptyString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ModuloThree::fromBinaryString('');
    }

    /**
     * Test long binary string.
     *
     * @return void
     */
    public function testLongString(): void
    {
        $this->assertEquals('1', ModuloThree::getFinalState($this->getLongString()));
    }

    /**
     * Test various binary values.
     *
     * @return void
     */
    public function testBinaryStrings(): void
    {
        // Final state should be S1 or '1' for binary number '1101'.
        $this->assertEquals('1', ModuloThree::getFinalState('1101'));

        // Final state should be S2 or '2' for binary number '1110'.
        $this->assertEquals('2', ModuloThree::getFinalState('1110'));

        // Final state should be S0 or '0' for binary number '1111'.
        $this->assertEquals('0', ModuloThree::getFinalState('1111'));

        // Final state should be S0 or '0' for binary number '110'.
        $this->assertEquals('0', ModuloThree::getFinalState('110'));

        // Final state should be S1 or '1' for binary number '1010'.
        $this->assertEquals('1', ModuloThree::getFinalState('1010'));
    }

    /**
     * Test binary to decimal conversion.
     *
     * @return void
     */
    public function testBinaryToDecimalConversion(): void
    {
        // Should be 13.
        $this->assertEquals('13', ModuloThree::convertBinaryToDecimal('1101'));

        // Should be 14.
        $this->assertEquals('14', ModuloThree::convertBinaryToDecimal('1110'));

        // Should be 15.
        $this->assertEquals('15', ModuloThree::convertBinaryToDecimal('1111'));

        // Should be 6.
        $this->assertEquals('6', ModuloThree::convertBinaryToDecimal('110'));

        // Should be 10.
        $this->assertEquals('10', ModuloThree::convertBinaryToDecimal('1010'));
    }

    /**
     * Get a long binary string.
     *
     * @return string
     */
    public function getLongString()
    {
        $characters = '01';
        $limit = (int) ceil(32768 / strlen($characters));

        return substr(str_repeat($characters, $limit), 1, 32768);
    }
}
