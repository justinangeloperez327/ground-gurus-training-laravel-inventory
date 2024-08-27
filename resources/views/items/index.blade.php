<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end">
                        <a href="{{ route('items.create') }}" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Create Item</a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 mt-2">
                        <thead class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <tr class="hover:bg-gray-200 hover:-translate-y-1 transition-transform ease-in-out">
                                    <td class="px-2 py-2">{{ $item->id }}</td>
                                    <td class="px-2 py-2">
                                        <img src="{{ '/storage/'.$item->image }}" class="h-16 w-16" />
                                    </td>
                                    <td class="px-2 py-2">{{ $item->name }}</td>
                                    <td class="px-2 py-2">{{ $item->price }}</td>
                                    <td class="px-2 py-2">{{ $item->quantity }}</td>
                                    <td class="px-2 py-2">
                                        <a href="{{ route('items.show', $item->id) }}" class="bg-blue-300 text-white hover:bg-blue-400 text-sm px-2 py-1 rounded-md">Show</a>

                                        <a href="{{ route('items.edit', $item->id) }}" class="bg-green-300 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">Edit</a>

                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-300 text-white hover:bg-red-400 text-sm px-2 py-1 rounded-md">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
