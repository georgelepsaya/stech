<x-guest-layout>
    <div class="xl:w-1/2 w-full lg:w-3/4 mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg">
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <ul>
            @foreach($errors->all() as $error)
                <li class="text-red-500">{{ $error }}</li>
            @endforeach
        </ul>

            <h1 class="text-lg font-medium mb-2">Personal information</h1>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <h1 class="text-lg font-medium my-2">Your profile picture</h1>
            <div class="mb-4 flex items-center">
                <input id="fileInput" class="hidden" type="file" name="profile_image" required/>
                <label for="fileInput" class="w-fit flex items-center hover:bg-gray-50 border border-gray-200 transition-all rounded-md py-1 shadow-sm dark:bg-gray-500 dark:hover:bg-gray-400 bg-white dark:text-gray-200 text-gray-800 px-3 text-sm">
                    Choose file
                </label>
                <span id="selectedFile" class="ml-3">No image chosen</span>
            </div>

            <h1 class="text-lg font-medium mb-2">Select your Interests (3-5)</h1>
            <ul id="tags_list" class="overflow-y-auto h-80 p-3 mt-4 grid grid-cols-1 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @foreach($tags as $tag)
                    <li class="flex items-center">
                        <input name="tags[]" id="checkbox-list-{{$tag->id}}" type="checkbox" value="{{$tag->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-list-{{$tag->id}}" class="w-full py-2 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$tag->title}}</label>
                    </li>
                @endforeach
            </ul>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
    </form>
    </div>
    <script>
        // custom file upload
        document.getElementById('fileInput').addEventListener('change', function() {
            const fileLabel = document.getElementById('selectedFile');
            if (this.files.length > 0) {
                fileLabel.textContent = this.files[0].name;
            } else {
                fileLabel.textContent = 'No file chosen';
            }
        });
    </script>
</x-guest-layout>
