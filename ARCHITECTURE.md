# Arquitectura de ASONATA

> 📋 **NOTA PARA AGENTES/IA**: Este archivo contiene contexto esencial y debe permanecer en la raíz. 
> Para documentación adicional, scripts o archivos auxiliares, usar la carpeta `docs/` con subcarpetas categorizadas.

## Información General

**Nombre:** ASONATA (Asociación Nacional de Atletismo)
**Framework:** Laravel 8.83.27
**PHP:** 7.4.33 (Desarrollo con Laragon)
**Base de Datos:** MySQL 8.0+ (Desarrollo) / MySQL 5.7+ (Producción)
**Servidor Desarrollo:** Laragon (Windows)
**Servidor Producción:** iPage (Limitaciones: No PHP 8.1+)
**Fecha Última Actualización:** 1 de Septiembre 2025
**Estado del Entorno:** ✅ Configurado y Funcional

## Stack Tecnológico

### Backend
- **Laravel 8.75** - Framework principal
- **PHP 7.3/8.0** - Lenguaje de programación
- **MySQL** - Base de datos principal
- **Composer** - Gestor de dependencias PHP

### Frontend
- **Laravel UI 3.4** - Scaffolding de autenticación
- **Laravel Mix** - Compilación de assets
- **CKEditor 5** - Editor de texto enriquecido
- **Bootstrap** (implícito en Laravel UI)

### Dependencias Principales
```php
"require": {
    "php": "^7.3|^8.0",
    "barryvdh/laravel-dompdf": "^2.0",  // Generación PDF
    "fruitcake/laravel-cors": "^2.0",   // CORS
    "guzzlehttp/guzzle": "^7.0.1",      // HTTP Client
    "laravel/framework": "^8.75",       // Framework
    "laravel/sanctum": "^2.11",         // API Authentication
    "laravel/tinker": "^2.5",           // REPL
    "laravel/ui": "^3.4",               // UI Scaffolding
    "maatwebsite/excel": "^3.1"         // Excel Import/Export
}
```

## Estructura del Proyecto

### Directorio `app/`
```
app/
├── Console/
│   ├── Kernel.php                 // Comandos Artisan
│   └── Commands/                  // Comandos personalizados
├── Exceptions/
│   └── Handler.php                // Manejo de excepciones
├── Exports/
│   ├── ClassAthletsExport.php     // Export atletas por clase
│   └── PaymentsExport.php         // Export de pagos
├── Helpers/
│   └── Helpers.php                // Funciones auxiliares globales
├── Http/
│   ├── Controllers/               // Controladores MVC
│   ├── Middleware/                // Middlewares personalizados
│   ├── Requests/                  // Form Requests para validación
│   └── Kernel.php                 // HTTP Kernel
├── Mail/
│   ├── ContactMail.php            // Email de contacto
│   ├── InscriptionMail.php        // Email de inscripción
│   ├── InscriptionUpdateMail.php  // Email actualización inscripción
│   ├── PaymentMail.php            // Email de pagos
│   └── UserMail.php               // Email de usuarios
├── Models/                        // Modelos Eloquent (ver MODELS.md)
├── Providers/                     // Service Providers
└── View/Components/               // Componentes de vista
```

### Directorio `database/`
```
database/
├── factories/                     // Model Factories
├── migrations/                    // Migraciones de BD
└── seeders/                       // Seeders de datos
```

### Directorio `resources/`
```
resources/
├── css/                          // Estilos CSS
├── js/                           // JavaScript
├── lang/                         // Archivos de idioma
└── views/                        // Vistas Blade
```

### Directorio `public/`
```
public/
├── assets/                       // Assets compilados
├── backend/                      // Assets del panel admin
├── css/                          // CSS público
├── dashtemplate/                 // Template del dashboard
├── datePicker/                   // Componente date picker
├── frontend/                     // Assets del frontend
├── fronttemplate/                // Template del frontend
├── js/                           // JavaScript público
├── media/                        // Archivos de medios
├── dbasonata.sql                 // BD de respaldo
├── favicon.ico
├── index.php                     // Punto de entrada
└── robots.txt
```

## Patrones de Arquitectura

### MVC (Model-View-Controller)
- **Models:** Representan las entidades de negocio y datos
- **Views:** Templates Blade para presentación
- **Controllers:** Lógica de aplicación y coordinación

### Repository Pattern (Implícito en Eloquent)
- Modelos Eloquent actúan como repositorios
- Relationships definidas en modelos
- Query Scopes para consultas complejas

### Service Layer (Parcial)
- Lógica compleja en Services (a implementar)
- Mail services para notificaciones
- Export services para reportes

## Módulos Funcionales

### 1. Gestión de Atletas
- **Modelos:** `Atleta.php`
- **Funcionalidad:** CRUD, categorización, seguimiento

### 2. Sistema de Inscripciones  
- **Modelos:** `Inscription.php`
- **Funcionalidad:** Registro de atletas en competencias

### 3. Gestión de Pagos
- **Modelos:** `Payment.php`
- **Funcionalidad:** Control financiero, reportes

### 4. Sistema de Clases/Categorías
- **Modelos:** `Classs.php`, `Category.php`
- **Funcionalidad:** Organización por edades/niveles

### 5. Gestión de Equipos
- **Modelos:** `Team.php`, `TeamMember.php`
- **Funcionalidad:** Equipos y membresías

### 6. Control de Asistencia
- **Modelos:** `Assist.php`, `Attendance.php`
- **Funcionalidad:** Registro de asistencias

### 7. Programación y Horarios
- **Modelos:** `Schedule.php`, `Cycle.php`
- **Funcionalidad:** Calendario de actividades

### 8. Gestión de Instalaciones
- **Modelos:** `Facility.php`
- **Funcionalidad:** Espacios y recursos

### 9. Sistema de Contenidos
- **Modelos:** `Noticia.php`, `Slide.php`
- **Funcionalidad:** CMS básico

### 10. Gestión de Usuarios
- **Modelos:** `User.php`
- **Funcionalidad:** Autenticación, autorización

## Configuración y Entorno

### Variables de Entorno Clave
```env
APP_NAME=Asonata
APP_ENV=production
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=asonata
MAIL_MAILER=smtp
```

### Rutas Principales
- **Web:** `routes/web.php` - Rutas web principales
- **API:** `routes/api.php` - Endpoints API
- **Console:** `routes/console.php` - Comandos Artisan

## Limitaciones Técnicas Actuales

### Servidor de Producción (iPage)
- ❌ No soporta PHP 8.1+
- ❌ No puede usar Laravel Boost
- ❌ Limitaciones de recursos
- ✅ MySQL disponible
- ✅ Composer funcional

### Framework
- ❌ Laravel 8 (EOL se acerca)
- ❌ Dependencias desactualizadas
- ❌ Vulnerabilidades de seguridad potenciales

## Próximas Mejoras Sugeridas

1. **Documentación Completa**
   - Completar MODELS.md
   - Crear API.md
   - Documentar workflows

2. **Testing**
   - Implementar PHPUnit tests
   - Coverage reports
   - CI/CD pipeline

3. **Optimización**
   - Query optimization
   - Cache implementation
   - Asset minification

4. **Migración Futura**
   - Plan de upgrade a Laravel 10/11
   - Migración a servidor compatible
   - Modernización del stack
