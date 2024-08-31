<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-200 text-green-800 px-4 py-2 rounded-md mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="flex justify-end">
                        @can('create', App\Models\Order::class)
                            <a href="{{ route('orders.create') }}" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Create order</a>
                        @endcan
                    </div>
                    <div class="mt-2">
                        <form action="{{ route('orders.index')}}" method="GET">
                            <input type="text" name="search" id="search" class="border border-gray-300 rounded-md p-2 w-full" placeholder="Search orders" value="{{ request('search') }}">
                            <div class="mt-2">
                                <button type="submit" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Search</button>
                            </div>
                        </form>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 mt-2">
                        <thead class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"># Items</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($orders as $order)
                                <tr class="hover:bg-gray-200 hover:-translate-y-1 transition-transform ease-in-out">
                                    <td class="px-2 py-2">{{ $order->order_date }}</td>
                                    <td class="px-2 py-2 capitalize">
                                        <span class="rounded-md px-1 py-1 border border-gray-400">{{ $order->status }}</span>
                                    </td>

                                    <td class="px-2 py-2">
                                        {{ $order->items_count }}
                                    </td>
                                    <td class="px-2 py-2">
                                        @can('view', $order)
                                            <a href="{{ route('orders.show', $order->id) }}" class="bg-blue-300 text-white hover:bg-blue-400 text-sm px-2 py-1 rounded-md">Show</a>
                                        @endcan
                                        @can('update', $order)
                                            <a href="{{ route('orders.edit', $order->id) }}" class="bg-green-300 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">Edit</a>
                                        @endcan
                                        @can('delete', $order)
                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-300 text-white hover:bg-red-400 text-sm px-2 py-1 rounded-md">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
