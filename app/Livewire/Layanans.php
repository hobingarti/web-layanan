<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Layanan;
use App\Models\JenisLayanan;

class Layanans extends Component
{
    use WithPagination;
    
    public $alertTitle = '';
    public $alertMessage = '';
    public $number = 0;
    public $showForm = false;

    public $layanans;
    public $jenisLayanans;
    public $selectedJenisLayanan = null;
    public $nikWarga;
    public $namaWarga;
    public $alamatDomisili;
    public $lingkunganDomisili;
    public $isEditing = false;

    protected $rules = [
        // 'selectedJenisLayanan' => 'required|exists:jenis_layanans,id',
        'nikWarga' => 'required|string|max:16',
        'namaWarga' => 'required|string|max:255',
        'alamatDomisili' => 'required|string|max:255',
        'lingkunganDomisili' => 'required|string|max:255',
    ];

    public function render()
    {
        $this->layanans = Layanan::get();
        $this->jenisLayanans = JenisLayanan::where('is_aktif', 1)->get();

        return view('livewire.layanans', ['layanans' => $this->layanans, 'jenisLayanans' => $this->jenisLayanans]);
    }

    public $confirmingUserDeletion = false;

    public function confirmUserDeletion()
    {
        $this->alertTitle = 'Apakah Anda Yakin?';
        $this->alertMessage = 'Data yang sudah dihapus tidak dapat dikembalikan lagi.';
        $this->confirmingUserDeletion = true;
    }

    public function deleteUser()
    {
        // do nothing

        return redirect('/');
    }


    public function up()
    {
        $this->number++;
    }

    public function down()
    {
        $this->number--;
    }

    public function formTambahData()
    {
        $this->showForm = true;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->selectedJenisLayanan = null;
        $this->nikWarga = '';
        $this->namaWarga = '';
        $this->alamatDomisili = '';
        $this->lingkunganDomisili = '';
        $this->isEditing = false;
    }

    public function store()
    {
        // $this->validate();
        Layanan::create([
            // 'jenis_layanan_id' => $this->selectedJenisLayanan,
            'jenis_layanan_id' => 0,
            'nik_warga' => $this->nikWarga,
            'nama_warga' => $this->namaWarga,
            'alamat_domisili' => $this->alamatDomisili,
            'lingkungan_domisili' => $this->lingkunganDomisili,
        ]);

        session()->flash('message', 'Post created successfully.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        // $this->selectedJenisLayanan = $layanan->jenis_layanan_id;
        $this->nikWarga = $layanan->nik_warga;
        $this->namaWarga = $layanan->nama_warga;
        $this->alamatDomisili = $layanan->alamat_domisili;
        $this->lingkunganDomisili = $layanan->lingkungan_domisili;
        $this->isEditing = true;
    }

    public function update($id)
    {
        $this->validate();
        $layanan = Layanan::findOrFail($id);
        $layanan->update([
            // 'jenis_layanan_id' => $this->selectedJenisLayanan,
            'nik_warga' => $this->nikWarga,
            'nama_warga' => $this->namaWarga,
            'alamat_domisili' => $this->alamatDomisili,
            'lingkungan_domisili' => $this->lingkunganDomisili,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
        $this->resetForm();
    }
}
