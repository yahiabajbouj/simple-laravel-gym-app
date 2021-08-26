<?php

namespace App\Http\Controllers;

use App\Models\Programe;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Repositry\IRepositry\IProgrameRepositry;
use App\Http\Resources\ProgrameResourse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProgrameRequest;

class ProgrameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $programeRepositry;

    public function __construct(IProgrameRepositry $programe)
    {
        $this->programeRepositry = $programe;
        $this->authorizeResource(Programe::class, 'programe');
    }

    public function index()
    {
        if(Auth::user()->is_admin){
            return ProgrameResourse::collection($this->programeRepositry->all());
        }else{
            return new ProgrameResourse($this->programeRepositry->byUser());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProgrameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgrameRequest $request)
    {
        $programe = $this->programeRepositry->create($request->toArray());
        foreach($request->exercises as $exercise){
            $exercise['programeId'] = $programe->id;
            $programe->program_exercises()->create($exercise);
        }
        foreach($request->usersId as $userId){
            Customer::find($userId)->update(['programeId' => $programe->id]);
        } 
        return new ProgrameResourse($programe);
    }
    
    /*
     * @param  \App\Models\Programe  $programe
     * @return \Illuminate\Http\Response
     */
    public function show(Programe $programe)
    {
        return new ProgrameResourse($programe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProgrameRequest  $request
     * @param  \App\Models\Programe  $programe
     * @return \Illuminate\Http\Response
     */
    // public function update(ProgrameRequest $request, Programe $programe)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programe  $programe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programe $programe)
    {
        $this->programeRepositry->delete($programe->id);
        return "Done";
    }
}
