<x-guest-layout>
    <div class="min-h-screen flex flex-col md:flex-row bg-white">
        <!-- Left side - Branding and marketing content -->
        <div class="bg-indigo-600 text-white p-8 md:w-1/2 flex flex-col justify-center items-center">
            <div class="max-w-md w-full">
                <a href="/" class="block mb-8">
                    <x-application-logo class="w-20 h-20 fill-current text-white" />
                </a>
                
                <h1 class="text-4xl font-bold mb-4">Effortless Event Management Made Simple</h1>
                <p class="text-xl mb-8">Plan, organize, and execute flawless events with our intuitive platform. Save time, reduce stress, and delight your attendees.</p>
                
                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-medium text-center hover:bg-indigo-50 transition">Get Started - It's Free</a>
                    <a href="#" class="border-2 border-white text-white px-6 py-3 rounded-lg font-medium text-center hover:bg-white hover:text-indigo-600 transition">Explore Features</a>
                </div>
                
                <p class="text-indigo-200">Join 1,000+ happy event planners</p>
            </div>
        </div>

        <!-- Right side - Login form -->
        <div class="bg-white p-8 md:w-1/2 flex flex-col justify-center items-center">
            <div class="max-w-md w-full">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome back</h2>
                <p class="text-gray-600 mb-8">Sign in to your account to continue</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Error for blocked users -->
                @if ($errors->has('email'))
                    <div class="mb-4 text-sm text-red-600 bg-red-100 border border-red-300 rounded px-4 py-2">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:text-indigo-500 font-medium" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <x-primary-button class="w-full justify-center py-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:text-indigo-500">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>