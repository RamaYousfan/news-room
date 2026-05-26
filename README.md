# 📰 News Room API

RESTful API built with Laravel following clean architecture principles using:

- Repository Pattern
- Service Layer
- API Versioning (V1 / V2)
- Authentication with Sanctum
- Roles & Permissions with Spatie
- Events & Listeners
- Queue & Redis
- Notifications
- Policies & Middleware
- Form Requests & Custom Validation Rules
- Resources
- Observers
- Commands & Scheduling

---

# 📌 Features

### Authentication
- Login
- Logout
- Sanctum Token Authentication

Endpoints:

POST

/api/v1/login

POST

/api/v1/logout

---

### Roles & Permissions (Spatie)

Supported roles:

- admin
- writer
- reader

Permissions controlled using:

```php
HasRoles
assignRole()
hasRole()
```

Role middleware:

```php
role:admin
role:writer
```

---

### Articles

Supports:

- Create article
- Update article
- Delete article
- Show article
- List articles

Relations:

Article →

- User (Author)
- Comments
- Tags
- Attachments

---

### Comments

Polymorphic relation:

```php
commentable()
```

Supports comments on:

- Articles

---

### Attachments

Polymorphic relation:

```php
attachable()
```

---

### Tags

Many To Many Polymorphic:

```php
taggable
```

Used with:

- Articles
- Users

---

# 🏗 Architecture

Project follows:

```txt
Controller
↓
Service Layer
↓
Repository Layer
↓
Model
```

Example:

```txt
ArticleController
↓
ArticleService
↓
ArticleRepository
↓
Article Model
```

---

# API Versioning

Supported:

V1:

```txt
/api/v1/*
```

V2:

```txt
/api/v2/*
```

V2 adds:

- Request Logging
- Rate Limiting
- Extended Resources

---

# Notifications

Implemented:

Admin:

Database Notification

Writer:

Email Notification

Notifications triggered when:

Article status:

```txt
published
```

---

# Events & Listeners

Events:

- ArticlePublished
- ArticleUpdated
- UserRegistered

Listeners:

- SendArticleNotification
- ClearDashboardCache
- SendWelcomeEmail

---

# Queue

Queue driver:

```env
QUEUE_CONNECTION=redis
```

Run worker:

```bash
php artisan queue:work
```

---

# Redis Cache

Configured:

```env
CACHE_STORE=redis
```

Used for:

Dashboard cache clearing

---

# Observers

Implemented:

```txt
ArticleObserver
```

Triggers:

- ArticlePublished event
- ArticleUpdated event

---

# Policies

Implemented:

```txt
ArticlePolicy
```

Supports:

- view
- update
- delete

Authorization based on:

- ownership
- admin role
- published status

---

# Validation

Uses:

Form Requests:

- StoreArticleRequest
- UpdateArticleRequest
- LoginRequest

Custom Rule:

```txt
ValidArticleContent
```

Requires:

Minimum content length

---

# Resources

Implemented:

V1:

```txt
App\Http\Resources\V1
```

V2:

```txt
App\Http\Resources\V2
```

V2 includes:

- comments_count
- tags
- reading_time

---

# Commands

Custom Commands:

Archive articles:

```bash
php artisan articles:archive
```

Generate report:

```bash
php artisan articles:report
```

---

# Scheduling

Commands can be scheduled using:

```bash
php artisan schedule:list
```

Run scheduler:

```bash
php artisan schedule:work
```

---

# Database Seeders

Included:

- UserSeeder
- TagSeeder
- ArticleSeeder
- CommentSeeder

Run:

```bash
php artisan migrate:fresh --seed
```

Default users:

Admin:

```txt
admin@test.com
password
```

Writer:

```txt
writer@test.com
password
```

---

# Installation

Clone:

```bash
git clone repo-url
```

Install:

```bash
composer install
```

Copy env:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

Run migrations:

```bash
php artisan migrate
```

Seed:

```bash
php artisan db:seed
```

Run server:

```bash
php artisan serve
```

Queue:

```bash
php artisan queue:work
```

---

# Testing API

Login:

POST

```txt
/api/v1/login
```

Create article:

POST

```txt
/api/v1/articles
```

Headers:

```txt
Authorization:
Bearer TOKEN
```

Logout:

POST

```txt
/api/v1/logout
```

---

# Main Packages Used

Laravel Sanctum:

Authentication

Spatie Permission:

Roles & Permissions

Redis:

Queue + Cache

---

# Project Structure

```txt
Controllers
Services
Repositories
Policies
Observers
Events
Listeners
Notifications
Middleware
Resources
Rules
Commands
Providers
Models
```

---

# Author

Developed using Laravel Clean Architecture principles.