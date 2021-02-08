<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Cratespace\Sentinel\Http\Responses\Response;

class ThreadResponse extends Response implements Responsable
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        if (! isset($this->content['thread'])) {
            return $request->expectsJson()
                ? $this->json('', 204)
                : $this->redirectToRoute('threads.index', [
                    'channel' => $this->content['channel'],
                ], 303);
        }

        return $request->expectsJson()
            ? $this->json($this->content['thread'], $request->method() === 'PUT' ? 200 : 201)
            : $this->redirectTo($this->content['thread']->path, 303);
    }
}
