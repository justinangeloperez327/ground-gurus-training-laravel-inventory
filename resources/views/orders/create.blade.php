<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="{
                    items: [{
                        id: null,
                        quantity: 1,
                        price: 0.00,
                    }],
                    addItem() {
                        this.items.push({
                            id: null,
                            quantity: 1,
                            price: 0.00,
                        });
                    },
                    removeItem(index) {
                        this.items.splice(index, 1);
                    }
                }">
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="order_date" :value="__('Date')" />
                            <x-text-input id="order_date" class="block mt-1 w-full" type="date" name="order_date" :value="old('order_date')" autofocus />
                            <x-input-error :messages="$errors->get('order_date')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="supplier_id" :value="__('Supplier')" />
                            <x-select-option id="supplier_id" class="block mt-1 w-full" name="supplier_id" :options="$suppliers" :selected="old('supplier_id')" autofocus />
                            <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
                        </div>

                        <table class="min-w-full divide-y divide-gray-200 mt-2">
                            <thead class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template x-for="(item, index) in items" :key="index">
                                    <tr class="hover:bg-gray-200">
                                        <td class="px-2 py-2">
                                            <select class="" x-model="item.id" :name="'items['+index+'][id]'" >
                                                <option value="">Please Select Item</option>
                                                @foreach($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-2 py-2">
                                            <input type="number" x-model="item.quantity" :name="'items['+index+'][quantity]'">
                                        </td>
                                        <td class="px-2 py-2">
                                            <input type="number" x-model="item.price" min="0.01" step="0.01" :name="'items['+index+'][price]'">
                                        </td>
                                        <td class="px-2 py-2">
                                            <button type="button" class="bg-red-500 text-white hover:bg-red-700 text-sm px-2 py-1 rounded-md" @click="removeItem(index)">Remove</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <div>
                            <button type="button" @click="addItem" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">
                                Add Item
                            </button>
                        </div>
                        <div class="flex items-center justify-end mt-4">

                            <button type="submit" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">
                                Create Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
