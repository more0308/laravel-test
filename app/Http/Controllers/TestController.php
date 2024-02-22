<?php

namespace App\Http\Controllers;

use App\Http\Requests\Test\StoreRequest;
use App\Http\Resources\ManagerResource;
use App\Http\Resources\TestResource;
use App\Models\Test;
use App\Services\ManagerService;
use App\Services\TestService;

class TestController extends Controller
{
    private TestService $service;
    private ManagerService $managerService;

    public function __construct(TestService $service, ManagerService $managerService) {
        $this->service = $service;
        $this->managerService = $managerService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = $this->service->all();

        $tests = TestResource::collection($tests)->resolve();

        return inertia('Test/Index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $managers = $this->managerService->all();
        $managers = ManagerResource::collection($managers)->resolve();

        return inertia('Test/Create', compact('managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->create($data);

        return redirect()->route('test.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        $test = TestResource::make($test)->resolve();

        $managers = $this->managerService->all();
        $managers = ManagerResource::collection($managers)->resolve();

        return inertia('Test/Create', compact('test', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Test $test)
    {
        $data = $request->validated();
        $data['criterion'] = $this->service->getCriterion($data['grade']);

        $test->update($data);

        return redirect()->route('test.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        $test->delete();
    }
}
