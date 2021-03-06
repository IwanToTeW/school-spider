# School Spider technical task
# Requirements
Create a simple news administration system

 

We would like you to build a news administration system for the user to be able to simply create, update and delete news items through an administration system.

 

A news item needs to have the following fields available to it:

 

Title

Content (WYSIWYG)

TIMESTAMPS

 

For each news item we want be able to upload (unlimited) multiple images to it. Each should dynamically create a thumbnail (120px * 120px) and a large image (800px * 800px)

 

Frontend 

 

We would like to see 2 endpoints available to return json for the following

 

News List (title & date inserted)

News item (title & content) with an image array storing the relevant thumbnails

# Implementation
1. Created models for News and Image objects.<br />
News object:<br />

id": 10<br />
"title": "Example title"<br />
"content": "Some content"<br />
"created_at": "2019-10-30 17:10:36"<br />
"updated_at": "2019-10-30 17:10:36"<br />

Image object<br />
id": 10<br />
"news_id": "10"<br />
"name_logo": "path to 120x120 image"<br />
"name_large": "path to 800x800 image"<br />
"created_at": "2019-10-30 17:10:36"<br />
"updated_at": "2019-10-30 17:10:36"<br />

2. CRUD design choices
<br />
All the logic could be found in /app/Http/Controllers/NewsController

Method - Operation<br />
index() - Displays all the data<br />
create() - Redirects to the create News object template<br />
store() - Creates News object<br />
show() - Displays a single object data into a template<br />
edit() - Redirects to the selected News object update template<br />
update() - Updates the data for the selected News object
destroy() - Deletes selected object<br />
showAll() - returns News List (title & date inserted) in JSON<br />
showOne() - returns News item (title & content) with an image array storing the relevant thumbnails in JSON<br />

3. Implementation decisions<br />

I have decided to create a single object that will point to both image's 120x120 and 800x800 path. By doing so we will upload two variations of the same image but the data will be encapuslated into a single object instead of creating two identical ones with small difference in the path's value. I have decided to generate a random name for the newly uploaded images and their orignal extenstion. In order to avoid duplication a 'large' prefix is added to the 800x800 images.<br />

As a WYSIWYG editor I have chosen tinyMCE from all the options available because it required literally no installation and configuration just inserting a JS snippet into the template and define the HTML element we want to target.<br />

By implementing a WYSIWYG editor on the page that directly interacts with the database we have opened a security hole. By allowing user to insert text in any format one can easily store a JS script and store it into the database. When we display it on the view with {!! "some text" !!} we execute it directly as it is, which could be really dangerous. In order to prevent this I have installed a Mews/Purifier, which deals with such an input. There is a fuction called clean() that is purifies the input and then we are safe to store it into DB.
