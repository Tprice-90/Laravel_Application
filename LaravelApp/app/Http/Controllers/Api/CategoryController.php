<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request)
    {
        $sortColumn = $request->input('sort', 'id');
        $sortDirection = Str::startsWith($sortColumn, '-') ? 'desc' : 'asc';
        $sortColumn = ltrim($sortColumn, '-');
        $query = Category::query();
        $query->when(request()->filled('filter'), function ($query) {
            [$criteria, $value] = explode(':', request('filter'));
            return $query->where($criteria, $value);
        });

        return $categories = $query->orderBy($sortColumn, $sortDirection)->paginate(3);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CategoryResource|\Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create($request->all());
        } catch(Exception $e) {
            return response()->json([
                'errors' => [
                    'title'  => 'Could not create category',
                    'detail' => $e->getMessage(),
                    'code'   => 2,
                ],
            ], 400);
        }

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CategoryResource
     */
    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch(\Exception $e) {
            return response()->json([
                'errors' => [
                    'title'  => 'Could not find Category',
                    'detail' => $e->getMessage(),
                    'code'   => 1,
                ],
            ], 404);
        }
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Resources\Category as CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     * @return CategoryResource
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update($request->all());
        } catch(\Exception $e) {
            return response()->json([
                'errors' => [
                    'title'  => 'Could not update category',
                    'detail' => $e->getMessage(),
                    'code'   => 3,
                ],
            ], 404);
        }

        return new CategoryResource($category);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
        } catch(\Exception $e) {
            return response()->json([
                'errors' => [
                    'title'  => 'Could not delete category',
                    'detail' => $e->getMessage(),
                    'code'   => 4,
                ],
            ], 404);
        }

        return response()->json(null, 204);
    }
}
