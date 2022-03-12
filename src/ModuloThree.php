<?php

declare(strict_types = 1);

namespace Modulo;

use InvalidArgumentException;

/**
 * Modulo Three Exercise Class.
 *
 * @category Class
 * @author   Avinesh Bangar <avinesh@shaw.ca>
 *
 * Builds a simple Finite State Machine using three states.
 * States: S0, S1 and S2.
 */
class ModuloThree
{
    /**
     * Class constructor.
     *
     * @param string $value Binary string value.
     */
    public function __construct(string $value)
    {
        $this->_validateBinaryString($value);
    }

    /**
     * Validate binary string.
     *
     * @param string $value Binary string value.
     *
     * @return void
     */
    private function _validateBinaryString(string $value) : void
    {
        if (!preg_match('~^[01]+$~', $value)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid binary number string.',
                    $value
                )
            );
        }
    }

    /**
     * Convert binary number string to decimal.
     * Used for unit test.
     *
     * @param string $value Binary string value.
     *
     * @return integer
     */
    public static function convertBinaryToDecimal(string $value)
    {
        // Convert a string into an array, and subsequently reverse the values in the array.
        $binary_array = array_reverse(str_split($value));

        $bit = 0;
        $decimal = 0;
        // Iterate reversed array and manually convert each bit to a decimal value.
        foreach ($binary_array as $bit_value) {
            // The decimal number is equal to the sum of binary digits times their power of 2 (2^n).
            $decimal += $bit_value * pow(2, $bit);
            $bit++;
        }

        return $decimal;
    }

    /**
     * Determine the final state for a binary string value.
     *
     * @param string $value Binary string value.
     *
     * @return string
     */
    public static function getFinalState(string $value)
    {
        // Split binary string into individual byte values.
        $binary_array = str_split($value);
        // Initial state is 0 (S0).
        $state = '0';

        // Iterate `$binary_array`.
        for ($i = 0; $i < count($binary_array); $i++) {
            // Store binary digit (0 or 1).
            $digit = $binary_array[$i];

            // Switch state.
            switch ($state) {
            // State S0.
            case '0':
                if ($digit === '1') {
                    $state = '1';
                }
                break;

            // State S1.
            case '1':
                // Determine correct state.
                $state = ($digit === '0') ? '2' : '0';
                break;

            // State S2.
            case '2':
                if ($digit === '0') {
                    $state = '1';
                }
                break;
            }
        }

        return $state;
    }

    /**
     * Call class constructor with binary string value.
     * Used for unit test.
     *
     * @param string $value Binary string value.
     *
     * @return ModuloThree
     */
    public static function fromBinaryString(string $value)
    {
        return new self($value);
    }
}
