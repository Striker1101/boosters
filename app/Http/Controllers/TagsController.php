<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    // List all tags
    public function index()
    {
        $tags = Tag::latest()->get();
        return view('tags', compact('tags'));
    }

    // Store new tag
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:tags,name',
            'image' => 'nullable|string',
        ]);

        Tag::create($request->only('name', 'image'));

        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag created successfully');
    }

    // Update tag
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:tags,name,' . $tag->id,
            'image' => 'nullable|string',
        ]);

        $tag->update($request->only('name', 'image'));

        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag updated successfully');
    }

    // Delete tag
    public function destroy($id)
    {
        Tag::findOrFail($id)->delete();

        return redirect()
            ->route('tags.index')
            ->with('success', 'Tag deleted successfully');
    }
}
