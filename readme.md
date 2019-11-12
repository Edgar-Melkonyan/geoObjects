# GeoObjects Api

Please find how to launch the application and the structure of the API bellow.



## Application launching

	1) cp .env.example .env
	2) docker-compose build --no-cache
	3) docker-compose up -d  
	4) docker-compose exec app php artisan key:generate
    5) docker-compose exec app php artisan migrate --seed
    6) to run test docker-compose exec app composer test

## Api structure

- URL  
	- /api/geo_objects
- HTTP Method  
	- GET
- Operation  
	- Select all geoObjects and return paginated results
- Api Call Example  
	- api/geo_objects

##

- URL  
	- /api/geo_objects/:geo_object/geometries
- HTTP Method  
	- GET
- Operation  
	- Select geoObject with geometries history
- Api Call Example  
	- api/geo_object/1/geometries	
	
##

- URL  
	- /api/geo_objects/:geo_object
- HTTP Method  
	- GET
- Operation  
	- Select geoObject
- Api Call Example  
	- api/geo_object/1
	
##	
	
- URL  
	- api/geo_objects
- HTTP Method  
	- POST
- Operation  
	- Create geoObject 
- Api Call Example 
	- api/geo_objects	
- Request Body
    ```
    name 
    description
    type_id 
    "geometry": [
      ["type": "", "latitude": "", "longitude": ""],
      ["type": "", "latitude": "", "longitude": ""],
    ]	
## 	   

- URL  
	- api/geo_objects/:geo_object
- HTTP Method  
	- PUT
- Operation  
	- Update given geoObject
- Api Call Example 
	- api/geo_objects/1
- Request Body	
	```
  name 
  description
  type_id 
  "geometry": [
    ["type": "", "latitude": "", "longitude": ""],
    ["type": "", "latitude": "", "longitude": ""],
  ]	

##

- URL  
	- api/geo_objects/:geo_object
- HTTP Method  
	- DELETE
- Operation  
	- Delete given geoObject 
- Api Call Example 
	- api/geo_objects/1	


## Design Patterns and Principles 

- Repository  
- Dependency Injection
- SOLID
- KISS


## Functionality that you could miss :)

- RepositoryServiceProvider for Binding Interfaces and Services (See App\Providers\)
- Route Pattern provides common pattern for `id` route variables (See App\Providers\RouteServiceProvider)
- Exception Handling (See App\Exceptions\Handler) 

