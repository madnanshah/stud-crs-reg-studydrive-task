# Universit courses registration portal (API)

In this repository, following two APIs are built.

- API to show list of all offered courses
- API for course registraion

## 1. API to show list of all offered courses

This API returns list of all courses. Eeach couse contains following information.
- id
- name
- capacity (maximum student registration)
- registered_students_count (number of registered students)

The endpoint "{{base_url}}/courses" (GET request) is required to be hit. It returns the response in JSON format. Below are the sample responses of this API

- Success response
```
{
    "success": true,
    "code": 200,
    "message": "Please select a course.",
    "content": [
        {
            "id": 2,
            "name": "zueaoabusf",
            "capacity": 8,
            "registered_students_count": 5
        },
        {
            "id": 3,
            "name": "nlkgfckas3",
            "capacity": 5,
            "registered_students_count": 2
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

## 2. API for course registraion

The is API is to register any course. The endpoint is "{{base_url}}/students/register" (POST request). The data required to be passed is "student_id" and "course_id" following is an example (very basic structure).

```
{
    "student_id": 12,
    "course_id": 4
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

Following is collection of APIs (JSON)
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
					"raw": "{\n    \"student_id\": 7,\n    \"course_id\": 4\n}",
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

## Project architecture

With the existance of Laravel MVC, the ***Controller - Service - Repository*** architecture followed in this project.  ***Validations***, ***Rules***, ***Helpers*** and ***Constants*** are maintained separately.