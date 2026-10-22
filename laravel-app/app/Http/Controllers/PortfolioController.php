<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    private function authenticatedUserId(Request $request): string
    {
        $userId = $request->session()->get('supabase_user_id');

        abort_unless(is_string($userId) && $userId !== '', 401);

        return $userId;
    }

    public function index(Request $request)
    {
        $userId = $this->authenticatedUserId($request);

        $portfolios = Portfolio::where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();

        return view('portfolio.index', compact('portfolios'));
    }

    public function create(Request $request)
    {
        $this->authenticatedUserId($request);

        return view('portfolio.create');
    }

    public function store(Request $request)
    {
        $userId = $this->authenticatedUserId($request);
        
        // Prevent users from creating a second portfolio.
        $existingPortfolio = Portfolio::where('user_id', $userId)->first();

        if ($existingPortfolio) {
            return redirect('/portfolio/manage')
                ->with('success', 'You already have a portfolio. You can edit your existing one instead.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'contact_number' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'about_me' => 'nullable|string',
            'education' => 'nullable|string',
            'skills' => 'nullable|string',
            'projects' => 'nullable|string',
            'work_experience' => 'nullable|string',
            'social_links' => 'nullable|string',
            'template' => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')
                ->store('profile-pictures', 'public');
        }

        $validated['user_id'] = $userId;

        Portfolio::create($validated);

        return redirect('/portfolio/manage')
            ->with('success', 'Portfolio created successfully!');
    }
    
    public function preview(Request $request, int $id)
    {
        $userId = $this->authenticatedUserId($request);

        $portfolio = Portfolio::where('user_id', $userId)
            ->findOrFail($id);

        return view('portfolio.preview', compact('portfolio'));
    }
    public function edit(Request $request, int $id)
    {
        $userId = $this->authenticatedUserId($request);

        $portfolio = Portfolio::where('user_id', $userId)
            ->findOrFail($id);

        return view('portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, int $id)
    {
        $userId = $this->authenticatedUserId($request);

        $portfolio = Portfolio::where('user_id', $userId)
            ->findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'contact_number' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'about_me' => 'nullable|string',
            'education' => 'nullable|string',
            'skills' => 'nullable|string',
            'projects' => 'nullable|string',
            'work_experience' => 'nullable|string',
            'social_links' => 'nullable|string',
            'template' => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')
                ->store('profile-pictures', 'public');
        } else {
            unset($validated['profile_picture']);
        }

        $portfolio->update($validated);

        return redirect('/portfolio/manage')
            ->with('success', 'Portfolio updated successfully!');
    }

    public function destroy(Request $request, int $id)
    {
        $userId = $this->authenticatedUserId($request);

        $portfolio = Portfolio::where('user_id', $userId)
            ->findOrFail($id);

        $portfolio->delete();

        return redirect('/portfolio/manage')
            ->with('success', 'Portfolio deleted successfully!');
    }
}
