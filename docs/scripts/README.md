# Scripts de Mantenimiento

Este directorio contiene scripts útiles para el mantenimiento del proyecto.

## Scripts Disponibles

### clean-duplicates.ps1

Script de PowerShell que limpia archivos duplicados, vacíos y temporales del proyecto.

**Uso:**
```powershell
# Desde la raíz del proyecto
powershell -ExecutionPolicy Bypass -File docs/scripts/clean-duplicates.ps1
```

**Funciones:**
- ✅ Detecta y elimina archivos vacíos (excepto .gitkeep)
- ✅ Busca archivos duplicados por patrones comunes (_copy, .bak, .tmp, etc.)
- ✅ Verifica el estado del repositorio Git
- ✅ Identifica archivos no rastreados
- ✅ Confirmación interactiva antes de eliminar

**Patrones de archivos detectados:**
- `*_copy*`, `*-copy*`, `*.copy`
- `*.duplicate`
- `*~`, `*.bak`, `*.backup`
- `*.orig`, `*.tmp`, `*.temp`

## Prevención de Problemas

Para evitar que aparezcan archivos duplicados:

1. **Siempre usar Git correctamente:**
   ```bash
   git status          # Verificar antes de hacer cambios
   git add .           # Agregar archivos
   git commit -m "..."  # Hacer commit
   ```

2. **Limpiar archivos no rastreados:**
   ```bash
   git clean -fd       # Eliminar archivos no rastreados
   ```

3. **Verificar .gitignore está actualizado**

4. **Ejecutar el script de limpieza regularmente**
