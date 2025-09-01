# 🧠 Prompts Optimizados para Claude Sonnet - ASONATA

**Prompts específicamente diseñados para maximizar la efectividad de Claude Sonnet con MCP**

---

## 🚀 PROMPT DE INICIALIZACIÓN PRINCIPAL

```
CONTEXTO: ASONATA - Proyecto Laravel 8

Soy Claude Sonnet trabajando en ASONATA, un sistema de administración deportiva en Laravel 8.

CARGA INICIAL REQUERIDA:
📋 Lee ARCHITECTURE.md → Stack técnico completo
📊 Analiza ESTADO_ACTUAL.md → Métricas y estado del proyecto  
🗃️ Revisa MODELS.md → 15 modelos y sus relaciones
🎯 Consulta PRD.md → Objetivos de negocio
📁 Explora estructura: app/, config/, database/, resources/

CAPACIDADES MCP DISPONIBLES:
✅ Filesystem: Acceso completo a archivos del proyecto
✅ GitHub: Repositorio szystems/asonata 
✅ Memory: Contexto persistente entre sesiones
✅ Search: Búsqueda semántica en código

LIMITACIONES CRÍTICAS:
⚠️ Servidor iPage (máximo PHP 8.0)
⚠️ Laravel 8.75 (no se puede actualizar aún)
⚠️ Sin testing implementado (prioridad alta)

INSTRUCCIONES:
1. Confirma acceso a estos recursos vía MCP
2. Carga el contexto completo del proyecto
3. Pregunta en qué tarea específica quieres que me enfoque

¿Confirmado? ¿En qué comenzamos?
```

---

## 🔍 PROMPTS DE ANÁLISIS DE CÓDIGO

### Análisis Integral del Proyecto
```
TAREA: Auditoría completa ASONATA

Usando MCP filesystem, ejecuta análisis profundo:

🔍 ANÁLISIS REQUERIDO:
1. Escaneo de todos los modelos → app/Models/ (15 modelos)
2. Revisión de controladores → app/Http/Controllers/
3. Análisis de migraciones → database/migrations/
4. Evaluación de rutas → routes/web.php y api.php
5. Revisión de middleware → app/Http/Middleware/

🎯 ENFOQUE ESPECÍFICO:
- Relaciones Eloquent mal definidas o faltantes
- Consultas N+1 potenciales  
- Validaciones de formularios faltantes
- Patrones de seguridad Laravel
- Oportunidades de refactoring críticas

📊 FORMATO DE SALIDA:
- Listado de issues por prioridad (Crítico/Alto/Medio/Bajo)
- Ejemplos específicos de código problemático
- Recomendaciones con código corregido
- Estimación de impacto por cada cambio

Comienza el análisis sistemático.
```

### Análisis de Modelos Específico
```
ANÁLISIS DE MODELOS: ASONATA

Usando filesystem MCP, analiza exhaustivamente los 15 modelos:

📋 MODELOS A REVISAR:
Atleta, User, Team, Payment, Inscription, Category, Group, Classs, 
Attendance, Assist, Schedule, Facility, Config, Cycle, Noticia

🔍 POR CADA MODELO EVALÚA:
1. Relaciones Eloquent definidas vs MODELS.md
2. Fillable/guarded properties
3. Casts y mutadores/accessors
4. Validaciones (rules)
5. Scopes y métodos helper

🚨 DETECTAR PROBLEMAS:
- Relaciones faltantes o incorrectas
- Mass assignment vulnerabilities  
- Consultas ineficientes en métodos
- Falta de validación de datos
- Inconsistencias en nomenclatura

📊 GENERAR REPORTE:
- Tabla comparativa: Modelo vs Documentación
- Issues críticos por modelo
- Sugerencias de mejoras específicas
- Priorización de refactoring

Inicia análisis modelo por modelo.
```

---

## 🗄️ PROMPTS PARA BASE DE DATOS

### Análisis de Schema
```
BD ANALYSIS: ASONATA Database

Usando MySQL MCP (si disponible) o análisis de migraciones:

🔍 ANÁLISIS DEL SCHEMA:
1. Estructura de 15+ tablas principales
2. Índices existentes vs necesarios
3. Claves foráneas y restricciones
4. Tipos de datos y tamaños
5. Tablas pivot para relaciones many-to-many

🚨 PROBLEMAS A IDENTIFICAR:
- Tablas sin índices apropiados
- Claves foráneas faltantes
- Campos con tipos inadecuados
- Falta de restricciones de integridad
- Consultas lentas potenciales

📈 OPTIMIZACIONES SUGERIDAS:
- Índices compuestos necesarios
- Particionado de tablas grandes
- Normalización vs desnormalización
- Campos calculados o cachés

Genera análisis completo del schema.
```

### Queries y Performance
```
PERFORMANCE ANALYSIS: ASONATA Queries

Analiza patrones de consultas en controllers y modelos:

🔍 BUSCAR EN CÓDIGO:
- Consultas en loops (N+1 problem)
- SELECT * innecesarios
- JOINs complejos sin índices
- Paginación faltante en listings
- Consultas sin eager loading

📊 MÉTRICAS A EVALUAR:
- Controllers con más consultas
- Modelos con relaciones costosas
- Rutas con potencial lentitud
- APIs sin optimización

🚀 OPTIMIZACIONES:
- Implementar eager loading
- Añadir paginación donde falte
- Cachear consultas frecuentes
- Optimizar JOINs y subconsultas

Comienza el análisis de performance.
```

---

## 🔒 PROMPTS DE SEGURIDAD

### Auditoría de Seguridad
```
SECURITY AUDIT: ASONATA

Usando filesystem MCP, audita seguridad completa:

🔐 ANÁLISIS DE SEGURIDAD:
1. Middleware de autenticación → app/Http/Middleware/
2. Políticas de autorización → app/Policies/
3. Validaciones de input → app/Http/Requests/
4. Mass assignment protection → Modelos
5. CSRF y XSS protection → Blade templates

🚨 VULNERABILIDADES A BUSCAR:
- Endpoints sin autenticación
- Mass assignment vulnerabilities
- SQL injection potencial
- XSS en outputs sin escapar
- Archivos subidos sin validación

🛡️ MEJORAS REQUERIDAS:
- Form Request validators faltantes
- Políticas de autorización específicas
- Sanitización de datos de entrada
- Rate limiting en APIs
- Logging de acciones críticas

Ejecuta auditoría completa de seguridad.
```

---

## 🧪 PROMPTS PARA TESTING

### Estrategia de Testing
```
TESTING STRATEGY: ASONATA

El proyecto NO tiene tests. Diseña estrategia completa:

🧪 TESTING REQUERIDO:
1. Unit Tests → Modelos y helpers
2. Feature Tests → Controllers y rutas
3. Database Tests → Migraciones y seeders  
4. Browser Tests → Funcionalidad completa

📋 PRIORIDAD POR MÓDULO:
- CRÍTICO: Autenticación, Pagos, Inscripciones
- ALTO: Atletas, Teams, Schedules
- MEDIO: Attendance, Notifications
- BAJO: Config, Slides

🚀 PLAN DE IMPLEMENTACIÓN:
1. Setup PHPUnit configuration
2. Database testing environment
3. Test templates por tipo de modelo
4. Factories para datos de prueba
5. Seeders específicos para testing

Genera plan detallado de testing con ejemplos.
```

---

## 🚀 PROMPTS DE DESARROLLO

### Desarrollo de Nueva Feature
```
FEATURE DEVELOPMENT: [NOMBRE_FEATURE]

Contexto: Desarrollar nueva funcionalidad en ASONATA

🎯 PROCESO DE DESARROLLO:
1. Análizar requerimiento usando PRD.md
2. Identificar archivos a modificar con filesystem MCP
3. Revisar impacto en models con MODELS.md
4. Verificar limitaciones con ARCHITECTURE.md
5. Proponer implementación completa

📋 CHECKLIST DE DESARROLLO:
- ✅ Migration para cambios de BD
- ✅ Model con relaciones apropiadas  
- ✅ Controller con validaciones
- ✅ Routes con middleware apropiado
- ✅ Views con diseño consistente
- ✅ Validaciones de seguridad
- ✅ Tests para nueva funcionalidad

🔍 ANÁLISIS PREVIO:
- Funcionalidades similares existentes
- Patrones de código a seguir
- Dependencias y conflictos
- Compatibilidad Laravel 8/PHP 8.0

Describe la feature y comenzamos el desarrollo completo.
```

### Refactoring Específico
```
REFACTORING TASK: [COMPONENTE]

Usando el contexto completo del proyecto:

🔧 ANÁLISIS DE REFACTORING:
1. Código actual → Leer implementación completa
2. Problemas identificados → Según ESTADO_ACTUAL.md
3. Best practices Laravel 8 → Aplicar estándares
4. Impacto en sistema → Evaluar dependencias

🎯 OBJETIVOS DE REFACTORING:
- Mejorar legibilidad y mantenibilidad
- Implementar patrones apropiados
- Reducir duplicación de código  
- Mejorar performance
- Aumentar testabilidad

📊 PLAN DE EJECUCIÓN:
- Backup y git branch para cambios
- Refactoring incremental
- Validación paso a paso
- Tests para verificar funcionalidad
- Documentación de cambios

Especifica qué componente refactorizar y ejecutemos el plan.
```

---

## 📊 PROMPTS DE REPORTING

### Estado del Proyecto
```
PROJECT STATUS REPORT: ASONATA

Usando toda la información MCP disponible:

📊 GENERAR REPORTE COMPLETO:
1. Métricas de código → Líneas, archivos, complejidad
2. Estado de funcionalidades → Completitud por módulo
3. Deuda técnica → Issues prioritarios
4. Seguridad → Vulnerabilidades encontradas
5. Performance → Puntos de mejora
6. Testing → Cobertura actual (0%) y plan

📈 FORMATO EJECUTIVO:
- Resumen ejecutivo (2-3 párrafos)
- Métricas clave en tabla
- Top 5 prioridades de mejora
- Estimación de esfuerzo por prioridad
- Roadmap de mejoras sugerido

🎯 AUDIENCIA: Desarrollador técnico y stakeholders

Genera reporte completo del estado actual.
```

---

## 💡 PROMPTS DE OPTIMIZACIÓN ESPECÍFICA

### Optimización Laravel
```
LARAVEL OPTIMIZATION: ASONATA

Optimización específica para Laravel 8 en hosting iPage:

🚀 ÁREAS DE OPTIMIZACIÓN:
1. Config caching → php artisan config:cache
2. Route caching → php artisan route:cache  
3. View compilation → php artisan view:cache
4. Autoloader optimization → composer dump-autoload -o
5. Database query optimization

⚡ PERFORMANCE ESPECÍFICO:
- Eager loading en relaciones frecuentes
- Índices de BD apropiados
- Paginación en listados grandes
- Cache de consultas repetitivas
- Compresión de assets

🔧 LIMITACIONES iPage:
- No Redis/Memcached disponible
- File-based caching únicamente
- Límites de memoria PHP
- Restricciones de .htaccess

Ejecuta optimización completa para el entorno actual.
```

---

## 🎯 COMANDOS FRECUENTES PARA CLAUDE

### Quick Commands
```
// Análisis rápido
"Muestra resumen del proyecto ASONATA"
"¿Cuáles son los 5 problemas más críticos del código?"  
"Analiza el modelo [NombreModelo] completamente"

// Desarrollo  
"Crea feature de [funcionalidad] completa"
"Refactoriza el controller [NombreController]"
"Optimiza las consultas del modelo [NombreModelo]"

// Debugging
"¿Por qué falla [funcionalidad específica]?"
"Encuentra el origen del error en [archivo]"
"Revisa las dependencias de [componente]"

// Documentation  
"Documenta la función [nombreFuncion]"
"Actualiza MODELS.md con cambios recientes"
"Genera documentation de la API"
```

---

## 🏗️ WORKFLOW COMPLETO RECOMENDADO

### Sesión de Trabajo Típica
```
1. INICIALIZACIÓN:
   - Usar prompt de inicialización principal
   - Verificar acceso MCP  
   - Cargar contexto de extended memory

2. ANÁLISIS:
   - Estado actual del proyecto
   - Issues prioritarios pendientes  
   - Contexto de la tarea específica

3. DESARROLLO:
   - Planificación detallada
   - Implementación paso a paso
   - Validación continua

4. TESTING:  
   - Verificación de funcionalidad
   - Tests apropiados
   - Documentación de cambios

5. CIERRE:
   - Resumen de cambios realizados
   - Guardar contexto en extended memory
   - Next steps para próxima sesión
```

---

## 🎯 PROMPTS ESPECIALIZADOS POR ROL

### Para Product Owner
```
BUSINESS ANALYSIS: ASONATA

Análisis desde perspectiva de negocio:

📊 KPIs DEL SISTEMA:
- Usuarios activos vs registrados  
- Inscripciones por período
- Pagos procesados y pendientes
- Utilización de facilities y horarios

💰 OPTIMIZACIÓN DE REVENUE:
- Automated payment reminders
- Upselling de clases adicionales  
- Programas de referidos
- Análisis de churn de atletas

📈 GROWTH OPPORTUNITIES:
- Mobile app para atletas/padres
- API para integración con partners
- Reportes avanzados para coaches  
- Sistema de comunicaciones mejorado
```

### Para Tech Lead  
```
TECHNICAL ROADMAP: ASONATA

Roadmap técnico estratégico:

🏗️ ARQUITECTURA:
- Migración gradual a Laravel 9/10
- Implementación de API REST completa
- Microservicios para módulos críticos
- Queue system para tareas pesadas

🔧 INFRASTRUCTURE:
- Migration plan desde iPage
- CI/CD pipeline setup
- Monitoring y logging
- Backup y disaster recovery

👥 TEAM DEVELOPMENT:  
- Code review processes
- Testing culture implementation
- Documentation standards
- Performance monitoring
```

¿Te gustaría que ejecute alguno de estos prompts específicos, o necesitas que adapte alguno para tu caso de uso particular?
