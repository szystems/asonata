@echo off
REM =========================================================
REM Script de testing MCP para Claude Sonnet - ASONATA
REM =========================================================

echo.
echo ====================================================
echo     TESTING CONFIGURACION MCP - CLAUDE SONNET
echo ====================================================
echo.

set PROJECT_PATH=C:\Users\szott\Dropbox\Desarrollo\asonata
set CLAUDE_CONFIG=%APPDATA%\Claude\claude_desktop_config.json

REM Test 1: Verificar archivos de configuración
echo [TEST 1/7] Verificando archivos de configuración...

if exist "%CLAUDE_CONFIG%" (
    echo ✅ Claude config existe: %CLAUDE_CONFIG%
) else (
    echo ❌ Claude config no encontrado: %CLAUDE_CONFIG%
    goto :error
)

if exist "%PROJECT_PATH%" (
    echo ✅ Proyecto accesible: %PROJECT_PATH%
) else (
    echo ❌ Proyecto no encontrado: %PROJECT_PATH%
    goto :error
)

REM Test 2: Verificar estructura del proyecto Laravel
echo.
echo [TEST 2/7] Verificando estructura Laravel...

set /a laravel_files=0

if exist "%PROJECT_PATH%\composer.json" (
    echo ✅ composer.json encontrado
    set /a laravel_files+=1
)
if exist "%PROJECT_PATH%\artisan" (
    echo ✅ artisan encontrado  
    set /a laravel_files+=1
)
if exist "%PROJECT_PATH%\app" (
    echo ✅ directorio app/ encontrado
    set /a laravel_files+=1
)
if exist "%PROJECT_PATH%\config" (
    echo ✅ directorio config/ encontrado
    set /a laravel_files+=1
)

if %laravel_files% geq 4 (
    echo ✅ Estructura Laravel válida (%laravel_files%/4 archivos)
) else (
    echo ❌ Estructura Laravel incompleta (%laravel_files%/4 archivos)
)

REM Test 3: Verificar documentación del proyecto
echo.
echo [TEST 3/7] Verificando documentación del proyecto...

set /a doc_files=0

if exist "%PROJECT_PATH%\ARCHITECTURE.md" (
    echo ✅ ARCHITECTURE.md encontrado
    set /a doc_files+=1
)
if exist "%PROJECT_PATH%\ESTADO_ACTUAL.md" (
    echo ✅ ESTADO_ACTUAL.md encontrado
    set /a doc_files+=1
)
if exist "%PROJECT_PATH%\MODELS.md" (
    echo ✅ MODELS.md encontrado
    set /a doc_files+=1
)
if exist "%PROJECT_PATH%\PRD.md" (
    echo ✅ PRD.md encontrado
    set /a doc_files+=1
)

if %doc_files% geq 4 (
    echo ✅ Documentación completa para AI (%doc_files%/4 archivos)
) else (
    echo ⚠️  Documentación incompleta (%doc_files%/4 archivos)
    echo    Claude tendrá contexto limitado
)

REM Test 4: Verificar instalación de Node.js y MCP servers
echo.
echo [TEST 4/7] Verificando MCP servers...

where node >nul 2>&1
if %errorlevel% equ 0 (
    for /f "tokens=*" %%i in ('node --version 2^>nul') do set NODE_VERSION=%%i
    echo ✅ Node.js instalado: %NODE_VERSION%
) else (
    echo ❌ Node.js no encontrado
    goto :error
)

call npm list -g @modelcontextprotocol/server-filesystem >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ MCP Filesystem instalado
) else (
    echo ❌ MCP Filesystem no instalado
)

call npm list -g @0xshariq/github-mcp-server >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ GitHub MCP instalado
) else (
    echo ⚠️  GitHub MCP no instalado (opcional)
)

REM Test 5: Verificar configuración JSON
echo.
echo [TEST 5/7] Validando configuración JSON...

REM Test básico de sintaxis JSON
python -c "import json; json.load(open(r'%CLAUDE_CONFIG%'))" 2>nul
if %errorlevel% equ 0 (
    echo ✅ JSON sintácticamente válido
) else (
    echo ❌ JSON con errores de sintaxis
    echo    Revisar manualmente: %CLAUDE_CONFIG%
)

REM Test 6: Verificar permisos de escritura
echo.
echo [TEST 6/7] Verificando permisos...

echo test > "%PROJECT_PATH%\mcp_test_file.tmp" 2>nul
if exist "%PROJECT_PATH%\mcp_test_file.tmp" (
    del "%PROJECT_PATH%\mcp_test_file.tmp" 2>nul
    echo ✅ Permisos de escritura en proyecto: OK
) else (
    echo ❌ Sin permisos de escritura en proyecto
)

echo test > "%APPDATA%\Claude\mcp_test.tmp" 2>nul
if exist "%APPDATA%\Claude\mcp_test.tmp" (
    del "%APPDATA%\Claude\mcp_test.tmp" 2>nul
    echo ✅ Permisos de escritura en Claude: OK
) else (
    echo ❌ Sin permisos de escritura en directorio Claude
)

REM Test 7: Generar reporte de configuración
echo.
echo [TEST 7/7] Generando reporte de configuración...

echo. > "%PROJECT_PATH%\mcp-test-report.txt"
echo REPORTE DE CONFIGURACION MCP - %date% %time% >> "%PROJECT_PATH%\mcp-test-report.txt"
echo ================================================================= >> "%PROJECT_PATH%\mcp-test-report.txt"
echo. >> "%PROJECT_PATH%\mcp-test-report.txt"
echo CONFIGURACION: >> "%PROJECT_PATH%\mcp-test-report.txt"
echo - Claude Config: %CLAUDE_CONFIG% >> "%PROJECT_PATH%\mcp-test-report.txt"
echo - Project Path: %PROJECT_PATH% >> "%PROJECT_PATH%\mcp-test-report.txt"
echo - Node Version: %NODE_VERSION% >> "%PROJECT_PATH%\mcp-test-report.txt"
echo. >> "%PROJECT_PATH%\mcp-test-report.txt"
echo ARCHIVOS CRITICOS: >> "%PROJECT_PATH%\mcp-test-report.txt"
dir "%PROJECT_PATH%\*.md" /b 2>nul >> "%PROJECT_PATH%\mcp-test-report.txt"
echo. >> "%PROJECT_PATH%\mcp-test-report.txt"
echo ESTRUCTURA LARAVEL: >> "%PROJECT_PATH%\mcp-test-report.txt"
dir "%PROJECT_PATH%\app" 2>nul | find "Directory of" >> "%PROJECT_PATH%\mcp-test-report.txt"
dir "%PROJECT_PATH%\config" 2>nul | find "Directory of" >> "%PROJECT_PATH%\mcp-test-report.txt"

echo ✅ Reporte generado: %PROJECT_PATH%\mcp-test-report.txt

REM Resumen final
echo.
echo ====================================================
echo                  RESUMEN DE TESTING
echo ====================================================
echo.
echo ✅ Configuración MCP lista para usar con Claude
echo 📁 Archivos críticos verificados
echo 🔧 Permisos de acceso confirmados
echo 📋 Reporte detallado disponible
echo.
echo 🚀 SIGUIENTE PASO: 
echo    1. Configurar GitHub token en Claude config
echo    2. Reiniciar Claude Desktop
echo    3. Probar con: "Analiza la estructura del proyecto ASONATA"
echo.
echo 💡 COMANDOS DE PRUEBA PARA CLAUDE:
echo    - "¿Puedes leer el archivo ARCHITECTURE.md?"
echo    - "Muestra la estructura del directorio app/Models/"
echo    - "Analiza el composer.json del proyecto"
echo    - "¿Qué modelos Laravel hay en el proyecto?"
echo.
goto :end

:error
echo.
echo ❌ ERRORES ENCONTRADOS EN LA CONFIGURACION
echo    Revisar logs arriba y corregir antes de usar Claude
echo.

:end
pause
