<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositry\IRepositry\ISubscribeRepositry;
use App\Http\Resources\SubscribeResourse;
use App\Http\Requests\SubscribeRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Subscribe as SubscribeNotification;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $subscribeRepositry;

    public function __construct(ISubscribeRepositry $subscribe)
    {
        $this->subscribeRepositry = $subscribe;
        $this->authorizeResource(Subscribe::class, 'subscribe');
    }

    public function index()
    {
        if (Auth::user()->is_admin) {
            return SubscribeResourse::collection($this->subscribeRepositry->all());
        } else {
            return SubscribeResourse::collection($this->subscribeRepositry->byUser(Auth::user()->id));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SubscribeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscribeRequest $request)
    {
        $request['userId'] = Auth::user()->id;
        return new SubscribeResourse($this->subscribeRepositry->create($request->toArray()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program_exercise  $program_exercise
     * @return \Illuminate\Http\Response
     */
    public function show(Subscribe $subscribe)
    {
        return new SubscribeResourse($subscribe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SubscribeRequest  $request
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function update(SubscribeRequest $request, Subscribe $subscribe)
    {
        $this->subscribeRepositry->update($request->toArray(), $subscribe->id);
        $user = $this->subscribeRepositry->GetUser($subscribe->id);
        Notification::send($user, new SubscribeNotification(['service'=> $subscribe->service, "status" => $request->isOk]));
        return new SubscribeResourse($subscribe = $this->subscribeRepositry->find($subscribe->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscribe $subscribe)
    {
        $this->subscribeRepositry->delete($subscribe->id);
        return "done";
    }
}
