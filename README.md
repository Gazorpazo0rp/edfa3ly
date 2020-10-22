# edfa3ly
Edfa3ly interview OOD task.
___
## Problem Description
Create a cart billing system that accepts a cart of predefined items and a currency. The system should issue a bill taking into consideration some aspects like:
* Subtotal
* Vat
* Discounts
* Total
___
## Solution 
- A simple php API implemented with OO fundamentals following SOLID principles.
___
## System inputs:
The API accepts a post request with a body of cart and an optional currency. <br>
The cart is a list of strings.<br>
The available cart items are ("T-shirt","Pants","Jacket","Shoes") -- case sensitive.<br>
The available currencies are "USD", "EGP" and "EURO". <br>
___
## System outputs:
The Api returns a string with bill details.<br>
**Note** This is not suitable for production. A better choice would be to return json object that looks like this:<br>
{"status": "success", "subtotal": x , "taxes":y, "discounts": "some string", "total": z}
<br>
However I chose the output to be a string not json encoded to be more readable. Converting to Json encoding for production purposes can be done simple, given the architecture.
___
