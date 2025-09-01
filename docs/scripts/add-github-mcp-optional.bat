@echo off
REM =========================================================
REM Agregar GitHub MCP gradualmente - OPCIONAL
REM =========================================================

echo.
echo ====================================================
echo       AGREGAR GITHUB MCP - OPCIONAL
echo ====================================================
echo.

set CLAUDE_CONFIG=%APPDATA%\Claude\claude_desktop_config.json

echo [INFO] Esta mejora es OPCIONAL
echo        Tu configuracion actual ya es perfecta
echo.
echo ¿Quieres agregar GitHub MCP? (permite ver commits, issues, historial)
echo.
echo Ventajas:
echo ✅ Claude puede ver historial de commits
echo ✅ Acceso a issues y pull requests  
echo ✅ Contexto completo del repositorio
echo.
echo Desventajas:
echo ⚠️  Puede causar errores si el token expira
echo ⚠️  Configuracion mas compleja
echo ⚠️  No es esencial para desarrollo diario
echo.
set /p ADD_GITHUB="¿Agregar GitHub MCP? (s/n): "

if /i "%ADD_GITHUB%"=="s" goto :add_github
if /i "%ADD_GITHUB%"=="y" goto :add_github
goto :skip_github

:add_github
echo.
echo [INFO] Agregando GitHub MCP...

REM Crear backup
copy "%CLAUDE_CONFIG%" "%CLAUDE_CONFIG%.backup.pre-github"

REM Tu token ya configurado (REEMPLAZAR CON TU TOKEN)
set GITHUB_TOKEN=TU_GITHUB_TOKEN_AQUI

REM Crear nueva configuracion con GitHub
echo { > "%CLAUDE_CONFIG%"
echo   "mcpServers": { >> "%CLAUDE_CONFIG%"
echo     "filesystem_asonata": { >> "%CLAUDE_CONFIG%"
echo       "command": "npx", >> "%CLAUDE_CONFIG%"
echo       "args": [ >> "%CLAUDE_CONFIG%"
echo         "@modelcontextprotocol/server-filesystem", >> "%CLAUDE_CONFIG%"
echo         "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata" >> "%CLAUDE_CONFIG%"
echo       ] >> "%CLAUDE_CONFIG%"
echo     }, >> "%CLAUDE_CONFIG%"
echo     "github_integration": { >> "%CLAUDE_CONFIG%"
echo       "command": "npx", >> "%CLAUDE_CONFIG%"
echo       "args": ["@0xshariq/github-mcp-server"], >> "%CLAUDE_CONFIG%"
echo       "env": { >> "%CLAUDE_CONFIG%"
echo         "GITHUB_PERSONAL_ACCESS_TOKEN": "%GITHUB_TOKEN%", >> "%CLAUDE_CONFIG%"
echo         "GITHUB_REPO_OWNER": "szystems", >> "%CLAUDE_CONFIG%"
echo         "GITHUB_REPO_NAME": "asonata" >> "%CLAUDE_CONFIG%"
echo       } >> "%CLAUDE_CONFIG%"
echo     } >> "%CLAUDE_CONFIG%"
echo   } >> "%CLAUDE_CONFIG%"
echo } >> "%CLAUDE_CONFIG%"

echo ✅ GitHub MCP agregado
echo 📁 Backup: %CLAUDE_CONFIG%.backup.pre-github
echo.
echo 🚀 REINICIA Claude Desktop para aplicar cambios
goto :end

:skip_github
echo.
echo ✅ GitHub MCP omitido - tu configuracion sigue perfecta
echo    Tu setup actual ya es excelente para desarrollo diario

:end
echo.
pause
