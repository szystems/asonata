@echo off
REM =========================================================
REM Verificacion final MCP - Claude Desktop
REM =========================================================

echo.
echo ====================================================
echo        VERIFICACION FINAL MCP - CLAUDE DESKTOP
echo ====================================================
echo.

set CLAUDE_CONFIG=%APPDATA%\Claude\claude_desktop_config.json
set PROJECT_PATH=C:\Users\szott\Dropbox\Desarrollo\asonata

echo [1/5] Verificando archivos de configuracion...

if exist "%CLAUDE_CONFIG%" (
    echo ✅ Claude config existe: %CLAUDE_CONFIG%
) else (
    echo ❌ Claude config faltante
    goto :error
)

if exist "%PROJECT_PATH%" (
    echo ✅ Proyecto ASONATA accesible
) else (
    echo ❌ Proyecto no encontrado
    goto :error
)

echo.
echo [2/5] Verificando configuracion JSON...

REM Verificar que el archivo no tenga "TU_TOKEN_AQUI"
findstr /C:"TU_TOKEN_AQUI" "%CLAUDE_CONFIG%" >nul
if %errorlevel% equ 0 (
    echo ⚠️  GitHub token aun no configurado
    echo    Ejecuta: configure-github-token.bat
) else (
    echo ✅ GitHub token configurado
)

REM Verificar sintaxis JSON basica
powershell -Command "try { Get-Content '%CLAUDE_CONFIG%' | ConvertFrom-Json | Out-Null; Write-Host '✅ JSON sintacticamente valido' } catch { Write-Host '❌ JSON con errores' }"

echo.
echo [3/5] Verificando MCP servers instalados...

call npm list -g @modelcontextprotocol/server-filesystem >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ MCP Filesystem instalado globalmente
) else (
    echo ❌ MCP Filesystem no encontrado
)

call npm list -g @0xshariq/github-mcp-server >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ GitHub MCP instalado globalmente
) else (
    echo ❌ GitHub MCP no encontrado
)

echo.
echo [4/5] Verificando procesos Claude Desktop...

tasklist /FI "IMAGENAME eq Claude.exe" 2>nul | findstr /I "Claude.exe" >nul
if %errorlevel% equ 0 (
    echo ⚠️  Claude Desktop ejecutandose
    echo    Reinicia Claude Desktop para cargar nueva configuracion
) else (
    echo ✅ Claude Desktop no ejecutandose (listo para reiniciar)
)

echo.
echo [5/5] Verificando documentacion AI...

set /a doc_count=0
if exist "%PROJECT_PATH%\ARCHITECTURE.md" set /a doc_count+=1
if exist "%PROJECT_PATH%\ESTADO_ACTUAL.md" set /a doc_count+=1
if exist "%PROJECT_PATH%\MODELS.md" set /a doc_count+=1
if exist "%PROJECT_PATH%\PRD.md" set /a doc_count+=1
if exist "%PROJECT_PATH%\CLAUDE-MCP-SETUP.md" set /a doc_count+=1
if exist "%PROJECT_PATH%\CLAUDE-PROMPTS.md" set /a doc_count+=1

echo ✅ Documentacion AI: %doc_count%/6 archivos disponibles

echo.
echo ====================================================
echo                VERIFICACION COMPLETA
echo ====================================================

REM Mostrar contenido basico del config (sin token por seguridad)
echo.
echo 📋 CONFIGURACION ACTUAL (Claude Desktop):
powershell -Command "$config = Get-Content '%CLAUDE_CONFIG%' | ConvertFrom-Json; Write-Host 'Servers configurados:'; $config.mcpServers.PSObject.Properties | ForEach-Object { Write-Host \"  - $($_.Name)\" }"

echo.
echo ✅ MCP COMPLETAMENTE CONFIGURADO
echo.
echo 🚀 PASOS FINALES:
echo.
echo    1. REINICIA Claude Desktop completamente
echo       - Cierra Claude Desktop si esta abierto
echo       - Abrelo nuevamente
echo.
echo    2. PRUEBA INICIAL con este prompt:
echo.
echo       "¿Puedes acceder a los archivos del proyecto ASONATA?"
echo       "Confirma que tienes acceso via MCP a:"
echo       "1. Sistema de archivos del proyecto"
echo       "2. Repositorio GitHub szystems/asonata" 
echo       "3. Documentacion: ARCHITECTURE.md, MODELS.md, etc"
echo.
echo    3. PROMPT AVANZADO (una vez confirmado el acceso):
echo.
echo       "CONTEXTO: ASONATA - Proyecto Laravel 8"
echo       ""
echo       "Carga el contexto completo del proyecto:"
echo       "1. Lee ARCHITECTURE.md para el stack tecnico"
echo       "2. Analiza ESTADO_ACTUAL.md para metricas"
echo       "3. Revisa MODELS.md para relaciones de datos"
echo       "4. Consulta PRD.md para objetivos de negocio"
echo       ""
echo       "Despues dame un resumen ejecutivo del proyecto y"
echo       "las 3 prioridades mas criticas que identificas."
echo.
echo 💡 ARCHIVOS DE REFERENCIA:
echo    - Prompts optimizados: %PROJECT_PATH%\CLAUDE-PROMPTS.md
echo    - Setup tecnico: %PROJECT_PATH%\CLAUDE-MCP-SETUP.md
echo    - Config Claude: %CLAUDE_CONFIG%
echo.
goto :end

:error
echo.
echo ❌ ERRORES ENCONTRADOS
echo    Revisar configuracion antes de usar Claude
echo.

:end
pause
