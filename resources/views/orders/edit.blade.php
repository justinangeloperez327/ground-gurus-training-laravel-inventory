<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="{
                    orderItems: {{ $orderItems }},
                    addItem() {
                        this.orderItems.push({
                            id: null,
                            quantity: 1,
                            price: 0.01,
                        });
                    },
                    removeItem(index) {
                        this.orderItems.splice(index, 1);
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
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="order_date" :value="$order->order_date" />

                        </div>

                        <div class="mt-2">
                            <x-input-label for="supplier_id" :value="__('Supplier')" />
                            <x-select-option id="supplier_id" class="block mt-1 w-full" name="supplier_id" :options="$suppliers" :selected="old('supplier_id')" autofocus />
                            <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" id="">
                                <option value="pending" {{ 'pending' === $order->status ? 'selected' : '' }}>Pending</option>
                                @can('approve', $order)
                                    <option value="approved" {{ 'approved' === $order->status ? 'selected' : '' }}>Approved</option>
                                @endcan
                                @can('reject', $order)
                                    <option value="rejected" {{ 'rejected' === $order->status ? 'selected' : '' }}>Rejected</option>
                                @endcan
                                @can('cancel', $order)
                                    <option value="canceled" {{ 'canceled' === $order->status ? 'selected' : '' }}>Canceled</option>
                                @endcan
                                @can('receive', $order)
                                    <option value="received" {{ 'received' === $order->status ? 'selected' : '' }}>Received</option>
                                @endcan
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <table class="min-w-full divide-y divide-gray-200 mt-2">
                            <thead class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th></th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template x-for="(item, index) in orderItems" :key="index">
                                    <tr class="hover:bg-gray-200">
                                        <td class="px-2 py-2">
                                            <select class="" x-model="item.item_id" :name="'items['+index+'][item_id]'" >
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
                                            <input type="number" x-model="item.price" step="0.01" min="0.01" :name="'items['+index+'][price]'">
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
                            <button class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">
                                Update Order
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
