<?php

namespace App\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 */
abstract class Table extends Component
{
    use WithPagination;

    public int $perPage;
    public int $page = 1;
    public string $sortBy = '';
    public string $sortDirection = 'asc';
    protected Collection $columns;
    protected Collection $actions;

    public function mount()
    {
        $this->perPage = config('table.default_per_page', 10);
        $this->columns = collect($this->columns());
        $this->actions = collect($this->actions($this->model()));
    }

    public function render(): Application|Factory|View
    {
        return view(
            'livewire.table',
            [
                'columns' => $this->columns,
                'actions' => $this->actions,
            ],
        );
    }

    abstract public function model(): Model;

    /**
     * @return Builder<TModel>
     */
    abstract public function query(): Builder;

    /**
     * @return Column[]
     */
    abstract public function columns(): array;

    /**
     * TODO: add return type
     *
     * @param TModel $model
     *
     * @return array
     */
    public function actions(Model $model): array
    {
        return [];
    }

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
