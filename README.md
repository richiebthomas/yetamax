# YetaMax Event Management System

YetaMax is a robust web-based event management system built with Laravel, designed to streamline the process of organizing and managing college events. The system supports multiple event categories, team registrations, and comprehensive admin controls.

## Features

- **User Authentication**
  - Student registration and login
  - Role-based access control (Admin, Event Admin, Student)

- **Event Management**
  - Multiple event categories (Technical, Cultural, Seminar)
  - Day-wise event scheduling
  - Team and individual participation support
  - Dynamic seat availability tracking
  - WhatsApp group integration for approved participants

- **Admin Features**
  - Super admin dashboard
  - Event-specific admin management
  - Enrollment approval system
  - Real-time participant tracking

- **User Features**
  - Easy event registration
  - Team formation capabilities
  - Profile management
  - Event enrollment history
  - Fee tracking

## Prerequisites

Before you begin, ensure you have the following installed:
- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js and npm
- Git

## Installation

1. Clone the repository
```bash
git clone https://github.com/richiebthomas/yetamax.git
cd yetamax
```

2. Install PHP dependencies
```bash
composer install
``

3. Create environment file
```bash
cp .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Configure your database in `.env` file
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yetamax
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run database migrations
```bash
php artisan migrate
```

8. Start the development server
```bash
php artisan serve
```


The application should now be running at `http://localhost:8000`

## Database Structure

The system uses several key tables:
- `users` - Stores user information
- `events` - Contains event details
- `enrollments` - Manages event registrations
- `teams` - Handles team formations
- `event_admins` - Manages event-specific administrators

## User Roles

1. **Super Admin**
   - Full system access
   - Can manage event admins
   - Can approve/disapprove enrollments

2. **Event Admin**
   - Manage specific events
   - View participant lists
   - Update event details

3. **Student**
   - Register for events
   - Form teams
   - View enrollment history

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request


## Support

For support, please email rbtthegreat@gmai.com or raise an issue in the repository.

## Acknowledgments

- Laravel Framework
- Bootstrap
- Font Awesome
- All contributors who have helped shape YetaMax