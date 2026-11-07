
Add-Type -AssemblyName System.Drawing

function Resize-Image {
    param(
        [string]$ImagePath,
        [int]$NewWidth,
        [string]$OutputPath
    )

    if (-not (Test-Path $ImagePath)) {
        Write-Host "File not found: $ImagePath"
        return
    }

    $img = [System.Drawing.Image]::FromFile($ImagePath)
    $ratio = $img.Height / $img.Width
    $NewHeight = [int]($NewWidth * $ratio)

    $bitmap = New-Object System.Drawing.Bitmap($NewWidth, $NewHeight)
    $graph = [System.Drawing.Graphics]::FromImage($bitmap)
    $graph.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
    $graph.SmoothingMode = [System.Drawing.Drawing2D.SmoothingMode]::HighQuality
    $graph.CompositingQuality = [System.Drawing.Drawing2D.CompositingQuality]::HighQuality

    $graph.DrawImage($img, 0, 0, $NewWidth, $NewHeight)

    $bitmap.Save($OutputPath, $img.RawFormat)

    $img.Dispose()
    $bitmap.Dispose()
    $graph.Dispose()

    Write-Host "Resized $ImagePath to $OutputPath ($NewWidth x $NewHeight)"
}

$baseDir = "d:\laragon\www\Outer\Sensors\public\land\images"

# Resize Logos (Originals are ~1024px, target 300px for 75px display @ retina/high-res)
Resize-Image "$baseDir\logo-light.png" 300 "$baseDir\logo-light-opt.png"
Resize-Image "$baseDir\logo-dark.png" 300 "$baseDir\logo-dark-opt.png"

# Resize Project Images (Originals ~1200px, target 600px for ~270px display)
Resize-Image "$baseDir\project1.jpeg" 600 "$baseDir\project1-opt.jpeg"
Resize-Image "$baseDir\project2.jpeg" 600 "$baseDir\project2-opt.jpeg"
Resize-Image "$baseDir\project3.jpg" 600 "$baseDir\project3-opt.jpg"
Resize-Image "$baseDir\project4.jpg" 600 "$baseDir\project4-opt.jpg"
Resize-Image "$baseDir\project4.jpeg" 600 "$baseDir\project4-opt.jpeg"
