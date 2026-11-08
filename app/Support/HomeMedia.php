<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Resolves a stored image path to a public URL.
 *
 * Two kinds of paths coexist on purpose:
 *  - "mas-cool-assets/<file>.png" — the original approved artwork that ships in
 *    resources/images/mas-cool and is served by the mas-cool.asset route.
 *  - anything else — an admin upload living on the public disk.
 */
class HomeMedia
{
    public const LEGACY_PREFIX = 'mas-cool-assets/';

    public static function url(?string $path, ?string $fallback = null): ?string
    {
        $path = trim((string) $path);

        if ($path === '') {
            return $fallback;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//', 'data:'])) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (Str::startsWith($path, self::LEGACY_PREFIX)) {
            return '/'.$path;
        }

        return Storage::disk('public')->url($path);
    }

    /** True when the path points at the bundled approved artwork (never deletable). */
    public static function isBundled(?string $path): bool
    {
        return Str::startsWith(ltrim((string) $path, '/'), self::LEGACY_PREFIX);
    }
}
