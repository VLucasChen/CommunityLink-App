# CommunityLink

Web application for **event planning**, **volunteer coordination**, and **partner organisation** workflows for community and not-for-profit teams. Public pages support discovery and sign-up; authenticated staff get dashboards, CRUD, search, and file handling behind role-based access.

**Stack:** PHP 8.3+, CakePHP 5, MySQL, Bootstrap 5, Font Awesome 6.

---

## Features

- **Public site:** branded home, volunteer registration (with document upload), partner organisation registration, contact enquiries.
- **Admin dashboard:** activity summaries (top volunteers and partners, skills distribution, upcoming events), sensible defaults such as archiving past events.
- **Operations:** full CRUD for events, volunteers, volunteer sign-ups, organisations, users, and contact messages; related-record views; server-side search and filters; pagination.
- **Security:** CakePHP Authentication, hashed passwords, roles (admin, assistant, volunteer), guardrails (e.g. assistants cannot delete admin users), parameterized queries via the ORM.
- **Uploads:** volunteer profile images and documents with storage under `webroot/`.
- **Validation:** Australian mobile-style phone rules where applicable, email and required-field checks, numeric and date rules, consistent field-level errors.

---

## Requirements

- PHP 8.3+
- MySQL 5.7+ (or compatible)
- [Composer](https://getcomposer.org/)

---

## Quick start

### 1. Clone and install

```bash
git clone https://github.com/VLucasChen/CommunityLink-App.git
cd CommunityLink-App
composer install
```

### 2. Local configuration

CakePHP reads `config/app_local.php` for environment-specific settings (this file is gitignored).

```bash
cp config/app_local.example.php config/app_local.php
```

Edit `config/app_local.php` and set your MySQL `Datasources.default` host, username, password, and database name. The bundled seed script creates a database named **`A5`** by default; you can change that in `schema_data.sql` and match it in `app_local.php` if you prefer another name.

### 3. Database

```bash
mysql -u YOUR_USER -p < schema_data.sql
```

Or from the MySQL client after creating/selecting your database:

```sql
SOURCE schema_data.sql;
```

The seed file includes schema, constraints, a demo admin user (hashed password), and sample organisations, volunteers, and events. **Replace demo credentials** before any shared or production deployment.

### 4. Writable paths

```bash
chmod -R 755 tmp/ logs/ webroot/volunteer_documents/ webroot/img/volunteer_profiles/
```

### 5. Run locally

```bash
bin/cake server -p 8765
```

Open `http://localhost:8765`.

### Demo admin & volunteers

After the import, sign in using the administrator account defined in `schema_data.sql` (username in the seed data; password stored as a bcrypt hash—set a known password via your DB or app if you need to log in locally). Volunteer **user** accounts are not pre-linked to every volunteer row; create linked users from the admin **Users** area as needed.

---

## Project layout

| Area | Path |
|------|------|
| App config | `config/app.php`, `config/app_local.php` (local only) |
| Routes | `config/routes.php` |
| Controllers | `src/Controller/` |
| Models / tables | `src/Model/Table/` |
| Templates | `templates/` |
| Web / uploads | `webroot/` |
| Schema + seed | `schema_data.sql` |

---

## Maintainer

**Lucas Huang** — [@VLucasChen](https://github.com/VLucasChen)

---

## License

MIT. See [`LICENSE`](LICENSE).
