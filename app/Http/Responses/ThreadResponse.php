<?php

namespace App\Http\Responses;

use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Routing\Redirector;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Contracts\Support\Responsable;
use Cratespace\Citadel\Http\Responses\Response;

class ThreadResponse extends Response implements Responsable
{
    /**
     * Instance of the thread that was created or updated.
     *
     * @var \App\Models\Thread|null
     */
    protected $thread;

    /**
     * Instance of channel the current thread belongs to.
     *
     * @var \App\Models\Channel
     */
    protected $channel;

    /**
     * Create a new response factory instance.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     * @param \Illuminate\Routing\Redirector     $redirector
     * @param \App\Models\Thread|null            $thread
     * @param \App\Models\Channel|null           $channel
     *
     * @return void
     */
    public function __construct(
        ViewFactory $view,
        Redirector $redirector,
        ?Thread $thread = null,
        ?Channel $channel
    ) {
        parent::__construct($view, $redirector);

        if (! is_null($thread)) {
            $this->thread = $thread->fresh();
        }

        $this->channel = $channel;
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
        if (is_null($this->thread)) {
            return $request->expectsJson()
                ? $this->json('', 204)
                : $this->redirectToRoute('threads.index', [
                    'channel' => $this->channel,
                ], 303);
        }

        return $request->expectsJson()
            ? $this->json($this->thread, $request->method() === 'PUT' ? 200 : 201)
            : $this->redirectTo($this->thread->path, 303);
    }
}
