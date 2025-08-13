<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Список пользователей</h2>
    </x-slot>

    <div class="container mx-auto max-w-7xl px-4 py-6">
        <table class="table-auto w-full border border-collapse bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" >
            <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Имя</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Роль</th>
                <th class="px-4 py-2 border">Создан</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border text-center">{{ $user->id }}</td>
                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                    <td class="px-4 py-2 border text-center">
                        @if ($user->is_admin)
                            <span class="text-green-600 font-semibold">Админ</span>
                        @else
                            <span class="text-gray-600">Пользователь</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border text-sm text-gray-500">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
