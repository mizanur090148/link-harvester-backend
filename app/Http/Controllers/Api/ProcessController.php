<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Http\Controllers\Api\BaseController;
// use App\Http\Controllers\Api\ApiCrudHandler;
// use App\Http\Requests\UserRequest;
// use App\Models\User;
// use Illuminate\Http\Response;
// use Validator;
use App\Repositories\Interfaces\DomainRepositoryInterface;

class ProcessController extends Controller
{
     /**
     * @var DomainRepositoryInterface
     */
    protected $repository;

    /**
     * DomainControllerController constructor.
     * @param DomainRepositoryInterface $repository
     */
    public function __construct(DomainRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return JsonResponse|\JsonResponse
     */
    public function index()
    {
        try {
            return responseSuccess($this->repository->index(request('Domain_type')));
        } catch (\Exception $e) {
        	return responseCantProcess($e);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse|JsonResponse4
     */
    public function store(Request $request)
    {
        try {
            $result = $this->repository->store($request->validated());
            return responseCreated($result);
        } catch (\Exception $e) {
            return responseCantProcess($e);
        }
    }
}
