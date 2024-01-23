<?php

namespace Tests\Unit;

use App\Models\Edition;
use Tests\TestCase;

// FIX: Call to a member function connection() on null
// Replace "use PHPUnit\Framework\TestCase;" with "use Tests\TestCase;"

class EditionTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_active_and_only_one_edition(): void
    {
        $edition = Edition::where('active', 1)->get();
        $hasActiveAndOnlyOneEdition = (!is_null($edition)) && (count($edition) === 1);
        $this->assertTrue($hasActiveAndOnlyOneEdition);
    }
}
