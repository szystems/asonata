@echo off
REM =========================================================
REM Backup rapido configuracion MCP - Claude Desktop
REM =========================================================

echo.
echo ====================================================
echo         BACKUP CONFIGURACION MCP CLAUDE
echo ====================================================
echo.

set CLAUDE_CONFIG=%APPDATA%\Claude\claude_desktop_config.json
set BACKUP_DIR=C:\Users\szott\Dropbox\Desarrollo\asonata\mcp-backups
set BACKUP_FILE=%BACKUP_DIR%\claude_config_%date:~-4,4%%date:~-10,2%%date:~-7,2%_%time:~0,2%%time:~3,2%.json

REM Crear directorio de backup
if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

if exist "%CLAUDE_CONFIG%" (
    copy "%CLAUDE_CONFIG%" "%BACKUP_FILE%"
    echo ✅ Backup creado: %BACKUP_FILE%
) else (
    echo ❌ Config no encontrado: %CLAUDE_CONFIG%
)

echo.
echo 💡 Para restaurar: copy "%BACKUP_FILE%" "%CLAUDE_CONFIG%"
pause
