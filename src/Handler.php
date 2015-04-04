<?php
namespace Songbird\Package\Jsonable;

use Illuminate\Support\Collection;
use League\Route\Http\Exception\NotFoundException;
use Songbird\Handler as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Handler extends BaseController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request  $request
     * @param \Symfony\Component\HttpFoundation\Response $response
     * @param array                                      $args
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \League\Route\Http\Exception\NotFoundException
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        $content = $this->getFileContent($args['fileId']);

        if (!isset($content['jsonable']) || !$content['jsonable']) {
            throw new NotFoundException();
        }

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($this->transformToJson($content));

        return $response;
    }

    /**
     * @param mixed $content
     *
     * @return mixed
     */
    public function transformToJson($content)
    {
        return Collection::make($content)->toJson();
    }
}
