
//https://www.w3schools.com/jquery/default.asp
//JQUERY FUNCTIONS SHOULD BE PLACED INSIDE THIS FUNCTIONS
$(function(){
  // TIP: Basic syntax is: $(selector).action()
  //        $ sign to define/access jQuery
  //        (selector) to "query (or find)" HTML elements
  //        jQuery action() to be performed on the element(s)

  /*
    FUNCTION: add in the variables for dropdowns and what not
    i.e. materials -> carbon fiber, aluminium, ..
  */
  function createFormData() {

  }

  /*
    FUNCTION: when form is changed
  */
  $("#userinput").change(function five(){
    alert("testing");
  });

  /*
    FUNCTION: when user submits form
  */
  $("#userinput").submit(function(){
    //process form and get data
    //make into json
    //send request
    //call processResponse when data comeback
  });

  /*
    FUNCTION: processes the respone json to the user
    IS CALLBACK FUNCTION
  */
  function processResponse(){
    //
  }
});
