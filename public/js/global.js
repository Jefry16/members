"use strict";
console.log("global js");

function togglePasswordField(field) {
  if (field.getAttribute("type") == "password") {
    field.setAttribute("type", "text");
    return;
  }
  field.setAttribute("type", "password");
}


