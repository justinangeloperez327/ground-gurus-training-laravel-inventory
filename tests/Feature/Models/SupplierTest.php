<?php

use App\Models\Supplier;
use function Pest\Laravel\assertDatabaseHas;

it('returns supplier model', function () {
    $supplier = Supplier::factory()->create([
        'name' => 'Test Supplier',
    ]);

    assertDatabaseHas('suppliers', [
        'name' => $supplier->name,
    ]);
});
