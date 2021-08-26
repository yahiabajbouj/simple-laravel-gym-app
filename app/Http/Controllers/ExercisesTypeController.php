<?php

namespace App\Http\Controllers;

use App\Helper\FileHelper;
use App\Models\ExercisesType;
use App\Repositry\IRepositry\IExercisesTypeRepositry;
use App\Http\Resources\ExercisesTypeResourse;
use App\Http\Requests\ExerciesTypeRequest;

class ExercisesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function __construct(IExercisesTypeRepositry $IExercisesTypeRepositry)
    {
        $this->exercisesTypeRepositry = $IExercisesTypeRepositry;
        $this->authorizeResource(ExercisesType::class, 'exercises_type');
    }

    public function index()
    {
        return ExercisesTypeResourse::collection($this->exercisesTypeRepositry->all());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ExerciesTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExerciesTypeRequest $request)
    {
        $request['image'] = FileHelper::uplodFile($request->img, 'ExercisesType');
        $DATA = $this->exercisesTypeRepositry->create($request->toArray());
        return new ExercisesTypeResourse($DATA);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExercisesType  $exercisesType
     * @return \Illuminate\Http\Response
     */
    public function show(ExercisesType $exercisesType)
    {
        return new ExercisesTypeResourse($exercisesType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ExerciesTypeRequest  $request
     * @param  \App\Models\ExercisesType  $exercisesType
     * @return \Illuminate\Http\Response
     */
    public function update(ExerciesTypeRequest $request, ExercisesType $exercisesType)
    {
        if($request['img']){
            $request['image'] = FileHelper::uplodFile($request->img, 'ExercisesType');
        }
        $this->exercisesTypeRepositry->update($request->toArray(), $exercisesType->id);
        return new ExercisesTypeResourse($exercisesType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExercisesType  $exercisesType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExercisesType $exercisesType)
    {
        $this->exercisesTypeRepositry->delete($exercisesType->id);
        return response()->json(['DATA'=>'done'], 200);
    }
}
