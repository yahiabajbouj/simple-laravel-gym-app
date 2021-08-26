<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Repositry\IRepositry\IExerciseRepositry;
use App\Http\Resources\ExerciseResourse;
use App\Models\Images;
use App\Helper\FileHelper;
use App\Http\Requests\ExerciesRequest;

class ExercisesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    private $exercisesRepositry; 

    public function _construct(IExerciseRepositry $exercises){
        $this->exercisesRepositry = $exercises;
        $this->authorizeResource(Exercise::class, 'exercise');
    }

    public function index()
    {
        return ExerciseResourse::collection(Exercise::all());
        // return ExerciseResourse::collection($this->exercisesRepositry->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExerciesRequest $request)
    {
        $DATA = Exercise::create($request->toArray());
        foreach($request->imgs as $img){
            $DATA->images()->create(["path" => FileHelper::uplodFile($img, 'exercises')]);
        }
        return new ExerciseResourse($DATA);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function show(Exercise $exercise)
    {
        return $exercise;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function update(ExerciesRequest $request, Exercise $exercise)
    {
        $exercise->update($request->toArray());
        if ($request['imgs']) {
            $exercise->images()->delete();
            foreach ($request->imgs as $img) {
                $exercise->images()->create(["path" => FileHelper::uplodFile($img, 'exercises')]);
            }
        }
        return new ExerciseResourse($exercise);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return "done";
    }
}
