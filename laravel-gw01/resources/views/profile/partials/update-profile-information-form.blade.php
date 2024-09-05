<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information .") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <!-- 画像アップロードフィールド -->
        <div>
            <x-input-label for="profile_image" :value="__('Profile Image')" />
            <input id="profile_image" name="profile_image" type="file" class="mt-1 block w-full" onchange="previewImage(event)" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
        </div>
        <div class="mt-4">
            <img id="image_preview" src="#" alt="Image Preview" class="hidden w-32 h-32 object-cover" />
        </div>
        
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="number" :value="__('社員番号')" />
            <x-text-input id="number" name="number" type="text" class="mt-1 block w-full" :value="old('number', $user->number)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('number')" />
        </div>

        <div>
            <x-input-label for="department" :value="__('部署')" />
            <x-text-input id="department" name="department" type="text" class="mt-1 block w-full" :value="old('department', $user->department)" required autofocus autocomplete="部署" />
            <x-input-error class="mt-2" :messages="$errors->get('department')" />
        </div>

        <div>
            <x-input-label for="class" :value="__('職能')" />
            <select id="class" name="class" class="mt-1 block w-full" required autofocus>
                <option value="機構" {{ old('class', $user->class) == '機構' ? 'selected' : '' }}>機構</option>
                <option value="電気" {{ old('class', $user->class) == '電気' ? 'selected' : '' }}>電気</option>
                <option value="ソフト" {{ old('class', $user->class) == 'ソフト' ? 'selected' : '' }}>ソフト</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('class')" />
        </div>

        <div>
            <x-input-label for="hobby" :value="__('趣味')" />
            <x-text-input id="hobby" name="hobby" type="text" class="mt-1 block w-full" :value="old('hobby', $user->hobby)" required autofocus autocomplete="趣味" />
            <x-input-error class="mt-2" :messages="$errors->get('hobby')" />
        </div>

        <div>
            <x-input-label for="business_experience" :value="__('業務経験')" />
            <textarea id="business_experience" name="business_experience" class="mt-1 block w-full" rows="4" required autofocus>{{ old('business_experience', $user->business_experience) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('business_experience')" />
        </div>

        <script>
            function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('image_preview');
            output.src = reader.result;
            output.classList.remove('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
            }
        </script>

        <style>
            #image_preview {
            width: 150px; /* 幅を指定 */
            height: 150px; /* 高さを指定 */
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 5px;
            }
        </style>

        <div class="flex gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
            <x-primary-button>
                <a href="{{ route('profile.show') }}">{{ __('Back') }}</a>
            </x-primary-button>
            <form method="POST" action="{{ route('profile.delete') }}">
                @csrf
                @method('DELETE')
                <x-danger-button onclick="return confirm('{{ __('Are you sure you want to delete your profile?') }}')">
                    {{ __('Delete') }}
                </x-danger-button>
            </form>
        </div>
    </form>
</section>
