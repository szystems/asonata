@echo off
REM =========================================================
REM Script para configurar GitHub Token - Claude MCP
REM =========================================================

echo.
echo ====================================================
echo       CONFIGURACION GITHUB TOKEN - CLAUDE MCP
echo ====================================================
echo.

set CLAUDE_CONFIG=%APPDATA%\Claude\claude_desktop_config.json

echo [INFO] Configuracion Claude Desktop: %CLAUDE_CONFIG%
echo.

if not exist "%CLAUDE_CONFIG%" (
    echo ❌ Error: Archivo de configuracion no encontrado
    echo    Ejecuta primero: install-mcp.bat
    pause
    exit /b 1
)

echo 📋 PASOS PARA CONFIGURAR GITHUB TOKEN:
echo.
echo 1. Ve a: https://github.com/settings/tokens
echo 2. Clic en "Generate new token (classic)"
echo 3. Nombre: "Claude MCP ASONATA"
echo 4. Expiracion: "No expiration" (o 1 año)
echo 5. Selecciona SOLO estos permisos:
echo    ✅ repo (Full control of private repositories)
echo    ✅ read:org (Read org and team membership)
echo 6. Clic en "Generate token"
echo 7. COPIA el token (solo se muestra una vez)
echo.

set /p GITHUB_TOKEN="Pega tu GitHub token aqui: "

if "%GITHUB_TOKEN%"=="" (
    echo ❌ Token vacio. Cancelando...
    pause
    exit /b 1
)

REM Crear backup
copy "%CLAUDE_CONFIG%" "%CLAUDE_CONFIG%.backup.%date:~-4,4%%date:~-10,2%%date:~-7,2%"

echo.
echo [INFO] Actualizando configuracion...

REM Usar PowerShell para reemplazar el token en el JSON
powershell -Command "(Get-Content '%CLAUDE_CONFIG%') -replace 'TU_TOKEN_AQUI', '%GITHUB_TOKEN%' | Set-Content '%CLAUDE_CONFIG%'"

if %errorlevel% equ 0 (
    echo ✅ Token configurado correctamente
) else (
    echo ❌ Error configurando token
    echo    Configura manualmente en: %CLAUDE_CONFIG%
    echo    Reemplaza: "TU_TOKEN_AQUI" con tu token
)

echo.
echo ====================================================
echo                TOKEN CONFIGURADO
echo ====================================================
echo.
echo ✅ Configuracion actualizada: %CLAUDE_CONFIG%
echo 📁 Backup creado: %CLAUDE_CONFIG%.backup.*
echo.
echo 🚀 SIGUIENTE PASO:
echo    1. Reinicia Claude Desktop completamente
echo    2. Abre Claude Desktop
echo    3. Prueba con este comando:
echo.
echo    "¿Puedes acceder a los archivos del proyecto ASONATA usando MCP?"
echo.
echo 💡 COMANDO DE PRUEBA COMPLETO:
echo    "Tengo configurado MCP para acceder al proyecto ASONATA en Laravel 8."
echo    "¿Puedes confirmar que tienes acceso a:"
echo    "1. Archivos del proyecto usando filesystem MCP?"
echo    "2. Repositorio GitHub szystems/asonata?"
echo    "3. Documentacion en ARCHITECTURE.md, MODELS.md, etc?"
echo.
pause
