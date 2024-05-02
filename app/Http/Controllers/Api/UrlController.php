<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Http\Controllers\Api\BaseController;
// use App\Http\Controllers\Api\ApiCrudHandler;
use App\Http\Requests\UrlRequest;
use App\Jobs\ProcessUrlJob;
// use App\Models\User;
// use Illuminate\Http\Response;
// use Validator;
use App\Repositories\Interfaces\DomainRepositoryInterface;

class UrlController extends Controller
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
    public function store(UrlRequest $request)
    {
        $inputs = [];
        $inputArr = $request->urls; 
        
        foreach ($inputArr as $url) {
            // Add 'http://' to URL if no scheme is provided
            if (!parse_url($url, PHP_URL_SCHEME)) {
                $url = "http://" . $url;
            }
        
            $parsedUrl = parse_url($url);
            $path = '';
            
            // Extract path from URL
            if (isset($parsedUrl['host'])) {
                if (isset($parsedUrl['path'])) {
                    $startPos = strpos($url, $parsedUrl['host']);
                    if ($startPos !== false) {
                        // Remove the hostname and everything before it from the URL
                        $path = substr($url, $startPos + strlen($parsedUrl['host']));
                    }
                }
                $inputs[] = ['name' => $parsedUrl['host'], 'url' => $path];
            }
        }

        try {
            ProcessUrlJob::dispatch($inputs);
            //$result = $this->repository->store($inputs);
            //return responseCreated($result);
        } catch (\Exception $e) {
            return responseCantProcess($e);
        }
    }

}
