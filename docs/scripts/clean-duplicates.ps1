# Script para limpiar archivos duplicados y vacíos
# Ejecutar desde la raíz del proyecto: powershell -ExecutionPolicy Bypass -File docs/scripts/clean-duplicates.ps1

$rootPath = "."

Write-Host "🧹 Limpiando archivos duplicados y vacíos..." -ForegroundColor Cyan

# 1. Buscar y eliminar archivos vacíos
Write-Host "`n📂 Buscando archivos vacíos..." -ForegroundColor Yellow
$emptyFiles = Get-ChildItem -Path $rootPath -Recurse -File | Where-Object { $_.Length -eq 0 -and $_.Name -ne ".gitkeep" }

if ($emptyFiles.Count -gt 0) {
    Write-Host "Archivos vacíos encontrados:" -ForegroundColor Red
    $emptyFiles | ForEach-Object { Write-Host "  - $($_.FullName)" -ForegroundColor Red }
    
    $confirm = Read-Host "¿Eliminar archivos vacíos? (y/N)"
    if ($confirm -eq "y" -or $confirm -eq "Y") {
        $emptyFiles | Remove-Item -Force
        Write-Host "✅ Archivos vacíos eliminados." -ForegroundColor Green
    }
} else {
    Write-Host "✅ No se encontraron archivos vacíos." -ForegroundColor Green
}

# 2. Buscar archivos duplicados por patrones comunes
Write-Host "`n📄 Buscando archivos duplicados..." -ForegroundColor Yellow
$duplicatePatterns = @(
    "*_copy*", 
    "*-copy*", 
    "*.copy", 
    "*.duplicate",
    "*~",
    "*.bak",
    "*.backup",
    "*.orig",
    "*.tmp",
    "*.temp"
)

$duplicateFiles = @()
foreach ($pattern in $duplicatePatterns) {
    $found = Get-ChildItem -Path $rootPath -Recurse -File -Name $pattern -ErrorAction SilentlyContinue
    $duplicateFiles += $found
}

if ($duplicateFiles.Count -gt 0) {
    Write-Host "Archivos duplicados/temporales encontrados:" -ForegroundColor Red
    $duplicateFiles | ForEach-Object { Write-Host "  - $_" -ForegroundColor Red }
    
    $confirm = Read-Host "¿Eliminar archivos duplicados/temporales? (y/N)"
    if ($confirm -eq "y" -or $confirm -eq "Y") {
        foreach ($file in $duplicateFiles) {
            $fullPath = Join-Path $rootPath $file
            if (Test-Path $fullPath) {
                Remove-Item $fullPath -Force
                Write-Host "  ✅ Eliminado: $file" -ForegroundColor Green
            }
        }
    }
} else {
    Write-Host "✅ No se encontraron archivos duplicados." -ForegroundColor Green
}

# 3. Verificar estado de Git
Write-Host "`n🔍 Verificando estado del repositorio..." -ForegroundColor Yellow
$gitStatus = git status --porcelain 2>$null
if ($gitStatus) {
    Write-Host "⚠️  Hay cambios pendientes en Git:" -ForegroundColor Yellow
    git status --short
} else {
    Write-Host "✅ El repositorio está limpio." -ForegroundColor Green
}

# 4. Verificar archivos no rastreados
Write-Host "`n📋 Verificando archivos no rastreados..." -ForegroundColor Yellow
$untrackedFiles = git ls-files --others --exclude-standard 2>$null
if ($untrackedFiles) {
    Write-Host "⚠️  Archivos no rastreados encontrados:" -ForegroundColor Yellow
    $untrackedFiles | ForEach-Object { Write-Host "  - $_" -ForegroundColor Yellow }
    
    $confirm = Read-Host "¿Agregar estos archivos al .gitignore? (y/N)"
    if ($confirm -eq "y" -or $confirm -eq "Y") {
        Write-Host "💡 Revisa manualmente qué archivos agregar al .gitignore" -ForegroundColor Cyan
    }
} else {
    Write-Host "✅ No hay archivos no rastreados." -ForegroundColor Green
}

Write-Host "`n🎉 Limpieza completada!" -ForegroundColor Green
Write-Host "💡 Recuerda hacer commit de los cambios al .gitignore si es necesario." -ForegroundColor Cyan
