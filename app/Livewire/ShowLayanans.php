<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Layanan;
use App\Models\JenisLayanan;

class ShowLayanans extends Component
{
    use WithPagination;

    // variables;
    public $showForm = false;
    public $isEditing = false;
    // forms
    public $testText = "test";
    public $number = 0;

    public function render()
    {
        return view('livewire.show-layanans',[
            'layanans' => Layanan::paginate(10),
        ]);
    }

    public function formTambahData()
    {
        $this->showForm = true;
        $this->isEditing = false;
    }

    public function cancelForm()
    {
        $this->showForm = false;
        $this->isEditing = false;
    }

    public function up()
    {
        $this->number++;
    }

    public function down()
    {
        $this->number--;
    }

    public function handleClick()
    {
        dd("clicked");
    }

    // #[On('post-created')]
    protected $listeners = ['tambah-data' => 'formTambahData'];
    public function handlePostCreated()
    {
        $this->number++;
    }
}
