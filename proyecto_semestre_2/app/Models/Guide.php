<?php

namespace App\Models;

use Database\Factories\GuideFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'user_id',
    'title',
    'description',
    'category',
    'file_path',
    'file_type',
    'pdf_path',
    'pdf_type',
    'image_paths',
    'visibility',
])]
class Guide extends Model
{
    /** @use HasFactory<GuideFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    #[Scope]
    protected function public(Builder $query): void
    {
        $query->where('visibility', 'public');
    }

    public function getFileUrlAttribute(): string
    {
        return $this->file_path ? Storage::disk('public')->url($this->file_path) : '';
    }

    public function isImage(): bool
    {
        return $this->file_type ? str_starts_with($this->file_type, 'image/') : false;
    }

    public function isPdf(): bool
    {
        return $this->file_type === 'application/pdf';
    }

    public function getPdfUrlAttribute(): ?string
    {
        return $this->pdf_path ? Storage::disk('public')->url($this->pdf_path) : null;
    }

    public function getImageUrlsAttribute(): array
    {
        $paths = $this->image_paths ?? [];

        if (!is_array($paths)) {
            return [];
        }

        return array_map(fn ($p) => Storage::disk('public')->url($p), $paths);
    }

    public function hasPdf(): bool
    {
        return (bool) $this->pdf_path;
    }

    public function hasImages(): bool
    {
        return is_array($this->image_paths) && count($this->image_paths) > 0;
    }
}
