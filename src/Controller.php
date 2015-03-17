<?php
namespace Songbird\Package\Jsonable;

use League\Route\Http\Exception\NotFoundException;
use Songbird\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request  $request
     * @param \Symfony\Component\HttpFoundation\Response $response
     * @param array                                      $args
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \League\Route\Http\Exception\NotFoundException
     */
    public function handle(Request $request, Response $response, array $args)
    {
        $document = $this->getDocument($args['documentId']);

        if (!isset($document['jsonable']) || !$document['jsonable']) {
            throw new NotFoundException();
        }

        $this->emit('PrepareDocument', ['document' => &$document]);

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($this->transformToJson($document));

        return $response;
    }

    /**
     * @param mixed $document
     *
     * @return mixed
     */
    public function transformToJson($document)
    {
        return $this->resolve('Repository.Content')->make($document)->toJson();
    }
}
