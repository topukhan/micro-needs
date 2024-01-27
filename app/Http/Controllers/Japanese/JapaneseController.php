<?php

namespace App\Http\Controllers\Japanese;

use App\Http\Controllers\Controller;
use App\Models\Japanese;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JapaneseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $words = Japanese::all();
        return view('japaneses.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('japaneses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'japanese_word' => 'required',
            'example' => 'nullable|min:15',
            'note' => 'nullable|min:10',
            'bangla_meaning' => 'required_without:english_meaning',
            'english_meaning' => 'required_without:bangla_meaning',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        // dd($request->all());
        try {
            $data = Japanese::create([
                'japanese_word' => $request->japanese_word,
                'bangla_meaning' => $request->bangla_meaning,
                'english_meaning' => $request->english_meaning,
                'example' => $request->example,
                'note' => $request->note,
            ]);
            // dd($data);
            return redirect()->route('japaneses.index')->withMessage('Translation Added');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withError($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Japanese $japanese)
    {
        return view('japaneses.show', compact('japanese'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Japanese $japanese)
    {
        return view('japaneses.edit', compact('japanese'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Japanese $japanese)
    {
        $validator = Validator::make($request->all(), [
            'japanese_word' => 'required',
            'example' => 'nullable|min:15',
            'note' => 'nullable|min:10',
            'bangla_meaning' => 'required_without:english_meaning',
            'english_meaning' => 'required_without:bangla_meaning',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        try {
            $japanese->update([
                'japanese_word' => $request->japanese_word,
                'bangla_meaning' => $request->bangla_meaning,
                'english_meaning' => $request->english_meaning,
                'example' => $request->example,
                'note' => $request->note,
            ]);
            return redirect()->route('japaneses.index')->withMessage('Word Updated');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Japanese $japanese)
    {
        $japanese->delete();
        return redirect()->route('japaneses.index')->withMessage("Word Deleted!");
    }
}
