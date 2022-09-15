<?php

namespace App\Http\Controllers;

use App\Models\TelegraphText;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function add()
    {
        return view('telegraph');
    }

    public function show(string $slug)
    {
        $data = TelegraphText::where('slug', $slug)->firstOrFail();
        return view('show', compact('data'));
    }

    public function list()
    {
        $data = TelegraphText::all();
        return view('list', compact('data'));
    }

    public function delete(string $slug): RedirectResponse
    {
        TelegraphText::where('slug', $slug)->delete();
        return redirect()->route('text.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateText($request);

        $telegraphText = new TelegraphText();
        $telegraphText->slug = $validated['title'];
        $telegraphText->fill($validated)->save();

        return redirect()->route('text.show', $telegraphText->slug);
    }

    public function edit(string $slug)
    {
        $data = TelegraphText::where('slug', $slug)->firstOrFail();
        return view('telegraph', compact('data'));
    }

    public function update(Request $request, string $slug): RedirectResponse
    {
        $validated = $this->validateText($request);

        $telegraphText = TelegraphText::where('slug', $slug)->firstOrFail();
        $telegraphText->slug = $validated['title'];

        $telegraphText->fill($validated)->save();

        return redirect()->route('text.show', $telegraphText->slug);
    }

    private function validateText($data)
    {
        return $data->validate([
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
            'author' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
        ]);
    }
}
