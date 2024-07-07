<style>
    .container {
    display: flex;
    height: 100vh;
}

.photo {
    flex: 1;
    /*background-image: url('vendor/adminlte/dist/img/waste-management-edited-1536x960 - copia.png');*/
    /*background-color: #ebeef1;*/
    background-size: cover;
   
}

.form {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #F3F4F6;
}

/* .form h2 {
    margin-bottom: 20px;
}

.form form {
    width: 80%;
}

.form label, .form input, .form button {
    width: 100%;
    margin-bottom: 10px;
} */

.form button {
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}
.center_img{
    height: 100%;
    padding-top: 100px;
}
</style>

<div class="container">
    <div class="photo">
        <div class="center_img">
        <img src="vendor/adminlte/dist/img/waste-management-edited-1536x960 - copia.png" style="center"> 
    </div>
    </div>
    <div class="form">

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Usuario:') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña:') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Recuperar Acceso') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Acceder') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
</div>
</div>