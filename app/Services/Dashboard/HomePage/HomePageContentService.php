<?php

namespace App\Services\Dashboard\HomePage;

use App\Services\Landing\MasCoolHomePageService;
use App\Support\HomeMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Write-side helper for every Home Page CMS screen.
 *
 * Owns the two rules that must never be broken:
 *  1. An image is only replaced when a new file is actually uploaded.
 *  2. The bundled approved artwork is never deleted from disk.
 */
class HomePageContentService
{
    /**
     * Persist a model and its optional image inside one transaction,
     * then invalidate the public cache.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function save(Model $model, array $attributes, ?UploadedFile $image = null, string $folder = 'home', string $column = 'image'): Model
    {
        return DB::transaction(function () use ($model, $attributes, $image, $folder, $column) {
            $previous = $model->{$column} ?? null;

            if ($image instanceof UploadedFile) {
                $attributes[$column] = $this->store($image, $folder);
            } else {
                // never blank an existing image just because the field was left empty
                unset($attributes[$column]);
            }

            $model->fill($attributes)->save();

            if ($image instanceof UploadedFile) {
                $this->discard($previous, $model->{$column});
            }

            $this->flushCache();

            return $model;
        });
    }

    public function delete(Model $model, string $column = 'image'): void
    {
        DB::transaction(function () use ($model, $column) {
            $path = $model->{$column} ?? null;
            $model->delete();
            $this->discard($path, null);
            $this->flushCache();
        });
    }

    /** Store an upload on the public disk and return its relative path. */
    public function store(UploadedFile $file, string $folder): string
    {
        $name = Str::uuid()->toString().'.'.$file->getClientOriginalExtension();

        return $file->storeAs('mas-cool/'.$folder, $name, 'public');
    }

    /**
     * Remove a superseded upload.
     * Bundled artwork (mas-cool-assets/*) is shared and never deleted.
     */
    public function discard(?string $path, ?string $replacement): void
    {
        if (! $path || $path === $replacement || HomeMedia::isBundled($path)) {
            return;
        }

        Storage::disk('public')->delete($path);
    }

    public function flushCache(): void
    {
        MasCoolHomePageService::flush();
    }

    /** Unique slug helper for categories and products. */
    public function uniqueSlug(string $table, ?string $value, string $fallback, ?int $ignoreId = null): string
    {
        $base = Str::slug($value ?: $fallback) ?: Str::slug(Str::ascii($fallback)) ?: 'item';
        $slug = $base;
        $i = 2;

        while (DB::table($table)->where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
