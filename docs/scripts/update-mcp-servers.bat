@echo off
REM =========================================================
REM Actualizar MCP servers - Mantenimiento opcional
REM =========================================================

echo.
echo ====================================================
echo        ACTUALIZAR MCP SERVERS - OPCIONAL
echo ====================================================
echo.

echo [INFO] Verificando versiones actuales...

echo.
echo MCP Filesystem actual:
call npm list -g @modelcontextprotocol/server-filesystem 2>nul | findstr @modelcontextprotocol/server-filesystem || echo No instalado

echo.
echo GitHub MCP actual:  
call npm list -g @0xshariq/github-mcp-server 2>nul | findstr @0xshariq/github-mcp-server || echo No instalado

echo.
echo [INFO] ¿Actualizar MCP servers a ultima version?
echo        (Solo necesario si hay problemas o nuevas features)
echo.
set /p UPDATE_MCP="¿Actualizar? (s/n): "

if /i "%UPDATE_MCP%"=="s" goto :update_mcp
if /i "%UPDATE_MCP%"=="y" goto :update_mcp
goto :skip_update

:update_mcp
echo.
echo [INFO] Actualizando MCP servers...

echo Actualizando MCP Filesystem...
call npm update -g @modelcontextprotocol/server-filesystem
if %errorlevel% equ 0 (
    echo ✅ MCP Filesystem actualizado
) else (
    echo ⚠️  Error actualizando MCP Filesystem
)

echo.
echo Actualizando GitHub MCP...
call npm update -g @0xshariq/github-mcp-server
if %errorlevel% equ 0 (
    echo ✅ GitHub MCP actualizado
) else (
    echo ⚠️  Error actualizando GitHub MCP (normal si no esta instalado)
)

echo.
echo ✅ Actualizacion completada
echo 🔄 Reinicia Claude Desktop para aplicar cambios
goto :end

:skip_update
echo.
echo ✅ Actualizacion omitida
echo   Tu configuracion actual funciona perfectamente

:end
echo.
pause
