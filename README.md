# README — Sistema de Login y Registro con Roles en Laravel 13

## 📌 Descripción del Proyecto

Este proyecto es un sistema completo de:

- Registro
- Login
- Logout
- Roles
- Middleware
- Protección de rutas
- Remember Me
- ENUM para roles
- Dashboards separados
- Home pública
- Errores personalizados
- Recuperación de contraseña
- Envío de correos con Mailtrap

desarrollado completamente:

✅ desde cero  
✅ sin starter kits  
✅ sin Breeze  
✅ sin Jetstream  
✅ sin paquetes externos

Todo fue construido manualmente para aprender cómo funciona realmente la autenticación en Laravel 13.

---

# 🎯 Objetivo del Proyecto

El objetivo fue aprender:

- cómo funciona Laravel internamente
- cómo crear autenticación manual
- cómo proteger rutas
- cómo manejar sesiones
- cómo funcionan los middleware
- cómo trabajar con Blade
- cómo separar usuarios por roles
- cómo organizar un proyecto correctamente
- cómo funciona recuperación de contraseña
- cómo funciona el envío de correos SMTP

---

# 🛠 Tecnologías Utilizadas

- PHP 8+
- Laravel 13
- Blade
- Bootstrap 5 (CDN)
- MySQL
- Composer
- Mailtrap

---

# 📂 Estructura General del Proyecto

```text
app/
│
├── Enums/
│   └── RoleEnum.php
│
├── Http/
│   ├── Controllers/
│   │   └── AuthController.php
│   │
│   └── Middleware/
│       ├── AuthMiddleware.php
│       ├── GuestMiddleware.php
│       └── RoleMiddleware.php
│
resources/
│
├── views/
│   ├── auth/
│   │   ├── login.blade.php
│   │   ├── register.blade.php
│   │   ├── forgot-password.blade.php
│   │   └── reset-password.blade.php
│   │
│   ├── cliente/
│   │   └── dashboard.blade.php
│   │
│   ├── productor/
│   │   └── dashboard.blade.php
│   │
│   ├── errors/
│   │   ├── 403.blade.php
│   │   └── 404.blade.php
│   │
│   ├── layouts/
│   │   └── app.blade.php
│   │
│   └── welcome.blade.php
│
routes/
│   └── web.php
```

---

# 📚 FASE 1 — Crear Proyecto Laravel

## Crear proyecto

```bash
composer create-project laravel/laravel register-login
```

---

# 📚 FASE 2 — Configurar Base de Datos

Editar:

```text
.env
```

Ejemplo:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=register_login
DB_USERNAME=root
DB_PASSWORD=
```

---

# Ejecutar migraciones

```bash
php artisan migrate
```

---

# 📚 FASE 3 — Agregar Campo Role

## Crear migración

```bash
php artisan make:migration add_role_to_users_table
```

---

# Agregar columna

```php
$table->string('role');
```

---

# Ejecutar migración

```bash
php artisan migrate
```

---

# 📚 FASE 4 — Configurar Modelo User

Archivo:

```text
app/Models/User.php
```

## Agregar Fillable

```php
#[Fillable(['name', 'email', 'password', 'role'])]
```

---

# 📚 FASE 5 — Crear AuthController

## Crear controlador

```bash
php artisan make:controller AuthController
```

---

# Funciones creadas

- showRegister()
- register()
- showLogin()
- login()
- logout()

---

# 📚 FASE 6 — Crear Formularios Blade

## Login

Archivo:

```text
resources/views/auth/login.blade.php
```

---

## Registro

Archivo:

```text
resources/views/auth/register.blade.php
```

---

# 📚 FASE 7 — Crear Middleware

## Middleware Auth

Protege rutas privadas.

```bash
php artisan make:middleware AuthMiddleware
```

---

## Middleware Guest

Evita entrar a login/register si ya hay sesión.

```bash
php artisan make:middleware GuestMiddleware
```

---

## Middleware Role

Protege dashboards por rol.

```bash
php artisan make:middleware RoleMiddleware
```

---

# 📚 FASE 8 — Remember Me

## Objetivo

Mantener sesión iniciada incluso cerrando navegador.

---

# Agregar checkbox

```blade
<input type="checkbox" name="remember">
```

---

# En login()

```php
$remember = $request->has('remember');

Auth::attempt($credentials, $remember);
```

---

# 📚 FASE 9 — ENUM para Roles

## Crear carpeta

```text
app/Enums
```

---

# Crear ENUM

Archivo:

```text
app/Enums/RoleEnum.php
```

---

# Código

```php
enum RoleEnum: string
{
    case CLIENTE = 'cliente';

    case PRODUCTOR = 'productor';
}
```

---

# Beneficios

✅ evita errores  
✅ más profesional  
✅ más limpio  
✅ más mantenible

---

# 📚 FASE 10 — Dashboard Automático

## Nueva ruta

```text
/dashboard
```

---

# Función

Detecta automáticamente:

- cliente
- productor

y redirige al dashboard correcto.

---

# Beneficio

Centralizar lógica.

---

# 📚 FASE 11 — Home Pública

Archivo:

```text
resources/views/welcome.blade.php
```

---

# Funciones

## Si NO hay login

Mostrar:

- Login
- Registro

---

## Si SÍ hay login

Mostrar:

- Dashboard
- Logout
- Nombre usuario

---

# 📚 FASE 12 — Dashboards Dinámicos

Mostrar:

```blade
{{ Auth::user()->name }}
```

---

# Resultado

```text
Bienvenido Moises
```

---

# 📚 FASE 13 — Error 403 Personalizado

Archivo:

```text
resources/views/errors/403.blade.php
```

---

# Función

Mostrar página bonita cuando usuario intenta entrar donde no debe.

---

# Ejemplo

Cliente entrando a:

```text
/productor/dashboard
```

---

# 📚 FASE 14 — Error 404 Personalizado

Archivo:

```text
resources/views/errors/404.blade.php
```

---

# Función

Mostrar página bonita cuando ruta no existe.

---

# 📚 FASE 15 — Navbar Profesional

Archivo:

```text
resources/views/layouts/app.blade.php
```

---

# Funciones

## Usuario NO autenticado

Mostrar:

- Inicio
- Login
- Registro

---

## Usuario autenticado

Mostrar:

- Dashboard
- Nombre usuario
- Logout

---

# 📚 FASE 16 — Recuperar Contraseña

## Objetivo

Permitir que un usuario pueda recuperar su contraseña mediante correo electrónico.

Laravel ya trae internamente gran parte del sistema preparado.

En este proyecto se implementó manualmente para comprender cómo funciona realmente.

---

# Nuevas vistas agregadas

```text
resources/views/auth/forgot-password.blade.php
```

```text
resources/views/auth/reset-password.blade.php
```

---

# Nuevas funcionalidades

✅ recuperar contraseña  
✅ generar token seguro  
✅ envío de correo  
✅ formulario nueva contraseña  
✅ actualización segura contraseña

---

# Configuración SMTP

Se utilizó Mailtrap para pruebas locales.

---

# Variables agregadas al .env

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=TU_USERNAME
MAIL_PASSWORD=TU_PASSWORD
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="test@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

# Flujo recuperación contraseña

```text
Usuario
↓
/forgot-password
↓
Ingresa correo
↓
Laravel genera token
↓
Correo enviado
↓
Usuario abre enlace
↓
/reset-password/{token}
↓
Nueva contraseña
↓
Contraseña actualizada
↓
Login nuevamente
```

---

# Tabla utilizada

Laravel utiliza:

```text
password_reset_tokens
```

---

# Seguridad implementada

✅ token temporal  
✅ validación email  
✅ confirmación contraseña  
✅ token seguro Laravel  
✅ contraseña encriptada  
✅ middleware guest

---

# 📚 Middleware Utilizados

| Middleware | Función |
|---|---|
| auth.custom | proteger rutas privadas |
| guest.custom | evitar login/register si ya autenticado |
| role | proteger rutas por rol |

---

# 📚 Roles del Sistema

| Rol | Función |
|---|---|
| cliente | acceder dashboard cliente |
| productor | acceder dashboard productor |

---

# 📚 Seguridad Implementada

✅ protección rutas  
✅ middleware auth  
✅ middleware guest  
✅ middleware role  
✅ validaciones  
✅ remember me  
✅ sesiones  
✅ password hashing automático Laravel 13  
✅ recuperación de contraseña  
✅ tokens temporales  
✅ envío de correos SMTP

---

# 📚 Password Hashing

Laravel 13 ya incluye:

```php
'password' => 'hashed'
```

---

# Esto significa

Laravel automáticamente:

✅ encripta contraseña  
✅ usa hashing seguro  
✅ NO guarda texto plano

---

# 📚 Sistema de Rutas

## Públicas

```text
/
```

```text
/login
```

```text
/register
```

```text
/forgot-password
```

```text
/reset-password/{token}
```

---

# Privadas

```text
/dashboard
```

```text
/cliente/dashboard
```

```text
/productor/dashboard
```

---

# 📚 Flujo Completo del Sistema

## Registro

```text
Usuario
↓
Formulario registro
↓
Validación
↓
Crear usuario
↓
Login automático
↓
/dashboard
↓
Dashboard según rol
```

---

# Login

```text
Usuario
↓
Formulario login
↓
Validación
↓
Auth::attempt()
↓
Sesión iniciada
↓
/dashboard
↓
Dashboard correcto
```

---

# Recuperar contraseña

```text
Usuario
↓
Olvidó contraseña
↓
/forgot-password
↓
Correo recuperación
↓
Token temporal
↓
Nueva contraseña
↓
Login nuevamente
```

---

# 📚 Clonar Proyecto desde GitHub

# 🔥 PASO 1 — Clonar repositorio

```bash
git clone https://github.com/MoisesOsorioD/register-login.git
```

---

# 🔥 PASO 2 — Entrar al proyecto

```bash
cd register-login
```

---

# 🔥 PASO 3 — Instalar dependencias

```bash
composer install
```

---

# 🔥 PASO 4 — Crear archivo .env

```bash
cp .env.example .env
```

---

# 🔥 PASO 5 — Generar APP_KEY

```bash
php artisan key:generate
```

---

# 🔥 PASO 6 — Configurar Base de Datos

Editar:

```text
.env
```

---

# 🔥 PASO 7 — Configurar Mailtrap

Agregar en `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=TU_USERNAME
MAIL_PASSWORD=TU_PASSWORD
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="test@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

# 🔥 PASO 8 — Ejecutar migraciones

```bash
php artisan migrate
```

---

# 🔥 PASO 9 — Levantar servidor

```bash
php artisan serve
```

---

# Abrir navegador

```text
http://127.0.0.1:8000
```

---

# 📚 Lo Aprendido en Este Proyecto

✅ autenticación manual  
✅ sesiones  
✅ middleware  
✅ roles  
✅ rutas protegidas  
✅ Blade  
✅ Bootstrap  
✅ ENUM  
✅ validaciones  
✅ arquitectura básica Laravel  
✅ organización proyecto  
✅ navegación  
✅ errores personalizados  
✅ remember me  
✅ dashboards dinámicos  
✅ recuperación de contraseña  
✅ envío de correos SMTP  
✅ Mailtrap  
✅ tokens temporales

---

# 📚 Resultado Final

Este proyecto terminó siendo un sistema completo de autenticación con roles hecho manualmente desde cero en Laravel 13.

El objetivo principal NO fue solo “hacer login”.

El verdadero objetivo fue comprender:

- cómo Laravel maneja autenticación
- cómo funcionan las sesiones
- cómo proteger rutas
- cómo funcionan los middleware
- cómo separar usuarios por roles
- cómo estructurar correctamente un proyecto Laravel
- cómo funciona recuperación de contraseña
- cómo funciona envío de correos SMTP

---