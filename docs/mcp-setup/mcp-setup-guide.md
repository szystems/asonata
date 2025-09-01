# Configuración MCP Completa para Agentes IA - ASONATA

## 🤖 Estrategia de Contexto Completo para Agentes IA

Esta configuración permite que los agentes de IA tengan **acceso total** al contexto de la aplicación ASONATA, incluyendo estructura, modelos, estado actual y documentación técnica.

## 📁 Documentos de Contexto Generados

Los siguientes archivos han sido creados para proporcionar contexto completo a los agentes:

- ✅ **ARCHITECTURE.md** - Arquitectura técnica completa
- ✅ **ESTADO_ACTUAL.md** - Estado actual detallado con métricas
- ✅ **MODELS.md** - Documentación completa de modelos de datos
- ✅ **PRD.md** - Product Requirements Document
- 🔲 **README.md** - Instrucciones de instalación y uso
- 🔲 **API.md** - Documentación de endpoints API
- 🔲 **WORKFLOWS.md** - Procesos de negocio documentados
- 🔲 **CHANGELOG.md** - Historial de cambios
- 🔲 **DEPLOYMENT.md** - Guía de despliegue

## 🛠️ Herramientas MCP para Contexto Completo

### 1. Filesystem Context Server (CRÍTICO)

```bash
# Instalación del servidor de archivos más completo
npm install -g @flesler/mcp-files

# O usar el filesystem server oficial
git clone https://github.com/modelcontextprotocol/servers
cd servers/src/filesystem
npm install && npm run build
```

### 2. Extended Memory MCP (ESENCIAL)

```bash
# Para mantener contexto entre sesiones
npm install -g @ssmirnovpro/extended-memory-mcp
```

### 3. Context Crystallizer (RECOMENDADO)

```bash
# Para análisis sistemático de repositorio
git clone https://github.com/hubertciebiada/context-crystallizer
```

### 4. Database Schema MCP (MYSQL)

```bash
# Para contexto de base de datos
npm install -g @designcomputer/mysql-mcp-server
```

## 🔧 Configuración Claude Desktop

Archivo: `%APPDATA%\Claude\claude_desktop_config.json`

```json
{
  "mcpServers": {
    "filesystem_asonata": {
      "command": "node",
      "args": ["C:\\path\\to\\mcp-files\\dist\\index.js"],
      "env": {
        "PROJECT_ROOT": "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata",
        "ALLOWED_EXTENSIONS": ".php,.js,.vue,.blade.php,.json,.md,.sql,.env.example",
        "MAX_FILE_SIZE": "1000000",
        "INCLUDE_PATTERNS": "app/**,config/**,database/**,resources/**,routes/**,public/**,*.md,*.json,composer.*"
      }
    },
    "extended_memory": {
      "command": "node",
      "args": ["path/to/extended-memory-mcp/dist/index.js"],
      "env": {
        "PROJECT_NAME": "ASONATA",
        "MEMORY_DB_PATH": "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata\\ai_memory.db"
      }
    },
    "mysql_context": {
      "command": "python",
      "args": ["path/to/mysql-mcp-server/server.py"],
      "env": {
        "MYSQL_HOST": "localhost",
        "MYSQL_USER": "root",
        "MYSQL_PASSWORD": "",
        "MYSQL_DATABASE": "asonata",
        "MYSQL_PORT": "3306"
      }
    },
    "git_context": {
      "command": "git-mcp-go",
      "args": ["-repo", "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata"]
    }
  }
}
```

## 🎯 Flujo de Trabajo Completo con Agente IA

### 1. Inicialización del Contexto
```
Agente AI: "Lee ARCHITECTURE.md, ESTADO_ACTUAL.md y PRD.md para entender el proyecto"
```

### 2. Análisis del Código Base
```
Agente AI: "Analiza todos los archivos PHP en app/Models/ y app/Http/Controllers/"
```

### 3. Evaluación del Estado
```
Agente AI: "Revisa MODELS.md para entender las relaciones entre entidades"
```

### 4. Planificación de Cambios
```
Agente AI: "Basándome en PRD.md, propongo los siguientes cambios..."
```

## 📋 Lista de Documentos de Contexto

### Documentos Críticos (YA CREADOS)
- ✅ **ARCHITECTURE.md** - Stack técnico, estructura, limitaciones
- ✅ **ESTADO_ACTUAL.md** - Análisis completo del estado actual
- ✅ **MODELS.md** - Todos los modelos y relaciones
- ✅ **PRD.md** - Requerimientos de producto y roadmap

### Documentos por Crear (PRÓXIMOS PASOS)

#### README.md
```markdown
# ASONATA - Sistema de Gestión Deportiva

## Instalación Local
## Configuración
## Comandos Útiles
## Estructura del Proyecto
## Contribución
```

#### API.md
```markdown
# Documentación API ASONATA

## Endpoints Atletas
## Endpoints Inscripciones  
## Endpoints Pagos
## Autenticación Sanctum
## Códigos de Error
```

#### WORKFLOWS.md
```markdown
# Procesos de Negocio ASONATA

## Proceso de Inscripción
## Proceso de Pago
## Workflow de Comunicaciones
## Gestión de Equipos
```

#### CHANGELOG.md
```markdown
# Historial de Cambios

## v2.0.0 - Septiembre 2025
## v1.5.0 - Junio 2025
## v1.0.0 - Enero 2025
```

## 🚀 Comandos para Agentes IA

### Prompt de Inicialización
```
Hola, soy el agente IA para el proyecto ASONATA. Para comenzar:

1. Lee todos los archivos .md en la raíz del proyecto
2. Analiza la estructura de archivos PHP en app/
3. Revisa las migraciones en database/migrations/
4. Examina las rutas en routes/web.php y routes/api.php
5. Confirma que entiendes la arquitectura Laravel 8

Una vez completado, confirma tu entendimiento y pregunta qué tarea necesitas que realice.
```

### Comandos de Análisis
```
# Para análisis de código
"Analiza todos los controladores y identifica patrones comunes"

# Para análisis de BD
"Revisa las migraciones y sugiere optimizaciones de índices"

# Para análisis de seguridad
"Identifica vulnerabilidades potenciales en la validación de datos"

# Para mejoras de rendimiento
"Analiza las consultas Eloquent y sugiere optimizaciones"
```

## 🔍 Herramientas de Análisis Complementarias

### PHPStan (Análisis Estático)
```bash
composer require --dev phpstan/phpstan
./vendor/bin/phpstan analyse app
```

### Laravel Telescope (Debugging)
```bash
composer require laravel/telescope
php artisan telescope:install
```

### Laravel Debugbar (Desarrollo)
```bash
composer require --dev barryvdh/laravel-debugbar
```

## 📊 Dashboard de Estado para Agentes

### Métricas Clave que el Agente debe monitorear:
- **Archivos PHP:** 50+ archivos
- **Modelos:** 15 modelos principales
- **Controladores:** 20+ controladores
- **Migraciones:** Base establecida
- **Rutas:** Web + API definidas
- **Dependencias:** 13 principales (composer.json)

### Indicadores de Salud del Proyecto:
- 🟢 **Funcionalidad:** 8/10 (Operativo)
- 🟡 **Mantenibilidad:** 5/10 (Requiere mejoras)
- 🔴 **Seguridad:** 4/10 (Vulnerabilidades)
- 🟡 **Rendimiento:** 5/10 (Optimizable)
- 🔴 **Testing:** 1/10 (Crítico)

## 🎯 Objetivos para el Agente IA

### Inmediatos (1-2 semanas)
1. **Completar documentación faltante** (README.md, API.md, WORKFLOWS.md)
2. **Implementar tests básicos** para modelos críticos
3. **Optimizar consultas** identificadas como problemáticas
4. **Mejorar validaciones** en FormRequests

### Corto Plazo (1 mes)
1. **Refactorizar controladores** que no sigan estándares Laravel
2. **Implementar Repository Pattern** para consultas complejas
3. **Añadir middleware personalizado** para auditoría
4. **Crear Seeders** para datos de prueba

### Medio Plazo (2-3 meses)
1. **Planificar migración a Laravel 11**
2. **Implementar API completa** con documentación OpenAPI
3. **Mejorar UI/UX** del frontend
4. **Añadir sistema de roles** más granular

## 🛡️ Consideraciones de Seguridad para Agentes

### Acceso Limitado en Producción
- ❌ **NO** dar acceso a archivos .env reales
- ❌ **NO** ejecutar comandos destructivos sin confirmación
- ❌ **NO** modificar migraciones existentes con datos
- ✅ **SÍ** proponer cambios antes de ejecutar
- ✅ **SÍ** crear backups antes de cambios críticos

### Validación de Cambios
```bash
# Antes de cualquier cambio importante
php artisan config:cache --env=local
php artisan route:cache
composer install --no-dev --optimize-autoloader
./vendor/bin/phpstan analyse
```

Este setup completo permite que cualquier agente IA tenga acceso completo al contexto, comprenda la aplicación y pueda trabajar de manera efectiva con toda la información necesaria.
