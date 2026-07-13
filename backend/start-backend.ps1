$ErrorActionPreference = 'Stop'
Set-Location $PSScriptRoot
$appRoot = Resolve-Path "$PSScriptRoot\.."
$tempPath = Join-Path $appRoot 'storage\framework\tmp'
$env:TEMP = $tempPath
$env:TMP = $tempPath
php artisan serve
