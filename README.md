# dbravoan/dbcms-module-maintenance 1.0.0

## Qué hace

`dbravoan/dbcms-module-maintenance` controla el modo mantenimiento / en construcción con pantalla interactiva, temporizador, bypass para administradores y personalización.

## Requisitos y dependencias

- `dbravoan/dbcms-core` `^1.0`
- Identificador: `maintenance`

## Instalación y activación

Instala y activa `maintenance`. Los ajustes del módulo controlan el estado público. Las acciones de panel usan permiso `manage:modules`.

## Configuración

El modo operativo se controla sobre todo con ajustes del módulo. Existe también la clave de entorno relacionada en el núcleo.

Ajustes del módulo (panel; claves por nombre):

- `is_enabled`
- `mode`
- `title`
- `logo_text`
- `accent_color`
- `bg_color`
- `end_datetime`
- `show_countdown`
- `headline`
- `message`
- `show_download_svg`
- `show_admin_link`
- `custom_html`
- `retry_after_fallback`

Claves de entorno / `config` relacionadas (por nombre; sin valores):

- `CMS_MAINTENANCE_MODE`
- `config('cms.maintenance_mode')`

## Rutas

**Admin** (prefijo del panel + `maintenance`, permiso `manage:modules`):
- `POST .../save` → `maintenance.save`
- `POST .../toggle` → `maintenance.toggle`
- `GET .../preview` → `maintenance.preview`

## Comandos Artisan

Ninguno.

## Permisos

- `manage:modules` (rutas y navegación del módulo)

## Privacidad y datos

No aplica recogida de datos personales propia del módulo más allá del mensaje público configurado. Gap: no hay `CookieDisclosure` ni tratamiento `legal.processing` específico en el código revisado.

## Enlaces

- [Extensiones](../../../docs/EXTENSIONS.md)
- [Núcleo y extensiones](../../../specs/CORE_AND_EXTENSIONS.md)
- [README del núcleo](../../../packages/core/README.md)
- [README del monorepo](../../../README.md)
