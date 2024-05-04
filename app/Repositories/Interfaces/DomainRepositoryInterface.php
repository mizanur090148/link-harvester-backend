<?php


namespace App\Repositories\Interfaces;

interface DomainRepositoryInterface
{
    public function index($orderBy = 'created_at', $order = 'desc');
    public function search(array $where, $orderBy = 'created_at', $order = 'desc');
    public function store(array $data);
}
