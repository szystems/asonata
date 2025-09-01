@echo off
REM =========================================================
REM Script de instalación MCP para Claude Sonnet - ASONATA
REM =========================================================

echo.
echo ====================================================
echo   INSTALACION MCP PARA CLAUDE SONNET - ASONATA
echo ====================================================
echo.

REM Verificar prerrequisitos
echo [1/6] Verificando prerrequisitos...

where node >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Node.js no encontrado. Por favor instala Node.js primero.
    echo    Descarga desde: https://nodejs.org/
    pause
    exit /b 1
)

where python >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Python no encontrado. Por favor instala Python primero.
    echo    Descarga desde: https://python.org/
    pause
    exit /b 1
)

where git >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Git no encontrado. Por favor instala Git primero.
    echo    Descarga desde: https://git-scm.com/
    pause
    exit /b 1
)

echo ✅ Prerrequisitos verificados

REM Crear directorio para MCP servers
echo.
echo [2/6] Creando directorio MCP...
set MCP_DIR=%USERPROFILE%\mcp-servers
if not exist "%MCP_DIR%" mkdir "%MCP_DIR%"
echo ✅ Directorio MCP creado: %MCP_DIR%

REM Instalar MCP Filesystem
echo.
echo [3/6] Instalando MCP Filesystem...
call npm install -g @modelcontextprotocol/server-filesystem
if %errorlevel% neq 0 (
    echo ❌ Error instalando MCP Filesystem
    pause
    exit /b 1
)
echo ✅ MCP Filesystem instalado

REM Instalar GitHub MCP
echo.
echo [4/6] Instalando GitHub MCP...
call npm install -g @0xshariq/github-mcp-server
if %errorlevel% neq 0 (
    echo ⚠️  GitHub MCP no disponible, probando alternativa...
    cd /d "%MCP_DIR%"
    git clone https://github.com/modelcontextprotocol/servers.git
    cd servers\src\github
    call npm install
    call npm run build
    if %errorlevel% neq 0 (
        echo ❌ Error instalando GitHub MCP
    ) else (
        echo ✅ GitHub MCP instalado (desde fuente)
    )
) else (
    echo ✅ GitHub MCP instalado
)

REM Instalar Extended Memory MCP  
echo.
echo [5/6] Instalando Extended Memory MCP...
call npm install -g @ssmirnovpro/extended-memory-mcp
if %errorlevel% neq 0 (
    echo ⚠️  Extended Memory MCP no disponible
    echo    Continuando sin memory persistence...
) else (
    echo ✅ Extended Memory MCP instalado
)

REM Crear configuración Claude Desktop
echo.
echo [6/6] Configurando Claude Desktop...

set CLAUDE_CONFIG_DIR=%APPDATA%\Claude
set CLAUDE_CONFIG_FILE=%CLAUDE_CONFIG_DIR%\claude_desktop_config.json

if not exist "%CLAUDE_CONFIG_DIR%" mkdir "%CLAUDE_CONFIG_DIR%"

REM Crear backup si existe configuración previa
if exist "%CLAUDE_CONFIG_FILE%" (
    echo ⚠️  Configuración existente encontrada
    copy "%CLAUDE_CONFIG_FILE%" "%CLAUDE_CONFIG_FILE%.backup.%date:~-4,4%%date:~-10,2%%date:~-7,2%"
    echo ✅ Backup creado: %CLAUDE_CONFIG_FILE%.backup.%date:~-4,4%%date:~-10,2%%date:~-7,2%
)

REM Escribir nueva configuración
echo { > "%CLAUDE_CONFIG_FILE%"
echo   "mcpServers": { >> "%CLAUDE_CONFIG_FILE%"
echo     "filesystem_asonata": { >> "%CLAUDE_CONFIG_FILE%"
echo       "command": "npx", >> "%CLAUDE_CONFIG_FILE%"
echo       "args": [ >> "%CLAUDE_CONFIG_FILE%"
echo         "@modelcontextprotocol/server-filesystem", >> "%CLAUDE_CONFIG_FILE%"
echo         "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata" >> "%CLAUDE_CONFIG_FILE%"
echo       ], >> "%CLAUDE_CONFIG_FILE%"
echo       "env": { >> "%CLAUDE_CONFIG_FILE%"
echo         "FILESYSTEM_ROOT": "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata" >> "%CLAUDE_CONFIG_FILE%"
echo       } >> "%CLAUDE_CONFIG_FILE%"
echo     }, >> "%CLAUDE_CONFIG_FILE%"
echo     "github_integration": { >> "%CLAUDE_CONFIG_FILE%"
echo       "command": "npx", >> "%CLAUDE_CONFIG_FILE%"
echo       "args": ["@0xshariq/github-mcp-server"], >> "%CLAUDE_CONFIG_FILE%"
echo       "env": { >> "%CLAUDE_CONFIG_FILE%"
echo         "GITHUB_PERSONAL_ACCESS_TOKEN": "TU_TOKEN_AQUI", >> "%CLAUDE_CONFIG_FILE%"
echo         "GITHUB_REPO_OWNER": "szystems", >> "%CLAUDE_CONFIG_FILE%"
echo         "GITHUB_REPO_NAME": "asonata" >> "%CLAUDE_CONFIG_FILE%"
echo       } >> "%CLAUDE_CONFIG_FILE%"
echo     }, >> "%CLAUDE_CONFIG_FILE%"
echo     "extended_memory": { >> "%CLAUDE_CONFIG_FILE%"
echo       "command": "npx", >> "%CLAUDE_CONFIG_FILE%"
echo       "args": ["@ssmirnovpro/extended-memory-mcp"], >> "%CLAUDE_CONFIG_FILE%"
echo       "env": { >> "%CLAUDE_CONFIG_FILE%"
echo         "PROJECT_NAME": "ASONATA", >> "%CLAUDE_CONFIG_FILE%"
echo         "MEMORY_DB_PATH": "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata\\ai_memory.db" >> "%CLAUDE_CONFIG_FILE%"
echo       } >> "%CLAUDE_CONFIG_FILE%"
echo     } >> "%CLAUDE_CONFIG_FILE%"
echo   } >> "%CLAUDE_CONFIG_FILE%"
echo } >> "%CLAUDE_CONFIG_FILE%"

echo ✅ Configuración Claude Desktop creada

REM Instrucciones finales
echo.
echo ====================================================
echo                INSTALACION COMPLETADA
echo ====================================================
echo.
echo ✅ MCP Servers instalados correctamente
echo ✅ Configuración Claude Desktop creada
echo.
echo 📋 PASOS SIGUIENTES:
echo.
echo 1. Configurar GitHub Token:
echo    - Ve a: https://github.com/settings/tokens
echo    - Genera nuevo token con permisos 'repo'
echo    - Reemplaza "TU_TOKEN_AQUI" en:
echo      %CLAUDE_CONFIG_FILE%
echo.
echo 2. Reiniciar Claude Desktop para cargar configuración
echo.
echo 3. Verificar funcionamiento:
echo    - Abre Claude Desktop
echo    - Escribe: "¿Puedes acceder a los archivos del proyecto ASONATA?"
echo.
echo 📁 Archivos de configuración:
echo    - Config: %CLAUDE_CONFIG_FILE%
echo    - MCP Dir: %MCP_DIR%
echo    - Backup: %CLAUDE_CONFIG_FILE%.backup.*
echo.
echo 🚀 ¡Ya puedes usar Claude con acceso completo al proyecto!
echo.
pause
