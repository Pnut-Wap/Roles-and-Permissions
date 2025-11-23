<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }} / Edit
            </h2>

            <a href="{{ route('users.index') }}" class="text-white bg-slate-700 text-sm rounded-md p-2">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                    placeholder="Enter Name" name="name" id="name"
                                    value="{{ old('name', $user->name) }}">

                                @error('name')
                                    <p class="text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="text-lg font-medium">Email</label>
                            <div class="my-3">
                                <input type="email" class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                    placeholder="Enter Email" name="email" id="email"
                                    value="{{ old('email', $user->email) }}">

                                @error('email')
                                    <p class="text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-4 mb-3">
                            @forelse ($roles as $role)
                                @if ($role->name !== 'superadmin' || auth()->user()->hasRole('superadmin'))
                                    <div class="mt-3">
                                        <input type="checkbox" class="rounded" name="role[]"
                                            value="{{ $role->name }}"
                                            {{ $hasRoles->contains($role->id) ? 'checked' : '' }}
                                            id="role-{{ $role->id }}">

                                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endif

                            @empty
                                <p>No roles found!</p>
                            @endforelse

                        </div>

                        <button type="submit"
                            class="text-white bg-slate-700 hover:bg-slate-600 text-sm rounded-md px-5 py-3">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
