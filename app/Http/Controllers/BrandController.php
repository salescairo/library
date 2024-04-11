<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Services\BrandService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController
{
    public function __construct(public BrandService $service)
    {
    }

    public function index(Request $request): Response
    {
        return response()->view('model.brand.index', [
            'models' => $this->service->findPaginate($request->all())]
        );
    }

    public function create(): Response
    {
        return response()->view('model.brand.create');
    }

    public function edit(int $id): RedirectResponse|Response
    {
        $model = $this->service->findById($id);
        if (is_null($model)) {
            return back();
        }
        return response()->view('model.brand.edit', [
            'model' => $model
        ]);
    }

    public function store(BrandRequest $request): RedirectResponse
    {
        $this->service->save($request->all());
        return back();
    }

    public function update(Request $request, int $id): RedirectResponse|Response
    {
        $model = $this->service->findById($id);
        if (is_null($model)) {
            return back();
        }
        $this->service->update($id, $request->all());
        return back();
    }

    public function destroy(int $id): RedirectResponse|Response
    {
        $model = $this->service->findById($id);
        if (is_null($model)) {
            return back();
        }
        $this->service->delete($id);
        return back();
    }
}