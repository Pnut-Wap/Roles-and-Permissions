<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }} / Create
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
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf

                        <div>
                            <label for="name" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                    placeholder="Enter Name" name="name" id="name" value="{{ old('name') }}">

                                @error('name')
                                    <p class="text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="text-lg font-medium">Email</label>
                            <div class="my-3">
                                <input type="email" class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                    placeholder="Enter Email" name="email" id="email" value="{{ old('email') }}">

                                @error('email')
                                    <p class="text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password" class="text-lg font-medium">Password</label>
                            <div class="my-3">
                                <input type="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                    placeholder="Enter Password" name="password" id="password"
                                    value="{{ old('password') }}">

                                @error('password')
                                    <p class="text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="text-lg font-medium">Confirm Password</label>
                            <div class="my-3">
                                <input type="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                    placeholder="Confirm Password" name="password_confirmation"
                                    id="password_confirmation" value="{{ old('confirm_password') }}">

                                @error('confirm_password')
                                    <p class="text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-4 mb-3">
                            @forelse ($roles as $role)
                                <div class="mt-3">

                                    <input type="checkbox" class="rounded" name="role[]" value="{{ $role->name }}"
                                        id="role-{{ $role->id }}">
                                    <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            @empty
                            @endforelse
                        </div>

                        <button type="submit"
                            class="text-white bg-slate-700 hover:bg-slate-600 text-sm rounded-md px-5 py-3">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
