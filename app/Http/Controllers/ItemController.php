<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function viewInsert()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    public function index()
    {
    $items = Item::with('category')->get();
        return view('admin.index', compact('items'));
    }

    public function show()
    {
        $items = Item::with('category')->get();
        return view('home', compact('items'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'name' => 'required|string|min:5|max:80',
            'price' => 'required|integer|min:0',
            'total' => 'required|integer|min:0',
            // 'image' => 'required|mimes:jpeg,png,jpg,gif', 
        ]);

        if ($validatedData) {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/', 'public');
            } else {
                $imagePath = 'null.jpg';
            }

            $category = Category::where('category_name', $request->category)->first();

            if (!$category) {
                $category = new Category();
                $category->category_name = $request->category;
                $category->save();
            }

            $item = new Item();
            $item->category_id = $category->id;
            $item->name = $request->name;
            $item->price = $request->price;
            $item->total = $request->total;
            $item->image = $imagePath;
            $item->save();
            return redirect('admin-index');
            // return redirect()->back()->with('success', 'Item and category successfully stored.');
        }


        return redirect()->back()->with('error', 'Failed to store.');
    }

    public function showUpdateForm($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('admin.update', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'name' => 'required|min:5|max:80',
            'price' => 'required|integer|min:0',
            'total' => 'required|integer|min:0',
        ]);

        $item = Item::findOrFail($id);

        $item->category_id = $request->category;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->total = $request->total;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $item->image = $imagePath;
        }

        $item->save();

        return redirect('admin-index');
    }

   

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item successfully deleted.');
    }
}
