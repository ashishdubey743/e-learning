<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;
    public string $selectedTab = 'login-form';
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        event(new Registered($user = User::create($validated)));
        Auth::login($user);
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-mary-tabs
        wire:model="selectedTab"
        active-class="bg-primary rounded text-white"
        label-class="font-semibold"
        label-div-class="bg-primary/5 p-2 rounded"
    >
        <x-mary-tab name="login-form" label="Login">
            <x-mary-form wire:submit="login">
                <div class="mb-4">
                    <x-mary-input wire:model="form.email" label="Email" icon="o-envelope"
                                  class="w-full px-4 py-2 border  rounded-md shadow-sm " inline/>
                </div>
                <div class="mb-4">
                    <x-mary-password wire:model="form.password" label="Password" icon="o-key" right
                                     class="w-full px-4 py-2 border rounded-md shadow-sm " inline/>
                </div>
                <div class="flex items-center justify-between">
                    <x-mary-checkbox class="self-start" wire:model="form.remember">
                        <x-slot:label>
                            <span>Remember Me</span>
                        </x-slot:label>
                    </x-mary-checkbox>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800"
                           wire:navigate>Forgot Your Password?</a>
                    @endif
                </div>
                <div class="grid justify-end w-full">
                    <x-mary-button type="submit" label="Login" class="w-full btn-primary py-2 mt-3 rounded-md shadow-sm"
                                   spinner="login"/>
                </div>
            </x-mary-form>
        </x-mary-tab>
        <x-mary-tab name="register-form" label="Register">
            <form wire:submit="register">
                <div>
                    <x-mary-input wire:model="name" label="Name" icon="o-envelope"
                                  class="w-full px-4 py-2 border  rounded-md shadow-sm " inline/>
                </div>
                <div class="mt-4">
                    <x-mary-input wire:model="email" label="Email" icon="o-envelope"
                                  class="w-full px-4 py-2 border  rounded-md shadow-sm " inline/>
                </div>
                <div class="mt-4">
                    <x-mary-password wire:model="password" label="Password" icon="o-key" right
                                     class="w-full px-4 py-2 border rounded-md shadow-sm " inline/>
                </div>
                <div class="mt-4">
                    <x-mary-password wire:model="password_confirmation" label="Password" icon="o-key" right
                                     class="w-full px-4 py-2 border rounded-md shadow-sm " inline/>
                </div>
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800 whitespace-nowrap"
                           wire:navigate>Already registered?</a>
                    @endif
                        <div class="grid justify-end w-full">
                            <x-mary-button type="submit" label="Register" class="w-full btn-primary py-2 mt-3 rounded-md shadow-sm"
                                           spinner="register"/>
                        </div>
                </div>
            </form>
        </x-mary-tab>
    </x-mary-tabs>
</div>
