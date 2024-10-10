<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
  
   public function manageUsers()
   {
       $users = User::all();
       return view('admin.users', compact('users'));
   }
   
 
   public function manageCategories()
   {
       $categories = Category::all();
       return view('admin.categories', compact('categories'));
   }
   
 
   public function storeCategory(Request $request)
   {
       $request->validate([
           'category_name' => 'required|string|max:255'
       ]);

     
       Category::create([
           'category_name' => $request->category_name,
       ]);

      
       return redirect()->back()->with('success', 'Category added successfully.');
   }
  
   public function deleteCategory($id)
   {
     
       $category = Category::findOrFail($id);
       $category->delete();

     
       return redirect()->back()->with('success', 'Category deleted successfully.');
   }
   
   // View Files
   public function viewFiles()
   {
      
       $files = Document::all();
       return view('admin.files', compact('files'));
   }
   public function updateCategory(Request $request, $id)
{
    
    $request->validate([
        'category_name' => 'required|string|max:255'
    ]);

    $category = Category::findOrFail($id);
    $category->update([
        'category_name' => $request->category_name,
    ]);


    return redirect()->back()->with('success', 'Category updated successfully.');
}
public function deleteFile($id)
{
    $file = Document::findOrFail($id);
    
    // Delete the file from storage
    Storage::delete('public/' . $file->file_path);
    
    // Delete the file record from the database
    $file->delete();
    
    return redirect()->back()->with('success', 'File deleted successfully.');
}
}