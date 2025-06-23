# YetaMax Event Management System

YetaMax is a robust web-based event management system built with Laravel, designed to streamline the process of organizing and managing college events. The system supports multiple event categories, team registrations, and comprehensive admin controls.
![image](https://github.com/user-attachments/assets/e8a07798-5746-4ccd-b6d4-c13970bcea52)



⚠️ Disclaimer

    YetaMax is an independent educational project created for learning and demonstration purposes only.

    This system, including all references to events, clubs, or organizational roles, is entirely fictional and bears no intentional affiliation with, endorsement from, or official connection to Fr. C. Rodrigues Institute of Technology (FCRIT) or any of its members, clubs, or departments.

    Any resemblance to real names, events, or entities — living, dead, or institutionally functional — is purely coincidental. All content and naming conventions used within the system are for illustrative or satirical purposes only.
    Any concerns, questions, or requests for clarification regarding content or references should be directed to Richie Thomas, the developer, at richiebt2004@gmail.com.
    If you are a real human, robot, or club president reading this and feel a little too seen — we assure you: it's not about you.

    By using or referencing this system, you acknowledge and accept the terms of this disclaimer.

    

## Features

- **User Authentication**
  - Student registration and login
  - Role-based access control (Admin, Event Admin, Student)

- **Event Management**
  - Multiple event categories (Technical, Cultural, Seminar)
  - Day-wise event scheduling
![image](https://github.com/user-attachments/assets/433a2719-0ffd-4698-855f-b65ba6983641)
  - Team and individual participation support
  - Dynamic seat availability tracking
  - WhatsApp group integration for approved participants
![image](https://github.com/user-attachments/assets/7f6a10a6-b9b6-4639-8325-850163aa2aae)


- **Admin Features**
  - Super admin dashboard
  - Event-specific admin management
  - Enrollment approval system
  - Real-time participant tracking
![image](https://github.com/user-attachments/assets/45134980-4829-41dd-8fc5-41a5d69926e3)
![image](https://github.com/user-attachments/assets/50fc1aad-d1f9-43fe-8ede-aeb5bb2ea0f6)
![image](https://github.com/user-attachments/assets/ef6b1f15-1adc-4ba0-b922-14ace7c0526c)
![image](https://github.com/user-attachments/assets/b183dd0a-2950-41f2-8188-82847ac8dc31)
![image](https://github.com/user-attachments/assets/7a46298a-b21b-45e1-9ba9-9f5aa7a2ae8d)
![image](https://github.com/user-attachments/assets/7a26229f-7c1f-4594-b564-9a73e5dda2d8)
![image](https://github.com/user-attachments/assets/27198b0b-3b5f-43f9-9337-ce5c88e8f061)








- **User Features**
  - Easy event registration
  - Team formation capabilities
  - Profile management
  - Event enrollment history
  - Fee tracking
![image](https://github.com/user-attachments/assets/9d8a9da3-25c6-4ab6-bef3-27dcc0a74e43)

## Demo: Want a quick demo? 
Go to http://yetamax.free.nf and login with
roll: 5022161 & pass: 12345678
(All admin rights given to this account for testing - user, event-admin and admin pages)

Offline installation on local machine:
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

For support, please email rbtthegreat@gmail.com or raise an issue in the repository.

## Acknowledgments

- Laravel Framework
- Bootstrap
- Font Awesome
- All contributors who have helped shape YetaMax
