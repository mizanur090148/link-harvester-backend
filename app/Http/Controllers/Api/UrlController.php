<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UrlRequest;
use App\Jobs\ProcessUrlJob;
use App\Repositories\Interfaces\DomainRepositoryInterface;
use Illuminate\Http\Request;

class UrlController extends Controller
{
     /**
     * @var DomainRepositoryInterface
     */
    protected DomainRepositoryInterface $repository;

    /**
     * DomainControllerController constructor.
     * @param DomainRepositoryInterface $repository
     */
    public function __construct(DomainRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            return responseSuccess($this->repository->index());
        } catch (\Exception $e) {
        	return responseCantProcess($e);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $where = [];
            if ($request->name) {
                $where['name'] = $request->name;
            }
            return responseSuccess($this->repository->search($where));
        } catch (\Exception $e) {
            return responseCantProcess($e);
        }
    }

    /**
     * @param UrlRequest $request
     * @return JsonResponse
     */
    public function store(UrlRequest $request): JsonResponse
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
                //if (isset($parsedUrl['path'])) {
                    $startPos = strpos($url, $parsedUrl['host']);
                    if ($startPos !== false) {
                        // Remove the hostname and everything before it from the URL
                        $path = substr($url, $startPos + strlen($parsedUrl['host']));
                    }
                //}
                $inputs[] = ['name' => $parsedUrl['host'], 'url' => $path];
            }
        }

        try {
            $chunks = array_chunk($inputs, 1);
            foreach ($chunks as $chunk) {
                //$this->repository->store(['name' => 'www.fb.com', 'url' => '/home']);
               ProcessUrlJob::dispatch($chunk, $this->repository)->onConnection('database');
            }
            return responseCreated();
        } catch (\Exception $e) {
            return responseCantProcess($e);
        }
    }

}
