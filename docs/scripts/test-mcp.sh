#!/bin/bash
# =========================================================
# Script de testing MCP para Claude Sonnet - ASONATA (bash)
# =========================================================

echo
echo "===================================================="
echo "     TESTING CONFIGURACION MCP - CLAUDE SONNET"
echo "===================================================="
echo

PROJECT_PATH="/c/Users/szott/Dropbox/Desarrollo/asonata"
CLAUDE_CONFIG_WIN="%APPDATA%\\Claude\\claude_desktop_config.json"
CLAUDE_CONFIG="/c/Users/szott/AppData/Roaming/Claude/claude_desktop_config.json"

# Test 1: Verificar archivos de configuración
echo "[TEST 1/7] Verificando archivos de configuración..."

if [ -f "$CLAUDE_CONFIG" ]; then
    echo "✅ Claude config existe: $CLAUDE_CONFIG"
else
    echo "❌ Claude config no encontrado: $CLAUDE_CONFIG"
    echo "   (Se creará durante instalación MCP)"
fi

if [ -d "$PROJECT_PATH" ]; then
    echo "✅ Proyecto accesible: $PROJECT_PATH"
else
    echo "❌ Proyecto no encontrado: $PROJECT_PATH"
    exit 1
fi

# Test 2: Verificar estructura del proyecto Laravel
echo
echo "[TEST 2/7] Verificando estructura Laravel..."

laravel_files=0

if [ -f "$PROJECT_PATH/composer.json" ]; then
    echo "✅ composer.json encontrado"
    ((laravel_files++))
fi

if [ -f "$PROJECT_PATH/artisan" ]; then
    echo "✅ artisan encontrado"  
    ((laravel_files++))
fi

if [ -d "$PROJECT_PATH/app" ]; then
    echo "✅ directorio app/ encontrado"
    ((laravel_files++))
fi

if [ -d "$PROJECT_PATH/config" ]; then
    echo "✅ directorio config/ encontrado"
    ((laravel_files++))
fi

if [ $laravel_files -ge 4 ]; then
    echo "✅ Estructura Laravel válida ($laravel_files/4 archivos)"
else
    echo "❌ Estructura Laravel incompleta ($laravel_files/4 archivos)"
fi

# Test 3: Verificar documentación del proyecto
echo
echo "[TEST 3/7] Verificando documentación del proyecto..."

doc_files=0

if [ -f "$PROJECT_PATH/ARCHITECTURE.md" ]; then
    echo "✅ ARCHITECTURE.md encontrado"
    ((doc_files++))
fi

if [ -f "$PROJECT_PATH/ESTADO_ACTUAL.md" ]; then
    echo "✅ ESTADO_ACTUAL.md encontrado"
    ((doc_files++))
fi

if [ -f "$PROJECT_PATH/MODELS.md" ]; then
    echo "✅ MODELS.md encontrado"
    ((doc_files++))
fi

if [ -f "$PROJECT_PATH/PRD.md" ]; then
    echo "✅ PRD.md encontrado"
    ((doc_files++))
fi

if [ -f "$PROJECT_PATH/CLAUDE-MCP-SETUP.md" ]; then
    echo "✅ CLAUDE-MCP-SETUP.md encontrado"
    ((doc_files++))
fi

if [ -f "$PROJECT_PATH/CLAUDE-PROMPTS.md" ]; then
    echo "✅ CLAUDE-PROMPTS.md encontrado"
    ((doc_files++))
fi

if [ $doc_files -ge 4 ]; then
    echo "✅ Documentación completa para AI ($doc_files/6 archivos disponibles)"
else
    echo "⚠️  Documentación incompleta ($doc_files/6 archivos)"
    echo "    Claude tendrá contexto limitado"
fi

# Test 4: Verificar instalación de herramientas
echo
echo "[TEST 4/7] Verificando herramientas necesarias..."

if command -v node &> /dev/null; then
    NODE_VERSION=$(node --version)
    echo "✅ Node.js instalado: $NODE_VERSION"
else
    echo "❌ Node.js no encontrado"
    echo "   Descargar desde: https://nodejs.org/"
fi

if command -v python &> /dev/null; then
    PYTHON_VERSION=$(python --version)
    echo "✅ Python instalado: $PYTHON_VERSION"
else
    echo "⚠️  Python no encontrado (opcional para algunos MCP servers)"
fi

if command -v git &> /dev/null; then
    GIT_VERSION=$(git --version)
    echo "✅ Git instalado: $GIT_VERSION"
else
    echo "❌ Git no encontrado"
fi

# Test 5: Verificar MCP servers disponibles
echo
echo "[TEST 5/7] Verificando disponibilidad de MCP servers..."

if npm list -g @modelcontextprotocol/server-filesystem &> /dev/null; then
    echo "✅ MCP Filesystem ya instalado"
else
    echo "⚠️  MCP Filesystem no instalado aún"
    echo "   Se instalará con: npm install -g @modelcontextprotocol/server-filesystem"
fi

if npm list -g @0xshariq/github-mcp-server &> /dev/null; then
    echo "✅ GitHub MCP ya instalado"
else
    echo "⚠️  GitHub MCP no instalado aún (opcional)"
fi

# Test 6: Verificar permisos
echo
echo "[TEST 6/7] Verificando permisos de escritura..."

if touch "$PROJECT_PATH/mcp_test_file.tmp" 2>/dev/null; then
    rm "$PROJECT_PATH/mcp_test_file.tmp" 2>/dev/null
    echo "✅ Permisos de escritura en proyecto: OK"
else
    echo "❌ Sin permisos de escritura en proyecto"
fi

# Test 7: Resumen y recomendaciones
echo
echo "[TEST 7/7] Generando resumen..."

echo
echo "===================================================="
echo "                  RESUMEN DE TESTING"
echo "===================================================="
echo

# Crear reporte
cat > "$PROJECT_PATH/mcp-test-report.txt" << EOF
REPORTE DE CONFIGURACION MCP - $(date)
=================================================================

CONFIGURACION:
- Project Path: $PROJECT_PATH
- Claude Config: $CLAUDE_CONFIG  
- Node Version: ${NODE_VERSION:-"No instalado"}
- Python Version: ${PYTHON_VERSION:-"No instalado"}

ARCHIVOS CRITICOS ENCONTRADOS:
$(ls -la "$PROJECT_PATH"/*.md 2>/dev/null | grep -E '\.(md)$' || echo "No se encontraron archivos .md")

ESTRUCTURA LARAVEL:
- app/: $([ -d "$PROJECT_PATH/app" ] && echo "✅ Existe" || echo "❌ Faltante")
- config/: $([ -d "$PROJECT_PATH/config" ] && echo "✅ Existe" || echo "❌ Faltante") 
- database/: $([ -d "$PROJECT_PATH/database" ] && echo "✅ Existe" || echo "❌ Faltante")
- resources/: $([ -d "$PROJECT_PATH/resources" ] && echo "✅ Existe" || echo "❌ Faltante")

DOCUMENTACION IA:
- ARCHITECTURE.md: $([ -f "$PROJECT_PATH/ARCHITECTURE.md" ] && echo "✅" || echo "❌")
- ESTADO_ACTUAL.md: $([ -f "$PROJECT_PATH/ESTADO_ACTUAL.md" ] && echo "✅" || echo "❌")
- MODELS.md: $([ -f "$PROJECT_PATH/MODELS.md" ] && echo "✅" || echo "❌")
- PRD.md: $([ -f "$PROJECT_PATH/PRD.md" ] && echo "✅" || echo "❌")
- CLAUDE-MCP-SETUP.md: $([ -f "$PROJECT_PATH/CLAUDE-MCP-SETUP.md" ] && echo "✅" || echo "❌")
- CLAUDE-PROMPTS.md: $([ -f "$PROJECT_PATH/CLAUDE-PROMPTS.md" ] && echo "✅" || echo "❌")
EOF

echo "✅ Configuración evaluada completamente"
echo "📋 Reporte detallado generado: $PROJECT_PATH/mcp-test-report.txt"
echo

echo "🚀 ESTADO ACTUAL:"
if [ -f "$CLAUDE_CONFIG" ]; then
    echo "   📁 Claude Desktop config existe"
else
    echo "   📁 Claude Desktop config pendiente"
fi

if [ $laravel_files -ge 4 ]; then
    echo "   🏗️  Proyecto Laravel válido"
else
    echo "   🏗️  Proyecto Laravel con issues"
fi

if [ $doc_files -ge 4 ]; then
    echo "   📚 Documentación AI completa"
else
    echo "   📚 Documentación AI parcial"
fi

echo
echo "📋 PRÓXIMOS PASOS:"
echo "   1. Ejecutar install-mcp.bat (como Administrador en Windows)"
echo "   2. Configurar GitHub token en Claude config"  
echo "   3. Reiniciar Claude Desktop"
echo "   4. Probar con Claude usando prompts en CLAUDE-PROMPTS.md"
echo

echo "💡 COMANDO DE INSTALACIÓN:"
echo "   Ejecuta: install-mcp.bat (desde Windows cmd como Administrador)"
echo

echo "🎯 PRUEBA INICIAL CON CLAUDE:"
echo "   '¿Puedes acceder a los archivos del proyecto ASONATA y mostrarme la estructura?'"
echo

read -p "Presiona Enter para continuar..."
