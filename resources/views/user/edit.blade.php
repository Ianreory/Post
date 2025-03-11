<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="w-full max-w-lg mx-auto">
        <form method="POST" action="{{ route('users.update', $user->id) }}" class="p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    value="{{ old('email', $user->email) }}" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="role" :value="__('Role')" />
                <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Author" {{ $user->role == 'Author' ? 'selected' : '' }}>Author</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('users.index') }}">
                    {{ __('Back to Users') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Update User') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
