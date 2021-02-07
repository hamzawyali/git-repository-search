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
     * @api {get} /api/search/
     * @apiName search
     * @apiHeader {String} Accept "application/json".
     *
     * @apiParam {date} date Y-m-d.
     * @apiParam {string} language.
     * @apiParam {string} sort stars or forks.
     * @apiParam {string} order asc or desc.
     * @apiParam {integer} per_page.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 202 OK
     * {
     * "status_code": 202,
     * "response":
     * {
     * }
     * }
     * @apiErrorExample {json} Error-Response 422:
     *     HTTP/1.1 422 Not Found
     * {
     * "status_code" : 422
     * "error":
     * {
     * "message": "The given data was invalid.",
     * "errors": {
     * "date": {
     *       "The date field is required."
    *  }
     * }
     * }
     * }
     */
    public function search(SearchRequest $request)
    {
        return response()->json($this->searchService->listGitRepos($request->all()));
    }
}
