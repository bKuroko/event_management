<x-guest-layout>
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left side - Branding and marketing content -->
        <div class="bg-indigo-600 text-white p-8 md:w-1/2 flex flex-col justify-center">
            <div class="max-w-md mx-auto">
                <h1 class="text-4xl font-bold mb-4">Join EventFlow Today</h1>
                <p class="text-xl mb-8">Create your account and start planning amazing events in minutes. Our platform makes event management effortless and enjoyable.</p>
                
                <div class="space-y-4 mb-8">
                    <div class="flex items-start">
                        <svg class="h-6 w-6 text-green-300 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p>Plan events with our intuitive tools</p>
                    </div>
                    <div class="flex items-start">
                        <svg class="h-6 w-6 text-green-300 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p>Manage attendees with ease</p>
                    </div>
                    <div class="flex items-start">
                        <svg class="h-6 w-6 text-green-300 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p>Get real-time analytics</p>
                    </div>
                </div>
                
                <p class="text-indigo-200">Trusted by 1,000+ event professionals worldwide</p>
            </div>
        </div>

        <!-- Right side - Registration form -->
        <div class="bg-white p-8 md:w-1/2 flex flex-col justify-center">
            <div class="max-w-md mx-auto w-full">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Create your account</h2>
                <p class="text-gray-600 mb-8">Get started with your free account today</p>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Full Name')" />
                        <x-text-input id="name" class="block mt-1 w-full px-4 py-3" 
                                    type="text" 
                                    name="name" 
                                    :value="old('name')" 
                                    required 
                                    autofocus 
                                    autocomplete="name"
                                    placeholder="Enter your full name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email Address')" />
                        <x-text-input id="email" class="block mt-1 w-full px-4 py-3" 
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    required 
                                    autocomplete="email"
                                    placeholder="Enter your email address" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full px-4 py-3"
                                    type="password"
                                    name="password"
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Create a password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <p class="mt-1 text-sm text-gray-500">Minimum 8 characters</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full px-4 py-3"
                                    type="password"
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Confirm your password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center mt-6">
                        <input id="terms" name="terms" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" required>
                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            I agree to the <a href="#" class="text-indigo-600 hover:text-indigo-500">Terms of Service</a> and <a href="#" class="text-indigo-600 hover:text-indigo-500">Privacy Policy</a>
                        </label>
                    </div>

                    <x-primary-button class="w-full justify-center py-3 mt-4">
                        {{ __('Create Account') }}
                    </x-primary-button>

                    <div class="mt-6 text-center">
                        <p class="text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:text-indigo-500">Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>