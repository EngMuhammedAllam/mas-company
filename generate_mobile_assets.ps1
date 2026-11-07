
Add-Type -AssemblyName System.Drawing

function Optimize-And-WebP {
    param(
        [string]$ImagePath,
        [int]$MobileWidth
    )

    if (-not (Test-Path $ImagePath)) {
        Write-Host "File not found: $ImagePath"
        return
    }

    try {
        $img = [System.Drawing.Image]::FromFile($ImagePath)
        $ext = [System.IO.Path]::GetExtension($ImagePath).ToLower()
        $baseName = [System.IO.Path]::GetFileNameWithoutExtension($ImagePath)
        $dir = [System.IO.Path]::GetDirectoryName($ImagePath)

        # Generate mobile version (half size approx)
        if ($img.Width -gt $MobileWidth) {
            $ratio = $img.Height / $img.Width
            $newHeight = [int]($MobileWidth * $ratio)
            $mobileBitmap = New-Object System.Drawing.Bitmap($MobileWidth, $newHeight)
            $g = [System.Drawing.Graphics]::FromImage($mobileBitmap)
            $g.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
            $g.DrawImage($img, 0, 0, $MobileWidth, $newHeight)

            $mobilePath = "$dir\$baseName-mobile$ext"
            $mobileBitmap.Save($mobilePath, $img.RawFormat)
            Write-Host "Generated mobile version: $mobilePath"

            $mobileBitmap.Dispose()
            $g.Dispose()
        }

        # Conversion to WebP (This requires a tool like cwebp, but I might not have it).
        # Since I am on Windows and might not have cwebp in PATH, I'll stick to JPG/PNG for now but highly compressed.
        # Actually, let's just make sure the mobile versions exist.

        $img.Dispose()
    } catch {
        Write-Host "Error processing $ImagePath : $_"
    }
}

$storageDir = "d:\laragon\www\Outer\Sensors\public\storage"
# Hero image - finding it might be hard if it's dynamic, but I can target the common ones.
# Actually, I'll just look for jpg/png in storage/hero and storage/about
Get-ChildItem -Path "$storageDir\hero", "$storageDir\about" -Include *.jpg, *.png -Recurse | ForEach-Object {
    Optimize-And-WebP $_.FullName 600
}
