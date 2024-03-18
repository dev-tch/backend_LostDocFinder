##LostDocFinder
this back api developped with larvel 10

# modified files
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

