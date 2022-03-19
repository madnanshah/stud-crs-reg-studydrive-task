## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Universit courses registration portal (API)

In this repository, following two APIs are built.

1. API to show list of all offered courses
2. API for course registraion

# 1. API to show list of all offered courses
This API returns list of all courses. Eeach couse contains following information.
a. id
b. name
c. capacity (maximum student registration)
d. registered_students_count (number of registered students)

The endpoint "{{base_url}}/courses" (GET request) is required to be hit. It returns the response in JSON format. Below are the sample responses of this API

a. Success response
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

b. Fail response 
{
    "success": false,
    "code": 500,
    "message": "We are under maintenance! Please check back later"
}

# 2. API for course registraion

The is API is to register any course. The endpoint is "{{base_url}}/students/register" (POST request). The data required to be passed is "student_id" and "course_id" following is an example (very basic structure).

{
    "student_id": 12,
    "course_id": 4
}

It returns 3 mainly three types of responses (success, validation fail, and server error). Below are the samples of all three types of responses.

a. Sucsess
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

b. Validation fail
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

c. Server error
{
    "success": false,
    "code": 500,
    "message": "We are under maintenance! Please check back later"
}

Collection of APIs (JSON)
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

# Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
