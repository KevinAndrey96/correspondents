# APIs de usuario

---
En esta sección se explicará como usar las diferentes APIs para los usuarios de la plataforma.

<a name="section-1"></a>
## Login API
### Endpoint
El endpoint al que tiene que hacer la petición POST es el siguiente: 

```php
https://testing.asparecargas.net/api/v1/user/login
```
### Login JSON 
Tiene que usar el siguiente formato en el JSON con el que realizará la petición:

```php
{
	"email":"user@gmail.com",
	"password":"user1234"
}
```
### Resultado de la petición
Si todo sale correctamente el resultado sera el siguiente:

```php
{
	"message": "Success Login",
	"access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmU1ZGJkNzUwNTYzMjJhOTFmZDM2M2RhMTkxZj
	lmMGFiNjY1MmUwOWJjNzk1NjM0OTJhNTQ3YzI5NGQ4OWNiNWJmMjNjZDgxZDkzOTFmNjkiLCJpYXQiOjE3MTY3Njg4NzAuOTM5NTM2LCJuYmYiOjE3MT
	Y3Njg4NzAuOTM5NTQzLCJleHAiOjE3NDgzMDQ4NzAuOTMwNDY0LCJzdWIiOiIyNyIsInNjb3BlcyI6W119.mZNg4yOdFRrw9tG1ZcFnmpe-8sFfzGFyI
	ehHUM-B45d8kAwAlM16-xY1lqxqAtMKWj2fkT_1zjmXUY4qkZ6MCkgaKQ0A8D62nDkAcmvhIME-ea70AaopQfo325g9DzZ2HaLpUVdvfvXoB9yfa1D4_
	7e4BIzsZpX7l-8Cc11Bm9EwlI63m5ufsKXMdLocuKSP5uU_WZgfs4WUkjCv12355_X2xVCGMyQSb8nccFdnr0FCnSPNoCZrLCY4dALMP9ireIgt1L5yOC
	3stcrIjvLqPR687PqKF6bCxr1WaUVQat1vJT6P5kR7Q8UBlr0Xx0kKiON9xO3PdZKvQ7LRNSoAgvssBOcGBEIXCmoVmr9xLZKxZPpfOhdoAcy1hDZocYE
	srFQHMBT_wT1lm7YgcI2ZFf5bfqQKwN3hC_jL4kWBDrJz9irD2Tl44rpowiTtO0QofbUuZXztpk1svgpmAASteUdT5Ich1eHlSu3_v5CODZl4-svJg4t7
	ec3q4dE6jg56AwDaGPNSLc4Kw96TdxarY5l0c1UJ1LNjYPZUcVdEJI3NKFdewqNIE0V1Oh29e9_9cp9-2fekLtnpn6wiaRsg8fOm5ozhSeMyuHX3BefC
	GS-e4e0Nn3UEzEISiYQTCQtgjWC6ZiZP_rNEOQLaKlpI9M2ukXXBpN0dDdGUpK4J_OE"
}
```
El siguiente link lo redirigirá a una página donde se mostrará de manera más detallada como serian cada uno de los
posibles resultados de la API.

```php
https://testing.asparecargas.net/api/documentation
```
