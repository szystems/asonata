# Modelos de Datos - ASONATA

> 📋 **NOTA PARA AGENTES/IA**: Este archivo contiene contexto esencial sobre modelos de datos y debe permanecer en la raíz. 
> Para documentación adicional, scripts o archivos auxiliares, usar la carpeta `docs/` con subcarpetas categorizadas.

**Fecha de Documentación:** 1 de Septiembre de 2025
**Framework:** Laravel 8.83.27
**ORM:** Eloquent
**Entorno:** Desarrollo con Laragon + PHP 7.4.33

## 🗃️ Resumen de Modelos

Total de modelos: **15 modelos principales**
Patrón utilizado: **Active Record (Eloquent)**
Convenciones: **Laravel Standards**

---

## 👨‍🏃‍♂️ Atleta (`App\Models\Atleta`)

### Propósito
Representa a los atletas registrados en la asociación.

### Campos Principales
```php
// Información Personal
- id (PK)
- nombre
- apellidos  
- fecha_nacimiento
- genero
- documento_identidad
- telefono
- email

// Información Deportiva
- categoria_id (FK)
- clase_id (FK)
- fecha_registro
- estado (activo/inactivo)

// Timestamps
- created_at
- updated_at
```

### Relaciones
```php
// Pertenece a una categoría
belongsTo(Category::class)

// Pertenece a una clase
belongsTo(Classs::class)

// Tiene muchas inscripciones
hasMany(Inscription::class)

// Tiene muchas asistencias
hasMany(Attendance::class)

// Puede pertenecer a equipos
belongsToMany(Team::class)
```

---

## 📝 Inscription (`App\Models\Inscription`)

### Propósito
Gestiona las inscripciones de atletas a competencias o actividades.

### Campos Principales
```php
- id (PK)
- atleta_id (FK)
- competencia
- fecha_inscripcion
- estado_inscripcion
- observaciones
- costo
- pagado (boolean)
- created_at
- updated_at
```

### Relaciones
```php
// Pertenece a un atleta
belongsTo(Atleta::class)

// Puede tener pagos asociados
hasMany(Payment::class)
```

---

## 💰 Payment (`App\Models\Payment`)

### Propósito
Control financiero de pagos de inscripciones y cuotas.

### Campos Principales
```php
- id (PK)
- atleta_id (FK)
- inscription_id (FK)
- monto
- fecha_pago
- metodo_pago
- referencia
- estado_pago
- descripcion
- created_at
- updated_at
```

### Relaciones
```php
// Pertenece a un atleta
belongsTo(Atleta::class)

// Puede pertenecer a una inscripción
belongsTo(Inscription::class)
```

---

## 🏷️ Category (`App\Models\Category`)

### Propósito
Categorización de atletas por rangos de edad o nivel.

### Campos Principales
```php
- id (PK)
- nombre
- descripcion
- edad_minima
- edad_maxima
- activo
- created_at
- updated_at
```

### Relaciones
```php
// Tiene muchos atletas
hasMany(Atleta::class)

// Puede tener clases asociadas
hasMany(Classs::class)
```

---

## 📚 Classs (`App\Models\Classs`)

### Propósito
Clases o grupos específicos de entrenamiento.

### Campos Principales
```php
- id (PK)
- nombre
- descripcion
- categoria_id (FK)
- horario
- capacidad_maxima
- activo
- created_at
- updated_at
```

### Relaciones
```php
// Pertenece a una categoría
belongsTo(Category::class)

// Tiene muchos atletas
hasMany(Atleta::class)

// Tiene horarios
hasMany(Schedule::class)
```

---

## 🏃‍♂️ Team (`App\Models\Team`)

### Propósito
Gestión de equipos deportivos.

### Campos Principales
```php
- id (PK)
- nombre
- descripcion
- categoria
- entrenador
- activo
- created_at
- updated_at
```

### Relaciones
```php
// Tiene muchos miembros
hasMany(TeamMember::class)

// Atletas a través de TeamMember
hasManyThrough(Atleta::class, TeamMember::class)
```

---

## 👥 TeamMember (`App\Models\TeamMember`)

### Propósito
Tabla pivote que relaciona atletas con equipos.

### Campos Principales
```php
- id (PK)
- team_id (FK)
- atleta_id (FK)
- posicion
- fecha_ingreso
- estado
- created_at
- updated_at
```

### Relaciones
```php
// Pertenece a un equipo
belongsTo(Team::class)

// Pertenece a un atleta
belongsTo(Atleta::class)
```

---

## 📅 Schedule (`App\Models\Schedule`)

### Propósito
Programación de horarios y actividades.

### Campos Principales
```php
- id (PK)
- clase_id (FK)
- dia_semana
- hora_inicio
- hora_fin
- facility_id (FK)
- activo
- created_at
- updated_at
```

### Relaciones
```php
// Pertenece a una clase
belongsTo(Classs::class)

// Se realiza en una instalación
belongsTo(Facility::class)
```

---

## 🏢 Facility (`App\Models\Facility`)

### Propósito
Gestión de instalaciones y espacios deportivos.

### Campos Principales
```php
- id (PK)
- nombre
- descripcion
- capacidad
- tipo_instalacion
- disponible
- ubicacion
- created_at
- updated_at
```

### Relaciones
```php
// Tiene muchos horarios
hasMany(Schedule::class)

// Puede tener equipos asignados
hasMany(Team::class)
```

---

## ✅ Attendance (`App\Models\Attendance`)

### Propósito
Control de asistencias de atletas a entrenamientos.

### Campos Principales
```php
- id (PK)
- atleta_id (FK)
- clase_id (FK)
- fecha
- presente (boolean)
- observaciones
- created_at
- updated_at
```

### Relaciones
```php
// Pertenece a un atleta
belongsTo(Atleta::class)

// Pertenece a una clase
belongsTo(Classs::class)
```

---

## 🎯 Assist (`App\Models\Assist`)

### Propósito
Modelo alternativo/complementario para asistencias.

### Campos Principales
```php
- id (PK)
- atleta_id (FK)
- actividad
- fecha_asistencia
- estado
- created_at
- updated_at
```

### Relaciones
```php
// Pertenece a un atleta
belongsTo(Atleta::class)
```

---

## 📰 Noticia (`App\Models\Noticia`)

### Propósito
Sistema de noticias y contenido informativo.

### Campos Principales
```php
- id (PK)
- titulo
- contenido
- imagen
- publicado
- fecha_publicacion
- autor_id (FK)
- created_at
- updated_at
```

### Relaciones
```php
// Pertenece a un autor (usuario)
belongsTo(User::class, 'autor_id')
```

---

## 🖼️ Slide (`App\Models\Slide`)

### Propósito
Gestión de slides para carrusel o galería.

### Campos Principales
```php
- id (PK)
- titulo
- descripcion
- imagen
- enlace
- orden
- activo
- created_at
- updated_at
```

---

## 🔧 Config (`App\Models\Config`)

### Propósito
Configuraciones globales de la aplicación.

### Campos Principales
```php
- id (PK)
- clave
- valor
- descripcion
- tipo
- created_at
- updated_at
```

---

## 🔄 Cycle (`App\Models\Cycle`)

### Propósito
Gestión de ciclos deportivos o períodos académicos.

### Campos Principales
```php
- id (PK)
- nombre
- fecha_inicio
- fecha_fin
- activo
- descripcion
- created_at
- updated_at
```

---

## 📋 Secction (`App\Models\Secction`)

### Propósito
Secciones organizacionales o divisiones.

### Campos Principales
```php
- id (PK)
- nombre
- descripcion
- responsable
- activo
- created_at
- updated_at
```

---

## 👤 User (`App\Models\User`)

### Propósito
Usuarios del sistema (administradores, entrenadores, etc.)

### Campos Principales
```php
- id (PK)
- name
- email
- email_verified_at
- password
- remember_token
- created_at
- updated_at
```

### Relaciones
```php
// Puede tener muchas noticias
hasMany(Noticia::class, 'autor_id')
```

---

## 🔗 Mapa de Relaciones

```
User (1) -----> (*) Noticia

Category (1) -----> (*) Atleta
Category (1) -----> (*) Classs

Classs (1) -----> (*) Atleta
Classs (1) -----> (*) Schedule
Classs (1) -----> (*) Attendance

Atleta (1) -----> (*) Inscription
Atleta (1) -----> (*) Payment
Atleta (1) -----> (*) Attendance
Atleta (1) -----> (*) Assist

Team (1) -----> (*) TeamMember
Atleta (1) -----> (*) TeamMember

Facility (1) -----> (*) Schedule

Inscription (1) -----> (*) Payment
```

---

## 📊 Estadísticas de Modelos

- **Modelos con Timestamps:** 15/15 (100%)
- **Modelos con SoftDeletes:** 0/15 (0%)
- **Modelos con Relaciones:** 12/15 (80%)
- **Tablas Pivote:** 1 (TeamMember)
- **Modelos de Configuración:** 2 (Config, Secction)

---

## 🚨 Recomendaciones

### Mejoras Sugeridas
1. **Implementar SoftDeletes** en modelos críticos
2. **Agregar índices** en claves foráneas
3. **Validaciones de modelo** más robustas
4. **Scopes** para consultas comunes
5. **Accessors/Mutators** para formateo de datos
6. **Model Events** para auditoría

### Patrones a Implementar
1. **Repository Pattern** para consultas complejas
2. **Service Layer** para lógica de negocio
3. **Observer Pattern** para eventos de modelo
4. **Factory Pattern** para testing
