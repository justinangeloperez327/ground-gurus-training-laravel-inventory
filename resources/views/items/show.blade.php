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
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$supplier->name" disabled />

                        </div>
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="$supplier->email" disabled />

                        </div>
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="$supplier->phone" disabled />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">
                                Edit Supplier
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
