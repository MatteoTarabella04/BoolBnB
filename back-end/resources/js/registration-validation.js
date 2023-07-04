//TODO implementare validazione doppia delle regole HTML

// RETRIEVE DOM ELEMENTS
const form = document.querySelector("form");
const passwordEl = document.getElementById("password");
const passwordConfirmationEl = document.getElementById("password-confirmation");
const dateEl = document.getElementById("date_of_birth");

form.addEventListener("submit", (e) => {
  // SELECT SPAN WITH ERROR MESSAGE AND DELETE THEM IF ALREADY EXIST
  const errorSpans = [];
  errorSpans.push(document.getElementById("passwordConfirmationError"));
  errorSpans.push(document.getElementById("dateError"));

  errorSpans.forEach(span => {
    if(span) {
      span.remove();
    }
  });

  // REMOVE is-invalid CLASS FROM PREVIOUS SUBMIT
  passwordEl.classList.remove("is-invalid");
  passwordConfirmationEl.classList.remove("is-invalid");
  dateEl.classList.remove("is-invalid");

  // READ DOM ELEMENTS VALUES
  let password = passwordEl.value;
  let passwordConfirmation = passwordConfirmationEl.value;
  let date = dateEl.value;

  // FORMAT DATE
  let limitDate = new Date();
  const dd = String(limitDate.getDate()).padStart(2, '0');
  const mm = String(limitDate.getMonth() + 1).padStart(2, '0'); //January is 0!
  const yyyy = limitDate.getFullYear() - 18;
  limitDate = yyyy + '-' + mm + '-' + dd;

  if(password != passwordConfirmation || date > limitDate) {
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
      passwordConfirmationStrong.innerText = "Le password non coincidono";
      
      // ADD THE ERROR MESSAGE TO THE DOM
      passwordConfirmationSpan.appendChild(passwordConfirmationStrong);
      passwordConfirmationEl.insertAdjacentElement("afterend", passwordConfirmationSpan);
    }

    if(date > limitDate) {
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
      dateStrong.innerText = "Bisogna essere maggiorenni per registrarsi";
      
      // ADD THE ERROR MESSAGE TO THE DOM
      dateSpan.appendChild(dateStrong);
      dateEl.insertAdjacentElement("afterend", dateSpan);
    }
  }
})
