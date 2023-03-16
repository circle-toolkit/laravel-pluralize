<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use CircleToolkit\LaravelPluralize\PluralizeHelper;

final class HelpersTest extends TestCase
{
    public function testTransPluralizeExists(): void
    {
        $this->assertTrue(function_exists('trans_pluralize'));
    }

    public function testTransPluralizeWorksCorrectly(): void
    {
        $this->assertInstanceOf(PluralizeHelper::class, trans_pluralize('Faker'));
    }
}
