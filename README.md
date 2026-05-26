# Sistema de Login y Registro con Roles en Laravel 13

## 📖 Descripción del Proyecto

Este proyecto fue creado con el objetivo de aprender desde cero cómo funciona un sistema de autenticación real en Laravel 13 sin usar ningún starter kit como Breeze o Jetstream.

La idea principal fue entender todo manualmente:

* cómo funciona el registro
* cómo funciona el login
* cómo funcionan las sesiones
* cómo funcionan los roles
* cómo proteger rutas
* cómo funciona Blade
* cómo funcionan los middlewares
* cómo organizar un proyecto Laravel correctamente

El sistema tiene dos roles:

* Cliente
* Productor Agrícola

Cada usuario:

* puede registrarse
* puede iniciar sesión
* tiene su propio dashboard
* no puede entrar al dashboard del otro rol
* no puede entrar si no ha iniciado sesión

---

# 🧠 Objetivo Principal

Aprender Laravel entendiendo todo el proceso internamente.

NO usar herramientas automáticas.

NO copiar código sin entender.

Construir una base sólida.

---

# ⚙️ Tecnologías Utilizadas

| Tecnología  | Uso                    |
| ----------- | ---------------------- |
| Laravel 13  | Framework backend      |
| PHP         | Lenguaje principal     |
| Blade       | Sistema de vistas      |
| Bootstrap 5 | Diseño visual          |
| MySQL       | Base de datos          |
| Middleware  | Protección de rutas    |
| Eloquent    | Manejo de modelos y BD |

---

# 📁 Estructura Principal del Proyecto

```text
app/
 ├── Http/
 │    ├── Controllers/
 │    │     └── AuthController.php
 │    └── Middleware/
 │          ├── AuthMiddleware.php
 │          ├── GuestMiddleware.php
 │          └── RoleMiddleware.php
 │
 ├── Models/
 │     └── User.php
 │
resources/
 └── views/
      ├── auth/
      │     ├── login.blade.php
      │     └── register.blade.php
      │
      ├── cliente/
      │     └── dashboard.blade.php
      │
      ├── productor/
      │     └── dashboard.blade.php
      │
      └── layouts/
            └── app.blade.php

routes/
 └── web.php
```

---

# 🚀 FASE 1 — Sistema de Registro

---

# 🧠 ¿Qué es el registro?

El registro es el proceso donde un usuario:

* escribe sus datos
* se guarda en la base de datos
* crea una cuenta

---

# 📌 Objetivo

Permitir que:

* Cliente se registre
* Productor se registre

Y dependiendo del rol:

* redirigir a dashboards diferentes

---

# 📌 Rutas de Registro

Archivo:

```text
routes/web.php
```

Se crearon rutas:

```php
Route::get('/register', [AuthController::class, 'showRegister']);

Route::post('/register', [AuthController::class, 'register']);
```

---

# 🧠 Explicación

## GET

Muestra el formulario.

---

## POST

Procesa los datos enviados.

---

# 📌 Vista de Registro

Archivo:

```text
resources/views/auth/register.blade.php
```

Se creó un formulario con:

* nombre
* correo
* contraseña
* rol

---

# 📌 Validación

Antes de guardar datos:

Laravel valida:

* campos vacíos
* correo válido
* correo repetido
* contraseña mínima

---

# 📌 Crear Usuario

Se usó:

```php
User::create()
```

para guardar usuario en base de datos.

---

# 📌 Roles

Se agregó campo:

```text
role
```

con dos valores:

* cliente
* productor

---

# 📌 Redirección por Rol

Después del registro:

```php
if ($user->role == 'productor')
```

Laravel decide:

* dashboard productor
* dashboard cliente

---

# 🔐 FASE 2 — Login

---

# 🧠 ¿Qué es login?

Login significa:

verificar si un usuario ya existe.

Laravel compara:

* correo
* contraseña

---

# 📌 Rutas Login

```php
Route::get('/login', [AuthController::class, 'showLogin']);

Route::post('/login', [AuthController::class, 'login']);
```

---

# 📌 Vista Login

Archivo:

```text
resources/views/auth/login.blade.php
```

Formulario:

* correo
* contraseña

---

# 📌 Auth::attempt()

Se utilizó:

```php
Auth::attempt($credentials)
```

Laravel automáticamente:

* busca email
* compara contraseña
* crea sesión

---

# 📌 Sesiones

Cuando login es correcto:

Laravel crea una sesión.

La sesión permite saber:

```text
quién está autenticado
```

---

# 📌 regenerate()

```php
$request->session()->regenerate();
```

Genera nueva sesión por seguridad.

---

# 🔓 FASE 3 — Logout

---

# 🧠 ¿Qué es logout?

Cerrar sesión.

Eliminar autenticación actual.

---

# 📌 Ruta Logout

```php
Route::post('/logout', [AuthController::class, 'logout']);
```

---

# 📌 Auth::logout()

```php
Auth::logout();
```

Laravel elimina usuario autenticado.

---

# 📌 invalidate()

```php
$request->session()->invalidate();
```

Destruye sesión actual.

---

# 🛡️ FASE 4 — Middlewares

---

# 🧠 ¿Qué es un Middleware?

Un middleware funciona como:

```text
un guardia de seguridad
```

Antes de entrar a una ruta:

* verifica condiciones
* decide si puede pasar

---

# 📌 Middlewares creados

## AuthMiddleware

Verifica:

```text
si hay login
```

---

## GuestMiddleware

Verifica:

```text
si NO hay login
```

Evita entrar a:

* login
* register

si ya inició sesión.

---

## RoleMiddleware

Verifica:

```text
qué rol tiene el usuario
```

---

# 📌 Protección de Rutas

Ejemplo:

```php
->middleware(['auth.custom', 'role:productor'])
```

Primero:

* verifica login

Luego:

* verifica rol

---

# 📌 Resultado

## Cliente

NO puede entrar:

```text
/productor/dashboard
```

---

## Productor

NO puede entrar:

```text
/cliente/dashboard
```

---

## Usuario NO autenticado

NO puede entrar a dashboards.

---

# 🎨 FASE 5 — Blade y Layouts

---

# 🧠 ¿Qué es Blade?

Blade es el sistema de vistas de Laravel.

Permite:

* reutilizar HTML
* organizar vistas
* escribir código limpio

---

# 📌 Layout Principal

Archivo:

```text
resources/views/layouts/app.blade.php
```

Contiene:

* navbar
* estructura HTML
* Bootstrap

---

# 📌 @extends

```blade
@extends('layouts.app')
```

Permite heredar layout principal.

---

# 📌 @yield

```blade
@yield('content')
```

Es un espacio donde cada vista inserta contenido.

---

# 📌 @section

```blade
@section('content')
```

Define contenido que irá dentro del yield.

---

# 🎨 FASE 6 — Bootstrap

---

# 🧠 ¿Qué es Bootstrap?

Framework CSS.

Sirve para:

* diseños rápidos
* formularios bonitos
* navbar
* botones
* cards

---

# 📌 Bootstrap CDN

Se utilizó CDN porque:

* más simple
* no requiere Vite
* no requiere npm
* ideal para aprender Laravel primero

---

# 📌 Navbar Bootstrap

Se creó una navbar con:

* Login
* Registro
* Logout
* Nombre usuario
* Rol

---

# 📌 Cards

Se utilizaron:

```html
<div class="card">
```

para crear contenedores visuales.

---

# 📌 form-control

Clase Bootstrap para inputs bonitos.

---

# 📌 btn btn-success

Clase Bootstrap para botones verdes.

---

# 🎯 FASE 7 — Navbar Inteligente

---

# 🧠 Objetivo

Cambiar navbar automáticamente dependiendo:

* si hay login
* si no hay login

---

# 📌 @guest

```blade
@guest
```

Muestra contenido SOLO si NO hay login.

---

# 📌 @auth

```blade
@auth
```

Muestra contenido SOLO si hay login.

---

# 📌 Auth::user()

Devuelve usuario autenticado.

Ejemplo:

```blade
{{ Auth::user()->name }}
```

---

# 📌 Resultado Final Navbar

## Usuario invitado

Ve:

* Login
* Registro

---

## Usuario autenticado

Ve:

* nombre
* rol
* logout

---

# 📌 Dashboards

Se crearon vistas:

```text
resources/views/productor/dashboard.blade.php
resources/views/cliente/dashboard.blade.php
```

---

# 📌 Arquitectura Mejorada

ANTES:

```php
return '<h1>Dashboard</h1>';
```

---

AHORA:

```php
return view('productor.dashboard');
```

Mucho más profesional.

---

# 🧠 Conceptos Aprendidos

---

# Laravel

* rutas
* controladores
* vistas
* middleware
* modelos
* autenticación
* sesiones

---

# Blade

* layouts
* extends
* sections
* yield
* auth
* guest
* error

---

# Bootstrap

* navbar
* cards
* formularios
* grid
* botones

---

# Seguridad

* sesiones
* middleware
* roles
* protección rutas
* validaciones

---

# 🛡️ Seguridad Implementada

✅ Protección de rutas

✅ Protección por roles

✅ Logout seguro

✅ Validaciones

✅ Password hash automático

✅ Protección CSRF

---

# 📌 Middleware Finales

| Middleware   | Función                             |
| ------------ | ----------------------------------- |
| auth.custom  | verificar login                     |
| guest.custom | bloquear login/register autenticado |
| role         | verificar rol                       |

---

# 📌 Roles Finales

| Rol       | Permisos            |
| --------- | ------------------- |
| cliente   | dashboard cliente   |
| productor | dashboard productor |

---

# 📌 Flujo Final del Sistema

## Registro

Usuario:

* llena formulario
* selecciona rol
* se guarda en BD
* inicia sesión automáticamente
* redirige dashboard correspondiente

---

## Login

Usuario:

* escribe correo
* escribe contraseña
* Laravel verifica datos
* crea sesión
* redirige dashboard

---

## Logout

Usuario:

* presiona logout
* Laravel elimina sesión
* redirige login

---

# 📚 Archivos Importantes

| Archivo             | Función                             |
| ------------------- | ----------------------------------- |
| web.php             | rutas                               |
| AuthController.php  | lógica auth                         |
| User.php            | modelo usuario                      |
| app.blade.php       | layout principal                    |
| login.blade.php     | formulario login                    |
| register.blade.php  | formulario registro                 |
| AuthMiddleware.php  | proteger rutas privadas             |
| GuestMiddleware.php | bloquear login/register autenticado |
| RoleMiddleware.php  | verificar roles                     |

---

# 🎯 Resultado Final

Se construyó completamente desde cero:

✅ Sistema de registro

✅ Sistema login

✅ Logout

✅ Roles

✅ Protección rutas

✅ Dashboards separados

✅ Bootstrap

✅ Navbar dinámica

✅ Middleware profesional

✅ Blade organizado

✅ Arquitectura limpia

---

# 🧠 Lo Más Importante Aprendido

El objetivo NO fue solamente hacer un login.

El objetivo fue entender:

* cómo Laravel autentica usuarios
* cómo funcionan las sesiones
* cómo funcionan los middlewares
* cómo se protegen rutas
* cómo funcionan los roles
* cómo organizar un proyecto correctamente

---

# 🚀 Próximos Pasos Posibles

Aunque el sistema ya está completo para autenticación con roles, las siguientes mejoras posibles serían:

* CRUD
* Relaciones Eloquent
* Roles dinámicos
* Permisos
* Policies
* Gates
* Arquitectura avanzada
* Panel administrativo completo

---

# 👨‍💻 Autor

Proyecto desarrollado con fines educativos para aprender Laravel 13 desde cero entendiendo internamente:

* autenticación
* middleware
* Blade
* Bootstrap
* roles
* sesiones
* arquitectura básica

---

# 🌱 Fin del Proyecto Base

Sistema completo de autenticación con roles realizado manualmente en Laravel 13.
