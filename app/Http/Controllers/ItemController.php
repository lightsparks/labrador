<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Models\Category;
use App\Models\Item;
use Inertia\Inertia;
use Inertia\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $items = Item::with('category')
            ->select('id', 'name', 'price', 'stock', 'online', 'category_id')
            ->withCount('images')
            ->orderBy('id')
            ->paginate(12);

        $categories = Category::all();

        return Inertia::render('Items/Index', [
            'items' => $items,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $validatedData = $request->validated();

        // Set default values
        $validatedData['online'] = false;

        $item = Item::create($validatedData);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): \Inertia\Response
    {
        $item = Item::with('category')->withCount('images')->find($id);

        if (!$item) {
            return Inertia::render('Item/ItemNotFound', [
                'message' => 'The item you are looking for could not be found.',
            ]);
        }

        $item->category = $item->category ?? (object)['name' => 'No Category'];

        return Inertia::render('Items/Show', [
            'item' => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }

}
