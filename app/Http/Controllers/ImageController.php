<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request, Item $item)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('item-images', 'public');

        $image = $item->images()->create([
            'path' => $path,
            'alt_text' => $request->alt_text,
            'order' => $item->images()->count() + 1,
        ]);

        return response()->json($image, 201);
    }

    public function destroy(Item $item, Image $image)
    {
        if ($image->imageable_id !== $item->id || $image->imageable_type !== Item::class) {
            return response()->json(['message' => 'Image does not belong to this item'], 403);
        }

        Storage::disk('public')->delete($image->path);
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }
}

