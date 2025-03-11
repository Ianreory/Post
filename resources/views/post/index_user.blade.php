<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data User') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg shadow-md mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('users.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-5">
                Create User
            </a>
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-500 bg-gray-800">
                    <table class="min-w-full divide-y">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->role }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-sm font-medium">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="ml-2 text-red-600 hover:text-red-900">Delete</button>
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
