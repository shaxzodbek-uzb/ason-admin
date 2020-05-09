<?php

namespace EllipseSynergie\ApiResponse\Laravel;

use EllipseSynergie\ApiResponse\AbstractResponse;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Validation\Validator;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Response
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package EllipseSynergie\ApiResponse\Laravel
 * @author Maxime Beaudoin <maxime.beaudoin@ellipse-synergie.com>
 */
class Response extends AbstractResponse
{
    /**
     * @param array $array
     * @param array $headers
     * @param int $json_options @link http://php.net/manual/en/function.json-encode.php
     * @return ResponseFactory
     */
    public function withArray(array $array, array $headers = [], $json_options = 0)
    {
        return response()->json($array, $this->statusCode, $headers, $json_options);
    }

    /**
     * Respond with a paginator, and a transformer.
     *
     * @param LengthAwarePaginator $paginator
     * @param callable|\League\Fractal\TransformerAbstract $transformer
     * @param string $resourceKey
     * @param array $meta
     * @return ResponseFactory
     */
    public function withPaginator(LengthAwarePaginator $paginator, $transformer, $resourceKey = null, $meta = [])
    {
        $queryParams = array_diff_key($_GET, array_flip(['page']));
        $paginator->appends($queryParams);
        
        $resource = new Collection($paginator->items(), $transformer, $resourceKey);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        foreach ($meta as $metaKey => $metaValue) {
            $resource->setMetaValue($metaKey, $metaValue);
        }
        $this->manager->setSerializer(new ArraySerializer());
        $rootScope = $this->manager->createData($resource);
        return $rootScope->toArray();
    }
    public function get($params){
        $response = [
            'code' => 200,
            'data' => []
        ];
        foreach($params as $key => $item){
            if (!is_array($item) || count($item) < 2){
                throw new \Exception("Api Response: content should be array and included data and transformer instance!", 1);
            }
            if ($item[0] instanceof LengthAwarePaginator){
                $response['data'][$key] = $this->withPaginator($item[0], $item[1], 'list');
            } else
            if ($item[0] instanceof Model){
                $response['data'][$key] = $this->withItem($item[0], $item[1])['data'];    
            }else {
                $response['data'][$key] = $this->withCollection($item[0], $item[1], 'list');    
            }
        }
        return $this->withArray($response);
    }
    /**
     * Generates a Response with a 400 HTTP header and a given message from validator
     *
     * @param Validator $validator
     * @return ResponseFactory
     */
    public function errorWrongArgsValidator(Validator $validator)
    {
        return $this->errorWrongArgs($validator->getMessageBag()->toArray());
    }
}
