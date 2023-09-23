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
BookController
The BookController class is responsible for handling requests related to books. It includes the following methods:

create
The create method is responsible for displaying the book creation form. It returns the create view with an empty Book model.

store
The store method is responsible for storing a new book in the database. It takes a Request object as a parameter, which contains the book data submitted by the user.

The method creates a new Book model using the authenticated user's books relationship and the data from the Request object. It then redirects the user to the book show view using the route method on the redirect helper.

show
The show method is responsible for displaying a single book. It takes the book's ID as a parameter and retrieves the corresponding Book model from the database.

The method then returns the show view with the Book model as a parameter.

SectionController
The SectionController class is responsible for handling requests related to sections. It includes the following methods:

create
The create method is responsible for displaying the section creation form. It takes the book's ID as a parameter and retrieves the corresponding Book model from the database.

The method then returns the create view with an empty Section model and the Book model as parameters.

store
The store method is responsible for storing a new section in the database. It takes the book's ID and a Request object as parameters, which contains the section data submitted by the user.

The method creates a new Section model using the book's sections relationship and the data from the Request object. It then redirects the user to the book show view using the route method on the redirect helper.

show
The show method is responsible for displaying a single section. It takes the book's ID and the section's ID as parameters and retrieves the corresponding Book and Section models from the database.

The method then returns the show view with the Book and Section models as parameters.

SubSectionController
The SubSectionController class is responsible for handling requests related to subsections. It includes the following methods:

create
The create method is responsible for displaying the subsection creation form. It takes the book's ID and the section's ID as parameters and retrieves the corresponding Book and Section models from the database.

The method then returns the create view with an empty SubSection model and the Book and Section models as parameters.

store
The store method is responsible for storing a new subsection in the database. It takes the book's ID, the section's ID, and a Request object as parameters, which contains the subsection data submitted by the user.

The method creates a new SubSection model using the section's subSections relationship and the data from the Request object. It then redirects the user to the section show view using the route method on the redirect helper.

show
The show method is responsible for displaying a single subsection. It takes the book's ID, the section's ID, and the subsection's ID as parameters and retrieves the corresponding Book, Section, and SubSection models from the database.

The method then returns the show view with the Book, Section, and SubSection models as parameters.

destroy
The destroy method is responsible for deleting a subsection from the database. It takes the book's ID, the section's ID, and the subsection's ID as parameters and retrieves the corresponding SubSection model from the database.

The method checks if the authenticated user is the author of the book or a collaborator. If the user is not authorized to delete the subsection, the method aborts with a 403 error.

If the user is authorized, the method deletes the subsection from the database using the delete method on the SubSection model. Finally, the method redirects the user to the section show view using the route method on the redirect helper.
