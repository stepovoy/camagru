# camagru
Instagram-like PHP &amp; JavaScript &amp; HTML &amp; CSS project at School 42. No frameworks allowed.

(116/100)

Subject rewrite in task list:

USER

Sign up:
Email, password(at least 8symbols), confirmation email with a validation link.
Log in:
Email, password.
Forgot password? Email reset link.
Logout link at every page.

EDIT (Only after logged in) Else: homepage/register/login link 

This page should contain 2 sections:
“A main section containing the preview of the user’s webcam, the list of superposable images and a button allowing to capture a picture.”
“A side section displaying thumbnails of all previous pictures taken.”

   •    Superposable images must be selectable and the button allowing to take the picture should be inactive (not clickable) as long as no superposable image has been selected.  


   •    The creation of the final image (so among others the superposing of the two images) must be done on the server side, in PHP.


   •    Because not everyone has a webcam, you should allow the upload of a user image instead of capturing one with the webcam.

   •    The user should be able to delete his edited images, but only his, not other users’ creations.

GALLERY(Homepage)

Display all images ordered by date of creation.
For logged in users an ability to like and comment them.
On receiving a comment on user’s image, send notification on email.
The list of images must be presented in successive pages (i.e. X images by page).


BONUS(any bonus you wish)

Mind that image processing should be done on server side(probable meaning PHP?)
Examples:

   •    “AJAXify” exchanges with the server.


   •    Propose a live preview of the edited result, directly on the webcam preview. We  should note that this is much easier than it looks.


   •    Do an infinite pagination of the gallery part of the site.


   •    Offer the possibility to a user to share his images on social networks.


   •    Render an animated GIF.


Required structure:

   •    A index.php file, containing the entering point of your site and located at the root of your file hierarchy.  


   •    A config/database.php file, containing your database configuration, that will be instanced via PDO in the following format:  DSN (Data Source Name) contains required information needed to connect to the database, for instance ‘mysql:dbname=testdb;host=127.0.0.1’.  Generally, a DSN is composed of the PDO driver name, followed by a specific syntax for that driver. For more details take a look at the PDO doc of each driver1.  


   •    A config/setup.php file, capable of creating or re-creating the database schema, by using the info contained in the file config/database.php.
