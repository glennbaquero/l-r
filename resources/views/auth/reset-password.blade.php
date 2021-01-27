<x-guest-layout>
    <x-slot name="title">
        Reset your Password
    </x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mt-8 sm:ml-40 sm:w-full sm:max-w-md">
        <div class="py-8 px-4 sm:rounded-lg sm:px-10">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
    
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block text-sm font-medium leading-5 mb-2 @error('email') text-red-500 @enderror">
                        {{ __('Email')}}
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2 @error('email') text-red-500 @enderror">
                            <span class="p-1 focus:outline-none focus:shadow-outline">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>                   
                            </span>
                        </span>

                        <input type="email" id="email" name="email" value="{{old('email')}}" required class="appearance-none block w-full pl-12 py-2 border border-white bg-transparent rounded-full placeholder-gray-400 tracking-wider focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-8 @error('email') border-red-500 @enderror" />
                    </div>
                    @error('email')
                        <p class="mt-2 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mt-10">
                    <label for="password" class="block text-sm font-medium leading-5 mb-2 @error('password') text-red-500 @enderror">
                        {{ __('New Password')}}
                    </label>
                    <toggle>
                        <div slot-scope="{ display, toggled }" class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2 @error('password') text-red-500 @enderror">
                                <span class="p-1 focus:outline-none focus:shadow-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>                      
                                </span>
                            </span>

                            <input id="password" :type="display ? 'text' : 'password'" name="password" required class="appearance-none block w-full pl-12 py-2 border border-white bg-transparent rounded-full placeholder-gray-400 tracking-wider focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:leading-8 @error('password') border-red-500 @enderror" :class="display ? 'sm:text-sm' : 'sm:text-xl'" />

                            <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                                <button tabindex="-1" @click.prevent="toggled" class="p-1 focus:outline-none focus:shadow-outline">
                                    <svg v-if="!display" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                </button>
                            </span>
                        </div>
                    </toggle>
                    @error('password')
                        <p class="mt-2 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mt-10">
                    <label for="password_confirmation" class="block text-sm font-medium leading-5 mb-2 @error('password') text-red-500 @enderror">
                        {{ __('Confirm Password')}}
                    </label>
                    <toggle>
                        <div slot-scope="{ display, toggled }" class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2 @error('password') text-red-500 @enderror">
                                <span class="p-1 focus:outline-none focus:shadow-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>                      
                                </span>
                            </span>

                            <input id="password_confirmation" :type="display ? 'text' : 'password'" name="password_confirmation" required class="appearance-none block w-full pl-12 py-2 border border-white bg-transparent rounded-full placeholder-gray-400 tracking-wider focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:leading-8 @error('password') border-red-500 @enderror" :class="display ? 'sm:text-sm' : 'sm:text-xl'" />

                            <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                                <button tabindex="-1" @click.prevent="toggled" class="p-1 focus:outline-none focus:shadow-outline">
                                    <svg v-if="!display" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                </button>
                            </span>
                        </div>
                    </toggle>
                </div>

                <div class="mt-10">
                    <span class="block w-full shadow-sm">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-full text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out sm:leading-8">
                            {{ __('Reset Password') }}
                        </button>
                    </span>
                </div>

                <div class="mt-4 text-center">            
                    <div class="text-sm leading-5">
                        <a href="{{ route('login') }}" class="font-medium focus:outline-none focus:underline transition ease-in-out duration-150">
                            {{ __('Sign-in instead?') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
