<?php


namespace App\Repositories\Interfaces;

interface DomainRepositoryInterface extends BaseRepositoryInterface
{
    public function index($voucherType);
    public function store(array $voucher);
}