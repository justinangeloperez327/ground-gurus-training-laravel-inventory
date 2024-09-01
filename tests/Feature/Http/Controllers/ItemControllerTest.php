<?php

use App\Models\Item;
use App\Models\Supplier;
use App\Models\User;

use function Pest\Laravel\{actingAs, delete, get, mock, post, put};

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->item = Item::factory()->create();

    mock(Item::class)->allows(['resolveRouteBinding' => $this->item]);

    actingAs($this->user);
});

it('display items index', function () {
    get(route('items.index'))
        ->assertViewIs('items.index')
        ->assertViewHas('items');
});

it('display items create', function () {
    get('/items/create')
        ->assertViewIs('items.create');
});

it('creates item', function () {
    $data = [
        'name' => 'Test Name',
        'description' => "Test Description",
        'price' => 12.0,
        'quantity' => 10,
        'supplier_id' => Supplier::factory()->create()->id,
    ];

    post('/items', $data)
        ->assertRedirect(route('items.index'))
        ->assertSee('items')
        ->assertSessionHas('success', 'Item created successfully');
});

it('display items edit', function () {
    get("/items/{{ $this->item->id }}/edit")
        ->assertViewIs('items.edit')
        ->assertViewHas('item')
        ->assertSee($this->item->name);
});

it('display items show', function () {
    get("/items/{{ $this->item->id }}")
        ->assertViewIs('items.show');
});

it('updates item', function () {
    $data = [
        'name' => 'Updated Name',
        'description' => "Updated Description",
        'price' => 12.0,
        'quantity' => 10,
        'supplier_id' => Supplier::factory()->create()->id,
    ];

    put("/items/{{ $this->item->id }}", $data)
        ->assertRedirect(route('items.index'))
        ->assertSee('items')
        ->assertSessionHas('success', 'Item updated successfully');
});

it('deletes item', function () {

    delete("/items/{{ $this->item->id }}")
        ->assertRedirect('/items')
        ->assertSee('items')
        ->assertSessionHas('success', 'Item deleted successfully');
});
