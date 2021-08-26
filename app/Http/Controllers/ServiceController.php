<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Repositry\IRepositry\IServiceRepositry;
use App\Http\Resources\ServiceResourse;
use App\Helper\FileHelper;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $serviceRepositry;

    public function __construct(IServiceRepositry $service)
    {
        $this->serviceRepositry = $service;
        $this->authorizeResource(Service::class, 'service');
    }

    public function index()
    {
        return ServiceResourse::collection($this->serviceRepositry->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = $this->serviceRepositry->create($request->toArray());
        foreach ($request->imgs as $img) {
            $service->images()->create(["path" => FileHelper::uplodFile($img, 'service')]);
        }
        return new ServiceResourse($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program_exercise  $program_exercise
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return new ServiceResourse($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $this->serviceRepositry->update($request->toArray(), $service->id);
        if ($request['imgs']) {
            $service->images()->delete();
            foreach ($request->imgs as $img) {
                $service->images()->create(["path" => FileHelper::uplodFile($img, 'service')]);
            }
        }
        return new ServiceResourse($this->serviceRepositry->find($service->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->serviceRepositry->delete($service->id);
        return "Done";
    }
}
