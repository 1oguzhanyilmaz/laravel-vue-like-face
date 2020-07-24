@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-8 flex">
        <div class="max-w-md w-full mx-auto">
            <h1 class="text-4xl text-center mb-12 font-thin">{{ __('Login') }}</h1>



            <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                <div class="p-8">
                    <form method="POST" class="" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-5">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-600">{{ __('E-Mail Address') }}</label>
                            <input type="text" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                            @error('email')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-600">{{ __('Password') }}</label>

                            <input type="password" id="password" name="password" required autocomplete="current-password"
                                   class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">

                            @error('password')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>

                        <button class="w-full p-3 mt-4 bg-indigo-600 text-white rounded shadow hover:bg-indigo-400">Login</button>
                    </form>
                </div>

                <div class="flex justify-between p-8 text-sm border-t border-gray-300 bg-gray-100">
                    <a href="{{ route('register') }}" class="font-medium text-indigo-500">Create account</a>

                    @if (Route::has('password.request'))
                        <a class="text-gray-600" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
