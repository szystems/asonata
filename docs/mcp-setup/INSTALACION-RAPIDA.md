# 🚀 INSTALACIÓN MCP - GUÍA RÁPIDA PARA CLAUDE SONNET

**Tu proyecto ASONATA está 100% listo para MCP. Sigue estos pasos:**

---

## ✅ ESTADO ACTUAL (CONFIRMADO)
- ✅ **Proyecto Laravel válido**: Estructura completa verificada
- ✅ **Documentación AI completa**: 6/6 archivos para contexto perfecto  
- ✅ **Herramientas instaladas**: Node.js v20.19.2, Python 3.13.3, Git 2.51
- ✅ **Permisos OK**: Escritura y lectura confirmados

---

## 🎯 INSTALACIÓN EN 3 PASOS

### **PASO 1: Instalar MCP Servers (2 minutos)**
Abrir **PowerShell como Administrador** y ejecutar:

```powershell
# Instalar MCP Filesystem (ESENCIAL)
npm install -g @modelcontextprotocol/server-filesystem

# Instalar GitHub MCP (RECOMENDADO)  
npm install -g @0xshariq/github-mcp-server

# Opcional: Extended Memory para contexto persistente
npm install -g @ssmirnovpro/extended-memory-mcp
```

### **PASO 2: Configurar Claude Desktop (1 minuto)**
Crear archivo: `%APPDATA%\Claude\claude_desktop_config.json`

```json
{
  "mcpServers": {
    "filesystem_asonata": {
      "command": "npx",
      "args": [
        "@modelcontextprotocol/server-filesystem", 
        "C:\\Users\\szott\\Dropbox\\Desarrollo\\asonata"
      ]
    },
    "github_integration": {
      "command": "npx",
      "args": ["@0xshariq/github-mcp-server"],
      "env": {
        "GITHUB_PERSONAL_ACCESS_TOKEN": "TU_TOKEN_AQUI",
        "GITHUB_REPO_OWNER": "szystems",
        "GITHUB_REPO_NAME": "asonata"
      }
    }
  }
}
```

### **PASO 3: GitHub Token (30 segundos)**
1. Ve a: https://github.com/settings/tokens
2. "Generate new token (classic)"
3. Seleccionar: `repo` (Full control of repositories)
4. Copiar token y reemplazar `"TU_TOKEN_AQUI"` en el config

---

## ⚡ INSTALACIÓN AUTOMÁTICA (ALTERNATIVA)

**Opción más fácil:** Ejecutar el script automático:

1. Abrir **cmd como Administrador**
2. Navegar al proyecto: `cd "C:\Users\szott\Dropbox\Desarrollo\asonata"`
3. Ejecutar: `install-mcp.bat`

El script instala todo automáticamente y crea la configuración.

---

## 🧪 VERIFICACIÓN FINAL

Después de la instalación:

1. **Reiniciar Claude Desktop**
2. **Probar con este prompt:**

```
CONTEXTO: ASONATA - Proyecto Laravel 8

Soy Claude Sonnet trabajando en ASONATA, un sistema de administración deportiva.

VERIFICACIÓN MCP:
1. ¿Puedes acceder a los archivos del proyecto usando filesystem MCP?
2. ¿Puedes leer el archivo ARCHITECTURE.md?
3. ¿Puedes mostrar la estructura del directorio app/Models/?

Si todo funciona, confirma que tienes acceso completo y dime:
"🚀 MCP configurado correctamente. ¿En qué tarea del proyecto ASONATA quieres que me enfoque?"
```

---

## 🎯 PRIMEROS COMANDOS RECOMENDADOS

Una vez que Claude confirme acceso MCP, prueba:

### **Análisis Inicial del Proyecto**
```
"Carga el contexto completo del proyecto ASONATA. Lee ARCHITECTURE.md, ESTADO_ACTUAL.md, MODELS.md y PRD.md. Después dame un resumen ejecutivo del estado actual y las 5 prioridades más críticas."
```

### **Análisis de Código Específico**  
```
"Analiza todos los modelos en app/Models/ y compáralos con la documentación en MODELS.md. Identifica inconsistencias y problemas críticos."
```

### **Desarrollo de Nueva Feature**
```
"Quiero desarrollar [funcionalidad específica]. Analiza el impacto en el sistema, propón la implementación completa siguiendo los patrones del proyecto."
```

---

## 🔧 CONFIGURACIONES AVANZADAS (OPCIONALES)

### Para MySQL Access
Si quieres que Claude tenga acceso directo a tu BD:

```json
"mysql_context": {
  "command": "python",
  "args": ["path/to/mysql_mcp_server.py"],
  "env": {
    "MYSQL_HOST": "localhost",
    "MYSQL_USER": "root",
    "MYSQL_PASSWORD": "",
    "MYSQL_DATABASE": "asonata"
  }
}
```

### Para Memory Persistente
```json
"extended_memory": {
  "command": "npx", 
  "args": ["@ssmirnovpro/extended-memory-mcp"],
  "env": {
    "PROJECT_NAME": "ASONATA"
  }
}
```

---

## 🚨 TROUBLESHOOTING

### **Error: Claude no ve los archivos**
- Verificar que Claude Desktop esté reiniciado
- Comprobar ruta del proyecto en claude_desktop_config.json
- Verificar permisos de la carpeta

### **Error: GitHub MCP no funciona**
- Verificar que el token tenga permisos `repo`  
- Comprobar que owner/repo sean correctos
- Probar sin GitHub MCP primero (solo filesystem)

### **Error: MCP server not found**
- Ejecutar: `npm list -g` para verificar instalación
- Reinstalar: `npm install -g @modelcontextprotocol/server-filesystem`
- Verificar Node.js version (mínimo v18)

---

## 🎉 RESULTADO FINAL

Con esta configuración tendrás:

✅ **Claude con acceso completo** a todos los archivos del proyecto  
✅ **Contexto perfecto** con documentación especializada para AI  
✅ **GitHub integration** para ver commits, issues, etc.  
✅ **Prompts optimizados** para desarrollo eficiente  
✅ **Memoria persistente** entre sesiones (si instalaste extended-memory)  

**¡Tu workflow con Claude Sonnet será increíblemente fluido y preciso!**

---

## 💡 TIPS FINALES

1. **Usa los prompts** de `CLAUDE-PROMPTS.md` - están optimizados específicamente
2. **Siempre inicia sesiones** con el prompt de contexto completo  
3. **Aprovecha la documentación** - Claude tendrá contexto perfecto del proyecto
4. **Memoria persistente** - Claude recordará conversaciones anteriores
5. **GitHub context** - Claude puede ver el historial y estado del repo

**¿Listo para instalar y empezar a trabajar de manera súper eficiente con Claude Sonnet?**
