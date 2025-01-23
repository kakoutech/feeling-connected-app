<div  class="max-w-3xl p-6 mx-auto bg-white rounded-lg shadow">
 <h2 class="mb-6 text-2xl font-bold text-gray-700">Edit FC Admin</h2>
    <form wire:submit="editAdmin">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block w-full mt-1 cursor-text"  type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" disabled class="block w-full mt-1 bg-gray-200 cursor-not-allowed" type="email" name="email" required autocomplete="username" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input wire:model="phone" id="phone" class="block w-full mt-1 cursor-text" type="text" name="phone" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Edit FC Admin') }}
            </x-primary-button>
        </div>
    </form>
</div>
