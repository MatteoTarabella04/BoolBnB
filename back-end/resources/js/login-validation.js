//TODO implementare validazione doppia delle regole HTML

// RETRIEVE DOM ELEMENTS
const form = document.getElementById("login_form");
const emailEl = document.getElementById("email");
const passwordEl = document.getElementById("password");
const mailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

form.addEventListener("submit", (e) => {
  // SELECT SPAN WITH ERROR MESSAGE AND DELETE THEM IF ALREADY EXIST
  const errorSpans = document.querySelectorAll('span[id$="Error"]');
  errorSpans.forEach(span => {
    if(span) {
      span.remove();
    }
  });

  // REMOVE is-invalid CLASS FROM PREVIOUS SUBMIT
  passwordEl.classList.remove("is-invalid");
  emailEl.classList.remove("is-invalid");

  // READ DOM ELEMENTS VALUES
  let password = passwordEl.value;
  let email = emailEl.value;

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

  if(password.length < 8) {
    // PREVENT FORM SUBMIT IF THERE ARE ERRORS
    e.preventDefault();    

    // CLEAN THE PASSWORDS INPUTS
    passwordEl.value = "";

    // ADD is-invalid CLASS
    passwordEl.classList.add("is-invalid");

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
  }
})
