# Universit courses registration portal (APIs)

In this repository, following two APIs are built.

- API to show list of all offered courses
- API for course registraion

## API to show list of all offered courses

This API returns list of all courses. Eeach couse contains following information.
- id
- name
- capacity (maximum student registration)
- registered_students (total registered students)
- is_available (Is course available for registration? true/false)

The endpoint "{{base_url}}/courses" (GET request) is required to be hit. It returns the response in JSON format. Below are the sample responses of this API

- Success response
```
{
    "success": true,
    "code": 200,
    "message": "Please select a course.",
    "content": [
        {
            "id": 1,
            "name": "nxxoanpeh0",
            "capacity": 4,
            "registered_students": 4,
            "is_available": false
        },
        {
            "id": 2,
            "name": "5glej6z0md",
            "capacity": 5,
            "registered_students": 3,
            "is_available": true
        }
    ]
}

```
- Fail response 
```
{
    "success": false,
    "code": 500,
    "message": "We are under maintenance! Please check back later"
}
```

## API for course registraion

This API is to register any course. The endpoint is "{{base_url}}/students/register" (POST request). The data required to be passed is "student_id" and "course_id" following is an example (very basic structure).

```
{
    "data":{
        "student_id": "1",
        "course_id": "5"
    }
}
```

It returns mainly three types of responses (success, validation fail, and server error). Below are the samples of all three types of responses.

- Sucsess
```
{
    "success": true,
    "code": 200,
    "message": "You have registered for this course successfully!",
    "content": {
        "student_id": 12,
        "course_id": 4,
        "updated_at": "2022-03-19T01:14:02.000000Z",
        "created_at": "2022-03-19T01:14:02.000000Z",
        "id": 1
    }
}
```

- Validation fail
```
{
    "success": false,
    "code": 400,
    "message": "Validation failed",
    "content": {
        "course_id": [
            "The maximum capcity is filled."
        ]
    }
}
```

- Server error
```
{
    "success": false,
    "code": 500,
    "message": "We are under maintenance! Please check back later"
}
```

## Collection of APIs

Following is the collection of APIs (JSON)
```
{
	"info": {
		"_postman_id": "65b7aa0a-ffad-4672-9efe-d9a080472911",
		"name": "CourseRegistration",
		"schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
	},
	"item": [
		{
			"name": "{{base_url}}/students/register",
			"request": {
				"method": "POST",
				"header": [
					{
						"key": "Content-Type",
						"value": "application/json",
						"type": "default"
					},
					{
						"key": "Accept",
						"value": "application/json",
						"type": "default"
					}
				],
				"body": {
					"mode": "raw",
					"raw": "{\n    \"data\":{\n        \"student_id\": \"1\",\n        \"course_id\": \"5\"\n    }\n}",
					"options": {
						"raw": {
							"language": "json"
						}
					}
				},
				"url": {
					"raw": "{{base_url}}/students/register",
					"host": [
						"{{base_url}}"
					],
					"path": [
						"students",
						"register"
					]
				}
			},
			"response": []
		},
		{
			"name": "{{base_url}}/courses",
			"request": {
				"method": "GET",
				"header": [],
				"url": {
					"raw": "{{base_url}}/courses",
					"host": [
						"{{base_url}}"
					],
					"path": [
						"courses"
					]
				}
			},
			"response": []
		}
	]
}
```

## Environment

- PHP 8.1.2
- Laravel 9.5.1
- Composer 2.2.6
- MySQL 10.4.21

## Architecture

With the existance of Laravel MVC, the **Controller - Service - Repository** architecture is followed in this project. **Validations**, **Rules**, **Helpers** and **Constants** are maintained separately.

### Controller - Service - Repository architecture

#### Normally

 - For each DB table there is a model
 - For each model there is a repository
 - For each repository there is a service
 - For each service there is a controller
 - So basicly all layers are 1:1 to each other.

Some times there is no need of some of above mentioned files. It depends on further architechture standard of the organization.

#### In this project

There are mainly three DB tables
  - student
  - course
  - registration

So, for each DB table there is a Model but there are only two repositories
  - CourseRepositiries
  - RegistrationRepositiries

There is no interaction with Student Model other than that of StudentSeeder. So, repository for Student model is not created.

There are two Controller and Services for each i.e., student and course.

  - CourseController
  - CourseService
  - StudentController 
  - StudentService

Regarding course, there is complete flow from Controller to DB tabel. So, all of them are created, i.e, Controller -> Service -> Repository -> Model.
While, Registration model is only required with in the Student flow. So, Controller and Service is creaded only for student not for Registration Model.

#### Validations, Rules, Helpers, and Constants

- As there is only one request where user is passing data in request i.e, *students/register*. So, there is a StudentValidation to validate the request.
- RegistrationRule is also maintained that is being used in StudentValidation.
- To generate the responses of requests identically (to some extent), Responsehelper is created. So that the reponse can be formated in same manner.
- Some constants are described in constants in config.

#### Seeders

CourseSeeder and StudentSeeder are built to populate the tables intitially.

DB Tables

student 

<table>
  <tr>
    <th>Field</th>
    <th>Type</th>
    <th>Null</th>
    <th>Key</th>
    <th>Default</th>
    <th>Extra</th>
  </tr>
  <tr>
    <td>id</td>
    <td>bigint(20) unsigned</td>
    <td>NO</td>
    <td>PRI</td>
    <td>NULL</td>
    <td>auto_increment</td>
  </tr>
  <tr>
    <td>name</td>
    <td>varchar(255)</td>
    <td>NO</td>
    <td></td>
    <td>NULL</td>
    <td></td>
  </tr>
</table>

|| -- Field -- || -- Type -- || -- Null -- || -- Key -- || -- Default -- || -- Extra  
 ===================================================================================
|| --- id ---- || -- bigint(20) -- || -- Null -- || -- Key -- || -- Default -- || -- Extra  
  id ||bigint(20) unsigned
NO
PRI
NULL
auto_increment
 course	

id		   bigint(20) unsigned
NO
PRI
NULL
auto_increment

registration