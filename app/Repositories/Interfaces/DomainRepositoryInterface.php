<?php


namespace App\Repositories\Interfaces;

interface DomainRepositoryInterface
{
    public function index(string $orderBy = 'created_at', string $order = 'desc');
    public function search(array $where, string $orderBy = 'created_at', string $order = 'desc');
    public function store(array $data): bool;
}
