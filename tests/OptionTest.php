<?php

use App\Entity\Option;
use App\Entity\Property;

use PHPUnit\Framework\TestCase;

final class OptionTest extends TestCase
{
   public function testCanBeUsedAsString(): void
    {
        $property = new Property();

        $this->assertEquals(
            'user@example.com',
            Option::removeProperty($property)
        );
    }
}
