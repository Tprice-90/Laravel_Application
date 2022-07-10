<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Article;

class ArticleController extends Controller
{
    public function index() {
        $testing = 'Passing data...';
        $articles = DB::table('articles')->get();
        return view('articles.index', compact('testing', 'articles'));
    }

    public function show(Article $article) {
        return view('articles.show', compact("article"));
    }

    public function create() {
        $categories = Category::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        return view('articles.create', compact("categories", "tags"));
    }

    public function store(Request $request) {
        $category = Category::findOrFail($request->category_id);
        $article = new Article($request->all());
        $article->author_id = 1;
        $article->category()->associate($category)->save();
        $article->tags()->sync($request->tags);
        if ($request->hasFile('file') &&
            $request->file('file')->isValid()) {
            $path = $request->file->storePublicly('.', 'public');
            $article->file = $path;
            $article->save();
        }
        return redirect('articles');
    }

    public function destroy($article) {
        Article::destroy($article);
        return redirect('articles');
    }
}
