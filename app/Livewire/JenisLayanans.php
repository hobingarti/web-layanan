<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\JenisLayanan;

class JenisLayanans extends Component
{
    use WithPagination;
    public $showForm = false;
    public $isEditing = false;
    
    public $alertTitle = '';
    public $alertMessage = '';
    public $number = 0;

    // untuk wadah form data
    public $jenisLayananId;
    public $namaJenisLayanan;
    public $iconJenisLayanan;
    public $keterangan;
    public $isAktif = true;
    public $parentId = 0;

    protected $rules = [
        'namaJenisLayanan' => 'required|string|max:255',
        'iconJenisLayanan' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:500',
        'isAktif' => 'boolean',
        'parentId' => 'nullable'
    ];

    public function render()
    {
        return view('livewire.jenis-layanans', [
            'jenisLayanans' => JenisLayanan::with('parent')->paginate(10)
        ]);
    }

    public function formTambahData()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->isEditing = false;
    }

    public function resetForm()
    {
        $this->reset([
            'jenisLayananId',
            'namaJenisLayanan',
            'iconJenisLayanan',
            'keterangan',
            'isAktif',
            'parentId'
        ]);
        $this->showForm = false;
        $this->isEditing = false;
    }

    public function store()
    {
        $this->validate();

        JenisLayanan::create([
            'nama_jenis_layanan' => $this->namaJenisLayanan,
            'icon_jenis_layanan' => $this->iconJenisLayanan,
            'keterangan' => $this->keterangan,
            'is_aktif' => $this->isAktif,
            'parent_id' => $this->parentId
        ]);

        session()->flash('message', 'Jenis Layanan created successfully.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $jenisLayanan = JenisLayanan::findOrFail($id);
        $this->jenisLayananId = $jenisLayanan->id;
        $this->namaJenisLayanan = $jenisLayanan->nama_jenis_layanan;
        $this->iconJenisLayanan = $jenisLayanan->icon_jenis_layanan;
        $this->keterangan = $jenisLayanan->keterangan;
        $this->isAktif = $jenisLayanan->is_aktif;
        $this->parentId = $jenisLayanan->parent_id;

        $this->showForm = true;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        $jenisLayanan = JenisLayanan::findOrFail($this->jenisLayananId);
        $jenisLayanan->update([
            'nama_jenis_layanan' => $this->namaJenisLayanan,
            'icon_jenis_layanan' => $this->iconJenisLayanan,
            'keterangan' => $this->keterangan,
            'is_aktif' => $this->isAktif,
            'parent_id' => $this->parentId
        ]);

        session()->flash('message', 'Jenis Layanan updated successfully.');
        $this->resetForm();
    }

    // delete confirmation
    public $confirmingDeletion = false;
    public function confirmDeletion($id)
    {
        $jenisLayanan = JenisLayanan::findOrFail($id);
        $this->jenisLayananId = $id;
        $this->alertTitle = 'Konfirmasi Penghapusan '.$jenisLayanan->nama_jenis_layanan;
        $this->alertMessage = 'Apakah Anda yakin? Data yang dihapus tidak bisa kembali.';
        $this->confirmingDeletion = true;
    }

    public function delete()
    {
        if (!$this->confirmingDeletion) {
            return;
        }
        
        $jenisLayanan = JenisLayanan::findOrFail($this->jenisLayananId);
        $jenisLayanan->delete();
        
        // hide modal
        $this->confirmingDeletion = false;
        session()->flash('message', 'Jenis Layanan deleted successfully.');
    }

    public function hideModal()
    {
        $this->confirmingDeletion = false;
        
    }

    public function showModal()
    {
        $this->confirmingDeletion = true;
        
    }
}
