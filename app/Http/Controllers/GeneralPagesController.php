<?php

namespace App\Http\Controllers;

class GeneralPagesController extends Controller
{
    use Concerns\GetsThreads;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('threads.index', ['threads' => $this->getThreads()]);
    }
}
