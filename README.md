# CommunityLink - Community Event Management System

**Assignment 5 - FIT2104 Web Database Applications**

## Authors

- **HUANG YICHEN** - Student ID: 35860537 - Submitted Date: 07/11/2025

## Repository

**GitLab Repository URL:** https://git.infotech.monash.edu/fit2104/fit2104-2025-s2/assessment-5

## Database Dump File

**Filename:** `schema_data.sql`  
**Location:** Project root directory (`/schema_data.sql`)

This file contains:
- Complete table creation statements with primary keys, foreign keys, and column constraints
- All INSERT statements for initial data
- Can be used to restore the database to the exact state at submission time

To import the database:
```bash
mysql -u [username] -p A5 < schema_data.sql
```

Or using MySQL client:
```sql
SOURCE schema_data.sql;
```

## Login Credentials

### Admin Account
- **Username:** `AmyTan`
- **Password:** `AmyTan123`
- **Role:** `admin`
- **Email:** `admin@communitylink.com`

### Volunteer Account
Volunteer accounts are not pre-created in the database. To create a volunteer account:

1. Log in as admin (AmyTan / AmyTan123)
2. Navigate to **Users** → **Add User**
3. Create a user with role "volunteer"
4. Link the user to an existing volunteer record (or create a volunteer first via **Volunteers** → **Add Volunteer**)

**Note:** The database includes sample volunteer data (15 volunteers), but no user accounts are linked to them initially. Volunteer user accounts must be created through the admin interface.

## Work Breakdown Agreement

**HUANG YICHEN (35860537):**

### Task 1: Database Schema Design and CakePHP Compliance
### Task 2: Authentication System Implementation
### Task 3: Public-Facing Pages( Home Page, Contact Us Page, Volunteer Signup Page, Organisation Registration Page)
### Task 4: Admin Dashboard
### Task 5: Events Management
### Task 6: Volunteers Management
### Task 7: Volunteer Signups Management
### Task 8: Organisations Management
### Task 9: Users Management
### Task 10: Contact Messages Management
### Task 11: Search and Filter Functionality
### Task 12: Pagination Implementation
### Task 13: File Upload Handling
### Task 14: Email Notifications
### Task 15: Validation and Error Handling
### Task 16: UI/UX Improvements and Virtual Fields
### Task 17: CakePHP Configuration
### Task 18: Branding Customization
### Task 19: Code Quality and Best Practices

HUANG YICHEN agrees with the work breakdown agreement. 07/11/2025

---

## Database Setup

### Database Credentials

- **Database Name:** `A5`
- **Database Host:** `localhost`
- **Username:** [Configure in `config/app_local.php`]
- **Password:** [Configure in `config/app_local.php`]

The database dump file (`schema_data.sql`) includes:
- Complete schema for all tables (organisations, volunteers, users, events, volunteer_events, contact_messages, volunteer_signups)
- Primary keys, foreign keys, and all column constraints
- Initial admin user (AmyTan) with hashed password
- Sample data for organisations, volunteers, events, and other entities

---

## Installation & Configuration

### Prerequisites

- PHP 8.2 or higher
- MySQL 5.7 or higher
- Composer
- Apache/Nginx web server (or PHP built-in server)

### Installation Steps

1. Clone the repository:
```bash
git clone [repository-url]
cd FIT2104_A5
```

2. Install dependencies:
```bash
composer install
```

3. Configure database connection:
   - Edit `config/app_local.php`
   - Update the `Datasources` section with your database credentials:
   ```php
   'Datasources' => [
       'default' => [
           'host' => 'localhost',
           'username' => 'your_username',
           'password' => 'your_password',
           'database' => 'A5',
           // ... other settings
       ],
   ],
   ```

4. Import the database:
```bash
mysql -u [username] -p A5 < schema_data.sql
```

5. Set proper permissions:
```bash
chmod -R 755 tmp/
chmod -R 755 logs/
chmod -R 755 webroot/volunteer_documents/
chmod -R 755 webroot/img/volunteer_profiles/
```

6. Start the development server:
```bash
bin/cake server -p 8765
```

7. Visit `http://localhost:8765` in your browser

---

## Application Features

### Public Pages
- Home page with CommunityLink branding
- Volunteer registration form (with document upload)
- Partner Organisation registration form
- Contact Us page

### Admin Dashboard
- Top 10 most active volunteers (current year)
- Top 10 most active partner organisations (current year)
- Volunteer skills distribution
- Events in coming month by status
- Auto-archiving of past events

### Admin Page
- Events Management - Complete CRUD with all A5 fields
- Volunteers Management - Complete CRUD including profile page
- Volunteer Signups Management - List, view, edit, public signup
- Organisations Management - Complete CRUD with public signup
- Users Management - Complete CRUD with role management
- Contact Messages Management - List, view, edit, reply, public contact

### Authentication
- CakePHP Authentication plugin
- Role-based access (admin, assistant, volunteer)
- Hashed passwords
- Assistant protection (cannot delete admin users)

### Search & Filter
- Server-side multi-criteria search using QueryBuilder
- Search across all entities (Events, Volunteers, Organisations, etc.)
- Combined filters (e.g., skills AND date)

### Entity Management
- Complete CRUD for all entities
- Detail views with related records
- File uploads (profile pictures, documents)
- Status tracking and automation

### Validation & Error Handling
- **Phone Number Validation:** Australian format (04XX XXX XXX) enforced on all forms
  - Contact Messages, Volunteer Signups, Volunteers, Organisations
  - Accepts formats: `04XX XXX XXX`, `(04)XX XXX XXX`, `04XX-XXX-XXX`
- **Form Validation:**
  - Email validation on all email fields
  - Required field validation
  - Maximum length validation
  - Positive number validation for numeric fields (event size, crew count)
  - Date format validation
- **Error Display:**
  - Clear, user-friendly error messages
  - Field-specific validation errors
  - No duplicate error messages
  - Consistent error handling across all forms

---

## Technology Stack

- **Framework:** CakePHP 5.x
- **Database:** MySQL
- **Frontend:** Bootstrap 5.1.3
- **Icons:** Font Awesome 6.0.0
- **PHP Version:** 8.2+

---

## Important Files

- **Database Schema:** `schema_data.sql`
- **Configuration:** `config/app_local.php`, `config/app.php`
- **Routes:** `config/routes.php`
- **Models:** `src/Model/Table/`
- **Controllers:** `src/Controller/`
- **Views:** `templates/`

---

## Notes

- Debug mode is **disabled** in `app_local.php` for production
- Australian locale (`en_AU`) and timezone (`Australia/Melbourne`) configured
- All CakePHP branding removed, replaced with CommunityLink branding
- Server-side pagination implemented (no client-side DataTables)
- All forms use CakePHP FormHelper for best practices
- **Email Notifications:** All public form submissions (Contact, Volunteer Signup, Organisation Registration) send email notifications to `admin@communitylink.com` using CakePHP Mailer
- **CakePHP Compliance:** All code follows CakePHP best practices:
  - No direct SQL queries (uses ORM)
  - No raw PHP superglobals (uses Request object)
  - No raw PHP redirects (uses `$this->redirect()`)
  - No raw PHP email (uses CakePHP Mailer)
  - All templates use CakePHP helpers (FormHelper, HtmlHelper, UrlHelper)

---

## License

This project is developed for FIT2104 Web Database Applications at Monash University.
