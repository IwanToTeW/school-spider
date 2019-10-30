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
1. Created models for News and Image objects.
News object:

id": 10
"title": "Example title"
"content": "Some content"
"created_at": "2019-10-30 17:10:36"
"updated_at": "2019-10-30 17:10:36"

Image object
id": 10
"news_id": "10"
"name_logo": "path to 120x120 image"
"name_large": "path to 800x800 image"
"created_at": "2019-10-30 17:10:36"
"updated_at": "2019-10-30 17:10:36"

2. CRUD design choices
All the logic could be found in /app/Http/Controllers/NewsController

Method - Operation
index() - Displays all the data
create() - Redirects to the create News object template
store() - Creates News object
show() - Displays a single object data into a template
edit() - Redirects to the selected News object update template
update() - Updates the data for the selected News object
destroy() - Deletes selected object
showAll() - returns News List (title & date inserted) in JSON
showOne() - returns News item (title & content) with an image array storing the relevant thumbnails in JSON

3. Implementation decisions
I have decided to create a single object that will point to both image's 120x120 and 800x800 path. By doing so we will upload two variations of the same image but the data will be encapuslated into a single object instead of creating two identical ones with small difference in the path's value. I have decided to generate a random name for the newly uploaded images and their orignal extenstion. In order to avoid duplication a 'large' prefix is added to the 800x800 images.
