<?php


namespace App\Repositories;

use App\Repositories\Interfaces\DomainRepositoryInterface;
use App\Models\Domain;

class DomainRepository implements DomainRepositoryInterface
{

    /**
     * DomainRepository constructor.
     * @param Domain $model
     */
    public function __construct(Domain $model)
    {
        $this->model = $model;
    }

    public function index($orderBy = 'created_at', $order = 'desc')
    {
        $modelQuery = $this->model->orderBy($orderBy, $order);
        return $modelQuery->paginate();
    }

    public function search($where, $orderBy = 'created_at', $order = 'desc')
    {
        $modelQuery = $this->model->orderBy($orderBy, $order);
        if (sizeof($where) > 0) {
            $modelQuery->where($where);
        }
        return $modelQuery->paginate();
    }

    /**
     * @param array $data
     * @return true
     */
    public function store(array $data): true
    {
        $domain = $this->model->firstOrCreate(['name' => $data['name']]);
        if ($data['url'] && !$domain->urls()->where('url', $data['url'])->exists()) {
            // If it doesn't exist, create a new URL for the domain
            $domain->urls()->create(['url' => $data['url']]);
        }
        return true;
    }
}
