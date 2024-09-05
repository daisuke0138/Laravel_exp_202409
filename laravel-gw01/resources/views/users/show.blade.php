<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menber profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- 画像表示フィールド -->
                    <div class="mb-4">
                        <x-input-label for="profile_image" :value="__('Profile Image')" />
                        <div class="mt-2">
                            <img id="image_preview" src="{{ $user->profile_image }}" alt="Profile Image" class="w-32 h-32 object-cover rounded-full" />
                        </div>
                    </div>

                    <!-- 名前表示フィールド -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <p id="name" class="mt-2 text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                    </div>

                    <!-- 社員番号表示フィールド -->
                    <div class="mb-4">
                        <x-input-label for="number" :value="__('社員番号')" />
                        <p id="number" class="mt-2 text-gray-900 dark:text-gray-100">{{ $user->number }}</p>
                    </div>

                    <!-- メールアドレス表示フィールド -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <p id="email" class="mt-2 text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
                    </div>

                    <!-- 部署表示フィールド -->
                    <div class="mb-4">
                        <x-input-label for="department" :value="__('部署')" />
                        <p id="department" class="mt-2 text-gray-900 dark:text-gray-100">{{ $user->department }}</p>
                    </div>

                    <!-- 職能表示フィールド -->
                    <div class="mb-4">
                        <x-input-label for="class" :value="__('職能')" />
                        <p id="class" class="mt-2 text-gray-900 dark:text-gray-100">{{ $user->class }}</p>
                    </div>

                    <!-- 趣味表示フィールド -->
                    <div class="mb-4">
                        <x-input-label for="hobby" :value="__('趣味')" />
                        <p id="hobby" class="mt-2 text-gray-900 dark:text-gray-100">{{ $user->hobby }}</p>
                    </div>

                    <!-- 業務経験表示フィールド -->
                    <div class="mb-4">
                        <x-input-label for="business_experience" :value="__('業務経験')" />
                        <p id="business_experience" class="mt-2 text-gray-900 dark:text-gray-100">{{ $user->business_experience }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>