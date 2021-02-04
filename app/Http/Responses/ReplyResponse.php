<?php

namespace App\Http\Responses;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Routing\Redirector;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Contracts\Support\Responsable;
use Cratespace\Citadel\Http\Responses\Response;

class ReplyResponse extends Response implements Responsable
{
    /**
     * Instance of reply that was created or updated.
     *
     * @var \App\Models\Reply|null
     */
    protected $reply;

    /**
     * Instance of thread the deleted reply belonged to.
     *
     * @var \App\Models\Thread|null
     */
    protected $thread;

    /**
     * Create a new response factory instance.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     * @param \Illuminate\Routing\Redirector     $redirector
     * @param \App\Models\Reply|null             $reply
     *
     * @return void
     */
    public function __construct(
        ViewFactory $view,
        Redirector $redirector,
        ?Reply $reply = null,
        ?Thread $thread
    ) {
        parent::__construct($view, $redirector);

        if (! is_null($reply)) {
            $this->reply = $reply->fresh();
        }

        $this->thread = $thread;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        if (is_null($this->reply)) {
            return $request->expectsJson()
                ? $this->json('', 204)
                : $this->redirectTo($this->thread->path, 303);
        }

        return $request->expectsJson()
            ? $this->json($this->reply, $request->method() === 'PUT' ? 200 : 201)
            : $this->redirectTo($this->reply->thread->path, 303);
    }
}
