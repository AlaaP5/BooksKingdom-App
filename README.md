# Reading-App
## Installing Laravel 10 Passport from GitHub

1. Clone the repository:
``
git clone https://github.com/AlaaP5/Reading-App.git
```
2. Navigate to the project directory:
```
3. Install dependencies:
```
composer install
```

4. Create a `.env` file:


```
cp .env.example .env
```

5. Generate the application key:


```
php artisan key:generate
```

6. Run database migrations:


```
php artisan migrate
```

7. Install Passport:


```
php artisan passport:install
```

8. Start the server:


```
php artisan serve
```

That's it! You now have a Laravel 10 Passport project installed from GitHub and ready to use.
----------------------------------------------------------------------------------------------------

Project Description:
This project is a comprehensive book management and reading application designed to enhance the reading experience for users and provide robust management tools for system administrators.

The application includes the following features:
- User Features:
1- User Account Creation and Secure Login:
   Allows users to create accounts and log in securely.
2- Book Browsing:
   Enables users to browse a diverse collection of books.
3- Personal Library:   
   Users can create and manage their own library of favorite books.
4- Search Functionality:
   Empowers users to search for specific books or authors within the application.
5- Detailed Book Information:
   Displays comprehensive information for each book, including the title, author, summary, and cover image.
6- User-Friendly Reading Interface:
   Provides an easy-to-use interface for reading books within the application.
7- Note-Taking:
   Allows users to write and save notes within the app.
8- Reading Progress Tracking:
   Displays reading progress such as the percentage of the book completed or the time spent reading.
9- Feedback and Ratings:
   Users can submit feedback, suggestions, complaints, or questions about a specific book and rate the books they have read.
  
- Administrator Features:
1- Content Management Interface:
   Offers a user-friendly interface for managing the content available on the platform, including adding, editing, and removing books from the library.
2- User Engagement Insights:
   Provides administrators with insights into user engagement, such as the most popular books and user ratings.
3- Event and Complaint Monitoring:
   Enables administrators to receive and manage important events like user complaints, inquiries, and support requests.
