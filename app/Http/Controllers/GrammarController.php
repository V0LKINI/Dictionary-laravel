<?php

namespace App\Http\Controllers;

use App\Http\Requests\GrammarRequest;
use App\Models\Grammar;
use Illuminate\Support\Facades\Auth;

class GrammarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $basic = Grammar::where('level', 'basic')->get();
        return view('grammar/main', compact('basic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('grammar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GrammarRequest $request)
    {
        $params = $request->all();

        Grammar::create(['name' => $params['name'], 'description' =>$params['description'], 'level' => $params['level'] ]);

        return redirect()->route('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Grammar  $grammar
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Grammar $grammar)
    {
        return view('grammar.edit', compact('grammar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Grammar  $grammar
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GrammarRequest $request, Grammar $grammar)
    {
        $params = $request->all();
        $grammar->update($params);
        return redirect()->route('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Grammar  $rule
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Grammar $grammar)
    {
        $grammar->delete();
        return redirect()->route('admin');
    }
}
