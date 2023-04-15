## Pre-requisitos

- MySQL 5.7 o superior
- PHP 8.0 o superior
- Composer
- Nodejs v18 o superior

## Instalación

- Instalación de dependencias Servidor
```
composer install
```  

- Instalación de dependencias Cliente (Opcional)

```
npm install && npm run dev
```  

- Ejecución  

```
php artisan serve
```  

### Metodos disponibles

1. Obtener token de autenticación  

**Metodo:** POST 
**Endpoint:** /api/login  
**Headers:**  

| Key | Value |
| --- | --- |
| Content-Type | application/json |  

**Request Body:**  

```
{
    "email": "luigi@test.com",
    "password": "test01"
}
```  

**Response Body:**  

```
1|nKN0nHDfDTPsbRsTNBOYZf7Dx0MHu2ZgRyMOtz4I
```  

2. Crear evento  

**Metodo:** POST 
**Endpoint:** /api/events 
**Headers:**  

| Key | Value |
| --- | --- |
| Content-Type | application/json |
| Authorization | Bearer {access_token} |  

**Request Body:**  

```
{
    "title": "Electronic festival",
    "description": "20 days of full electronica festival in the best place of the world",
    "date": "2023-05-15",
    "location": "Seattle",
    "price": "3000",
    "attendee_limit": "400"
}
```  

**Response Body:**  

```
{
    "message": "The event has been created.",
    "event": {
        "title": "Electronic festival",
        "description": "20 days of full electronica festival in the best place of the world",
        "date": "2023-05-15",
        "location": "Seattle",
        "price": "3000",
        "attendee_limit": "400",
        "updated_at": "2023-04-15T00:46:06.000000Z",
        "created_at": "2023-04-15T00:46:06.000000Z",
        "id": 1
        }
}
```

3. Modificar evento  

**Metodo:** PUT
**Endpoint:** /api/events/{id}
**Headers:**  

| Key | Value |
| --- | --- |
| Content-Type | application/json |
| Authorization | Bearer {access_token} |  

**Request Body:**  

```
{
    "title": "Electronic festival",
    "description": "20 days of full electronica festival in the best place of the world",
    "date": "2023-05-15",
    "location": "Roma",
    "price": "4000",
    "attendee_limit": "400"
}
```  

**Response Body:**  

```
{
        "message": "The event has been modified.",
    "event": {
        "title": "Electronic festival",
        "description": "20 days of full electronica festival in the best place of the world",
        "date": "2023-05-15",
        "location": "Roma",
        "price": "4000",
        "attendee_limit": "400",
        "updated_at": "2023-04-15T00:56:47.000000Z",
        "created_at": "2023-04-15T00:56:47.000000Z",
        "id": 2
        }
}
```  

3. Eliminar evento  

**Metodo:** DELETE
**Endpoint:** /api/events/{id}
**Headers:**  

| Key | Value |
| --- | --- |
| Content-Type | application/json |
| Authorization | Bearer {access_token} |  

```  

**Response Body:**  

```

{
    "message": "The event has been deleted."
}

4. Mostrar eventos  

**Metodo:** GET
**Endpoint:** /api/events
**Headers:**  

| Key | Value |
| --- | --- |
| Content-Type | application/json |
| Authorization | Bearer {access_token} |  

```  

**Response Body:**  

```

{
  {
          "id": 1,
          "title": "Electronic festival",
          "description": "20 days of full electronica festival in the best place of the world",
          "date": "2023-05-15",
          "location": "Roma",
          "price": 4000,
          "attendee_limit": 400,
          "created_at": "2023-04-15T00:46:06.000000Z",
          "updated_at": "2023-04-15T00:56:47.000000Z"
      },
      {
          "id": 2,
          "title": "Vallenato festival",
          "description": "30 days of full vallenato festival in the best place of the world",
          "date": "2023-05-15",
          "location": "Valledupar",
          "price": 4000,
          "attendee_limit": 400,
          "created_at": "2023-04-15T00:56:47.000000Z",
          "updated_at": "2023-04-15T00:56:47.000000Z"
      }
 }


5. Reservar tiquetes para los eventos

**Metodo:** POST
**Endpoint:** /api/tickets  
**Headers:**  

| Key | Value |
| --- | --- |
| Content-Type | application/json |
| Authorization | Bearer {access_token} |  

**Request Body:**  

```
{
    "user_id": "11",
    "event_id": "1"
}

``` 

**Response Body:**  

```
{
    "message": "The ticket has been reserved.",
    "ticket": {
        "user_id": "11",
        "event_id": "1",
        "updated_at": "2023-04-15T01:15:02.000000Z",
        "created_at": "2023-04-15T01:15:02.000000Z",
        "id": 1
    }
}

```  
6. Modificar tiquetes para los eventos

**Metodo:** PUT
**Endpoint:** /api/tickets/{id}
**Headers:**  

| Key | Value |
| --- | --- |
| Content-Type | application/json |
| Authorization | Bearer {access_token} |  

**Request Body:**  

```
{
    "user_id": "11",
    "event_id": "2"
}

``` 

**Response Body:**  

```
{
    "message": "The ticket has been modified.",
    "ticket": {
        "user_id": "11",
        "event_id": "2",
        "updated_at": "2023-04-15T01:23:48.000000Z",
        "created_at": "2023-04-15T01:23:48.000000Z",
        "id": 2
    }
}

```

7. Eliminar tiquetes

**Metodo:** DELETE
**Endpoint:** /api/tickets/{id}
**Headers:**  

| Key | Value |
| --- | --- |
| Content-Type | application/json |
| Authorization | Bearer {access_token} |  

**Response Body:**  

```
{
    "message": "The ticket has been deleted."
}
```  
8.  Poblar la base de datos

```
php artisan db:seed
```  

