# Configuración MCP Optimizada para Claude Sonnet - ASONATA

**Configuración especializada para Claude Sonnet 3.5/4+ y compatibilidad con GPT**

## 🎯 Setup MCP Recomendado para Desarrollo Fluido

### **Herramientas MCP Esenciales (Orden de Prioridad)**

## 1. 📁 **MCP Filesystem (CRÍTICO)**
**Para:** Acceso completo a archivos de la aplicación

### Opción A: MCP Files (Recomendado para Laravel)
```bash
# Instalación
npm install -g @modelcontextprotocol/server-filesystem

# O instalar desde el repositorio oficial
git clone https://github.com/modelcontextprotocol/servers.git
cd servers/src/filesystem
npm install && npm run build
```

### Opción B: Advanced Files MCP  
```bash
# Más opciones de filtrado y análisis
npm install -g @flesler/mcp-files
```

## 2. 🐙 **GitHub MCP (ESENCIAL)**
**Para:** Integración completa con GitHub + Copilot context

```bash
# GitHub MCP Server más completo
npm install -g @0xshariq/github-mcp-server

# O el oficial más simple
git clone https://github.com/modelcontextprotocol/servers.git
cd servers/src/github
npm install && npm run build
```

## 3. 🗄️ **MySQL MCP (IMPORTANTE)**  
**Para:** Contexto completo de base de datos

```bash
# Opción Python (recomendada para Laravel)
pip install mysql-connector-python
git clone https://github.com/designcomputer/mysql_mcp_server

# Opción Node.js alternativa
npm install -g @benborla/mcp-server-mysql
```

## 4. 🧠 **Extended Memory MCP (MUY ÚTIL)**
**Para:** Contexto persistente entre sesiones

```bash
# Memoria entre conversaciones
npm install -g @ssmirnovpro/extended-memory-mcp
```

## 5. 🔍 **Context Search MCP (RECOMENDADO)**
**Para:** Búsqueda semántica en el código

```bash
# Para búsquedas inteligentes de código
git clone https://github.com/AB498/code-context-provider-mcp
cd code-context-provider-mcp
npm install && npm run build
```

---

## 🛠️ Configuración Claude Desktop

**Archivo:** `%APPDATA%\Claude\claude_desktop_config.json`

```json
{
  "mcpServers": {
    "filesystem_asonata": {
      "command": "npx",
      "args": [
        "@modelcontextprotocol/server-filesystem",
        "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata"
      ],
      "env": {
        "FILESYSTEM_ROOT": "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata"
      }
    },
    "github_integration": {
      "command": "npx", 
      "args": ["@0xshariq/github-mcp-server"],
      "env": {
        "GITHUB_PERSONAL_ACCESS_TOKEN": "tu_github_token_aqui",
        "GITHUB_REPO_OWNER": "szystems",
        "GITHUB_REPO_NAME": "asonata"
      }
    },
    "mysql_context": {
      "command": "python",
      "args": ["C:\\path\\to\\mysql_mcp_server\\server.py"],
      "env": {
        "MYSQL_HOST": "localhost",
        "MYSQL_USER": "root", 
        "MYSQL_PASSWORD": "",
        "MYSQL_DATABASE": "asonata",
        "MYSQL_PORT": "3306"
      }
    },
    "extended_memory": {
      "command": "npx",
      "args": ["@ssmirnovpro/extended-memory-mcp"],
      "env": {
        "PROJECT_NAME": "ASONATA",
        "MEMORY_DB_PATH": "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata\\ai_memory.db"
      }
    },
    "code_search": {
      "command": "node",
      "args": ["C:\\path\\to\\code-context-provider-mcp\\dist\\index.js"],
      "env": {
        "PROJECT_ROOT": "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata",
        "INCLUDE_PATTERNS": "*.php,*.js,*.vue,*.blade.php,*.json,*.md"
      }
    }
  }
}
```

---

## 🚀 Configuración Específica para Claude Sonnet

### **Prompts de Inicialización Optimizados**

#### Prompt Principal de Contexto
```
CONTEXTO DE PROYECTO: ASONATA

Soy Claude Sonnet trabajando en el proyecto ASONATA (Laravel 8). 

INFORMACIÓN INICIAL REQUERIDA:
1. Lee ARCHITECTURE.md para entender el stack completo
2. Analiza ESTADO_ACTUAL.md para conocer métricas y estado
3. Revisa MODELS.md para entender relaciones de datos  
4. Consulta PRD.md para objetivos de negocio
5. Explora la estructura de archivos en app/, config/, database/

CAPACIDADES DISPONIBLES via MCP:
✅ Acceso completo a filesystem del proyecto
✅ Integración con GitHub repo szystems/asonata  
✅ Consultas directas a BD MySQL asonata
✅ Memoria persistente entre sesiones
✅ Búsqueda semántica en código

LIMITACIONES CONOCIDAS:
- Servidor iPage (no PHP 8.1+)
- Laravel 8.75 (próximo upgrade)
- Sin testing implementado (prioridad)

Confirma que tienes acceso a estos recursos y dime en qué tarea quieres que me enfoque.
```

#### Prompt para Análisis de Código
```
TAREA: Análisis de código ASONATA

Usando MCP filesystem, realiza:
1. Escaneo de todos los modelos en app/Models/
2. Análisis de controladores en app/Http/Controllers/  
3. Revisión de migraciones en database/migrations/
4. Identificación de patterns y anti-patterns

ENFOQUE EN:
- Relaciones Eloquent mal definidas
- Consultas N+1 potenciales
- Validaciones faltantes
- Oportunidades de refactoring

Proporciona recomendaciones específicas con ejemplos de código.
```

---

## 🔗 GitHub Token Configuration

### 1. Crear Personal Access Token
1. Ve a GitHub → Settings → Developer settings → Personal access tokens
2. Generate new token (classic)
3. Selecciona scopes:
   - `repo` (Full control of repositories)
   - `read:org` (Read org and team membership)  
   - `user:email` (Access user email addresses)

### 2. Configurar en MCP
```json
"env": {
  "GITHUB_PERSONAL_ACCESS_TOKEN": "ghp_xxxxxxxxxxxxxxxxxxxx",
  "GITHUB_REPO_OWNER": "szystems", 
  "GITHUB_REPO_NAME": "asonata"
}
```

---

## 🎯 Herramientas MCP Adicionales Recomendadas

### Para Desarrollo Web (Laravel específico)
```bash
# 1. Laravel-specific MCP (si existe)
npm install -g laravel-mcp-server

# 2. Composer MCP para dependencias
npm install -g composer-mcp-server

# 3. Artisan MCP para comandos Laravel
npm install -g laravel-artisan-mcp
```

### Para Testing y QA
```bash
# PHPUnit MCP para testing
npm install -g phpunit-mcp-server

# PHPStan MCP para análisis estático  
npm install -g phpstan-mcp-server
```

### Para Deployment
```bash
# FTP MCP para deploy en iPage
npm install -g ftp-mcp-server

# SSH MCP para servidores
npm install -g ssh-mcp-server
```

---

## 🧪 Testing de Configuración MCP

### Script de Verificación
```bash
# Crear archivo test-mcp.bat
@echo off
echo Verificando configuración MCP...

echo.
echo 1. Verificando Claude Desktop config...
if exist "%APPDATA%\Claude\claude_desktop_config.json" (
    echo ✅ Config file exists
) else (
    echo ❌ Config file missing
    exit /b 1
)

echo.
echo 2. Verificando MCP servers...
npx @modelcontextprotocol/server-filesystem --version
python --version
node --version

echo.
echo 3. Verificando acceso al proyecto...
if exist "C:\Users\szott\Dropbox\Desarrollo\asonata\composer.json" (
    echo ✅ Project accessible
) else (
    echo ❌ Project path incorrect
)

echo.
echo ✅ Configuración MCP lista para usar con Claude
pause
```

---

## 📋 Comandos Frecuentes para Claude

### Análisis de Proyecto
```
"Analiza la estructura completa del proyecto ASONATA usando filesystem MCP"
"Revisa todas las migraciones y sugiere optimizaciones de índices"
"Identifica consultas N+1 en los controladores"
```

### Trabajo con GitHub  
```
"Muestra los últimos 10 commits del repo usando GitHub MCP"
"Analiza los issues abiertos y sugiere prioridades"
"Compara branch actual con master"
```

### Base de Datos
```
"Muestra el esquema completo de la BD usando MySQL MCP"
"Identifica tablas sin índices apropiados"  
"Sugiere optimizaciones basadas en el schema actual"
```

### Memoria Persistente
```
"Guarda el contexto de esta conversación en extended memory"
"Recupera lo que discutimos sobre el modelo Atleta la sesión pasada"
"Mantén registro de todos los cambios sugeridos"
```

---

## 🚀 Flujo de Trabajo Optimizado

### 1. **Inicio de Sesión**
```
Claude → "Carga contexto ASONATA desde extended memory"
Claude → "Revisa cambios recientes en GitHub desde última sesión"
Claude → "Analiza estructura actual de archivos"
```

### 2. **Desarrollo de Features**
```
Claude → "Analiza requerimiento usando PRD.md"
Claude → "Identifica archivos a modificar usando filesystem MCP"
Claude → "Revisa schema BD para cambios necesarios"
Claude → "Propone implementación completa"
```

### 3. **Code Review**
```
Claude → "Analiza cambios propuestos"  
Claude → "Verifica compatibilidad con Laravel 8"
Claude → "Sugiere tests apropiados"
Claude → "Propone documentación actualizada"
```

### 4. **Deployment**
```
Claude → "Valida que cambios sean compatibles con iPage"
Claude → "Genera comandos de deployment"
Claude → "Actualiza documentación de cambios"
```

---

## 🎯 Configuración Final Recomendada

Para tu uso específico con Claude Sonnet, te sugiero este **setup mínimo pero potente**:

### **Setup Básico (Esencial)**
1. **Filesystem MCP** - Acceso completo a archivos
2. **GitHub MCP** - Integración con repositorio  
3. **Extended Memory MCP** - Contexto persistente

### **Setup Avanzado (Recomendado)**  
1. Todos los anteriores +
2. **MySQL MCP** - Contexto de base de datos
3. **Code Search MCP** - Búsqueda semántica

### **Setup Profesional (Completo)**
1. Todos los anteriores +
2. **Laravel-specific MCPs** - Comandos Artisan, Composer
3. **Testing MCPs** - PHPUnit, PHPStan
4. **Deployment MCPs** - SSH, FTP

¿Quieres que te ayude a instalar y configurar alguna de estas herramientas específicamente?
