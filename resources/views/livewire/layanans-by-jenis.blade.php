<!-- header slot -->
<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Layanan') }} : {{ $jenisLayanan->nama_jenis_layanan }}
        </h2>
        <div class="flex justify-end text-gray-500">
            <!-- not working, kita akan ganti dengan breadcrumb sajalah -->
             Layanan / {{ $jenisLayanan->nama_jenis_layanan }}
        </div>
    </div>
</x-slot>

<div class="py-6">
    <!-- confirmation -->
    <x-confirmation-modal wire:model="confirmingDeletion">
        <x-slot name="title">
            {{$alertTitle}}
        </x-slot>
        <x-slot name="content">
            {{$alertMessage}}
        </x-slot>   
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                Batal
            </x-secondary-button>
            <button class="ml-2 bg-red-500 py-2 px-4 rounded-md " wire:click="delete" wire:loading.attr="disabled">
                Confirm
            </button>
        </x-slot>
    </x-confirmation-modal>

    <div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg mb-6">
        <div class="">
            @if($showForm)
            <div>
                <!-- header form -->
                <div class="flex justify-between border-b border-gray-200 pb-4 sm:px-6 lg:px-8 px-4 py-6">
                    <h2>{{ $isEditing ? 'Update' : 'Create' }} Layanan</h2>
                </div>

                @if($isEditing)
                <form wire:submit.prevent="update" class="sm:px-6 lg:px-8 px-4 py-6 bg-gray-100" enctype="multipart/form-data">
                @else
                <form wire:submit.prevent="store" class="sm:px-6 lg:px-8 px-4 py-6 bg-gray-100" enctype="multipart/form-data">
                @endif
                    <h4 class="font-semibold text-lg text-gray-800 mb-4">Data Warga</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-b border-gray-200 pb-4">
                        <div>
                            <label for="nikWarga" class="block text-sm font-medium text-gray-700">NIK Warga</label>
                            <input type="text" id="nikWarga" wire:model="nikWarga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('nikWarga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="namaWarga" class="block text-sm font-medium text-gray-700">Nama Warga</label>
                            <input type="text" id="namaWarga" wire:model="namaWarga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('namaWarga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="alamatDomisili" class="block text-sm font-medium text-gray-700">Alamat Domisili</label>
                            <input type="text" id="alamatDomisili" wire:model="alamatDomisili" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('alamatDomisili') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="lingkunganDomisili" class="block text-sm font-medium text-gray-700">Lingkungan Domisili</label>
                            <input type="text" id="lingkunganDomisili" wire:model="lingkunganDomisili" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('lingkunganDomisili') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    @if($jenisLayananId == 6)
                    <h4 class="font-semibold text-lg text-gray-800 mt-6 mb-4">Detail Warga Pendatang</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-b border-gray-200 pb-4">
                        <div>
                            <label for="tanggalKedatangan" class="block text-sm font-medium text-gray-700">Tanggal Kedatangan</label>
                            <input type="date" id="tanggalKedatangan" wire:model="tanggalKedatangan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('tanggalKedatangan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="alamatAsal" class="block text-sm font-medium text-gray-700">Alamat Asal</label>
                            <input type="text" id="alamatAsal" wire:model="alamatAsal" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('alamatAsal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                            <input type="text" id="pekerjaan" wire:model="pekerjaan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('pekerjaan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="pendidikanTerakhir" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                            <input type="text" id="pendidikanTerakhir" wire:model="pendidikanTerakhir" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('pendidikanTerakhir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="tempatLahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" id="tempatLahir" wire:model="tempatLahir" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('tempatLahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="tanggalLahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" id="tanggalLahir" wire:model="tanggalLahir" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('tanggalLahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="jenisKelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select id="jenisKelamin" wire:model="jenisKelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Please Select --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenisKelamin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="statusPerkawinan" class="block text-sm font-medium text-gray-700">Status Perkawinan</label>
                            <select id="statusPerkawinan" wire:model="statusPerkawinan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Please Select --</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Cerai">Cerai</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                            @error('statusPerkawinan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                            <select id="agama" wire:model="agama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Please Select --</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Kristen Khatolik">Kristen Khatolik</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('agama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="jenisKtp" class="block text-sm font-medium text-gray-700">Jenis KTP</label>
                            <select id="jenisKtp" wire:model="jenisKtp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Please Select --</option>
                                <option value="KTP Bali">KTP Bali</option>
                                <option value="KTP Non-Bali">KTP Non-Bali</option>
                            </select>
                            @error('jenisKtp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="telpHp" class="block text-sm font-medium text-gray-700">Telepon Hp</label>
                            <input type="text" id="telpHp" wire:model="telpHp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('telpHp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" id="email" wire:model="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="kodeNonpermanen" class="block text-sm font-medium text-gray-700">Kode Non-Permanen</label>
                            <input type="text" id="kodeNonpermanen" wire:model="kodeNonpermanen" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('kodeNonpermanen') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    @endif
                    <h4 class="font-semibold text-lg text-gray-800 mt-6 mb-4">Detail Hasil Layanan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-b border-gray-200 pb-4">
                        <div>
                            <label for="kodeArsip" class="block text-sm font-medium text-gray-700">Kode Arsip</label>
                            <input type="text" id="kodeArsip" wire:model="kodeArsip" placeholder="Kode Arsip akan diberikan saat Create" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 cursor-not-allowed" readonly>
                            @error('kodeArsip') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="hasilPelayanan" class="block text-sm font-medium text-gray-700">Hasil Pelayanan</label>
                            <input type="text" id="hasilPelayanan" wire:model="hasilPelayanan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('hasilPelayanan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <input type="text" id="keterangan" wire:model="keterangan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('keterangan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="filePendukung" class="block text-sm font-medium text-gray-700">File Pendukung</label>
                            <div class="flex">
                                <input type="file" id="filePendukung" wire:model="filePendukung" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @if($filePendukungUploaded)
                                    <a href="{{ $filePendukungUploaded }}" target="_blank" class="text-sky-500 flex"><x-antdesign-file-text-o class="me-1 h-5 w-5"/><span class="whitespace-nowrap">Download File</span></a>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, JPEG, PNG. Max size: 5MB</p>
                            @if($filePendukung)
                                <span class="text-xs text-gray-600 mt-1">
                                    Selected : {{ $filePendukung->getClientOriginalName() }}
                                </span>
                            @endif

                            @error('filePendukung') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="submit"
                                class="flex justify-between px-5 py-2 text-sm font-medium bg-sky-500 hover:bg-sky-700 text-white rounded disabled:opacity-50 disabled:cursor-not-allowed"
                                wire:loading.attr="disabled"
                                wire:target="filePendukung"
                                >
                            <x-antdesign-save-o class="w-5 h-5 text-white me-2"/>                                
                            {{ $isEditing ? 'Update' : 'Create' }}
                            
                        </button>
                        <button type="button" wire:click="resetForm"
                                class="flex bg-gray-500 hover:bg-gray-700 px-4 py-2 rounded text-white">
                            <x-heroicon-o-x-mark class="w-5 h-5 text-white me-2"/>
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            @else
            <!-- header form -->
            <div class="flex justify-between border-b border-gray-200 sm:px-6 lg:px-8 px-4 py-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- search data with select year and month and params -->
                    <div>
                        <label for="searchKey" class="block text-sm font-medium text-gray-700">Cari</label>
                        <input type="text" id="searchKey" wire:model.live.debounce.500ms="searchKey" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        {{ $searchKey }}
                    </div>
                    <div>
                        <label for="searchMonth" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select id="searchMonth" wire:model.live="searchMonth"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Semua --</option>
                            @foreach($months as $key => $month)
                                <option value="{{ $key }}">{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="searchYear" class="block text-sm font-medium text-gray-700">Tahun</label>
                        <select id="searchYear" wire:model.live="searchYear" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-end  items-start space-x-2">
                    <a target="_blank" href="{{ url('layanans/export/' . $jenisLayananId . '/year/' . $searchYear . '/month/' . ($searchMonth == '' ? 'all' : $searchMonth)) }}" 
                        
                        class="flex justify-between px-5 py-2 text-sm font-medium bg-green-500 hover:bg-green-700 text-white rounded me-1">
                        <x-iconpark-excel class="w-5 h-5 text-white me-2"/>
                        Export
                    </a>
                    <button class="flex justify-between px-5 py-2 text-sm font-medium bg-sky-500 hover:bg-sky-700 text-white rounded" wire:click="formTambahData">
                        <x-iconpark-excel-o class="w-5 h-5 text-white me-2"/>
                        Tambah
                    </button>
                </div>
            </div>

            <div class="sm:px-6 lg:px-8 px-4 py-6 bg-gray-100">
                <!-- datatable -->
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Warga</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Domisili</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Jenis Layanan</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($layanans as $layanan)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap">{{ Carbon\Carbon::parse($layanan->created_at)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap"><div class="font-semibold">{{ $layanan->warga->nik ?? '-' }}</div><div>{{ $layanan->warga->nama ?? '-' }}</div></td>
                                <td class="px-6 py-4 whitespace-no-wrap"><div class="font-semibold">{{ $layanan->warga->lingkungan_domisili ?? '-' }}</div><div>{{ $layanan->warga->alamat_domisili ?? '-' }}</div></td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $layanan->jenisLayanan->nama_jenis_layanan }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap flex">
                                    <!-- Actions -->
                                    <button wire:click="edit({{ $layanan->id }})" class="flex justify-between text-sm font-medium text-blue-600 hover:text-blue-900 me-2">
                                        <x-heroicon-o-pencil class="w-5 h-5 text-blue-600 me-2"/>
                                        Edit
                                    </button>
                                    <button wire:click="confirmDeletion({{ $layanan->id }})" class="flex justify-between text-sm font-medium text-red-600 hover:text-red-900">
                                        <x-heroicon-o-trash class="w-5 h-5 text-red-600 me-2"/>
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $layanans->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>