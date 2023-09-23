Book Tool
Book Tool is a web application that allows users to create and manage books. It is built using JavaScript, PHP, npm, and composer.

Features
User authentication: Users can create accounts and log in to the application.
Book creation: Users can create new books and add sections and subsections to them.
Collaborators: Users can invite other users to collaborate on their books.
Section and subsection management: Users can edit, delete, and reorder sections and subsections within their books.
Unit tests: The application includes unit tests to ensure that it is functioning correctly.
Installation
To install Book Tool, follow these steps:

Clone the repository from GitHub: git clone https://github.com/glow2590/book-tool.git
Install dependencies using npm and composer: npm install and composer install
Create a new database and update the .env file with your database credentials.
Run database migrations: php artisan migrate
Start the application: php artisan serve
Usage
To use Book Tool, follow these steps:

Log in to the application or create a new account.
Create a new book by clicking the "New Book" button on the dashboard.
Add sections and subsections to your book by clicking the "Add Section" and "Add Subsection" buttons.
Invite collaborators to your book by clicking the "Invite Collaborators" button and entering their email addresses.
Edit, delete, and reorder sections and subsections using the buttons on the book editor page.
Testing
To run the unit tests for Book Tool, run the following command: php artisan test

Contributing
If you would like to contribute to Book Tool, please follow these steps:

Fork the repository on GitHub.
Create a new branch for your changes: git checkout -b my-new-feature
Make your changes and commit them: git commit -am 'Add some feature'
Push your changes to your fork: git push origin my-new-feature
Create a pull request on GitHub.
License
Book Tool is open source software licensed under the MIT license.

Code Documentation
SubSectionController
The SubSectionController class is responsible for handling requests related to subsections. It includes the following methods:

destroy
The destroy method is responsible for deleting a subsection from the database. It takes three parameters: $book, $section, and $subsection, which are used to identify the subsection to be deleted.

The method first retrieves the SubSection model from the database using the $subsection parameter. It then checks if the authenticated user is the author of the book or a collaborator. If the user is not authorized to delete the subsection, the method aborts with a 403 error.

If the user is authorized, the method deletes the subsection from the database using the delete method on the $subSection model. Finally, the method redirects the user to the section that the deleted subsection belonged to using the route method on the redirect helper.
