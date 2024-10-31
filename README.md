# Quiz Management System

Welcome to the **Quiz Management System**—a robust web application developed with **Laravel**. This platform empowers users to effortlessly create, manage, and engage in quizzes. Key features include user registration, profile management, quiz creation, and subscription management.

## Features

- **User Registration and Login**: Secure access for all users.
- **Profile Management**: Customize and manage your user profile.
- **Quiz Creation and Management**: Design and administer your own quizzes.
- **Subscription Plans**: (WIP) Explore various subscription options.
- **Payment Processing**: (WIP) Secure transactions for subscriptions.
- **Contact Form**: Get in touch for support and inquiries.

## Installation

Follow these steps to get the application up and running:

1. **Clone the repository**:  
   `git clone https://github.com/Exill18/Quiz-Management-System.git`
2. **Navigate to the project folder**:  
   `cd Quiz-Management-System`
3. **Install the dependencies**:  
   `composer install`
4. **Create a copy of the `.env` file**:  
   `cp .env.example .env`
5. **Generate an application key**:  
   `php artisan key:generate`
6. **Create an SQLite database file**:  
   `touch database/database.sqlite`
7. **Migrate the database**:  
   `php artisan migrate`
8. **Seed the database**:  
   `php artisan db:seed PlansSeeder`
9. **Start the development server**:  
   `php artisan serve`
10. **Open the application in your browser**:  
    Navigate to: [http://localhost:8000](http://localhost:8000)

## Usage

1. **Register a new user** or log in with your credentials.
2. **Create a quiz** by clicking the "Create Quiz" button.
3. **Fill in the quiz details and questions**.
4. **Save the quiz** and share the link with others to participate.
5. **View the quiz results and statistics**.
6. **Manage your profile and subscription plan**.
