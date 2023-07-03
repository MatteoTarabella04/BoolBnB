// RETRIEVE DOM ELEMENTS
const form = document.querySelector("form");
const passwordEl = document.getElementById("password");
const passwordConfirmationEl = document.getElementById("password-confirmation");
const dateEl = document.getElementById("date_of_birth");

form.addEventListener("submit", (e) => {
  // SELECT SPAN WITH ERROR MESSAGE AND DELETE THEM IF ALREADY EXIST
  const existingPasswordSpan = document.getElementById("passwordConfirmationError");
  const existingDateSpan = document.getElementById("dateError");
  if(existingPasswordSpan) {
    existingPasswordSpan.remove();
  }
  if(existingDateSpan) {
    existingDateSpan.remove();
  }

  // REMOVE is-invalid CLASS FROM PREVIOUS SUBMIT
  passwordEl.classList.remove("is-invalid");
  passwordConfirmationEl.classList.remove("is-invalid");
  dateEl.classList.remove("is-invalid");

  // READ DOM ELEMENTS VALUES
  let password = passwordEl.value;
  let passwordConfirmation = passwordConfirmationEl.value;
  let date = dateEl.value;

  // FORMAT DATE
  let today = new Date();
  const dd = String(today.getDate()).padStart(2, '0');
  const mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  const yyyy = today.getFullYear();
  today = yyyy + '-' + mm + '-' + dd;

  if(password != passwordConfirmation || date > today) {
    // PREVENT FORM SUBMIT IF THERE ARE ERRORS
    e.preventDefault();    


    if(password != passwordConfirmation) {
      // CLEAN THE PASSWORDS INPUTS
      passwordEl.value = "";
      passwordConfirmationEl.value = "";

      // ADD is-invalid CLASS
      passwordEl.classList.add("is-invalid");
      passwordConfirmationEl.classList.add("is-invalid");

      // CREATE THE SPAN FOR THE ERROR MESSAGE
      const passwordConfirmationSpan = document.createElement("span");
      passwordConfirmationSpan.classList.add("mt-1");
      passwordConfirmationSpan.setAttribute("id", "passwordConfirmationError");
      passwordConfirmationSpan.setAttribute("role", "alert");
      
      // CREATE THE STRONG WITH THE ERROR MESSAGE
      const passwordConfirmationStrong = document.createElement("strong");
      passwordConfirmationStrong.style.fontSize = "14px";
      passwordConfirmationStrong.classList.add("text-danger");
      passwordConfirmationStrong.innerText = "The passwords don't match";
      
      // ADD THE ERROR MESSAGE TO THE DOM
      passwordConfirmationSpan.appendChild(passwordConfirmationStrong);
      passwordConfirmationEl.insertAdjacentElement("afterend", passwordConfirmationSpan);
    }

    if(date > today) {
      // ADD is-invalid CLASS
      dateEl.classList.add("is-invalid");

      // CREATE THE SPAN FOR THE ERROR MESSAGE
      const dateSpan = document.createElement("span");
      dateSpan.classList.add("mt-1");
      dateSpan.setAttribute("id", "dateError");
      dateSpan.setAttribute("role", "alert");
      
      // CREATE THE STRONG WITH THE ERROR MESSAGE
      const dateStrong = document.createElement("strong");
      dateStrong.style.fontSize = "14px";
      dateStrong.classList.add("text-danger");
      dateStrong.innerText = "The date is greater than today";
      
      // ADD THE ERROR MESSAGE TO THE DOM
      dateSpan.appendChild(dateStrong);
      dateEl.insertAdjacentElement("afterend", dateSpan);
    }
  }
})
