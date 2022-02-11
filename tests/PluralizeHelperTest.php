<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Medinam\LaravelPluralize\PluralizeHelper;

final class PluralizeHelperTest extends TestCase
{
    public function testSimplePlural(): void
    {
        $this->assertEquals(
            'Test Word|Test Words', 
            (new PluralizeHelper('Test Word'))->as('Test Words')
        );
    }

    public function testAdvancedPluralizations(): void
    {
        $pluralized = (new PluralizeHelper())
            ->case([0], 'no comments yet')
            ->case([1], '1 comment')
            ->case([2, 3], 'some comments')
            ->range([4, 20], 'many comments')
            ->range([21, 'Inf'], ':count comments')
            ->build();
        
        $this->assertEquals('{0} no comments yet|{1} 1 comment|{2, 3} some comments|[4, 20] many comments|[21, Inf] :count comments', $pluralized);
    }
}
