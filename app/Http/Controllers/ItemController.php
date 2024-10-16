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
        $items = Item::with(['category', 'inventory'])
            ->withCount('images')
            ->orderBy('id', 'asc')
            ->paginate(10);

        $categories = Category::all();

        return Inertia::render('Items/Index', [
            'items' => $items,
            'categories' => $categories,
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
        $validatedData['online'] = false;

        $item = Item::create($validatedData);

        // Create inventory record
        $item->inventory()->create(['quantity' => $request->input('stock', 0)]);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $item = Item::with(['category', 'inventory'])->withCount('images')->find($id);

        if (!$item) {
            return Inertia::render('Item/ItemNotFound', [
                'message' => 'The item you are looking for could not be found.',
            ]);
        }

        $item->category = $item->category ?? (object)['name' => 'No Category'];
        $item->stock = $item->inventory ? $item->inventory->quantity : 0;

        $categories = Category::all(); // Add this line

        return Inertia::render('Items/Show', [
            'item' => $item,
            'categories' => $categories, // Add this line
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
        $validatedData = $request->validated();

        $item->update($validatedData);

        // Update inventory
        $item->inventory()->updateOrCreate(
            ['item_id' => $item->id],
            ['quantity' => $request->input('quantity', 0)]
        );

        // Load the updated item with its relationships
        $item->load(['category', 'inventory']);
        $item->loadCount('images');

        return back()->with('success', 'Item updated successfully.');
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
