@echo off
REM =========================================================
REM Diagnostico MCP - Claude Desktop
REM =========================================================

echo.
echo ====================================================
echo           DIAGNOSTICO MCP - CLAUDE DESKTOP  
echo ====================================================
echo.

set CLAUDE_CONFIG=%APPDATA%\Claude\claude_desktop_config.json

echo [INFO] Verificando configuracion: %CLAUDE_CONFIG%
echo.

if not exist "%CLAUDE_CONFIG%" (
    echo ❌ PROBLEMA: Archivo config no existe
    echo    Ubicacion esperada: %CLAUDE_CONFIG%
    goto :crear_config
)

echo ✅ Archivo de configuracion existe
echo.

echo [INFO] Verificando contenido...
echo.
echo ==================== CONTENIDO ACTUAL ====================
type "%CLAUDE_CONFIG%"
echo.
echo ==================== FIN CONTENIDO ====================
echo.

REM Verificar que no tenga "TU_TOKEN_AQUI"
findstr /C:"TU_TOKEN_AQUI" "%CLAUDE_CONFIG%" >nul
if %errorlevel% equ 0 (
    echo ❌ PROBLEMA: Token no configurado (todavia dice TU_TOKEN_AQUI)
    goto :fix_token
) else (
    echo ✅ GitHub token configurado
)

REM Verificar JSON basico
echo [INFO] Verificando sintaxis JSON...
powershell -Command "try { Get-Content '%CLAUDE_CONFIG%' | ConvertFrom-Json | Out-Null; Write-Host '✅ JSON sintacticamente correcto' } catch { Write-Host '❌ JSON con errores de sintaxis' }"

echo.
echo [INFO] Verificando procesos Claude...
tasklist | findstr /I "Claude" >nul
if %errorlevel% equ 0 (
    echo ⚠️  Claude Desktop esta ejecutandose
    echo    SOLUCION: Cierra Claude Desktop COMPLETAMENTE y abrelo de nuevo
) else (
    echo ✅ Claude Desktop no esta ejecutandose
)

echo.
echo [INFO] Verificando MCP servers globales...
call npm list -g @modelcontextprotocol/server-filesystem >nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ MCP Filesystem instalado
) else (
    echo ❌ MCP Filesystem NO instalado
)

goto :end

:crear_config
echo.
echo 🔧 CREANDO CONFIGURACION FALTANTE...
if not exist "%APPDATA%\Claude" mkdir "%APPDATA%\Claude"

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

echo ✅ Configuracion basica creada
echo ⚠️  PENDIENTE: Configurar GitHub token
goto :end

:fix_token
echo.
echo 🔧 SOLUCIONANDO TOKEN...
set /p GITHUB_TOKEN="Pega tu GitHub token (ghp_XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX): "
if not "%GITHUB_TOKEN%"=="" (
    powershell -Command "(Get-Content '%CLAUDE_CONFIG%') -replace 'TU_TOKEN_AQUI', '%GITHUB_TOKEN%' | Set-Content '%CLAUDE_CONFIG%'"
    echo ✅ Token actualizado
)

:end
echo.
echo ====================================================
echo                 DIAGNOSTICO COMPLETO
echo ====================================================
echo.
echo 💡 PASOS PARA SOLUCION:
echo.
echo 1. CERRAR Claude Desktop completamente:
echo    - Clic derecho en el icono de la barra de tareas
echo    - "Quit Claude" o usar Ctrl+Q
echo    - Verificar que NO aparezca en el Administrador de tareas
echo.
echo 2. ABRIR Claude Desktop nuevamente
echo.
echo 3. VERIFICAR en Claude que aparezcan los iconos MCP:
echo    - Deberia ver iconos de herramientas en la interfaz
echo    - O mencionar "MCP servers available" al iniciar
echo.
echo 4. PROBAR con este prompt exacto:
echo    "Listame los archivos en la raiz del proyecto usando MCP filesystem"
echo.
echo 📋 Si sigue sin funcionar:
echo    - El problema puede ser la version de Claude Desktop
echo    - Verificar que sea Claude Desktop (no web)
echo    - Actualizar Claude Desktop a la ultima version
echo.
pause
