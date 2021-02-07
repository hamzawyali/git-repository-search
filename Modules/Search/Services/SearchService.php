<?php

namespace Modules\Search\Services;

use Modules\Search\Services\Interfaces\SearchServiceInterface;
use GuzzleHttp\Client;
use Modules\Infrastructure\Entities\Lookups\SearchLookup;
use Modules\Search\Exceptions\GitRepositoriesListFailedException;

class SearchService implements SearchServiceInterface
{

    /**
     * listGitRepos function
     *
     * @param array $params
     * @return array
     */
    public function listGitRepos(array $params)
    {
        return $this->sendRequest(SearchLookup::GET, SearchLookup::REPOSITORIES, $params);
    }

    /**
     * sendRequest function
     *
     * @param string $methodType
     * @param string $methodURI
     * @param array $params
     * @return array
     */
    private function sendRequest(string $methodType, string $methodURI, array $params)
    {
        $res = $this->$methodType($methodURI, $params);

        return json_decode($res->getBody(), true);
    }

    /**
     * get function
     *
     * @param string $methodURI
     * @param array $params
     */
    private function get(string $methodURI, array $params)
    {
        try {
            $client = new Client();


            $date = 'created:>' . $params['date'];

            $language = null;
            if (isset($params['language'])) {
                $language = '+language:' . $params['language'];
            }

            $queryBuilder =  $date . $language;
            unset($params['date'], $params['language']);
            $params['q'] = $queryBuilder;
            $params = urldecode(http_build_query($params));

            $url = config('search.API_URL') . "$methodURI?" . $params;
            $res = $client->request(SearchLookup::GET, $url);

            return $res;
        } catch (\Exception $e) {
            throw new GitRepositoriesListFailedException($e->getMessage(), $e->getCode());
        }
    }
}
