# Edfa3ly
Edfa3ly interview OOD task.



## Agenda 
  
   * [Problem Description](#problem-description) <br>
   * [Proposed Solution](#proposed-solution) <br>
   * [System Inputs](#system-inputs)
   * [Expected Outputs](#expected-outputs)
   * [Architecture](#architecture-)
   * [Classes](#classes-)
   * [How To Run](#how-to-run)
   * [Missing Requirements](#missing-requirements-)
  


## Problem Description
Create a cart billing system that accepts a cart of predefined items and a currency. The system should issue a bill taking into consideration some aspects like:
* Subtotal
* Vat
* Discounts
* Total

## Proposed Solution 
- A simple php API implemented with OO fundamentals following SOLID principles.

## System Inputs:
The API accepts a post request with a body of cart and an optional currency. <br>
The cart is a list of strings.<br>
The available cart items are [ "T-shirt" , "Pants" , "Jacket" , "Shoes" ] -- case sensitive.<br>
The available currencies are [ "USD" , "EGP" , "EURO" ]. <br>

## Expected Outputs:
The Api returns a string with bill details.<br>
**Note:** This is not suitable for production. A better choice would be to return json object that looks like this:<br>
{"status": "success", "bill" : {"subtotal": x , "taxes":y, "discounts": "some string", "total": z} }
<br>
However I chose the output to be a string not json encoded to be more readable. Converting to Json encoding for production purposes can be done simply, given the architecture.

## Architecture <br>
<ol>
  <li> index.php is the entry point to the API. It naively validates the request and creates a billing manager object. <br>
    It invokes the getBill method and wait for the program to finish.
  </li>
  <li> Billing Manager validates the cart and the currency. Then it creates a Bill object and invokes issueBill method that returns a bill. 
  </li>
  <li> issueBill follows this simple pipeline:<br>
    3.1. Calculate subtotal.<br>
    3.2. Apply 14% vat.<br>
    3.3. Check and apply discounts through DiscountManager.<br>
    3.4. Formats the bill and return it.<br>
  </li>
</ol> 

## Classes </li>

 ### Basic building units: <br>
 
 <ol>
  <li> Item : Encapsulates the basic unit of the system, the item. An item typically has a name and a price data members.  </li>
  <li> Currency : Encapsulates currencies. A currency has a name, a conversion rate to USD and a symbol as data members. </li>
  <li> Offer : Represents an offer and is open for extension and closed for modification. Each offer extends this class. </li>
  <li> Validator: A simple base class that all validators in the system extend </li>
 </ol>
 
 ### Concrete Classes:<br>
 
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
 
 ### Manager Classes:
 
 <ol> 
  <li> ItemsManager : Responsibilities:<br>
    <ul> 
      <li> Inits the system supported units.</li>
      <li> Has some utilities like searching item price or getting all items and so on.</li>
    </ul>
  </li>
  <li> CurrencyManager: Responsibilities:<br>
    <ul>
      <li> Inits supported currencies. </li>
      <li> Has some utilities like converting an amount from USD (the default currency) to any supported currency.</li>
    </ul>
  </li>
  <li> DiscountManager : Responsibilities:<br>
    <ul>
      <li> Inits system offers.</li>
      <li> Calculates discounts for a cart. Typically loops through the supported offers and applies the offer if it can be applied. </li>
      <li> Has a method that returns the discounts details for the bill to be printed.</li>
    </ul>
  </li>
  <li> BillingManager: Responsibilities: <br>
    <ul>
      <li> Uses the validator concrete classes to validate the cart and currency. If Both are valid, It creates a bill object and psses them on to issue the bill. Otherwise throws error message </li>
    </ul>
  </li>
  <li> Bill : Responsibilities: <br>
    <ul> 
      <li> The constructor sets up an empty bill. </li>
      <li> issueBill method executes this sequence of actions:
        <ol>
          <li> Calculate subtotal.</li>
          <li> Applies taxes. </li>
          <li> invokes DiscountManager:: calcDiscounts to apply all possible discounts.</li>
          <li> Finally, Updates the total and return a bill as a string. </li>
        </ol>
      </li>
    </ul>
   </li>
 </ol>
  
## How to run:
### Prequisites:
<ul>
  <li> PHP 7.x</li>
  <li> PHP Server - XAMPP is preferred </li>
  <li> An API testing tool -- **preferably Postman **</li>
</ul>

### File System:
Clone this repo inside a folder named "edfa3ly" in the root of your server, where localhost points. <br>
If you're using Xampp you file system should look something like this:<br>
Xampp --> htdocs --> edfa3ly --> index.php and other files in the repository.

### Integration testing:
Use postman to send post requests to the route "/cart" with body that contains:
<ul>
  <li> cart => Array of valid items in string format, separated by commas. Supported items are ["Pants" , "Shoes" , "T-shirt" , "Jacket"] -- case sensitive.</li>
  <li> [Optional] : currency => A currency in string format. Supported currencies are ["USD" , "EGP", "EURO"].</li>
 </ul>
 <br>
 The system should return a string with the details of the bill.
 
 ### Missing Requirements <br>
 <ul>
  <li> Unit testing </li>
 </ul>
 ** Note ** Integration testing was conducted. No unit tests are written though. I used unit testing before with C++ tool called Catch2. However I didn't make unit tests with PHPUnit before. 
  
