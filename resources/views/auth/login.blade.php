<x-guest-layout>
    <div class="flex min-h-screen flex-col justify-center px-4 sm:px-6 lg:px-8 
                bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-10 text-center text-2xl font-bold tracking-tight 
                       text-gray-900 dark:text-gray-100">
                {{ __('Login Ke Akun Anda') }}
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white dark:bg-gray-800 py-8 px-6 shadow rounded-lg">
                
                <!-- Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" 
                                      class="block mt-1 w-full dark:bg-gray-900 dark:text-gray-100" 
                                      type="email" 
                                      name="email" 
                                      :value="old('email')" 
                                      required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" 
                                      class="block mt-1 w-full dark:bg-gray-900 dark:text-gray-100"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" 
                                   class="rounded dark:bg-gray-900 border-gray-300 
                                          dark:border-gray-700 text-indigo-600 
                                          focus:ring-indigo-500 dark:focus:ring-indigo-600 
                                          dark:focus:ring-offset-gray-800" 
                                   name="remember">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Remember me') }}
                            </span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
