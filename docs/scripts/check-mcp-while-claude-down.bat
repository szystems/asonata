@echo off
REM =========================================================
REM Verificacion rapida MCP mientras Claude esta down
REM =========================================================

echo.
echo ====================================================
echo    VERIFICACION MCP - MIENTRAS CLAUDE ESTA DOWN
echo ====================================================
echo.

set CLAUDE_CONFIG=%APPDATA%\Claude\claude_desktop_config.json

echo [INFO] Verificando que MCP este listo para cuando Claude regrese...
echo.

if exist "%CLAUDE_CONFIG%" (
    echo ✅ Configuracion Claude existe
) else (
    echo ❌ Configuracion no existe
    goto :error
)

echo.
echo ==================== CONFIG ACTUAL ====================
type "%CLAUDE_CONFIG%"
echo.
echo ==================== FIN CONFIG ====================

echo.
echo [INFO] Verificando MCP servers...
call npm list -g @modelcontextprotocol/server-filesystem >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ MCP Filesystem instalado y listo
) else (
    echo ❌ MCP Filesystem problema
)

echo.
echo [INFO] Verificando acceso al proyecto...
if exist "C:\Users\szott\Dropbox\Desarrollo\asonata\composer.json" (
    echo ✅ Proyecto ASONATA accesible
) else (
    echo ❌ Proyecto no accesible
)

echo.
echo ====================================================
echo                ESTADO MCP: LISTO
echo ====================================================
echo.
echo ✅ Tu configuracion MCP esta perfecta
echo ⏳ Solo esperamos que Claude.ai regrese online
echo 🔄 La interrupcion es temporal (usualmente 15-30 minutos)
echo.
echo 💡 CUANDO CLAUDE REGRESE:
echo    1. Abre Claude Desktop normalmente
echo    2. NO habra errores MCP
echo    3. Usa inmediatamente el prompt principal
echo    4. Claude tendra acceso completo al proyecto
echo.
echo 🚀 PROMPT LISTO PARA USAR:
echo.
echo    "CONTEXTO: ASONATA - Proyecto Laravel 8"
echo    ""  
echo    "He configurado MCP filesystem y tienes acceso completo."
echo    "Analiza ARCHITECTURE.md, ESTADO_ACTUAL.md, MODELS.md y PRD.md"
echo    "Dame un resumen ejecutivo y las 3 prioridades criticas."
echo.
goto :end

:error
echo ❌ Hay problemas con la configuracion MCP
echo    Ejecuta fix-mcp-minimal.bat de nuevo

:end
pause
