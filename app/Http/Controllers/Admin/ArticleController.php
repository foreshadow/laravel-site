<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin/article/index')->withArticles(Article::all());
    }

    public function create()
    {
        return view('admin/article/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:articles|max:255',
            'body' => 'required',
        ]);

        $article = new Article;
        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->creator = $request->user()->id;
        $article->modifier = $request->user()->id;
        $article->renderer = $request->get('renderer');
        $article->toc = ($request->get('toc') or false);
        $article->label = ($request->get('label') or false);

        if ($article->save()) {
            return redirect('admin/article')->withErrors('发布成功');
        } else {
            return redirect()->back()->withInput()->withErrors('发布失败');
        }
    }

    /**
     * Not used
     */
    public function show($id) 
    {
        return view('article/index')->with('article', Article::find($id));
    }

    public function edit($id)
    {
        return view('admin/article/edit')->with('article', Article::find($id));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $article = Article::find($id);
        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->modifier = $request->user()->id;
        $article->renderer = $request->get('renderer');
        $article->toc = ($request->get('toc') or false);
        $article->label = ($request->get('label') or false);

        if ($article->save()) {
            return redirect('admin/article')->withErrors('发布成功');
        } else {
            return redirect()->back()->withInput()->withErrors('修改失败');
        }
    }

    public function destroy($id, Request $request)
    {
        Article::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功');
    }
}
