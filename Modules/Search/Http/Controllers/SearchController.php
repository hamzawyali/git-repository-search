<?php

namespace Modules\Search\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Search\Http\Requests\SearchRequest;
use Modules\Search\Services\Interfaces\SearchServiceInterface;


class SearchController extends Controller
{
    private $searchService;

    /**
     * __construct
     *
     * @param SearchServiceInterface $searchService
     */
    public function __construct(SearchServiceInterface $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function search(SearchRequest $request)
    {
        return response()->json($this->searchService->listGitRepos($request->all()));
    }
}
