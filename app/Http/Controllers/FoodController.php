<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Resources\FoodResourse;
use App\Helper\FileHelper;
use App\Repositry\IRepositry\IFoodRepositry;
use App\Http\Requests\FoodRequest;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $FoodRepositry;
    public function __construct(IFoodRepositry $FoodRepositry){
        $this->FoodRepositry = $FoodRepositry;
        $this->authorizeResource(Food::class, 'food');
    }

    public function index()
    {
        return FoodResourse::collection($this->FoodRepositry->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FoodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        $DATA = $this->FoodRepositry->create($request->toArray());
        $DATA->images()->create(["path" => FileHelper::uplodFile($request->img, 'food')]);
        return new FoodResourse($DATA);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        return new FoodResourse($food);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FoodRequest  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, Food $food)
    {
        $this->FoodRepositry->update($request->toArray(), $food->id);
        if ($request['img']) {
            $food->images()->delete();
            $food->images()->create(["path" => FileHelper::uplodFile($request->img, 'food')]);
        }
        return new FoodResourse($food);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $this->FoodRepositry->delete($food->id);
        return "done";
    }
}
