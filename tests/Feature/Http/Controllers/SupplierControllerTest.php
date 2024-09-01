<?php

use App\Models\Supplier;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\mock;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->supplier = Supplier::factory()->create();

    mock(Supplier::class)->allows(['resolveRouteBinding' => $this->supplier]);

    actingAs($this->user);
});

it('display suppliers index', function () {
    $supplier = Supplier::factory()->create([
        'name' => 'Test Supplier',
    ]);

    get('/suppliers')
        ->assertViewIs('suppliers.index')
        ->assertViewHas('suppliers')
        ->assertSee($supplier->name)
        ->assertSee($supplier->email)
        ->assertSee($supplier->phone);
});

it('display suppliers create', function () {
    get('/suppliers/create')
        ->assertViewIs('suppliers.create');
});

it('creates supplier', function () {
    $data = [
        'name' => 'Supplier Name',
        'email' => 'supplier@email.com',
        'phone' => '09544444444',
    ];

    post('/suppliers', $data)
        ->assertRedirect(route('suppliers.index'))
        ->assertSee('suppliers')
        ->assertSessionHas('success', 'Supplier created successfully');
});

it('display suppliers edit', function () {
    get("/suppliers/{{ $this->supplier->id }}/edit")
        ->assertViewIs('suppliers.edit')
        ->assertViewHas('supplier')
        ->assertSee($this->supplier->name);
});

it('display suppliers show', function () {
    get("/suppliers/{{ $this->supplier->id }}")
        ->assertViewIs('suppliers.show');
});

it('updates supplier', function () {
    $data = [
        'name' => 'Supplier Name',
        'email' => 'new@email.com',
        'phone' => '09544444444',
    ];

    put("/suppliers/{{ $this->supplier->id }}", $data)
        ->assertRedirect(route('suppliers.index'))
        ->assertSee('suppliers')
        ->assertSessionHas('success', 'Supplier updated successfully');
});

it('deletes supplier', function () {
    delete("/suppliers/{{ $this->supplier->id }}")
        ->assertRedirect('/suppliers')
        ->assertSee('suppliers')
        ->assertSessionHas('success', 'Supplier deleted successfully');
});
