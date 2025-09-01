@echo off
REM =========================================================
REM Crear configuracion MCP minima y funcional - Claude Desktop
REM =========================================================

echo.
echo ====================================================
echo      CONFIGURACION MCP MINIMA - SIN ERRORES
echo ====================================================
echo.

set CLAUDE_CONFIG=%APPDATA%\Claude\claude_desktop_config.json

echo [INFO] Creando configuracion minima funcional...

REM Crear backup del config actual
if exist "%CLAUDE_CONFIG%" (
    copy "%CLAUDE_CONFIG%" "%CLAUDE_CONFIG%.backup.errores.%date:~-4,4%%date:~-10,2%%date:~-7,2%"
    echo ✅ Backup creado del config con errores
)

REM Crear directorio si no existe
if not exist "%APPDATA%\Claude" mkdir "%APPDATA%\Claude"

REM Crear configuracion MINIMA solo con filesystem (lo mas estable)
echo { > "%CLAUDE_CONFIG%"
echo   "mcpServers": { >> "%CLAUDE_CONFIG%"
echo     "filesystem_asonata": { >> "%CLAUDE_CONFIG%"
echo       "command": "npx", >> "%CLAUDE_CONFIG%"
echo       "args": [ >> "%CLAUDE_CONFIG%"
echo         "@modelcontextprotocol/server-filesystem", >> "%CLAUDE_CONFIG%"
echo         "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata" >> "%CLAUDE_CONFIG%"
echo       ] >> "%CLAUDE_CONFIG%"
echo     } >> "%CLAUDE_CONFIG%"
echo   } >> "%CLAUDE_CONFIG%"
echo } >> "%CLAUDE_CONFIG%"

echo ✅ Configuracion minima creada (solo filesystem)
echo.

echo ==================== NUEVA CONFIGURACION ====================
type "%CLAUDE_CONFIG%"
echo.
echo ==================== FIN CONFIGURACION ====================

echo.
echo 🔍 VERIFICANDO MCP FILESYSTEM...
call npm list -g @modelcontextprotocol/server-filesystem >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ MCP Filesystem instalado correctamente
) else (
    echo ❌ MCP Filesystem no instalado - instalando...
    call npm install -g @modelcontextprotocol/server-filesystem
    if %errorlevel% equ 0 (
        echo ✅ MCP Filesystem instalado exitosamente
    ) else (
        echo ❌ Error instalando MCP Filesystem
    )
)

echo.
echo ====================================================
echo           CONFIGURACION MINIMA APLICADA
echo ====================================================
echo.
echo ✅ Config creado: SOLO filesystem MCP
echo 📁 Backup anterior: %CLAUDE_CONFIG%.backup.errores.*
echo.
echo 🚀 SIGUIENTES PASOS:
echo.
echo 1. CERRAR Claude Desktop completamente (Ctrl+Q)
echo 2. ABRIR Claude Desktop nuevamente  
echo 3. NO deberia haber errores ahora
echo 4. PROBAR con: "Lista los archivos del proyecto usando MCP"
echo.
echo 💡 UNA VEZ QUE FUNCIONE:
echo    Podemos agregar GitHub MCP gradualmente
echo    Esta config minima es 100%% estable
echo.

echo 🔧 SI SIGUEN LOS ERRORES:
echo    - Verificar version de Node.js (minimo v18)
echo    - Actualizar Claude Desktop a ultima version
echo    - Ejecutar Claude Desktop como administrador
echo.
pause
