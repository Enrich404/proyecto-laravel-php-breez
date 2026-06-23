<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuideRequest;
use App\Http\Requests\UpdateGuideRequest;
use App\Models\Guide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GuideController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('buscar'));
        $category = trim((string) $request->query('categoria'));

        $guides = Guide::query()
            ->with('user')
            ->public()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->when($category !== '', fn ($query) => $query->where('category', $category))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = Guide::query()
            ->public()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('guides.index', compact('guides', 'categories', 'search', 'category'));
    }

    public function create(): View
    {
        return view('guides.create', ['guide' => new Guide(['visibility' => 'public'])]);
    }

    public function store(StoreGuideRequest $request): RedirectResponse
    {
        $file = $request->file('file');
        $path = $file->store('guides', 'public');

        $request->user()->guides()->create([
            ...$request->safe()->except('file'),
            'file_path' => $path,
            'file_type' => $file->getMimeType() ?: $file->getClientMimeType(),
        ]);

        return redirect()->route('guides.mine')->with('status', 'Guia publicada correctamente.');
    }

    public function show(Guide $guide): View
    {
        abort_if($guide->visibility === 'private' && auth()->id() !== $guide->user_id, 404);

        $guide->load('user');

        return view('guides.show', compact('guide'));
    }

    public function edit(Guide $guide): View
    {
        $this->ensureOwner($guide);

        return view('guides.edit', compact('guide'));
    }

    public function update(UpdateGuideRequest $request, Guide $guide): RedirectResponse
    {
        $this->ensureOwner($guide);

        $data = $request->safe()->except('file');

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($guide->file_path);

            $file = $request->file('file');
            $data['file_path'] = $file->store('guides', 'public');
            $data['file_type'] = $file->getMimeType() ?: $file->getClientMimeType();
        }

        $guide->update($data);

        return redirect()->route('guides.mine')->with('status', 'Guia actualizada correctamente.');
    }

    public function destroy(Guide $guide): RedirectResponse
    {
        $this->ensureOwner($guide);

        Storage::disk('public')->delete($guide->file_path);
        $guide->delete();

        return redirect()->route('guides.mine')->with('status', 'Guia eliminada.');
    }

    public function mine(Request $request): View
    {
        $guides = $request->user()
            ->guides()
            ->latest()
            ->paginate(10);

        return view('guides.mine', compact('guides'));
    }

    private function ensureOwner(Guide $guide): void
    {
        abort_unless(auth()->id() === $guide->user_id, 403);
    }
}
