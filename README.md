# 📰 News Room API

A RESTful News Management API built with Laravel using Clean Architecture principles and modern Laravel features.

---

# 🚀 Features

* Authentication with Laravel Sanctum
* Roles & Permissions using Spatie Permission
* API Versioning (V1 / V2)
* Repository Pattern
* Service Layer
* Form Requests Validation
* API Resources
* Policies & Authorization
* Events & Listeners
* Queues & Jobs
* Notifications
* Redis Cache & Queue
* File Attachments
* Automated Testing with Pest

---

# 🏗 Architecture

The project follows a layered architecture:

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

# 🔐 Authentication

Implemented using Laravel Sanctum.

### Login

```http
POST /api/v1/login
```

### Logout

```http
POST /api/v1/logout
```

Authenticated requests require:

```txt
Authorization: Bearer TOKEN
```

---

# 👥 Roles & Permissions

Implemented using Spatie Permission.

Available Roles:

* admin
* writer
* reader

Common Permissions:

* Create Articles
* Update Articles
* Publish Articles
* Delete Articles
* Add Comments

---

# 📝 Articles

Supported Operations:

* Create Article
* List Articles
* Show Article Details
* Update Article
* Delete Article
* Publish Article

Endpoint:

```http
/api/v1/articles
```

Publish Endpoint:

```http
POST /api/v1/articles/{article}/publish
```

Relations:

```txt
Article
 ├── User
 ├── Comments
 ├── Attachments
 └── Tags
```

---

# 💬 Comments

Supports commenting on articles.

Endpoint:

```http
POST /api/v1/comments
```

Features:

* Reader can add comments
* Notifications sent to article owner
* No self-notifications

Relationship:

```php
commentable()
```

---

# 📎 Attachments

Supports uploading files to articles.

Allowed Types:

* pdf
* jpg
* jpeg
* png

Endpoint:

```http
POST /api/v1/articles/{article}/attachments
```

Relationship:

```php
attachable()
```

Files are stored using Laravel Storage.

---

# 🏷 Tags

Polymorphic Many-To-Many Relationship.

Relationship:

```php
taggable()
```

Used with:

* Articles
* Users

---

# 🔔 Notifications

Implemented:

### New Comment Notification

Writer:

```txt
mail
```

Admin:

```txt
database
```

Triggered when:

```txt
New comment is added
```

---

# 📨 Mail

Implemented Mailables:

### ArticlePublishedMail

Sent when:

```txt
Article status becomes published
```

Subject:

```txt
Article Published
```

---

# ⚙ Jobs & Queues

Implemented:

### NotifySubscribersJob

Queued after publishing an article.

Queue Driver:

```env
QUEUE_CONNECTION=redis
```

Run Worker:

```bash
php artisan queue:work
```

---

# ⚡ Events & Listeners

Events:

* ArticlePublished
* ArticleUpdated
* UserRegistered

Listeners:

* SendArticleNotification
* ClearDashboardCache
* SendWelcomeEmail

---

# 🛡 Policies

Implemented:

### ArticlePolicy

Supported Actions:

* view
* update
* delete
* publish

Authorization based on:

* Ownership
* User Role
* Article Status

---

# ✅ Validation

Implemented using Form Requests.

Examples:

```txt
StoreArticleRequest
UpdateArticleRequest
StoreCommentRequest
StoreAttachmentRequest
LoginRequest
```

Custom Rules:

```txt
ValidArticleContent
```

---

# 📦 API Resources

### V1 Resources

```txt
App\Http\Resources\V1
```

### V2 Resources

```txt
App\Http\Resources\V2
```

V2 includes additional fields such as:

* comments_count
* tags
* reading_time

---

# 💾 Redis

Used for:

* Queue Processing
* Cache Storage

Configuration:

```env
CACHE_STORE=redis
QUEUE_CONNECTION=redis
```

---

# 👀 Observers

Implemented:

```txt
ArticleObserver
```

Handles:

* Article Published Events
* Article Updated Events

---

# 🧪 Automated Testing

Testing framework:

```txt
Pest PHP
```

Implemented Test Suites:

### Feature Tests

```txt
tests/Feature

├── ArticleManagementTest.php
├── CommentSystemTest.php
├── ArticlePublishingTest.php
├── AttachmentUploadTest.php
└── ApiResponseStructureTest.php
```

Covered Scenarios:

* Authentication & Authorization
* Article CRUD
* Article Publishing
* Validation Rules
* Comments System
* Notifications
* Attachment Upload
* API Response Structure

### Unit Tests

```txt
tests/Unit

├── ArticlePublishedMailTest.php
├── NewCommentNotificationTest.php
└── NotifySubscribersJobTest.php
```

Covered Scenarios:

* Mail Construction
* Notification Channels
* Job Initialization

Run Tests:

```bash
php artisan test
```

or

```bash
./vendor/bin/pest
```

---

# 🌱 Seeders

Included:

* UserSeeder
* TagSeeder
* ArticleSeeder
* CommentSeeder

Run:

```bash
php artisan migrate:fresh --seed
```

Default Accounts:

### Admin

```txt
admin@test.com
password
```

### Writer

```txt
writer@test.com
password
```

---

# 🛠 Installation

Clone Repository:

```bash
git clone <repository-url>
```

Install Dependencies:

```bash
composer install
```

Copy Environment File:

```bash
cp .env.example .env
```

Generate Key:

```bash
php artisan key:generate
```

Run Migrations:

```bash
php artisan migrate
```

Seed Database:

```bash
php artisan db:seed
```

Run Application:

```bash
php artisan serve
```

Run Queue Worker:

```bash
php artisan queue:work
```

---

# 📂 Project Structure

```txt
app
├── Console
├── Events
├── Jobs
├── Listeners
├── Mail
├── Models
├── Notifications
├── Observers
├── Policies
├── Repositories
├── Resources
├── Rules
├── Services
└── Traits
```

---

# 👨‍💻 Author

Developed using Laravel Clean Architecture principles with testing, authorization, notifications, queues, and scalable API design.
