
Add-Type -AssemblyName System.Drawing

function Resize-Image {
    param(
        [string]$ImagePath,
        [int]$NewWidth
    )

    if (-not (Test-Path $ImagePath)) {
        Write-Host "File not found: $ImagePath"
        return
    }

    try {
        $img = [System.Drawing.Image]::FromFile($ImagePath)

        # Skip if already small enough
        if ($img.Width -le $NewWidth) {
            Write-Host "Skipping $ImagePath (Width $($img.Width) <= $NewWidth)"
            $img.Dispose()
            return
        }

        $ratio = $img.Height / $img.Width
        $NewHeight = [int]($NewWidth * $ratio)

        $bitmap = New-Object System.Drawing.Bitmap($NewWidth, $NewHeight)
        $graph = [System.Drawing.Graphics]::FromImage($bitmap)
        $graph.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
        $graph.SmoothingMode = [System.Drawing.Drawing2D.SmoothingMode]::HighQuality
        $graph.CompositingQuality = [System.Drawing.Drawing2D.CompositingQuality]::HighQuality

        $graph.DrawImage($img, 0, 0, $NewWidth, $NewHeight)

        $img.Dispose() # Release original handle

        # Save overwrite (convert to Jpeg for size if it's a huge PNG)
        $ext = [System.IO.Path]::GetExtension($ImagePath).ToLower()
        if ($ext -eq ".png" -and [System.IO.FileInfo]::new($ImagePath).Length -gt 200KB) {
             # Only convert to Jpeg if it's large and likely a photo
             Write-Host "Converting $ImagePath to Jpeg for size..."
             $newPath = $ImagePath.Replace(".png", ".jpg")
             $bitmap.Save($newPath, [System.Drawing.Imaging.ImageFormat]::Jpeg)
             # Note: We keep the old filename reference for now to avoid broken links, or delete old?
             # For now just overwrite the PNG with PNG but optimized
             $bitmap.Save($ImagePath, [System.Drawing.Imaging.ImageFormat]::Png)
        } else {
             $bitmap.Save($ImagePath, $img.RawFormat)
        }

        $bitmap.Dispose()
        $graph.Dispose()

        Write-Host "Resized $ImagePath to $NewWidth x $NewHeight"
    } catch {
        Write-Host "Error processing $ImagePath : $_"
    }
}

$dir = "d:\laragon\www\Outer\Sensors\public\land\images"
Resize-Image "$dir\blog-big.png" 800
Resize-Image "$dir\hero.png" 1200
Resize-Image "$dir\testimonial.png" 800
Resize-Image "$dir\project-03.png" 800
