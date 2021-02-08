<?php

namespace App\Http\Responses;

use App\Models\Channel;
use Illuminate\Routing\Redirector;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Contracts\Support\Responsable;
use Cratespace\Sentinel\Http\Responses\Response;

class ChannelResponse extends Response implements Responsable
{
    /**
     * Instance of channel.
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
        ?Channel $channel = null
    ) {
        parent::__construct($view, $redirector);

        if (! is_null($channel)) {
            $this->channel = $channel->fresh();
        }
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
        if (is_null($this->channel)) {
            return $request->expectsJson() ? $this->json('', 204) : $this->back(303);
        }

        return $request->expectsJson()
            ? $this->json($this->channel, $request->method() === 'PUT' ? 200 : 201)
            : $this->back(303);
    }
}
