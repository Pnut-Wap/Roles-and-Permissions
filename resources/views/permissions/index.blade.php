<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions') }}
            </h2>

            <a href="{{ route('permissions.create') }}" class="text-white bg-slate-700 text-sm rounded-md p-2">
                Create
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message />

            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Create</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($permissions as $permission)
                        <tr class="border-b">
                            <td class="px-6 py-3 text-left">{{ $permission->id }}</td>
                            <td class="px-6 py-3 text-left">{{ $permission->name }}</td>
                            <td class="px-6 py-3 text-left">
                                {{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}
                            </td>
                            <td class="px-6 py-3 text-center flex space-x-2">
                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                    class="text-white bg-slate-700 text-sm rounded-md p-2">
                                    Edit
                                </a>

                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-700 text-sm rounded-md p-2">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-3 text-center text-gray-500">No permissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="my-3">
                {{ $permissions->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
