<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Supplier Show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <x-input-label for="image" :value="__('Image')" />
                        <img  src="{{ $item->image_url }}" alt="Image Preview" style="max-width: 300px; margin-top: 20px;">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$item->name" autofocus autocomplete="name" disabled/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$item->description" autofocus autocomplete="description" disabled/>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Pirce')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" min="0.01" name="price" :value="$item->price" autofocus autocomplete="price" disabled/>
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="quantity" :value="__('Quantity')" />
                        <x-text-input id="quantity" class="block mt-1 w-full" type="number" step="1" min="1" name="quantity" :value="$item->quantity" autofocus autocomplete="quantity" disabled/>
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="supplier_id" :value="__('Supplier')" />
                        <x-select-option id="supplier_id" class="block mt-1 w-full" name="supplier_id" :options="$suppliers" :selected="$item->supplier_id" autofocus disabled/>
                        <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('items.edit', $item->id) }}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">
                            Edit Supplier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
