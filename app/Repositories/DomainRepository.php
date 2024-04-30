<?php


namespace App\Repositories;

use App\Repositories\Interfaces\DomainRepositoryInterface;
use App\Models\Domain;

class DomainRepository extends BaseRepository implements DomainRepositoryInterface
{

    /**
     * DomainRepository constructor.
     * @param Domain $model
     */
    public function __construct(Domain $model)
    {
        parent::__construct($model);
    }

    public function index($domainType)
    {
        // return $this->getModel()
        //     ->with([
        //         'company:id,name,address_one',
        //         'branch:id,name',
        //         'domainDetails',
        //         'chartOfAccount:id,title,ac_code',
        //         'domainDetails.chartOfAccount:id,title,ac_code',
        //         'domainDetails.chartOfAccountCredit:id,title,ac_code',
        //         'domainDetails.chartOfAccountContraAndJournal:id,title,ac_code',
        //     ])->when($domainType, function ($query, $domainType) {
        //         $query->where('domain_type', $domainType);
        //     })
        //     ->orderByDesc('id')
        //     ->paginate();
    }

    /**
     * @param array $domain
     * @param array $domainDetails
     * @return mixed
     */
    public function store(array $domain)
    {
        // $domain = $this->store($domain);
        // $domain->domainDetails()->createMany($domainDetails);
        // return $domain->load('domainDetails');
    }
}