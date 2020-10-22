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
**Note:** This is not suitable for production. A better choice would be to return json object that looks like this:<br>
{"status": "success", "subtotal": x , "taxes":y, "discounts": "some string", "total": z}
<br>
However I chose the output to be a string not json encoded to be more readable. Converting to Json encoding for production purposes can be done simple, given the architecture.
___
## Architecture Pipeline (Main scenario): <br>
<ol>
  <li> index.php is the entry point to the API. It naively validates the request and creates a billing manager object. <br>
    It invokes the getBill method and wait for the program to finish.
  </li>
  <li> Billing Manager validates the cart and the currency. Then it creates a Bill object and invokes issueBill method that returns a bill. 
  </li>
  <li> Bill::issueBill follows this simple pipeline:<br>
    3.1. Calculate subtotal.<br>
    3.2. Apply 14% vat.<br>
    3.3. Check and apply discounts through DiscountManager.<br>
    3.4. Formats the bill and return it.<br>
  </li>
</ol> 
___ 
## Classes and their responsibilties. 
  1. Basic building units: <br>
 <ol>
  <li> Item : Encapsulates the basic unit of the system, the item. An item typically has a name and a price data members.  </li>
  <li> Currency : Encapsulates currencies. A currency has a name, a conversion rate to USD and a symbol as data members. </li>
  <li> Offer : Represents an offer and is open for extension and closed for modification. Each offer extends this class. </li>
  <li> Validator: A simple base class that all validators in the system extend </li>
 </ol>
 2. Concrete Classes:<br>
 <ol>
  <li> CartValidator : Extends the <em>Validator</em> class and implements <em>validate</em> method.<br>
    The validate method accepts a cart and makes sure all items are among the predefined items. If at least one is not there, It terminates the request and echoes "invalid cart"
  </li>
  <li> CurrencyValidator : Extends the <em>Validator</em> class and also implements <em>validate</em> method.<br>
    The validate method makes sure that the currency submitted is supported by the system. Otherwise throws <em> invalid currency </em>.
  </li>
  <li> ShoesOffer : Extends the <em>offer</em> class and implements <em>calcDiscount</em> method. <br>
    If the offer applies to the cart, It sets the boolean <em>offerIsApplied</em> for implementation purposes.
  </li>
  <li> TshirtJacketOffer : Extends the <em>offer</em> class and implements <em>calcDiscount</em> method. <br>
    If the offer applies to the cart, It sets the boolean <em>offerIsApplied</em> for implementation purposes.
  </li>
 </ol>
