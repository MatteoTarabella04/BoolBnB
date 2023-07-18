// RETRIEVE DOM ELEMENTS
const form = document.getElementById("register_form");
const emailEl = document.getElementById("email");
const passwordEl = document.getElementById("password");
const passwordConfirmationEl = document.getElementById("password-confirmation");
const firstNameEl = document.getElementById("first_name");
const lastNameEl = document.getElementById("last_name");
const dateEl = document.getElementById("date_of_birth");
const mailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

// FORMAT DATE
let limitDate = new Date();
const dd = String(limitDate.getDate()).padStart(2, '0');
const mm = String(limitDate.getMonth() + 1).padStart(2, '0'); //January is 0!
const yyyy = limitDate.getFullYear() - 18;
limitDate = yyyy + '-' + mm + '-' + dd;
dateEl.setAttribute("max", limitDate);

form.addEventListener("submit", (e) => {
  // SELECT SPAN WITH ERROR MESSAGE AND DELETE THEM IF ALREADY EXIST
  const errorSpans = document.querySelectorAll('span[id$="Error"]');
  errorSpans.forEach(span => {
    if(span) {
      span.remove();
    }
  });

  // REMOVE is-invalid CLASS FROM PREVIOUS SUBMIT
  emailEl.classList.remove("is-invalid");
  passwordEl.classList.remove("is-invalid");
  passwordConfirmationEl.classList.remove("is-invalid");
  firstNameEl.classList.remove("is-invalid");
  lastNameEl.classList.remove("is-invalid");
  dateEl.classList.remove("is-invalid");

  // READ DOM ELEMENTS VALUES
  let email = emailEl.value;
  let password = passwordEl.value;
  let passwordConfirmation = passwordConfirmationEl.value;
  let firstName = firstNameEl.value;
  let lastName = lastNameEl.value;
  let date = dateEl.value;

  if(!mailRegex.test(email)) {
    // PREVENT FORM SUBMIT IF THERE ARE ERRORS
    e.preventDefault();

    // ADD is-invalid CLASS
    emailEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const emailSpan = document.createElement("span");
    emailSpan.classList.add("mt-1");
    emailSpan.setAttribute("id", "emailError");
    emailSpan.setAttribute("role", "alert");

    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const emailStrong = document.createElement("strong");
    emailStrong.style.fontSize = "14px";
    emailStrong.classList.add("text-danger");
    emailStrong.innerText = "Inserire una e-mail valida";

    // ADD THE ERROR MESSAGE TO THE DOM
    emailSpan.appendChild(emailStrong);
    emailEl.insertAdjacentElement("afterend", emailSpan);
  }

  if(password != passwordConfirmation || password.length < 8) {
    // PREVENT FORM SUBMIT IF THERE ARE ERRORS
    e.preventDefault();

    // CLEAN THE PASSWORDS INPUTS
    passwordEl.value = "";
    passwordConfirmationEl.value = "";

    // ADD is-invalid CLASS
    passwordEl.classList.add("is-invalid");

    if(password.length < 8) {
      // CREATE THE SPAN FOR THE ERROR MESSAGE
      const passwordSpan = document.createElement("span");
      passwordSpan.classList.add("mt-1");
      passwordSpan.setAttribute("id", "passwordError");
      passwordSpan.setAttribute("role", "alert");
      
      // CREATE THE STRONG WITH THE ERROR MESSAGE
      const passwordStrong = document.createElement("strong");
      passwordStrong.style.fontSize = "14px";
      passwordStrong.classList.add("text-danger");
      passwordStrong.innerText = "La password dev'essere lunga almeno 8 caratteri";
      
      // ADD THE ERROR MESSAGE TO THE DOM
      passwordSpan.appendChild(passwordStrong);
      passwordEl.insertAdjacentElement("afterend", passwordSpan);
    } else {
      // ADD is-invalid CLASS
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
  }

  if(firstName != "" && ( firstName.length < 2 || firstName.length > 50)) {
    // PREVENT FORM SUBMIT IF THERE ARE ERRORS
    e.preventDefault();

    // ADD is-invalid CLASS
    firstNameEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const firstNameSpan = document.createElement("span");
    firstNameSpan.classList.add("mt-1");
    firstNameSpan.setAttribute("id", "firstNameError");
    firstNameSpan.setAttribute("role", "alert");

    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const firstNameStrong = document.createElement("strong");
    firstNameStrong.style.fontSize = "14px";
    firstNameStrong.classList.add("text-danger");
    firstNameStrong.innerText = "Inserire un nome valido";

    // ADD THE ERROR MESSAGE TO THE DOM
    firstNameSpan.appendChild(firstNameStrong);
    firstNameEl.insertAdjacentElement("afterend", firstNameSpan);
  }

  if(lastName != "" && (lastName.length < 2 || lastName.length > 50)) {
    // PREVENT FORM SUBMIT IF THERE ARE ERRORS
    e.preventDefault();

    // ADD is-invalid CLASS
    lastNameEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const lastNameSpan = document.createElement("span");
    lastNameSpan.classList.add("mt-1");
    lastNameSpan.setAttribute("id", "lastNameError");
    lastNameSpan.setAttribute("role", "alert");

    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const lastNameStrong = document.createElement("strong");
    lastNameStrong.style.fontSize = "14px";
    lastNameStrong.classList.add("text-danger");
    lastNameStrong.innerText = "Inserire un cognome valido";

    // ADD THE ERROR MESSAGE TO THE DOM
    lastNameSpan.appendChild(lastNameStrong);
    lastNameEl.insertAdjacentElement("afterend", lastNameSpan);
  }

  if(date != "" && (date < "1900-01-01" || date > limitDate)) {
    // PREVENT FORM SUBMIT IF THERE ARE ERRORS
    e.preventDefault();
    
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
    dateStrong.innerText = "Bisogna essere maggiorenni per registrarsi e la data deve essere coerente";
    
    // ADD THE ERROR MESSAGE TO THE DOM
    dateSpan.appendChild(dateStrong);
    dateEl.insertAdjacentElement("afterend", dateSpan);
  }
});
