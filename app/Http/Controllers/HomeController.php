<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\Registration;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Menampilkan halaman index dengan fitur filter
    public function IndexPage(Request $request): View
    {
        // Ambil kategori yang ada di database
        $categories = Category::all();

        // Ambil kategori dan tanggal dari request
        $category = $request->input('category');
        $date = $request->input('date');

        // Query untuk mengambil data dengan filter untuk Featured Events
        $query = Event::where('type', 'Feature')->inRandomOrder()->latest();

        // Filter berdasarkan kategori (jika ada)
        if ($category) {
            $query->where('categorie_id', $category);
        }

        // Filter berdasarkan tanggal (jika ada)
        if ($date) {
            $query->whereDate('date', $date); // Sesuaikan dengan format tanggal di database
        }

        // Ambil 4 event yang terfilter
        $featurEvents = $query->take(4)->get();

        // Query untuk Recent Events dengan filter yang sama
        $recentEventsQuery = Event::where('type', 'Recent')->inRandomOrder()->latest();
        if ($category) {
            $recentEventsQuery->where('categorie_id', $category);
        }
        if ($date) {
            $recentEventsQuery->whereDate('date', $date);
        }

        // Ambil 6 recent events dengan pagination
        $recentEvents = $recentEventsQuery->paginate(6);

        // Kembalikan view dengan data yang sudah difilter
        return view('frontend.pages.index-page', compact('featurEvents', 'recentEvents', 'categories'));
    }

    // Menampilkan halaman post detail berdasarkan id
    public function PostPage($id)
    {
        $post = Event::find($id);
        $raletedEvents = Event::where('type', 'Recent')
                                ->where('categorie_id', $post->categorie_id)
                                ->inRandomOrder()
                                ->take(3)
                                ->get();
        return view('frontend.pages.post-page', compact('post', 'raletedEvents'));
    }

    // Menangani registrasi event
    public function EventRegistration(Request $request)
    {
        Registration::create([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'remark' => $request->input('remark'),
            'event_id' => $request->input('event_id'),
            'user_id' => $request->input('user_id')
        ]);

        return redirect()->back()->with('success', 'Your Registration Confirmed');
    }
}
