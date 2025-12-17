<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Phone Address -->
        <div>
            <x-input-label for="phone" dir="rtl" :value="__('رقم الجوال')" />
            <div class="flex mt-1">
                <!-- رمز الدولة -->
                <select id="country_code" name="country_code"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-l-md shadow-sm w-1/4"
                    required>
                    <option value="967">+967</option>
                </select>
                <!-- رقم الجوال -->
                <x-text-input id="phone" class="block w-full rounded-l-none" type="text" name="phone"
                    :value="old('phone')" required autofocus autocomplete="tel" />
            </div>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            <x-input-error :messages="$errors->get('country_code')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" dir="rtl" :value="__('كلمة المرور')" />

            <x-text-input id="password" dir="rtl" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-orange-400 text-orange-600 shadow-sm orange-focus orange-checkbox"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('تذكرني') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif --}}

            <x-primary-button class="ms-3">
                {{ __('تسجيل الدخول') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>