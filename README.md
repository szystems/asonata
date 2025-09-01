# ASONATA - Sistema de Gestión Deportiva

![Laravel](https://img.shields.io/badge/Laravel-8.83.27-red.svg)
![PHP](https://img.shields.io/badge/PHP-7.4.33-blue.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)
![Status](https://img.shields.io/badge/Status-Desarrollo_Activo-green.svg)
![Environment](https://img.shields.io/badge/Environment-Laragon-purple.svg)

**Sistema de Gestión Deportiva para Asociaciones de Atletismo**

---

## 📋 Descripción

ASONATA es una aplicación web desarrollada en Laravel 8 para la gestión integral de asociaciones deportivas de atletismo. Permite administrar atletas, inscripciones, pagos, equipos, horarios y comunicaciones de manera eficiente y centralizada.

### 🎯 Funcionalidades Principales

- 👥 **Gestión de Atletas** - CRUD completo con categorización automática
- 📝 **Sistema de Inscripciones** - Registro a competencias con notificaciones
- 💰 **Control Financiero** - Gestión de pagos y reportes
- 🏃‍♂️ **Gestión de Equipos** - Organización por categorías y niveles
- 📅 **Control de Asistencia** - Registro y seguimiento de entrenamientos
- 📧 **Comunicaciones** - Emails automáticos y sistema de noticias
- 📊 **Reportes** - Exportación a Excel y PDF

- 📊 **Reportes** - Exportación a Excel y PDF

---

## � Estructura de Documentación

⚠️ **IMPORTANTE PARA AGENTES/IA**: 
- **Archivos de contexto esenciales** deben permanecer en la raíz: `ARCHITECTURE.md`, `PRD.md`, `MODELS.md`, `ESTADO_ACTUAL.md`
- **Documentación adicional, scripts y archivos auxiliares** deben crearse en la carpeta `docs/` con la siguiente estructura:
  - `docs/mcp-setup/` - Configuraciones MCP y IA
  - `docs/scripts/` - Scripts de automatización
  - `docs/database-backups/` - Respaldos de BD
  - `docs/workflows/` - Flujos de trabajo
  - `docs/guides/` - Guías adicionales
  - `docs/testing/` - Documentación de pruebas

Ver `docs/README.md` para más detalles sobre la organización.

---

## �🛠️ Tecnologías

### Backend
- **Laravel 8.83.27** - Framework PHP (Actualizada)
- **MySQL 8.0+** - Base de datos (Desarrollo)
- **PHP 7.4.33** - Lenguaje de programación (Desarrollo)
- **Laragon** - Entorno de desarrollo local

### Frontend
- **Laravel UI 3.4** - Scaffolding de autenticación
- **Bootstrap** - Framework CSS
- **Laravel Mix** - Compilación de assets
- **CKEditor 5** - Editor de texto enriquecido

### Dependencias Clave
- `laravel/sanctum` - Autenticación API
- `maatwebsite/excel` - Exportación Excel
- `barryvdh/laravel-dompdf` - Generación PDF
- `guzzlehttp/guzzle` - Cliente HTTP

---

## ⚙️ Instalación

### Prerrequisitos

```bash
PHP >= 7.3
Composer
MySQL >= 5.7
Node.js & npm (para assets)
```

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/szystems/asonata.git
cd asonata
```

2. **Instalar dependencias PHP**
```bash
composer install
```

3. **Instalar dependencias JavaScript**
```bash
npm install
```

4. **Configurar entorno**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurar base de datos**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=asonata
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

6. **Migrar base de datos**
```bash
php artisan migrate
```

7. **Compilar assets**
```bash
npm run dev
# O para producción:
npm run prod
```

8. **Iniciar servidor**
```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

---

## 📊 Documentación Técnica

### Documentos Principales
- [ARCHITECTURE.md](ARCHITECTURE.md) - Arquitectura técnica completa
- [MODELS.md](MODELS.md) - Documentación de modelos y relaciones  
- [PRD.md](PRD.md) - Product Requirements Document
- [ESTADO_ACTUAL.md](ESTADO_ACTUAL.md) - Estado actual del proyecto
- [mcp-setup-guide.md](mcp-setup-guide.md) - Configuración para agentes IA

### Modelos Principales
- `Atleta` - Gestión de atletas registrados
- `Inscription` - Inscripciones a competencias
- `Payment` - Control de pagos
- `Team` - Gestión de equipos
- `User` - Usuarios del sistema

---

## 🚀 Comandos Útiles

```bash
# Desarrollo
php artisan serve
npm run dev
npm run watch

# Base de datos
php artisan migrate
php artisan migrate:fresh --seed
php artisan tinker

# Producción
npm run prod
php artisan config:cache
php artisan route:cache
composer install --optimize-autoloader --no-dev
```

---

## 🤖 Configuración para Agentes IA

Este proyecto incluye documentación completa para trabajar con agentes de IA mediante herramientas MCP (Model Context Protocol). Ver [mcp-setup-guide.md](mcp-setup-guide.md) para configuración detallada.

### Contexto Completo Disponible
- ✅ Arquitectura técnica documentada
- ✅ Modelos y relaciones mapeados
- ✅ Estado actual analizado
- ✅ Requerimientos de producto definidos
- ✅ Estructura de archivos completa

---

## 📈 Estado del Proyecto

- **Funcionalidad:** 8/10 ✅ Operativo
- **Mantenibilidad:** 5/10 ⚠️ Requiere mejoras
- **Seguridad:** 4/10 ❌ Necesita atención
- **Testing:** 1/10 ❌ Crítico
- **Documentación:** 8/10 ✅ Completa

---

## 🤝 Contribuir

1. Fork del repositorio
2. Crear rama: `git checkout -b feature/nueva-funcionalidad`
3. Commit: `git commit -am 'Add nueva funcionalidad'`
4. Push: `git push origin feature/nueva-funcionalidad`
5. Crear Pull Request

---

## 📄 Licencia

Proyecto propiedad de ASONATA - Asociación Nacional de Atletismo.
Todos los derechos reservados.

---

*Última actualización: Septiembre 2025*

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
