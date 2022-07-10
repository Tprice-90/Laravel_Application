<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request) {
        $sortColumn = $request->input('sort', 'id');
        $sortDirection = Str::startsWith($sortColumn, '-') ? 'desc' : 'asc';
        $sortColumn = ltrim($sortColumn, '-');
        $query = Article::query();
        $query->when(request()->filled('filter'), function ($query) {
            [$criteria, $value] = explode(':', request('filter'));
            return $query->where($criteria, $value);
        });

        return $articles = $query->orderBy($sortColumn, $sortDirection)->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ArticleResource
     */
    public function store(Request $request) {
        try {
            $article = Article::create($request->all());
        } catch(Exception $e) {
            return response()->json([
                'errors' => [
                    'title'  => 'Could not create article',
                    'detail' => $e->getMessage(),
                    'code'   => 2,
                ],
            ], 400);
        }

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ArticleResource
     */
    public function show($id)
    {
        try {
            $article = Article::findOrFail($id);
        } catch(\Exception $e) {
            return response()->json([
                'errors' => [
                    'title'  => 'Could not find article',
                    'detail' => $e->getMessage(),
                    'code'   => 1,
                ],
            ], 404);
        }
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return ArticleResource
     */
    public function update(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->update($request->all());
        } catch(\Exception $e) {
            return response()->json([
                'errors' => [
                    'title'  => 'Could not update article',
                    'detail' => $e->getMessage(),
                    'code'   => 3,
                ],
            ], 404);
        }

        return new ArticleResource($article);;
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
            $article = Article::findOrFail($id);
            if (isset($article->file))
                Storage::delete($article->file);
            $article->delete();
        } catch(\Exception $e) {
            return response()->json([
                'errors' => [
                    'title'  => 'Could not delete article',
                    'detail' => $e->getMessage(),
                    'code'   => 4,
                ],
            ], 404);
        }

        return response()->json(null, 204);

        return response()->json(null, 204);
    }
}
