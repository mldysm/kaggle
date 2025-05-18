<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dataset;

class DatasetSearch extends Component
{
    use WithPagination;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $datasets = Dataset::where('dataset_name', 'like', '%' . $this->search . '%')
            ->orderBy('dataset_name')
            ->paginate(9);

        return view('livewire.dataset-search', compact('datasets'));
    }
}
