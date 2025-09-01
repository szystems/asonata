# PRD - Product Requirements Document
# ASONATA (Asociación Nacional de Atletismo)

> 📋 **NOTA PARA AGENTES/IA**: Este archivo contiene contexto esencial del producto y debe permanecer en la raíz. 
> Para documentación adicional, scripts o archivos auxiliares, usar la carpeta `docs/` con subcarpetas categorizadas.

**Versión:** 2.1  
**Fecha:** 1 de Septiembre de 2025  
**Producto:** Sistema de Gestión Deportiva ASONATA  
**Stakeholder Principal:** Asociación Nacional de Atletismo  
**Estado Técnico:** Desarrollo Activo - Laravel 8.83.27 + Laragon  

---

## 🎯 Visión del Producto

**Visión:** Ser la plataforma digital líder para la gestión integral de asociaciones deportivas de atletismo, facilitando la administración eficiente de atletas, competencias, pagos y comunicaciones.

**Misión:** Digitalizar y optimizar los procesos administrativos de ASONATA, mejorando la experiencia de atletas, entrenadores y administradores mediante una plataforma web robusta y fácil de usar.

---

## 👥 Stakeholders

### Primarios
- **Administradores ASONATA** - Gestión completa del sistema
- **Entrenadores** - Seguimiento de atletas y clases
- **Atletas/Padres** - Consulta de información y estados

### Secundarios
- **Contadores** - Reportes financieros
- **Directiva** - Dashboard ejecutivo
- **Soporte Técnico** - Mantenimiento del sistema

---

## 🎨 User Personas

### 1. María González - Administradora Principal
- **Edad:** 45 años
- **Rol:** Coordinadora Administrativa ASONATA
- **Objetivos:** 
  - Gestionar inscripciones eficientemente
  - Control total de pagos y finanzas
  - Generar reportes ejecutivos
- **Frustración:** Procesos manuales lentos, errores en pagos
- **Tecnología:** Intermedio, usa Excel diariamente

### 2. Carlos Rodríguez - Entrenador
- **Edad:** 35 años
- **Rol:** Entrenador de Atletismo
- **Objetivos:**
  - Hacer seguimiento de asistencias
  - Comunicar con padres de familia
  - Organizar equipos por categorías
- **Frustración:** Falta de información actualizada de atletas
- **Tecnología:** Básico-Intermedio, móvil principalmente

### 3. Ana López - Madre de Atleta
- **Edad:** 38 años
- **Rol:** Representante Legal de Atleta
- **Objetivos:**
  - Ver estado de pagos del hijo
  - Recibir notificaciones importantes
  - Consultar horarios y competencias
- **Frustración:** Falta de transparencia en información
- **Tecnología:** Básico, prefiere WhatsApp

---

## 🏆 Objetivos de Negocio

### Objetivos Primarios (3 meses)
1. **Digitalizar procesos manuales** - Reducir 80% de trabajo en papel
2. **Centralizar información** - Base de datos única de atletas
3. **Automatizar notificaciones** - Email automático para inscripciones/pagos
4. **Generar reportes automáticos** - Excel/PDF on-demand

### Objetivos Secundarios (6 meses)
1. **Optimizar experiencia de usuario** - Interface moderna y responsive
2. **Implementar dashboard ejecutivo** - KPIs en tiempo real
3. **Integración de pagos online** - PSE, tarjetas, etc.
4. **App móvil complementaria** - Notificaciones push

### Objetivos a Largo Plazo (12 meses)
1. **Escalabilidad multi-asociación** - Modelo SaaS
2. **Inteligencia artificial** - Predicciones y recomendaciones
3. **Integración con federaciones** - APIs externas
4. **Gamificación** - Sistema de logros para atletas

---

## ⭐ Funcionalidades Core

### 1. Gestión de Atletas
**Prioridad:** P0 (Crítica)

#### User Stories
- Como **administrador**, quiero registrar nuevos atletas con toda su información personal y deportiva
- Como **administrador**, quiero actualizar información de atletas existentes
- Como **entrenador**, quiero ver lista de mis atletas asignados
- Como **padre**, quiero ver el perfil completo de mi hijo atleta

#### Criterios de Aceptación
- ✅ CRUD completo de atletas
- ✅ Validación de campos obligatorios
- ✅ Upload de fotos de perfil
- ✅ Categorización automática por edad
- ✅ Export de datos a Excel
- ✅ Búsqueda y filtros avanzados

### 2. Sistema de Inscripciones
**Prioridad:** P0 (Crítica)

#### User Stories
- Como **administrador**, quiero gestionar inscripciones a competencias
- Como **atleta/padre**, quiero inscribirme a competencias disponibles
- Como **sistema**, quiero enviar confirmación automática de inscripción

#### Criterios de Aceptación
- ✅ Formulario de inscripción online
- ✅ Validación de requisitos por categoría
- ✅ Email de confirmación automático
- ✅ Dashboard de inscripciones pendientes
- ✅ Control de cupos por competencia
- ✅ Estado de inscripciones (pendiente, confirmada, cancelada)

### 3. Control Financiero
**Prioridad:** P0 (Crítica)

#### User Stories
- Como **administrador**, quiero registrar pagos de atletas
- Como **contador**, quiero generar reportes financieros
- Como **padre**, quiero consultar estado de pagos de mi hijo

#### Criterios de Aceptación
- ✅ Registro manual de pagos
- ✅ Control de estados (pendiente, pagado, vencido)
- ✅ Reportes de ingresos por período
- ✅ Export de pagos a Excel
- ✅ Notificaciones de pagos vencidos
- 🔲 Integración con pasarelas de pago (Futuro)

### 4. Gestión de Equipos
**Prioridad:** P1 (Alta)

#### User Stories
- Como **entrenador**, quiero crear y gestionar equipos
- Como **administrador**, quiero asignar atletas a equipos
- Como **atleta**, quiero ver mi equipo y compañeros

#### Criterios de Aceptación
- ✅ CRUD de equipos
- ✅ Asignación de atletas a equipos
- ✅ Roles dentro del equipo
- ✅ Vista de equipos por categoría
- 🔲 Comunicación interna de equipo (Futuro)

### 5. Control de Asistencia
**Prioridad:** P1 (Alta)

#### User Stories
- Como **entrenador**, quiero registrar asistencia de atletas
- Como **padre**, quiero ver asistencias de mi hijo
- Como **administrador**, quiero reportes de asistencia

#### Criterios de Aceptación
- ✅ Registro rápido de asistencias
- ✅ Vista calendario de asistencias
- ✅ Reportes de asistencia por atleta
- ✅ Estadísticas de asistencia por clase
- 🔲 Registro por código QR (Futuro)

### 6. Sistema de Comunicaciones
**Prioridad:** P2 (Media)

#### User Stories
- Como **administrador**, quiero publicar noticias importantes
- Como **atleta/padre**, quiero recibir notificaciones relevantes
- Como **entrenador**, quiero comunicarme con padres de familia

#### Criterios de Aceptación
- ✅ CMS para noticias
- ✅ Sistema de slides/banners
- ✅ Email automático para eventos importantes
- 🔲 WhatsApp integration (Futuro)
- 🔲 Notificaciones push (Futuro)

---

## 🚫 Out of Scope (No incluido en esta versión)

- Streaming de competencias
- E-learning para entrenadores
- Marketplace de productos deportivos
- Redes sociales internas
- Integración con dispositivos IoT
- Análisis de rendimiento deportivo avanzado

---

## 📋 Requisitos Funcionales

### RF-001: Autenticación y Autorización
- Sistema de login seguro
- Roles y permisos granulares
- Recuperación de contraseña
- Sesiones seguras

### RF-002: Dashboard Personalizado
- Vista diferente por rol de usuario
- Widgets configurables
- Métricas en tiempo real
- Navegación intuitiva

### RF-003: Reportes y Exports
- Generación de reportes PDF
- Export a Excel/CSV
- Filtros personalizables
- Programación de reportes

### RF-004: Búsqueda y Filtros
- Búsqueda global en el sistema
- Filtros avanzados por entidad
- Ordenamiento personalizable
- Paginación eficiente

---

## 📐 Requisitos No Funcionales

### Rendimiento
- **Tiempo de respuesta:** < 2 segundos para operaciones normales
- **Carga de página:** < 3 segundos en conexión 3G
- **Usuarios concurrentes:** Soporte para 100 usuarios simultáneos
- **Uptime:** 99.5% disponibilidad

### Seguridad
- **Encripción:** HTTPS en todas las comunicaciones
- **Passwords:** Hash con bcrypt, mínimo 8 caracteres
- **SQL Injection:** Protección vía Eloquent ORM
- **XSS:** Validación y sanitización de inputs
- **CSRF:** Tokens en todos los formularios

### Usabilidad
- **Responsive:** Adaptable a móviles y tablets
- **Accesibilidad:** Cumplir estándares WCAG 2.1 AA
- **Idioma:** Español como idioma principal
- **Navegación:** Máximo 3 clicks para cualquier función

### Compatibilidad
- **Navegadores:** Chrome 90+, Firefox 90+, Safari 14+, Edge 90+
- **Móviles:** iOS 12+, Android 8+
- **Servidor:** PHP 7.3+, MySQL 5.7+
- **Framework:** Laravel 8+ (migración futura a 11)

---

## 🗓️ Roadmap y Milestones

### Fase 1: Core MVP (Completada ✅)
**Duración:** 3 meses  
**Estado:** Finalizada

- ✅ Gestión básica de atletas
- ✅ Sistema de inscripciones
- ✅ Control de pagos
- ✅ Estructura de equipos
- ✅ Control de asistencia básico

### Fase 2: Optimización y UX (En progreso 🚧)
**Duración:** 2 meses  
**Estado:** 60% completada

- ✅ Sistema de notificaciones por email
- ✅ Reportes automáticos
- 🚧 Mejoras de UI/UX
- 🔲 Dashboard personalizable
- 🔲 Búsqueda avanzada

### Fase 3: Características Avanzadas (Planificada 📋)
**Duración:** 3 meses  
**Estado:** Planificada

- 🔲 API RESTful completa
- 🔲 Integración de pagos online
- 🔲 App móvil
- 🔲 Dashboard ejecutivo
- 🔲 Analytics avanzado

### Fase 4: Escalabilidad (Futura 🔮)
**Duración:** 4 meses  
**Estado:** Visión futura

- 🔲 Multi-tenancy (múltiples asociaciones)
- 🔲 Integración con federaciones
- 🔲 AI para predicciones
- 🔲 Gamificación
- 🔲 Módulo de e-learning

---

## 📊 Métricas y KPIs

### Métricas de Producto
- **Usuarios activos mensuales:** Target 200+
- **Tiempo de uso promedio:** Target 15 min/sesión
- **Tasa de adopción:** Target 80% de atletas registrados
- **Net Promoter Score:** Target > 7

### Métricas de Negocio
- **Reducción de tiempo administrativo:** Target 70%
- **Errores en pagos:** Target < 2%
- **Satisfacción de usuarios:** Target > 85%
- **Tiempo de respuesta a consultas:** Target < 24h

### Métricas Técnicas
- **Uptime:** Target 99.5%
- **Tiempo de carga:** Target < 3s
- **Errores 4xx/5xx:** Target < 1%
- **Performance score:** Target > 80 (Lighthouse)

---

## 🎯 Definición de "Done"

Una funcionalidad se considera completa cuando:

- ✅ **Desarrollo:** Código implementado y probado localmente
- ✅ **Testing:** Unit tests con > 80% coverage
- ✅ **UI/UX:** Interface responsive y accesible
- ✅ **Documentación:** Actualizada en repositorio
- ✅ **Deploy:** Funcional en entorno de producción
- ✅ **Validación:** Aprobada por stakeholders
- ✅ **Training:** Usuarios capacitados en nueva funcionalidad

---

## 🚨 Riesgos y Mitigación

### Riesgos Técnicos
| Riesgo | Probabilidad | Impacto | Mitigación |
|--------|-------------|---------|------------|
| Servidor iPage limitado | Alta | Alto | Plan de migración a mejor hosting |
| Laravel 8 EOL | Media | Alto | Roadmap de upgrade a Laravel 11 |
| Pérdida de datos | Baja | Crítico | Backups automáticos diarios |
| Problemas de rendimiento | Media | Medio | Monitoring y optimización continua |

### Riesgos de Negocio
| Riesgo | Probabilidad | Impacto | Mitigación |
|--------|-------------|---------|------------|
| Resistencia al cambio | Media | Alto | Training y soporte continuo |
| Presupuesto insuficiente | Baja | Alto | Desarrollo por fases priorizadas |
| Competencia | Baja | Medio | Diferenciación por especialización |

---

## 📞 Contactos y Responsabilidades

### Equipo de Desarrollo
- **Product Owner:** Coordinador ASONATA
- **Tech Lead:** Desarrollador Senior Laravel
- **QA:** Tester Manual/Automatizado
- **DevOps:** Administrador de sistemas

### Stakeholders
- **Sponsor Ejecutivo:** Director ASONATA
- **Usuario Clave:** Administradora María González
- **SME Deportivo:** Entrenador Carlos Rodríguez

---

**Firma y Aprobación:**  
Documento aprobado por: [Director ASONATA]  
Fecha de aprobación: 1 de Septiembre de 2025  
Próxima revisión: 1 de Diciembre de 2025
