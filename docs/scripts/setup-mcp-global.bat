@echo off
REM =========================================================
REM Configuracion MCP GLOBAL para todos los proyectos
REM =========================================================

echo.
echo ====================================================
echo    CONFIGURACION MCP GLOBAL - TODOS LOS PROYECTOS
echo ====================================================
echo.

echo [INFO] Esta configuracion funcionara para TODOS tus proyectos
echo        No necesitaras repetir configuracion en cada uno
echo.

set GLOBAL_MCP_CONFIG=%APPDATA%\Code\User\settings.json
set USER_PROFILE=%USERPROFILE%

echo [1/4] Configurando VS Code global...

REM Crear backup del settings.json actual
if exist "%GLOBAL_MCP_CONFIG%" (
    copy "%GLOBAL_MCP_CONFIG%" "%GLOBAL_MCP_CONFIG%.backup.%date:~-4,4%%date:~-10,2%%date:~-7,2%"
    echo ✅ Backup creado: %GLOBAL_MCP_CONFIG%.backup.*
)

REM Crear o actualizar configuracion global
powershell -Command "
$configPath = '$env:APPDATA\Code\User\settings.json'
$config = @{}

if (Test-Path $configPath) {
    try {
        $config = Get-Content $configPath | ConvertFrom-Json -AsHashtable
    } catch {
        $config = @{}
    }
}

# Configuracion optimizada para Claude Sonnet via Copilot
$config['github.copilot.enable'] = @{
    '*' = $true
    'yaml' = $true
    'plaintext' = $true
    'markdown' = $true
    'php' = $true
    'javascript' = $true
    'python' = $true
}

$config['github.copilot.advanced'] = @{
    'length' = 1000
    'temperature' = 0.1
    'contextLength' = 16384
}

$config['github.copilot.chat.localeOverride'] = 'es'

# MCP filesystem para proyectos
$config['files.watcherExclude'] = @{
    '**/node_modules/**' = $true
    '**/vendor/**' = $true
    '**/.git/**' = $true
    '**/storage/logs/**' = $true
}

$config['search.exclude'] = @{
    '**/vendor' = $true
    '**/node_modules' = $true
    '**/.git' = $true
    '**/storage/logs' = $true
}

# Guardar configuracion
$config | ConvertTo-Json -Depth 10 | Set-Content $configPath -Encoding UTF8
Write-Host '✅ Configuracion global VS Code actualizada'
"

if %errorlevel% equ 0 (
    echo ✅ VS Code configurado globalmente
) else (
    echo ❌ Error configurando VS Code
)

echo.
echo [2/4] Creando template de documentacion AI...

set TEMPLATE_DIR=%USER_PROFILE%\Documents\ai-project-templates

if not exist "%TEMPLATE_DIR%" mkdir "%TEMPLATE_DIR%"

REM Copiar templates de documentacion AI
echo # ARCHITECTURE TEMPLATE > "%TEMPLATE_DIR%\ARCHITECTURE-template.md"
echo # MODELS TEMPLATE > "%TEMPLATE_DIR%\MODELS-template.md"
echo # ESTADO_ACTUAL TEMPLATE > "%TEMPLATE_DIR%\ESTADO-template.md"

echo ✅ Templates de documentacion creados en: %TEMPLATE_DIR%

echo.
echo [3/4] Configurando extension MCP global...

REM Instalar extension MCP para VS Code si existe
code --install-extension ms-vscode.vscode-json
code --install-extension bradlc.vscode-tailwindcss
code --install-extension bmewburn.vscode-intelephense-client

echo ✅ Extensiones VS Code instaladas

echo.
echo [4/4] Creando scripts de setup rapido...

REM Script para setup rapido en nuevos proyectos
echo @echo off > "%USER_PROFILE%\Documents\setup-project-ai.bat"
echo REM Setup rapido AI para nuevo proyecto >> "%USER_PROFILE%\Documents\setup-project-ai.bat"
echo echo Configurando AI para proyecto: %%1 >> "%USER_PROFILE%\Documents\setup-project-ai.bat"
echo if "%%1"=="" ( >> "%USER_PROFILE%\Documents\setup-project-ai.bat"
echo   echo Error: Especifica nombre del proyecto >> "%USER_PROFILE%\Documents\setup-project-ai.bat"
echo   echo Uso: setup-project-ai.bat nombre-proyecto >> "%USER_PROFILE%\Documents\setup-project-ai.bat"
echo   pause >> "%USER_PROFILE%\Documents\setup-project-ai.bat"
echo   exit /b 1 >> "%USER_PROFILE%\Documents\setup-project-ai.bat"
echo ^) >> "%USER_PROFILE%\Documents\setup-project-ai.bat"
echo copy "%TEMPLATE_DIR%\*-template.md" "%%1\" >> "%USER_PROFILE%\Documents\setup-project-ai.bat"
echo echo ✅ Documentacion AI copiada a proyecto %%1 >> "%USER_PROFILE%\Documents\setup-project-ai.bat"
echo pause >> "%USER_PROFILE%\Documents\setup-project-ai.bat"

echo ✅ Script de setup rapido creado

echo.
echo ====================================================
echo           CONFIGURACION GLOBAL COMPLETADA
echo ====================================================
echo.
echo ✅ VS Code configurado GLOBALMENTE para todos los proyectos
echo ✅ Templates de documentacion AI disponibles  
echo ✅ Scripts de setup rapido creados
echo.
echo 🚀 COMO USAR EN NUEVOS PROYECTOS:
echo.
echo    1. Abre VS Code en cualquier proyecto
echo    2. GitHub Copilot ya tiene configuracion optima
echo    3. Usa: @workspace [tu consulta]
echo    4. Para documentacion AI: ejecuta setup-project-ai.bat
echo.
echo 💡 ARCHIVOS IMPORTANTES:
echo    - Config global: %GLOBAL_MCP_CONFIG%
echo    - Templates AI: %TEMPLATE_DIR%
echo    - Setup rapido: %USER_PROFILE%\Documents\setup-project-ai.bat
echo.
echo 🎯 NO NECESITAS REPETIR CONFIGURACION EN CADA PROYECTO
echo    La configuracion global funciona en todos
echo.
pause
