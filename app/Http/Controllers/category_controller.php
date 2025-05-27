<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class category_controller extends Controller
{
    
  

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create(['name' => $request->name]);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }


    
}
