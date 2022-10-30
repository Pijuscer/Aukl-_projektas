<x-jet-action-section>
    <x-slot name="title">
        {{ __('Ištrinti paskyrą') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ištrinkite paskyrą visam laikui.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Kai paskyra bus ištrinta, visi jos ištekliai ir duomenys bus ištrinti visam laikui. Prieš ištrindami paskyrą, atsisiųskite visus duomenis ar informaciją, kurią norite išsaugoti.') }}
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Ištrinti paskyrą') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Ištrinti paskyrą') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Ar tikrai norite ištrinti savo paskyrą? Kai paskyra bus ištrinta, visi jos ištekliai ir duomenys bus ištrinti visam laikui. Įveskite slaptažodį, kad patvirtintumėte, jog norite visam laikui ištrinti paskyrą.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Slaptažodis') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Atšaukti') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Ištrinti paskyrą') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
