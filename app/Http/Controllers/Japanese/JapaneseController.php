<?php

namespace App\Http\Controllers\Japanese;

use App\Http\Controllers\Controller;
use App\Models\Japanese;
use Illuminate\Http\Request;

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
        
        $validator = [
            'japanese' => 'required',
            'meaning' => 'required',
            'note' => 'min:10',
        ];
        $request->validate($validator);
        try {
            $data = Japanese::create([
                'japanese' => $request->japanese,
                'meaning' => $request->meaning,
                'note' => $request->note,
            ]);
            return redirect()->route('japaneses.index')->withMessage('Word Added');
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
        $validator = [
            'japanese' => 'required',
            'meaning' => 'required',
            'note' => 'min:10',
        ];
        $request->validate($validator);
        try {
            $japanese->update([
                'japanese' => $request->japanese,
                'meaning' => $request->meaning,
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
