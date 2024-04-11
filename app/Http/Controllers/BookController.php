<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentRequest;
use App\Http\Requests\ReserveBookRequest;
use App\Services\BookService;
use App\Services\BrandService;
use App\Services\GenderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\BookRequest;

class BookController
{
    public function __construct(
        public BookService $service,
        public BrandService $brand_service,
        public GenderService $gender_service
    ) {
    }

    public function index(Request $request): Response
    {
        return response()->view('model.book.index', [
            'models' => $this->service->findPaginate($request->all())]
        );
    }

    public function create(): Response
    {
        return response()->view('model.book.create', [
            'brands' => $this->brand_service->findEnabledAll(),
            'genders' => $this->gender_service->findEnabledAll()
        ]);
    }

    public function edit(int $id): RedirectResponse|Response
    {
        $model = $this->service->findById($id);
        if (is_null($model)) {
            return back();
        }
        return response()->view('model.book.edit', [
            'model' => $model
        ]);
    }

    public function show(int $id): RedirectResponse|Response
    {
        $model = $this->service->findById($id);
        if (is_null($model)) {
            return back();
        }
        return response()->view('model.book.show', [
            'model' => $model,
            'brands' => $this->brand_service->findEnabledAll(),
            'genders' => $this->gender_service->findEnabledAll()
        ]);
    }

    public function store(BookRequest $request): RedirectResponse
    {
        $this->service->save($request->all());
        return back();
    }

    public function update(BookRequest $request, int $id): RedirectResponse|Response
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

    public function rentCreate(int $id): RedirectResponse|Response
    {
        $model = $this->service->findById($id);
        if (is_null($model)) {
            return back();
        }
        return response()->view('model.book.rent', [
            'model' => $model
        ]);
    }

    public function rentStore(RentRequest $request, int $id): RedirectResponse|Response
    {
        $this->service->rent($id, $request->all());
        return back();
    }

    public function return(int $id): RedirectResponse|Response
    {
        $model = $this->service->findById($id);
        if (is_null($model)) {
            return back();
        }
        $this->service->return($id);
        return back();
    }

    public function reserveCreate(int $id): RedirectResponse|Response
    {
        $model = $this->service->findById($id);
        if (is_null($model)) {
            return back();
        }
        return response()->view('model.book.reserve', [
            'model' => $model
        ]);
    }

    public function reserve(ReserveBookRequest $request, int $id): RedirectResponse|Response
    {
        $model = $this->service->findById($id);
        if (is_null($model)) {
            return back();
        }
        $this->service->reserve($id, $request->get(key: 'name'));
        return back();
    }

    public function unreserve(int $id): RedirectResponse|Response
    {
        $model = $this->service->findById($id);
        if (is_null($model)) {
            return back();
        }
        $this->service->reserve($id);
        return back();
    }
}