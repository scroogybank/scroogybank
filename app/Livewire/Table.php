<?php

namespace App\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;
    public int $perPage = 10;
    public int $page = 1;
    public string $sortBy = '';
    public string $sortDirection = 'asc';

    public function render(): Application|Factory|View
    {
        return view('livewire.table');
    }

    abstract public function query(): Builder;

    abstract public function columns(): array;

    public function data(): LengthAwarePaginator
    {
        return $this
            ->query()
            ->when($this->sortBy !== '', function (Builder $query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->perPage);
    }

    public function sort(string $key): void
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
