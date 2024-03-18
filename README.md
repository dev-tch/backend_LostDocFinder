## backend_LostDocFinder
this backend api developped with laravel 10
, it will be used for project angular :

[frontend_LostDocFinder](https://github.com/dev-tch/frontend_LostDocFinder)

## modified files
- app/api.php : contains all the routes api
- app/Http/Kernel.php : config the sanctum api token for single page

## added files
- app/Controllers/DocumentController.php: contains the api logic related to Document object
- app/Controllers/DocumentRequestController.php: contains the api logic related to document Request ( doc_found or doc_lost)
- app/Controllers/LoginController.php: contains the logic part of login or logout some user
- app/Controllers/UserController.php: contains the logic of managing user

- app/Models/document.php: model data for object Document
- app/Models/DocumentRequest.php: model data for object DocumentRequest
- app/User.php: model data for object User

## added folders
project_config: sql scripts to create tables of database 

## Api Description

- api/login(POST): login a user and generate a new token for the current authenticated user

- api/logout(POST) : logout a user session

- api/addDoc(POST) : create new a document

- api/documents(GET): get the list of documents belongs to the current authenticated user

- api/documents(DELETE): delete document 

- api/documents/{doc_id}(PUT): update the description of document

- api/documents/description(POST): get the description of document

- api/addReq(POST): create new document request

- api/requests(GET): get the list of requests belongs to the current authenticated user

- api/contacts(POST): get user contact(email,phone, ...) of user that create request of type doc_lost or doc_found

- api/requests(DELETE): delete document request

- api/requests/{req_id}(PUT): update the description of document request

- api/users(POST): create new user 

