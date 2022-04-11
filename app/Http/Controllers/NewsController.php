<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsRequest $request)
    {
        $params = $request->all();

        if ($request->has('image')){
            $path = $request->file('image')->store('news');
            $params['image'] = $path;
        }

        News::create($params);
        return redirect()->route('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  News  $news
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $user = Auth::user();
        $otherNews = News::where('id','!=', $news->id)->orderByDesc('id')->take(5)->get();
        return view('news.show', compact('user', 'news', 'otherNews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  News  $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  News  $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsRequest $request, News $news)
    {
        $params = $request->all();

        if ($request->has('image')){
            Storage::delete($news->image);
            $path = $request->file('image')->store('news');
            $params['image'] = $path;
        }

        $news->update($params);
        return redirect()->route('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  News  $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $news)
    {
        Storage::delete($news->image);
        $news->delete();
        return redirect()->route('admin');
    }
}

