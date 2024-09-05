<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menbers list') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-4" style="width: 90%;">
        <table class="min-w-full bg-white border border-black">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-center border">profile</th>
                    <th class="px-4 py-2 text-center border">氏名</th>
                    <th class="px-4 py-2 text-center border">社員番号</th>
                    <th class="px-4 py-2 text-center border">部署</th>
                    <th class="px-4 py-2 text-center border">職能</th>
                    <th class="px-4 py-2 text-center border">趣味</th>
                    <th class="px-4 py-2 text-center border">業務経験</th>
                    <th class="px-4 py-2 text-center border">詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2 border">
                            <img src="{{ $user->profile_image }}" alt="Profile Image" class="profile-image">
                        </td>
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->number }}</td>
                        <td class="px-4 py-2 border">{{ $user->department }}</td>
                        <td class="px-4 py-2 border">{{ $user->class }}</td>
                        <td class="px-4 py-2 border">{{ $user->hobby }}</td>
                        <td class="px-4 py-2 border">{{ $user->business_experience }}</td>
                        <td class="px-4 py-2 border"><a href="{{ route('users.show', $user->id) }}">詳細</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>