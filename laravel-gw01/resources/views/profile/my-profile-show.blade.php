<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div>
                    <x-input-label for="profile_image" :value="__('Profile Image')" />
                    <!-- プロフィール画像の表示 -->
                    @if ($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="mt-1 block w-full rounded-md" />
                    @endif
                    <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
                </div>
                <div class="mt-4">
                    <img id="image_preview" src="#" alt="Image Preview" class="hidden w-32 h-32 object-cover" />
                </div>
                <div>
                    <x-input-label class="my-2 mt-2" for="name" :value="__('Name')" />
                    <p id="name" class="my-2 mt-1 block w-full border rounded-md">{{ $user->name }}</p>
                    <x-input-error class="my-2 mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                    <x-input-label class="my-2 mt-2" for="email" :value="__('Email')" />
                    <p id="email" class="my-2 mt-1 block w-full border rounded-md">{{ $user->email }}</p>
                    <x-input-error class="my-2 mt-2" :messages="$errors->get('email')" />
                </div>
                <div>
                    <x-input-label class="my-2 mt-2" for="number" :value="__('社員番号')" />
                    <p id="number" class="my-2 mt-1 block w-full border rounded-md">{{ $user->number }}</p>
                    <x-input-error class="my-2 mt-2" :messages="$errors->get('number')" />
                </div>
                <div>
                    <x-input-label class="my-2 mt-2" for="department" :value="__('部署')" />
                    <p id="department" class="my-2 mt-1 block w-full border rounded-md">{{ $user->department }}</p>
                    <x-input-error class="my-2 mt-2" :messages="$errors->get('department')" />
                </div>
                <div>
                    <x-input-label class="my-2 mt-2" for="class" :value="__('職能')" />
                    <p id="class" class="my-2 mt-1 block w-full border rounded-md">{{ $user->class }}</p>
                    <x-input-error class="my-2 mt-2" :messages="$errors->get('class')" />
                </div>
                <div>
                    <x-input-label class="my-2 mt-2" for="hobby" :value="__('趣味')" />
                    <p id="hobby" class="my-2 mt-1 block w-full border rounded-md">{{ $user->hobby }}</p>
                    <x-input-error class="my-2 mt-2" :messages="$errors->get('hobby')" />
                </div>
                <div>
                    <x-input-label class="my-2 mt-2" for="business_experience" :value="__('業務経験')" />
                    <p id="business_experience" class="my-2 mt-1 block w-full border rounded-md">{{ $user->business_experience }}</p>
                    <x-input-error class="my-2 mt-2" :messages="$errors->get('business_experience')" />
                </div>

                <div class="my-4 flex items-center gap-4">
                    <x-primary-button>
                    <a href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>