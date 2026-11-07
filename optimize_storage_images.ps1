
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
        $ratio = $img.Height / $img.Width
        $NewHeight = [int]($NewWidth * $ratio)

        # Skip if already small enough
        if ($img.Width -le $NewWidth) {
            Write-Host "Skipping $ImagePath (Width $($img.Width) <= $NewWidth)"
            $img.Dispose()
            return
        }

        $bitmap = New-Object System.Drawing.Bitmap($NewWidth, $NewHeight)
        $graph = [System.Drawing.Graphics]::FromImage($bitmap)
        $graph.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
        $graph.SmoothingMode = [System.Drawing.Drawing2D.SmoothingMode]::HighQuality
        $graph.CompositingQuality = [System.Drawing.Drawing2D.CompositingQuality]::HighQuality

        $graph.DrawImage($img, 0, 0, $NewWidth, $NewHeight)

        $img.Dispose() # Release original file handle

        $bitmap.Save($ImagePath, [System.Drawing.Imaging.ImageFormat]::Jpeg) # Save back (assuming Jpeg/Png handled generally or force Jpeg for photos)

        $bitmap.Dispose()
        $graph.Dispose()

        Write-Host "Resized $ImagePath to $NewWidth x $NewHeight"
    } catch {
        Write-Host "Error processing $ImagePath : $_"
    }
}

$baseDir = "d:\laragon\www\Outer\Sensors\public\storage\projects"

Get-ChildItem "$baseDir" -Include *.jpg, *.jpeg, *.png -Recurse | ForEach-Object {
    Resize-Image $_.FullName 600
}
