---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_c6c5c00d6ac7f771f157dff4a2889b1a -->
## _debugbar/open
> Example request:

```bash
curl -X GET -G "/_debugbar/open" 
```

```javascript
const url = new URL("/_debugbar/open");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET _debugbar/open`


<!-- END_c6c5c00d6ac7f771f157dff4a2889b1a -->

<!-- START_7b167949c615f4a7e7b673f8d5fdaf59 -->
## Return Clockwork output

> Example request:

```bash
curl -X GET -G "/_debugbar/clockwork/1" 
```

```javascript
const url = new URL("/_debugbar/clockwork/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET _debugbar/clockwork/{id}`


<!-- END_7b167949c615f4a7e7b673f8d5fdaf59 -->

<!-- START_01a252c50bd17b20340dbc5a91cea4b7 -->
## _debugbar/telescope/{id}
> Example request:

```bash
curl -X GET -G "/_debugbar/telescope/1" 
```

```javascript
const url = new URL("/_debugbar/telescope/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET _debugbar/telescope/{id}`


<!-- END_01a252c50bd17b20340dbc5a91cea4b7 -->

<!-- START_5f8a640000f5db43332951f0d77378c4 -->
## Return the stylesheets for the Debugbar

> Example request:

```bash
curl -X GET -G "/_debugbar/assets/stylesheets" 
```

```javascript
const url = new URL("/_debugbar/assets/stylesheets");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET _debugbar/assets/stylesheets`


<!-- END_5f8a640000f5db43332951f0d77378c4 -->

<!-- START_db7a887cf930ce3c638a8708fd1a75ee -->
## Return the javascript for the Debugbar

> Example request:

```bash
curl -X GET -G "/_debugbar/assets/javascript" 
```

```javascript
const url = new URL("/_debugbar/assets/javascript");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET _debugbar/assets/javascript`


<!-- END_db7a887cf930ce3c638a8708fd1a75ee -->

<!-- START_0973671c4f56e7409202dc85c868d442 -->
## Forget a cache key

> Example request:

```bash
curl -X DELETE "/_debugbar/cache/1/1" 
```

```javascript
const url = new URL("/_debugbar/cache/1/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE _debugbar/cache/{key}/{tags?}`


<!-- END_0973671c4f56e7409202dc85c868d442 -->

<!-- START_739e407ef7a935c465ac4075153117be -->
## graphql
> Example request:

```bash
curl -X GET -G "/graphql" 
```

```javascript
const url = new URL("/graphql");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[]
```

### HTTP Request
`GET graphql`


<!-- END_739e407ef7a935c465ac4075153117be -->

<!-- START_3a2e8bf296afcbc9d26307e4ca84cfb4 -->
## graphql
> Example request:

```bash
curl -X POST "/graphql" 
```

```javascript
const url = new URL("/graphql");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST graphql`


<!-- END_3a2e8bf296afcbc9d26307e4ca84cfb4 -->

<!-- START_54e29140897474c4973797a7a3f24ef1 -->
## graphql/{default}
> Example request:

```bash
curl -X GET -G "/graphql/1" 
```

```javascript
const url = new URL("/graphql/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET graphql/{default}`


<!-- END_54e29140897474c4973797a7a3f24ef1 -->

<!-- START_01ee0e24406bbb7f71e516ab27f53b7e -->
## graphql/{default}
> Example request:

```bash
curl -X POST "/graphql/1" 
```

```javascript
const url = new URL("/graphql/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST graphql/{default}`


<!-- END_01ee0e24406bbb7f71e516ab27f53b7e -->

<!-- START_4306232d7b0614f3e020f720a2be3e61 -->
## graphiql/{graphql_schema?}/{default}
> Example request:

```bash
curl -X GET -G "/graphiql/1/1" 
```

```javascript
const url = new URL("/graphiql/1/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET graphiql/{graphql_schema?}/{default}`


<!-- END_4306232d7b0614f3e020f720a2be3e61 -->

<!-- START_18b0fb726c23dabde7373bd1edafb0eb -->
## graphiql/{graphql_schema?}/{default}
> Example request:

```bash
curl -X POST "/graphiql/1/1" 
```

```javascript
const url = new URL("/graphiql/1/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST graphiql/{graphql_schema?}/{default}`


<!-- END_18b0fb726c23dabde7373bd1edafb0eb -->

<!-- START_e9e2e0325698446184f4fd1613e895ec -->
## graphiql/{graphql_schema?}
> Example request:

```bash
curl -X GET -G "/graphiql/1" 
```

```javascript
const url = new URL("/graphiql/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET graphiql/{graphql_schema?}`


<!-- END_e9e2e0325698446184f4fd1613e895ec -->

<!-- START_cb7c69339a53477b3773bf17a25dcb09 -->
## graphiql/{graphql_schema?}
> Example request:

```bash
curl -X POST "/graphiql/1" 
```

```javascript
const url = new URL("/graphiql/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST graphiql/{graphql_schema?}`


<!-- END_cb7c69339a53477b3773bf17a25dcb09 -->

<!-- START_0c068b4037fb2e47e71bd44bd36e3e2a -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X GET -G "/oauth/authorize" 
```

```javascript
const url = new URL("/oauth/authorize");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/authorize`


<!-- END_0c068b4037fb2e47e71bd44bd36e3e2a -->

<!-- START_e48cc6a0b45dd21b7076ab2c03908687 -->
## Approve the authorization request.

> Example request:

```bash
curl -X POST "/oauth/authorize" 
```

```javascript
const url = new URL("/oauth/authorize");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/authorize`


<!-- END_e48cc6a0b45dd21b7076ab2c03908687 -->

<!-- START_de5d7581ef1275fce2a229b6b6eaad9c -->
## Deny the authorization request.

> Example request:

```bash
curl -X DELETE "/oauth/authorize" 
```

```javascript
const url = new URL("/oauth/authorize");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/authorize`


<!-- END_de5d7581ef1275fce2a229b6b6eaad9c -->

<!-- START_a09d20357336aa979ecd8e3972ac9168 -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X POST "/oauth/token" 
```

```javascript
const url = new URL("/oauth/token");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token`


<!-- END_a09d20357336aa979ecd8e3972ac9168 -->

<!-- START_d6a56149547e03307199e39e03e12d1c -->
## Get all of the authorized tokens for the authenticated user.

> Example request:

```bash
curl -X GET -G "/oauth/tokens" 
```

```javascript
const url = new URL("/oauth/tokens");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/tokens`


<!-- END_d6a56149547e03307199e39e03e12d1c -->

<!-- START_a9a802c25737cca5324125e5f60b72a5 -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE "/oauth/tokens/1" 
```

```javascript
const url = new URL("/oauth/tokens/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/tokens/{token_id}`


<!-- END_a9a802c25737cca5324125e5f60b72a5 -->

<!-- START_abe905e69f5d002aa7d26f433676d623 -->
## Get a fresh transient token cookie for the authenticated user.

> Example request:

```bash
curl -X POST "/oauth/token/refresh" 
```

```javascript
const url = new URL("/oauth/token/refresh");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token/refresh`


<!-- END_abe905e69f5d002aa7d26f433676d623 -->

<!-- START_babcfe12d87b8708f5985e9d39ba8f2c -->
## Get all of the clients for the authenticated user.

> Example request:

```bash
curl -X GET -G "/oauth/clients" 
```

```javascript
const url = new URL("/oauth/clients");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/clients`


<!-- END_babcfe12d87b8708f5985e9d39ba8f2c -->

<!-- START_9eabf8d6e4ab449c24c503fcb42fba82 -->
## Store a new client.

> Example request:

```bash
curl -X POST "/oauth/clients" 
```

```javascript
const url = new URL("/oauth/clients");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/clients`


<!-- END_9eabf8d6e4ab449c24c503fcb42fba82 -->

<!-- START_784aec390a455073fc7464335c1defa1 -->
## Update the given client.

> Example request:

```bash
curl -X PUT "/oauth/clients/1" 
```

```javascript
const url = new URL("/oauth/clients/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT oauth/clients/{client_id}`


<!-- END_784aec390a455073fc7464335c1defa1 -->

<!-- START_1f65a511dd86ba0541d7ba13ca57e364 -->
## Delete the given client.

> Example request:

```bash
curl -X DELETE "/oauth/clients/1" 
```

```javascript
const url = new URL("/oauth/clients/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/clients/{client_id}`


<!-- END_1f65a511dd86ba0541d7ba13ca57e364 -->

<!-- START_9e281bd3a1eb1d9eb63190c8effb607c -->
## Get all of the available scopes for the application.

> Example request:

```bash
curl -X GET -G "/oauth/scopes" 
```

```javascript
const url = new URL("/oauth/scopes");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/scopes`


<!-- END_9e281bd3a1eb1d9eb63190c8effb607c -->

<!-- START_9b2a7699ce6214a79e0fd8107f8b1c9e -->
## Get all of the personal access tokens for the authenticated user.

> Example request:

```bash
curl -X GET -G "/oauth/personal-access-tokens" 
```

```javascript
const url = new URL("/oauth/personal-access-tokens");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/personal-access-tokens`


<!-- END_9b2a7699ce6214a79e0fd8107f8b1c9e -->

<!-- START_a8dd9c0a5583742e671711f9bb3ee406 -->
## Create a new personal access token for the user.

> Example request:

```bash
curl -X POST "/oauth/personal-access-tokens" 
```

```javascript
const url = new URL("/oauth/personal-access-tokens");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/personal-access-tokens`


<!-- END_a8dd9c0a5583742e671711f9bb3ee406 -->

<!-- START_bae65df80fd9d72a01439241a9ea20d0 -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE "/oauth/personal-access-tokens/1" 
```

```javascript
const url = new URL("/oauth/personal-access-tokens/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/personal-access-tokens/{token_id}`


<!-- END_bae65df80fd9d72a01439241a9ea20d0 -->

<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## Register api

> Example request:

```bash
curl -X POST "/api/register" 
```

```javascript
const url = new URL("/api/register");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/register`


<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_26083a9b982777e3d0ba4e9d83370f29 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "/api/configurations" 
```

```javascript
const url = new URL("/api/configurations");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/configurations`


<!-- END_26083a9b982777e3d0ba4e9d83370f29 -->

<!-- START_bdde0fbf97d59556716385ecd3342898 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "/api/configurations" 
```

```javascript
const url = new URL("/api/configurations");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/configurations`


<!-- END_bdde0fbf97d59556716385ecd3342898 -->

<!-- START_f27942806025a32d26534e0e728c0568 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET -G "/api/configurations/1" 
```

```javascript
const url = new URL("/api/configurations/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/configurations/{configuration}`


<!-- END_f27942806025a32d26534e0e728c0568 -->

<!-- START_21422cc4d209d02f1045ea466d0388bc -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "/api/configurations/1" 
```

```javascript
const url = new URL("/api/configurations/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/configurations/{configuration}`

`PATCH api/configurations/{configuration}`


<!-- END_21422cc4d209d02f1045ea466d0388bc -->

<!-- START_06f02f4d64295dbf85bff01727ec4315 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "/api/configurations/1" 
```

```javascript
const url = new URL("/api/configurations/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/configurations/{configuration}`


<!-- END_06f02f4d64295dbf85bff01727ec4315 -->

<!-- START_54cb226e1c806f816f425980068f574f -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "/api/logs" 
```

```javascript
const url = new URL("/api/logs");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/logs`


<!-- END_54cb226e1c806f816f425980068f574f -->

<!-- START_2954c52b6dd49610ce45068ac3110149 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "/api/logs" 
```

```javascript
const url = new URL("/api/logs");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/logs`


<!-- END_2954c52b6dd49610ce45068ac3110149 -->

<!-- START_87ac3298a7783be0a9b1abd0131eaf97 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET -G "/api/logs/1" 
```

```javascript
const url = new URL("/api/logs/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/logs/{log}`


<!-- END_87ac3298a7783be0a9b1abd0131eaf97 -->

<!-- START_c2f52a04404c9ff44f9a46c34989cf85 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "/api/logs/1" 
```

```javascript
const url = new URL("/api/logs/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/logs/{log}`

`PATCH api/logs/{log}`


<!-- END_c2f52a04404c9ff44f9a46c34989cf85 -->

<!-- START_38dadfb6acef1c515e02cfcaa31be340 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "/api/logs/1" 
```

```javascript
const url = new URL("/api/logs/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/logs/{log}`


<!-- END_38dadfb6acef1c515e02cfcaa31be340 -->

<!-- START_53be1e9e10a08458929a2e0ea70ddb86 -->
## /
> Example request:

```bash
curl -X GET -G "/" 
```

```javascript
const url = new URL("/");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET /`


<!-- END_53be1e9e10a08458929a2e0ea70ddb86 -->

<!-- START_2ee0101268b5b74d08fe42d860ec3336 -->
## parse
> Example request:

```bash
curl -X GET -G "/parse" 
```

```javascript
const url = new URL("/parse");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET parse`


<!-- END_2ee0101268b5b74d08fe42d860ec3336 -->

<!-- START_246742b3d14508f7b0ee8b1cd697e3d8 -->
## parse/category
> Example request:

```bash
curl -X GET -G "/parse/category" 
```

```javascript
const url = new URL("/parse/category");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET parse/category`


<!-- END_246742b3d14508f7b0ee8b1cd697e3d8 -->

<!-- START_3fb939611bffc6f5ee1e2a48ff73ae0d -->
## parse/category
> Example request:

```bash
curl -X POST "/parse/category" 
```

```javascript
const url = new URL("/parse/category");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST parse/category`


<!-- END_3fb939611bffc6f5ee1e2a48ff73ae0d -->

<!-- START_5bbde1354e052175bcd97ea5e461309a -->
## parse/category/add
> Example request:

```bash
curl -X GET -G "/parse/category/add" 
```

```javascript
const url = new URL("/parse/category/add");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET parse/category/add`


<!-- END_5bbde1354e052175bcd97ea5e461309a -->

<!-- START_648db07c2259b99fc7c052dd993ece79 -->
## parse/category/add
> Example request:

```bash
curl -X POST "/parse/category/add" 
```

```javascript
const url = new URL("/parse/category/add");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST parse/category/add`


<!-- END_648db07c2259b99fc7c052dd993ece79 -->

<!-- START_6152c804d83df69ad027bcb52716135d -->
## parse/manufacturer
> Example request:

```bash
curl -X GET -G "/parse/manufacturer" 
```

```javascript
const url = new URL("/parse/manufacturer");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET parse/manufacturer`


<!-- END_6152c804d83df69ad027bcb52716135d -->

<!-- START_3316cc5a0b04add6fa9d07cf71adaf11 -->
## parse/manufacturer
> Example request:

```bash
curl -X POST "/parse/manufacturer" 
```

```javascript
const url = new URL("/parse/manufacturer");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST parse/manufacturer`


<!-- END_3316cc5a0b04add6fa9d07cf71adaf11 -->

<!-- START_43b4335b9d07d47624022b88eeced347 -->
## parse/manufacturer/add
> Example request:

```bash
curl -X GET -G "/parse/manufacturer/add" 
```

```javascript
const url = new URL("/parse/manufacturer/add");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET parse/manufacturer/add`


<!-- END_43b4335b9d07d47624022b88eeced347 -->

<!-- START_05e0795465207405d6d2ca3e8dc994ae -->
## parse/manufacturer/add
> Example request:

```bash
curl -X POST "/parse/manufacturer/add" 
```

```javascript
const url = new URL("/parse/manufacturer/add");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST parse/manufacturer/add`


<!-- END_05e0795465207405d6d2ca3e8dc994ae -->

<!-- START_c7803732545574eda1c05492acc708c5 -->
## parse/product
> Example request:

```bash
curl -X GET -G "/parse/product" 
```

```javascript
const url = new URL("/parse/product");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET parse/product`


<!-- END_c7803732545574eda1c05492acc708c5 -->

<!-- START_7ce4f19d9ed9e4c6956b61e948b8f318 -->
## parse/product
> Example request:

```bash
curl -X POST "/parse/product" 
```

```javascript
const url = new URL("/parse/product");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST parse/product`


<!-- END_7ce4f19d9ed9e4c6956b61e948b8f318 -->

<!-- START_de2ea77884c03e7346e10cd8571a1545 -->
## parse/product/add
> Example request:

```bash
curl -X GET -G "/parse/product/add" 
```

```javascript
const url = new URL("/parse/product/add");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET parse/product/add`


<!-- END_de2ea77884c03e7346e10cd8571a1545 -->

<!-- START_fdf82a2c45f4ee5d8cf77133e356d83e -->
## parse/product/add
> Example request:

```bash
curl -X POST "/parse/product/add" 
```

```javascript
const url = new URL("/parse/product/add");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST parse/product/add`


<!-- END_fdf82a2c45f4ee5d8cf77133e356d83e -->

<!-- START_47490acd7016ff9c290a948e57a04c1f -->
## parse/node
> Example request:

```bash
curl -X GET -G "/parse/node" 
```

```javascript
const url = new URL("/parse/node");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET parse/node`


<!-- END_47490acd7016ff9c290a948e57a04c1f -->

<!-- START_3ce07d2b3519e4c74a879e7620d4150a -->
## parse/node
> Example request:

```bash
curl -X POST "/parse/node" 
```

```javascript
const url = new URL("/parse/node");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST parse/node`


<!-- END_3ce07d2b3519e4c74a879e7620d4150a -->

<!-- START_e62a91d5adff9af2da1dd4a0f5438a98 -->
## parse/subcategory
> Example request:

```bash
curl -X GET -G "/parse/subcategory" 
```

```javascript
const url = new URL("/parse/subcategory");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET parse/subcategory`


<!-- END_e62a91d5adff9af2da1dd4a0f5438a98 -->

<!-- START_b9b12635beeb9d54d9600fb9e2daf652 -->
## parse/subcategory
> Example request:

```bash
curl -X POST "/parse/subcategory" 
```

```javascript
const url = new URL("/parse/subcategory");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST parse/subcategory`


<!-- END_b9b12635beeb9d54d9600fb9e2daf652 -->

<!-- START_a651d4727a4237ea14cd8cfb05dba381 -->
## parse/subcategory/add
> Example request:

```bash
curl -X GET -G "/parse/subcategory/add" 
```

```javascript
const url = new URL("/parse/subcategory/add");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET parse/subcategory/add`


<!-- END_a651d4727a4237ea14cd8cfb05dba381 -->

<!-- START_7b3d1301b7866f71402e84598b8a4f3c -->
## parse/subcategory/add
> Example request:

```bash
curl -X POST "/parse/subcategory/add" 
```

```javascript
const url = new URL("/parse/subcategory/add");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST parse/subcategory/add`


<!-- END_7b3d1301b7866f71402e84598b8a4f3c -->

<!-- START_e92bbe58bbb53a9f5060b65570daae89 -->
## configurations/search
> Example request:

```bash
curl -X GET -G "/configurations/search" 
```

```javascript
const url = new URL("/configurations/search");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "html": "<tbody>\n    \n    \n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"110\"><\/td>\n                <td>https:\/\/www.esmokercity.de<\/td>\n                <td>.pagination &gt; li &gt; a<\/td>\n                <td>01_get_ProductList_pagination<\/td>\n                <td align=\"center\">\n                    <a class=\"btn btn-primary btn-sm vcenter\" title=\"Edit\"\n                       href=\"javascript:ajaxLoad('http:\/\/localhost\/configurations\/update\/110')\">\n                        <i class=\"fa fa-edit\"><\/i><\/a>   \n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('110')\" data-target=\"#DeleteModal\" class=\"btn btn-sm btn-danger vcenter\"><i class=\"fa fa-trash\"><\/i><\/a>\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"111\"><\/td>\n                <td>https:\/\/www.esmokercity.de<\/td>\n                <td>.product-cell h4.title &gt; a<\/td>\n                <td>11_get_ProductList_Title_In_Category<\/td>\n                <td align=\"center\">\n                    <a class=\"btn btn-primary btn-sm vcenter\" title=\"Edit\"\n                       href=\"javascript:ajaxLoad('http:\/\/localhost\/configurations\/update\/111')\">\n                        <i class=\"fa fa-edit\"><\/i><\/a>   \n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('111')\" data-target=\"#DeleteModal\" class=\"btn btn-sm btn-danger vcenter\"><i class=\"fa fa-trash\"><\/i><\/a>\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"112\"><\/td>\n                <td>https:\/\/www.esmokercity.de<\/td>\n                <td>#content h1.product-title<\/td>\n                <td>02_get_ProductInfo_Product_Name<\/td>\n                <td align=\"center\">\n                    <a class=\"btn btn-primary btn-sm vcenter\" title=\"Edit\"\n                       href=\"javascript:ajaxLoad('http:\/\/localhost\/configurations\/update\/112')\">\n                        <i class=\"fa fa-edit\"><\/i><\/a>   \n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('112')\" data-target=\"#DeleteModal\" class=\"btn btn-sm btn-danger vcenter\"><i class=\"fa fa-trash\"><\/i><\/a>\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"113\"><\/td>\n                <td>https:\/\/www.esmokercity.de<\/td>\n                <td>.product-category &gt; a<\/td>\n                <td>03_get_ProductInfo_Category_URL<\/td>\n                <td align=\"center\">\n                    <a class=\"btn btn-primary btn-sm vcenter\" title=\"Edit\"\n                       href=\"javascript:ajaxLoad('http:\/\/localhost\/configurations\/update\/113')\">\n                        <i class=\"fa fa-edit\"><\/i><\/a>   \n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('113')\" data-target=\"#DeleteModal\" class=\"btn btn-sm btn-danger vcenter\"><i class=\"fa fa-trash\"><\/i><\/a>\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"114\"><\/td>\n                <td>https:\/\/www.esmokercity.de<\/td>\n                <td>.product-category &gt; a<\/td>\n                <td>04_get_ProductInfo_Category_Name<\/td>\n                <td align=\"center\">\n                    <a class=\"btn btn-primary btn-sm vcenter\" title=\"Edit\"\n                       href=\"javascript:ajaxLoad('http:\/\/localhost\/configurations\/update\/114')\">\n                        <i class=\"fa fa-edit\"><\/i><\/a>   \n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('114')\" data-target=\"#DeleteModal\" class=\"btn btn-sm btn-danger vcenter\"><i class=\"fa fa-trash\"><\/i><\/a>\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"115\"><\/td>\n                <td>https:\/\/www.esmokercity.de<\/td>\n                <td>.price_wrapper &gt; .price<\/td>\n                <td>05_get_ProductInfo_Price<\/td>\n                <td align=\"center\">\n                    <a class=\"btn btn-primary btn-sm vcenter\" title=\"Edit\"\n                       href=\"javascript:ajaxLoad('http:\/\/localhost\/configurations\/update\/115')\">\n                        <i class=\"fa fa-edit\"><\/i><\/a>   \n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('115')\" data-target=\"#DeleteModal\" class=\"btn btn-sm btn-danger vcenter\"><i class=\"fa fa-trash\"><\/i><\/a>\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"116\"><\/td>\n                <td>https:\/\/www.esmokercity.de<\/td>\n                <td>.product-gallery img<\/td>\n                <td>06_get_ProductInfo_MainImage_URL<\/td>\n                <td align=\"center\">\n                    <a class=\"btn btn-primary btn-sm vcenter\" title=\"Edit\"\n                       href=\"javascript:ajaxLoad('http:\/\/localhost\/configurations\/update\/116')\">\n                        <i class=\"fa fa-edit\"><\/i><\/a>   \n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('116')\" data-target=\"#DeleteModal\" class=\"btn btn-sm btn-danger vcenter\"><i class=\"fa fa-trash\"><\/i><\/a>\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"117\"><\/td>\n                <td>https:\/\/www.esmokercity.de<\/td>\n                <td>.desc<\/td>\n                <td>07_get_ProductInfo_Description<\/td>\n                <td align=\"center\">\n                    <a class=\"btn btn-primary btn-sm vcenter\" title=\"Edit\"\n                       href=\"javascript:ajaxLoad('http:\/\/localhost\/configurations\/update\/117')\">\n                        <i class=\"fa fa-edit\"><\/i><\/a>   \n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('117')\" data-target=\"#DeleteModal\" class=\"btn btn-sm btn-danger vcenter\"><i class=\"fa fa-trash\"><\/i><\/a>\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"118\"><\/td>\n                <td>https:\/\/www.esmokercity.de<\/td>\n                <td>.product--details .product--buybox .price--discount-icon<\/td>\n                <td>08_get_ProductInfo_Promotional<\/td>\n                <td align=\"center\">\n                    <a class=\"btn btn-primary btn-sm vcenter\" title=\"Edit\"\n                       href=\"javascript:ajaxLoad('http:\/\/localhost\/configurations\/update\/118')\">\n                        <i class=\"fa fa-edit\"><\/i><\/a>   \n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('118')\" data-target=\"#DeleteModal\" class=\"btn btn-sm btn-danger vcenter\"><i class=\"fa fa-trash\"><\/i><\/a>\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"119\"><\/td>\n                <td>https:\/\/www.esmokercity.de<\/td>\n                <td>.product--details .product--buybox .price--line-through<\/td>\n                <td>09_get_ProductInfo_Old_Price<\/td>\n                <td align=\"center\">\n                    <a class=\"btn btn-primary btn-sm vcenter\" title=\"Edit\"\n                       href=\"javascript:ajaxLoad('http:\/\/localhost\/configurations\/update\/119')\">\n                        <i class=\"fa fa-edit\"><\/i><\/a>   \n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('119')\" data-target=\"#DeleteModal\" class=\"btn btn-sm btn-danger vcenter\"><i class=\"fa fa-trash\"><\/i><\/a>\n                <\/td>\n            <\/tr>\n        \n<\/tbody>",
    "total": 127
}
```

### HTTP Request
`GET configurations/search`


<!-- END_e92bbe58bbb53a9f5060b65570daae89 -->

<!-- START_bdb1e8acbf092528a3e98091eec3f866 -->
## configurations/search
> Example request:

```bash
curl -X POST "/configurations/search" 
```

```javascript
const url = new URL("/configurations/search");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST configurations/search`


<!-- END_bdb1e8acbf092528a3e98091eec3f866 -->

<!-- START_69469dd021bed951d5ef287b0f93a60e -->
## configurations/myproductsDeleteAll
> Example request:

```bash
curl -X DELETE "/configurations/myproductsDeleteAll" 
```

```javascript
const url = new URL("/configurations/myproductsDeleteAll");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE configurations/myproductsDeleteAll`


<!-- END_69469dd021bed951d5ef287b0f93a60e -->

<!-- START_9e942d0acafe9bbee7f05aee374326d5 -->
## configurations
> Example request:

```bash
curl -X GET -G "/configurations" 
```

```javascript
const url = new URL("/configurations");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET configurations`


<!-- END_9e942d0acafe9bbee7f05aee374326d5 -->

<!-- START_84e897fc661187566625785dfcbe8713 -->
## configurations/all
> Example request:

```bash
curl -X GET -G "/configurations/all" 
```

```javascript
const url = new URL("/configurations/all");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET configurations/all`


<!-- END_84e897fc661187566625785dfcbe8713 -->

<!-- START_6b4229dad926345b3833a896f98735e6 -->
## configurations/create
> Example request:

```bash
curl -X GET -G "/configurations/create" 
```

```javascript
const url = new URL("/configurations/create");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET configurations/create`

`POST configurations/create`


<!-- END_6b4229dad926345b3833a896f98735e6 -->

<!-- START_04eaddba0aa7e3d2f605b920f3eb11fa -->
## configurations/update/{id}
> Example request:

```bash
curl -X GET -G "/configurations/update/1" 
```

```javascript
const url = new URL("/configurations/update/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET configurations/update/{id}`

`PUT configurations/update/{id}`


<!-- END_04eaddba0aa7e3d2f605b920f3eb11fa -->

<!-- START_71e66001bcce3649c820287743f0394c -->
## configurations/delete/{id}
> Example request:

```bash
curl -X DELETE "/configurations/delete/1" 
```

```javascript
const url = new URL("/configurations/delete/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE configurations/delete/{id}`


<!-- END_71e66001bcce3649c820287743f0394c -->

<!-- START_4347713614426a853c76ac5c51f08f4f -->
## logs/search
> Example request:

```bash
curl -X GET -G "/logs/search" 
```

```javascript
const url = new URL("/logs/search");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "html": "<tbody>\n\n    \n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"22\"><\/td>\n                <td>Success<\/td>\n                <td>1<\/td>\n                <td>https:\/\/dampfdorado.de<\/td>\n                <td><\/td>\n                <td align=\"center\">\n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('22')\" data-target=\"#DeleteModal\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"><\/i><\/a>\n\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"23\"><\/td>\n                <td>Success<\/td>\n                <td>6<\/td>\n                <td>https:\/\/dampfdorado.de\/eleaf\/<\/td>\n                <td>sudo php artisan subcategory:save --subcat=https:\/\/dampfdorado.de\/eleaf\/<\/td>\n                <td align=\"center\">\n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('23')\" data-target=\"#DeleteModal\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"><\/i><\/a>\n\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"24\"><\/td>\n                <td>Success<\/td>\n                <td>11<\/td>\n                <td>https:\/\/dampfdorado.de\/<\/td>\n                <td>sudo php artisan category:save --url=https:\/\/dampfdorado.de\/<\/td>\n                <td align=\"center\">\n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('24')\" data-target=\"#DeleteModal\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"><\/i><\/a>\n\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"25\"><\/td>\n                <td>Success<\/td>\n                <td>11<\/td>\n                <td>https:\/\/dampfdorado.de\/<\/td>\n                <td>sudo php artisan category:save --url=https:\/\/dampfdorado.de\/<\/td>\n                <td align=\"center\">\n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('25')\" data-target=\"#DeleteModal\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"><\/i><\/a>\n\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"26\"><\/td>\n                <td>Success<\/td>\n                <td>11<\/td>\n                <td>https:\/\/dampfdorado.de\/<\/td>\n                <td>sudo php artisan category:save --url=https:\/\/dampfdorado.de\/<\/td>\n                <td align=\"center\">\n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('26')\" data-target=\"#DeleteModal\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"><\/i><\/a>\n\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"27\"><\/td>\n                <td>Success<\/td>\n                <td>11<\/td>\n                <td>https:\/\/dampfdorado.de\/<\/td>\n                <td>sudo php artisan category:save --url=https:\/\/dampfdorado.de\/<\/td>\n                <td align=\"center\">\n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('27')\" data-target=\"#DeleteModal\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"><\/i><\/a>\n\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"28\"><\/td>\n                <td>Success<\/td>\n                <td>11<\/td>\n                <td>https:\/\/dampfdorado.de\/<\/td>\n                <td>sudo php artisan category:save --url=https:\/\/dampfdorado.de\/<\/td>\n                <td align=\"center\">\n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('28')\" data-target=\"#DeleteModal\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"><\/i><\/a>\n\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"29\"><\/td>\n                <td>Success<\/td>\n                <td>11<\/td>\n                <td>https:\/\/dampfdorado.de\/<\/td>\n                <td>sudo php artisan category:save --url=https:\/\/dampfdorado.de\/<\/td>\n                <td align=\"center\">\n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('29')\" data-target=\"#DeleteModal\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"><\/i><\/a>\n\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"30\"><\/td>\n                <td>Success<\/td>\n                <td>11<\/td>\n                <td>https:\/\/dampfdorado.de\/<\/td>\n                <td>sudo php artisan category:save --url=https:\/\/dampfdorado.de\/<\/td>\n                <td align=\"center\">\n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('30')\" data-target=\"#DeleteModal\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"><\/i><\/a>\n\n                <\/td>\n            <\/tr>\n                    <tr>\n                <td><input type=\"checkbox\" class=\"sub_chk\" data-id=\"31\"><\/td>\n                <td>Success<\/td>\n                <td>28<\/td>\n                <td>https:\/\/dampfdorado.de\/e-zigaretten<\/td>\n                <td>sudo php artisan hersteller:save --url=https:\/\/dampfdorado.de\/e-zigaretten<\/td>\n                <td align=\"center\">\n                    <input type=\"hidden\" name=\"_method\" value=\"delete\"\/>\n\n                    <a href=\"javascript:;\" data-toggle=\"modal\" onclick=\"deleteData('31')\" data-target=\"#DeleteModal\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"><\/i><\/a>\n\n                <\/td>\n            <\/tr>\n        \n<\/tbody>\n ",
    "total": 487
}
```

### HTTP Request
`GET logs/search`


<!-- END_4347713614426a853c76ac5c51f08f4f -->

<!-- START_d67785f5952b3d000c42a378eba0a734 -->
## logs/search
> Example request:

```bash
curl -X POST "/logs/search" 
```

```javascript
const url = new URL("/logs/search");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logs/search`


<!-- END_d67785f5952b3d000c42a378eba0a734 -->

<!-- START_dbea41188930c37317b4248d9b6456a0 -->
## logs/myproductsDeleteAll
> Example request:

```bash
curl -X DELETE "/logs/myproductsDeleteAll" 
```

```javascript
const url = new URL("/logs/myproductsDeleteAll");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE logs/myproductsDeleteAll`


<!-- END_dbea41188930c37317b4248d9b6456a0 -->

<!-- START_f497f1f7d005ed681f077661b5a3f11b -->
## logs
> Example request:

```bash
curl -X GET -G "/logs" 
```

```javascript
const url = new URL("/logs");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET logs`


<!-- END_f497f1f7d005ed681f077661b5a3f11b -->

<!-- START_7ad70dcb6fe1ebbdfe679e58b1e40af6 -->
## logs/all
> Example request:

```bash
curl -X GET -G "/logs/all" 
```

```javascript
const url = new URL("/logs/all");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET logs/all`


<!-- END_7ad70dcb6fe1ebbdfe679e58b1e40af6 -->

<!-- START_dc7a4cd7e896cab1d68148f31719dbc3 -->
## logs/delete/{id}
> Example request:

```bash
curl -X DELETE "/logs/delete/1" 
```

```javascript
const url = new URL("/logs/delete/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE logs/delete/{id}`


<!-- END_dc7a4cd7e896cab1d68148f31719dbc3 -->

<!-- START_4e9fc3df6ebb2a43640615862b5850b2 -->
## statistics
> Example request:

```bash
curl -X GET -G "/statistics" 
```

```javascript
const url = new URL("/statistics");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET statistics`


<!-- END_4e9fc3df6ebb2a43640615862b5850b2 -->

<!-- START_265b4e8bac1c6c7197dabb81f2fe480f -->
## Upload file to server.

> Example request:

```bash
curl -X POST "/ajax/uploader/upload" 
```

```javascript
const url = new URL("/ajax/uploader/upload");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST ajax/uploader/upload`


<!-- END_265b4e8bac1c6c7197dabb81f2fe480f -->

<!-- START_13fefec785b3858e23348f9c30d859e1 -->
## Delete file from server.

> Example request:

```bash
curl -X POST "/ajax/uploader/delete" 
```

```javascript
const url = new URL("/ajax/uploader/delete");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST ajax/uploader/delete`


<!-- END_13fefec785b3858e23348f9c30d859e1 -->

<!-- START_7a649048010a6c7aae88db8d183e0dcb -->
## Create preview image.

> Example request:

```bash
curl -X POST "/ajax/uploader/preview" 
```

```javascript
const url = new URL("/ajax/uploader/preview");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST ajax/uploader/preview`


<!-- END_7a649048010a6c7aae88db8d183e0dcb -->


