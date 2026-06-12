<?php
namespace app\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface{
    public function __construct(protected Model $model){}

    public function all() :Collection{
        return $this->model->all();
    }

    public function find(int $id): ?Model {
        return $this->model->find($id);
    }

    public function create(array $data): Model {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool{
        return(bool) $this->model->whereKey($id)->first()?->update($data);
    }

    public function delete($id): bool{
        return(bool) $this->model->whereKey($id)->first()?->delete();
    }
}
