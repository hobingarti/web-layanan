<?php

namespace App\Livewire;

use Str;
use Storage;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\JenisLayanan;
use App\Models\Layanan;
use App\Models\Warga;

class LayanansByJenis extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $jenisLayananId;
    public $jenisLayanan;

    public $showForm = false;
    public $isEditing = false;

    public $alertTitle = '';
    public $alertMessage = '';
    public $number = 0;

    // search component
    public $searchKey = '';
    public $months = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];

    public $years = [];
    public $searchMonth = '';
    public $searchYear = '';

    // untuk wadah form data layanan
    public $layananId;
    public $jenisLayanans;
    public $wargaId;
    public $kodeArsip;
    public $hasilPelayanan;
    public $keterangan;

    // untuk wadah form warga
    public $nikWarga;
    public $namaWarga;
    public $alamatDomisili;
    public $lingkunganDomisili;
    // untuk form jenis layanan 6
    public $alamatAsal;
    public $tempatLahir;
    public $tanggalLahir;
    public $jenisKelamin;
    public $agama;
    public $pendidikanTerakhir;
    public $jenisKtp;
    public $statusPerkawinan;
    public $pekerjaan;
    public $telpHp;
    public $email;
    public $kodeNonpermanen;
    public $tanggalKedatangan;
    // file pendukung
    public $filePendukung;
    public $filePendukungUploaded;

    protected $rules = [
        'kodeArsip' => 'required|string|max:255',
        'hasilPelayanan' => 'required|string|max:255',
        'keterangan' => 'nullable|string|max:255',
        'filePendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120000'
    ];
    
    public function mount($jenisLayananId)
    {
        $this->jenisLayananId = $jenisLayananId;
        $this->jenisLayanan = JenisLayanan::find($jenisLayananId);
        if (!$this->jenisLayanan) {
            abort(404, 'Jenis Layanan not found');
        }

        $this->years = range(date('Y'), date('Y') - 10);
        // $this->searchMonth = date('m');
        $this->searchYear = date('Y');
    }

    public function render()
    {
        $layanans = Layanan::where('jenis_layanan_id', $this->jenisLayananId)
            ->when($this->searchKey, function ($query) {
                return $query->where(function ($q) {
                    $q->where('kode_arsip', 'like', '%' . $this->searchKey . '%')
                        ->orWhere('hasil_pelayanan', 'like', '%' . $this->searchKey . '%')
                        ->orWhereHas('warga', function ($q) {
                            $q->where('nik', 'like', '%' . $this->searchKey . '%')
                                ->orWhere('nama', 'like', '%' . $this->searchKey . '%');
                        });
                });
            })
            ->when($this->searchMonth, function ($query) {
                return $query->whereMonth('created_at', $this->searchMonth);
            })
            ->when($this->searchYear, function ($query) {
                return $query->whereYear('created_at', $this->searchYear);
            })
            ->with(['warga'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.layanans-by-jenis', [
            'jenisLayanan' => $this->jenisLayanan,
            'layanans' => $layanans
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
        $this->nikWarga = '';
        $this->namaWarga = '';
        $this->alamatDomisili = '';
        $this->lingkunganDomisili = '';
        $this->alamatAsal = '';
        $this->tempatLahir = '';
        $this->tanggalLahir = '';
        $this->jenisKelamin = '';
        $this->agama = '';
        $this->pendidikanTerakhir = '';
        $this->jenisKtp = '';
        $this->statusPerkawinan = '';
        $this->pekerjaan = '';
        $this->telpHp = '';
        $this->email = '';
        $this->tanggalKedatangan = '';
        // bersihkan field untuk form layanan
        $this->kodeArsip = '';
        $this->hasilPelayanan = '';
        $this->keterangan = '';
        $this->filePendukung = null;
        $this->filePendukungUploaded = null;

        $this->showForm = false;
        $this->isEditing = false;
    }

    public function rulesWarga()
    {
        $rulesWarga = [
            'nikWarga' => 'required|string|max:16',
            'namaWarga' => 'required|string|max:255',
            'alamatDomisili' => 'required|string|max:255',
            'lingkunganDomisili' => 'required|string|max:255',
        ];

        if ($this->jenisLayananId == 6) {
            $rulesWarga['alamatAsal'] = 'required|string|max:255';
            $rulesWarga['tempatLahir'] = 'required|string|max:255';
            $rulesWarga['tanggalLahir'] = 'required|date';
            $rulesWarga['jenisKelamin'] = 'required|string|max:10';
            $rulesWarga['agama'] = 'required|string|max:50';
            $rulesWarga['pendidikanTerakhir'] = 'nullable|string|max:50';
            $rulesWarga['jenisKtp'] = 'required|string|max:50';
            $rulesWarga['statusPerkawinan'] = 'required|string|max:50';
            $rulesWarga['pekerjaan'] = 'required|string|max:50';
            $rulesWarga['telpHp'] = 'required|string|max:20';
            $rulesWarga['email'] = 'nullable|email|max:255';
            $rulesWarga['kodeNonpermanen'] = 'required|string|max:255';
            $rulesWarga['tanggalKedatangan'] = 'required|date';
        }

        $rulesWarga = array_merge($rulesWarga, $this->rules);
        
        return $rulesWarga;
    }

    public function saveDataWarga()
    {
        $this->validate($this->rulesWarga());

        $warga = Warga::where('nik', $this->nikWarga)->first();
        if (!$warga) {
            $warga = new Warga();
        }

        $warga->nik = $this->nikWarga;
        $warga->nama = $this->namaWarga;
        $warga->alamat_domisili = $this->alamatDomisili;
        $warga->lingkungan_domisili = $this->lingkunganDomisili;
        if ($this->jenisLayananId == 6) {
            $warga->alamat_asal = $this->alamatAsal;
            $warga->tempat_lahir = $this->tempatLahir;
            $warga->tanggal_lahir = $this->tanggalLahir;
            $warga->jenis_kelamin = $this->jenisKelamin;
            $warga->agama = $this->agama;
            $warga->pendidikan_terakhir = $this->pendidikanTerakhir;
            $warga->jenis_ktp = $this->jenisKtp;
            $warga->status_perkawinan = $this->statusPerkawinan;
            $warga->pekerjaan = $this->pekerjaan;
            $warga->telp_hp = $this->telpHp;
            $warga->email = $this->email;
            $warga->kode_nonpermanen = $this->kodeNonpermanen;
            $warga->tanggal_kedatangan = $this->tanggalKedatangan;
        }
        $warga->save();

        return $warga;
    }

    public function store()
    {
        $rulesWarga = $this->rulesWarga();
        $this->validate($rulesWarga);

        $warga = $this->saveDataWarga();

        $layanan = new Layanan();
        $layanan->jenis_layanan_id = $this->jenisLayananId;
        $layanan->warga_id = $warga->id;
        $layanan->kode_arsip = $this->kodeArsip;
        $layanan->hasil_pelayanan = $this->hasilPelayanan;
        $layanan->keterangan = $this->keterangan;   
        // try to save file pendukung if exists, use storeas and get datetime for filename, store it in storage
        if($this->filePendukung)
        {
            $fileName = pathinfo($this->filePendukung->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = now()->format('YmdHis') . '-' . Str::slug($fileName). '.' . $this->filePendukung->getClientOriginalExtension();
            $filePath = $this->filePendukung->storeAs('file_pendukung', $fileName, 'public');
            $layanan->file_pendukung = $filePath;
        }
        $layanan->assignKodeArsip();
        $layanan->save();

        // Layanan::create([
        //     'warga_id' => $warga->id,
        //     'kode_arsip' => $this->kodeArsip,
        //     'hasil_pelayanan' => $this->hasilPelayanan,
        //     'keterangan' => $this->keterangan,
        //     // 'file_pendukung' => ($this->filePendukung ?? null)
        // ]);

        session()->flash('message', 'Layanan created successfully.');
        $this->resetForm();
    }

    public function edit($layananId)
    {
        $this->layananId = $layananId;
        $layanan = Layanan::find($layananId);
        
        if ($layanan) {
            $this->nikWarga = $layanan->warga->nik ?? '';
            $this->namaWarga = $layanan->warga->nama ?? '';
            $this->alamatDomisili = $layanan->warga->alamat_domisili ?? '';
            $this->lingkunganDomisili = $layanan->warga->lingkungan_domisili ?? '';
            $this->alamatAsal = $layanan->warga->alamat_asal ?? '';
            $this->tempatLahir = $layanan->warga->tempat_lahir ?? '';
            $this->tanggalLahir = $layanan->warga->tanggal_lahir ?? '';
            $this->jenisKelamin = $layanan->warga->jenis_kelamin ?? '';
            $this->agama = $layanan->warga->agama ?? '';
            $this->pendidikanTerakhir = $layanan->warga->pendidikan_terakhir ?? '';
            $this->jenisKtp = $layanan->warga->jenis_ktp ?? '';
            $this->statusPerkawinan = $layanan->warga->status_perkawinan ?? '';
            $this->pekerjaan = $layanan->warga->pekerjaan ?? '';
            $this->telpHp = $layanan->warga->telp_hp ?? '';
            $this->email = $layanan->warga->email ?? '';
            $this->kodeNonpermanen = $layanan->warga->kode_nonpermanen ?? '';
            $this->tanggalKedatangan = $layanan->warga->tanggal_kedatangan ?? '';

            $this->kodeArsip = $layanan->kode_arsip ?? '';
            $this->hasilPelayanan = $layanan->hasil_pelayanan ?? '';
            $this->keterangan = $layanan->keterangan ?? '';
            $this->filePendukungUploaded = ($layanan->file_pendukung ?? '') == '' ? '' : Storage::url($layanan->file_pendukung);

            $this->showForm = true;
            $this->isEditing = true;
        } else {
            session()->flash('error', 'Layanan not found.');
        }
    }

    public function update()
    {
        $rulesWarga = $this->rulesWarga();
        $this->validate($rulesWarga);

        $warga = $this->saveDataWarga();
        
        $layanan = Layanan::find($this->layananId);
        if ($layanan) {
            $layanan->jenis_layanan_id = $this->jenisLayananId;
            $layanan->warga_id = $warga->id;
            $layanan->kode_arsip = $this->kodeArsip;
            $layanan->hasil_pelayanan = $this->hasilPelayanan;
            $layanan->keterangan = $this->keterangan;
            if($this->filePendukung)
            {
                $fileName = pathinfo($this->filePendukung->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = now()->format('YmdHis') . '-' . Str::slug($fileName). '.' . $this->filePendukung->getClientOriginalExtension();
                $filePath = $this->filePendukung->storeAs('file_pendukung', $fileName, 'public');
                $layanan->file_pendukung = $filePath;
            }
               
            $layanan->save();

            session()->flash('message', 'Layanan updated successfully.');
            $this->resetForm();
        } else {
            session()->flash('error', 'Layanan not found.');
        }
    }

    // delete confirmation
    public $confirmingDeletion = false;
    public function confirmDeletion($id)
    {
        $layanan = Layanan::findOrFail($id);
        $this->layananId = $id;
        $this->alertTitle = 'Konfirmasi Penghapusan '.$layanan->nama_jenis_layanan;
        $this->alertMessage = 'Apakah Anda yakin? Data yang dihapus tidak bisa kembali.';
        $this->confirmingDeletion = true;
    }

    public function delete()
    {
        if (!$this->confirmingDeletion) {
            return;
        }

        $layanan = Layanan::findOrFail($this->layananId);
        $layanan->delete();
        
        // hide modal
        $this->confirmingDeletion = false;
        session()->flash('message', 'Layanan deleted successfully.');
    }
    
}
