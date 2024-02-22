<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manager\StoreRequest;
use App\Http\Requests\Manager\UpdateRequest;
use App\Http\Resources\ManagerResource;
use App\Models\User;
use App\Services\ManagerService;

class ManagerController extends Controller
{
    private ManagerService $service;

    public function __construct(ManagerService $service) {
        $this->service = $service;

        $this->authorizeResource(User::class, 'manager');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managers = $this->service->all();

        $managers = ManagerResource::collection($managers)->resolve();

        return inertia('Manager/Index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Manager/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->create($data);

        return redirect()->route('manager.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $manager)
    {
        $manager = ManagerResource::make($manager)->resolve();

        return inertia('Manager/Create', compact('manager'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $manager)
    {
        $data = $request->validated();

        $manager->update($data);

        return redirect()->route('manager.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $manager)
    {
        $manager->delete();
    }
}
