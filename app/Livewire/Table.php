<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;

    public int $perPage = 10;
    public int $page = 1;
    public string $sortBy = '';
    public string $sortDirection = 'asc';

    public function render()
    {
        return view('livewire.table');
    }

    public abstract function query(): Builder;

    public abstract function columns(): array;

    public function data()
    {
        return $this
            ->query()
            ->when($this->sortBy !== '', function (Builder $query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->perPage);
    }

    public function sort($key)
    {
        $this->resetPage();

        if ($this->sortBy === $key) {
            $direction = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            $this->sortDirection = $direction;

            return;
        }

        $this->sortBy = $key;
        $this->sortDirection = 'asc';
    }
}
