<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Requisition Show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <x-input-label for="date" :value="__('Date')" />
                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="requistion_date" :value="$requisition->requisition_date" disabled />

                    </div>
                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <x-text-input id="status" class="block mt-1 w-full" type="text" name="status" :value="$requisition->status" disabled />
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 mt-2">
                        <thead class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($requisition->items as $item)
                                <tr class="hover:bg-gray-200 hover:-translate-y-1 transition-transform ease-in-out">
                                    <td class="px-2 py-2">{{ $item->name }}</td>
                                    <td class="px-2 py-2">{{ $item->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('requisitions.edit', $requisition->id) }}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">
                            Edit Requisition
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
