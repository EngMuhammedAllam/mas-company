
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

        # Save overwrite
        $bitmap.Save($ImagePath, [System.Drawing.Imaging.ImageFormat]::Jpeg)

        $bitmap.Dispose()
        $graph.Dispose()

        Write-Host "Resized $ImagePath to $NewWidth x $NewHeight"
    } catch {
        Write-Host "Error processing $ImagePath : $_"
    }
}

# Hero Images (Optimize to 1200px for large display)
$heroDir = "d:\laragon\www\Outer\Sensors\public\storage\hero"
Get-ChildItem "$heroDir" -Include *.jpg, *.jpeg, *.png -Recurse | ForEach-Object {
    Resize-Image $_.FullName 1200
}

# About Images (Optimize to 600px)
$aboutDir = "d:\laragon\www\Outer\Sensors\public\storage\about"
Get-ChildItem "$aboutDir" -Include *.jpg, *.jpeg, *.png -Recurse | ForEach-Object {
    Resize-Image $_.FullName 600
}
