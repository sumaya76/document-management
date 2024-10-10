<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
class UserController extends Controller
{
   

   
   // Show admin index page
   public function index()
   {
       return view('user.index'); // Admin dashboard
   }

   // Show user index page
   public function user()
   {
       return view('user.index'); // User index
   }

   
    // Show user dashboard
    public function dashboard(): View
    {
        return view('user.index'); // Ensure you have a dashboard view
    }
    public function file_manage()
    {
   
        $categories = Category::all();

     
        $documents = Document::where('user_id', Auth::id())->get();

        return view('user.file_manage', compact('categories', 'documents'));
    }

    // Handle file upload
    public function uploadFile(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,jpeg,png,jpg|max:2048', 
            'category_id' => 'required|exists:categories,id', 
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $filename, 'public'); 

            // Save file details to the database
            Document::create([
                'user_id' => Auth::id(),
                'filename' => $filename,
                'file_path' => $filePath,
                'category_id' => $request->category_id,
                'uploaded_at' => now(),
            ]);

            return redirect()->route('user.file_manage')->with('success', 'File uploaded successfully.');
        }

        return redirect()->route('user.file_manage')->with('error', 'File upload failed.');
    }

    
    public function viewFiles()
    {
        $documents = Document::where('user_id', Auth::id())->get();
        return view('user.files', compact('documents'));
    }

    // Handle file deletion
    public function deleteFile($id)
    {
   
        $document = Document::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$document) {
            return redirect()->route('user.file_manage')->with('error', 'File not found or you don’t have permission to delete this file.');
        }

   
        Storage::disk('public')->delete($document->file_path);

    
        $document->delete();

        return redirect()->route('user.file_manage')->with('success', 'File deleted successfully.');
    }
    public function toggleUserStatus($id)
{
    $user = User::findOrFail($id);
    $user->is_active = !$user->is_active; // Toggle the active status
    $user->save();

    return redirect()->back()->with('success', 'User status updated successfully.');
}
}    