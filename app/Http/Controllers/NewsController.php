<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:wartawan')->only(['create', 'store']);
        $this->middleware('role:editor')->only(['approve', 'reject']);
    }

    public function index()
    {
        $news = News::with(['category', 'user'])->latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $news = new News($validated);
        $news->slug = Str::slug($request->title);
        $news->user_id = auth()->id();
        $news->status = 'draft';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 400)->save(public_path('images/' . $filename));
            $news->image = $filename;
        }

        $news->save();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dibuat sebagai draft');
    }

    public function approve(News $news)
    {
        $news->update([
            'status' => 'published',
            'approved_by' => auth()->id()
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil dipublish');
    }

    public function reject(News $news)
    {
        $news->update([
            'status' => 'rejected',
            'approved_by' => auth()->id()
        ]);

        return redirect()->route('news.index')->with('success', 'Berita ditolak');
    }
}