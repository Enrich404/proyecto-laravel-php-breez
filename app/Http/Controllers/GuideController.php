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
        $data = $request->safe()->except(['pdf', 'images']);

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $data['pdf_path'] = $pdf->store('guides/pdfs', 'public');
            $data['pdf_type'] = $pdf->getMimeType() ?: $pdf->getClientMimeType();
        }

        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $image) {
                $paths[] = $image->store('guides/images', 'public');
            }

            $data['image_paths'] = $paths;
        }

        $request->user()->guides()->create($data);

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
        $data = $request->safe()->except(['pdf', 'images']);

        if ($request->hasFile('pdf')) {
            if ($guide->pdf_path) {
                Storage::disk('public')->delete($guide->pdf_path);
            }

            $pdf = $request->file('pdf');
            $data['pdf_path'] = $pdf->store('guides/pdfs', 'public');
            $data['pdf_type'] = $pdf->getMimeType() ?: $pdf->getClientMimeType();
        }

        if ($request->hasFile('images')) {
            // delete previous images
            if (is_array($guide->image_paths)) {
                foreach ($guide->image_paths as $old) {
                    Storage::disk('public')->delete($old);
                }
            }

            $paths = [];
            foreach ($request->file('images') as $image) {
                $paths[] = $image->store('guides/images', 'public');
            }

            $data['image_paths'] = $paths;
        }

        $guide->update($data);

        return redirect()->route('guides.mine')->with('status', 'Guia actualizada correctamente.');
    }

    public function destroy(Guide $guide): RedirectResponse
    {
        $this->ensureOwner($guide);
        if ($guide->pdf_path) {
            Storage::disk('public')->delete($guide->pdf_path);
        }

        if (is_array($guide->image_paths)) {
            foreach ($guide->image_paths as $img) {
                Storage::disk('public')->delete($img);
            }
        }

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
