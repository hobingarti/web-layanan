<div class="container mx-auto px-4 py-8">
    <x-confirmation-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            {{$alertTitle}}
        </x-slot>

        <x-slot name="content">
            {{$alertMessage}}
        </x-slot>   

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                Batal
            </x-secondary-button>

            <button class="ml-2 bg-red-500 py-2 px-4 rounded-md " wire:click="deleteUser" wire:loading.attr="disabled">
                Confirm
            </button>
        </x-slot>
    </x-confirmation-modal>

    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150'" wire:click="confirmUserDeletion">
        Delete Account
    </button>

    <x-secondary-button>Test</x-secondary-button>

    

    <x-danger-button>Test</x-danger-button>
    <button class="hover:bg-green-900 hover:ring hover:ring-green-900 hover:ring-offset-2 bg-green-700 text-white px-4 py-2 font-semibold text-sm text-slate-700 rounded-md"><i class="fa fa-trash-can"></i> Button B</button>

   

    

    <button class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150'" wire:click="confirmUserDeletion">
        Delete Account
    </button>


    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold mb-4">Layanan</h1>
        <button class="bg-sky-500 hover:bg-sky-700 text-white px-4 py-2 rounded" wire:click="formTambahData">Tambah Data</button>
    </div>

    <div>
        {{$number}}
        <button wire:click="up" class="bg-blue-500 text-white px-4 py-2 rounded">Increment</button>
        <button wire:click="down" class="bg-red-500 text-white px-4 py-2 rounded">Decrement</button>
    </div>

    

    @if(session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            <strong class="font-bold">Message:</strong>
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    @if($showForm)
        <form wire:submit.prevent="store" class="mb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nikWarga" class="block text-sm font-medium text-gray-700">nikWarga</label>
                    <input type="text" id="nikWarga" wire:model="nikWarga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nikWarga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="namaWarga" class="block text-sm font-medium text-gray-700">namaWarga</label>
                    <input type="text" id="namaWarga" wire:model="namaWarga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('namaWarga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="alamatDomisili" class="block text-sm font-medium text-gray-700">alamatDomisili</label>
                    <input type="text" id="alamatDomisili" wire:model="alamatDomisili" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('alamatDomisili') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="lingkunganDomisili" class="block text-sm font-medium text-gray-700">lingkunganDomisili</label>
                    <input type="text" id="lingkunganDomisili" wire:model="lingkunganDomisili" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('lingkunganDomisili') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-4 flex justify-end space-x-2">
                <button class="bg-sky-500 hover:bg-sky-700 px-4 py-2 rounded">Save changes</button>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded">
                    {{ $isEditing ? 'Update' : 'Create' }}
                </button>
                @if ($isEditing)
                    <button type="button" wire:click="resetForm"
                        class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancel
                    </button>
                @endif
            </div>
        </form>
    @endif
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b">No</th>
                <th class="px-4 py-2 border-b">NIK</th>
                <th class="px-4 py-2 border-b">Nama</th>
                <th class="px-4 py-2 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($layanans as $index => $layanan)
                <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b">{{ $layanan->nik_warga }}</td>
                    <td class="px-4 py-2 border-b">{{ $layanan->nama_warga }}</td>
                    <td class="px-4 py-2 border-b">
                        <button wire:click="edit({{ $layanan->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                            Edit
                        </button>
                        <button wire:click="delete({{ $layanan->id }})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            Hapus
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
</div>
