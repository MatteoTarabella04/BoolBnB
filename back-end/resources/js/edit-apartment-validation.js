//TODO implementare validazione doppia delle regole HTML
// RETRIEVE DOM ELEMENTS
const formEl = document.getElementById("edit_apartment_form");
const nameValidationEl = document.getElementById("name");
const descriptionValidationEl = document.getElementById("description");
const apartmentTypeValidationEl = document.getElementById("apartment_type_id")
const pricePerNightValidationEl = document.getElementById("price_per_night");
const roomsValidationEl = document.getElementById("rooms");
const bedsValidationEl = document.getElementById("beds");
const bathroomsValidationEl = document.getElementById("bathrooms");
const squareMetersValidationEl = document.getElementById("square_meters");
const addressValidationEl = document.getElementById("address");
const latitudeValidationEl = document.getElementById("latitude");
const longitudeValidationEl = document.getElementById("longitude");
const apartmentServicesValidationEls = document.querySelectorAll("[name='services[]']");
const apartmentTypesAmount = document.querySelectorAll("#apartment_type_id > option").length - 1;

function scrollToTop() {
  document.body.scrollTop = document.documentElement.scrollTop = 0;
}

formEl.addEventListener("submit", (e) => {
  // SELECT SPAN WITH ERROR MESSAGE AND DELETE THEM IF ALREADY EXIST
  const errorSpans = document.querySelectorAll('span[id$="Error"]');
  errorSpans.forEach(span => {
    if(span) {
      span.remove();
    }
  });

  // REMOVE is-invalid CLASS FROM PREVIOUS SUBMIT
  nameValidationEl.classList.remove("is-invalid");
  descriptionValidationEl.classList.remove("is-invalid");
  apartmentTypeValidationEl.classList.remove("is-invalid");
  pricePerNightValidationEl.classList.remove("is-invalid");
  roomsValidationEl.classList.remove("is-invalid");
  bedsValidationEl.classList.remove("is-invalid");
  bathroomsValidationEl.classList.remove("is-invalid");
  squareMetersValidationEl.classList.remove("is-invalid");
  addressValidationEl.classList.remove("is-invalid");
  latitudeValidationEl.classList.remove("is-invalid");
  longitudeValidationEl.classList.remove("is-invalid");
  
  apartmentServicesValidationEls.forEach(apartmentService => {
    apartmentService.classList.remove("is-invalid");
  });

  // READ DOM ELEMENTS VALUES
  let name = nameValidationEl.value;
  let description = descriptionValidationEl.value;
  let apartmentType = apartmentTypeValidationEl.value;
  let pricePerNight = pricePerNightValidationEl.value;
  let rooms = roomsValidationEl.value;
  let beds = bedsValidationEl.value;
  let bathrooms = bathroomsValidationEl.value;
  let squareMeters = squareMetersValidationEl.value;
  let address = addressValidationEl.value;
  let latitude = latitudeValidationEl.value;
  let longitude = longitudeValidationEl.value;

  if(name.length < 3 || name.length > 255) {
    e.preventDefault();
    scrollToTop();

    // ADD is-invalid CLASS
    nameValidationEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const nameValidationSpan = document.createElement("span");
    nameValidationSpan.classList.add("mt-1");
    nameValidationSpan.setAttribute("id", "nameError");
    nameValidationSpan.setAttribute("role", "alert");
    
    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const nameValidationStrong = document.createElement("strong");
    nameValidationStrong.style.fontSize = "14px";
    nameValidationStrong.classList.add("text-danger");
    nameValidationStrong.innerText = "Inserire un nome compreso tra 3 e 255 caratteri";
    
    // ADD THE ERROR MESSAGE TO THE DOM
    nameValidationSpan.appendChild(nameValidationStrong);
    nameValidationEl.insertAdjacentElement("afterend", nameValidationSpan);
  }

  if(description.length < 3 || description.length > 65535) {
    e.preventDefault();
    scrollToTop();

    // ADD is-invalid CLASS
    descriptionValidationEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const descriptionValidationSpan = document.createElement("span");
    descriptionValidationSpan.classList.add("mt-1");
    descriptionValidationSpan.setAttribute("id", "descriptionError");
    descriptionValidationSpan.setAttribute("role", "alert");
    
    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const descriptionValidationStrong = document.createElement("strong");
    descriptionValidationStrong.style.fontSize = "14px";
    descriptionValidationStrong.classList.add("text-danger");
    descriptionValidationStrong.innerText = "Inserire una descrizione di almeno 3 caratteri";
    
    // ADD THE ERROR MESSAGE TO THE DOM
    descriptionValidationSpan.appendChild(descriptionValidationStrong);
    descriptionValidationEl.insertAdjacentElement("afterend", descriptionValidationSpan);
  }

  if(isNaN(parseInt(apartmentType)) || apartmentType === "" || apartmentType < 1 || apartmentType > apartmentTypesAmount) {
    e.preventDefault();
    scrollToTop();

    // ADD is-invalid CLASS
    apartmentTypeValidationEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const apartmentTypeValidationSpan = document.createElement("span");
    apartmentTypeValidationSpan.classList.add("mt-1");
    apartmentTypeValidationSpan.setAttribute("id", "apartmentTypeError");
    apartmentTypeValidationSpan.setAttribute("role", "alert");
    
    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const apartmentTypeValidationStrong = document.createElement("strong");
    apartmentTypeValidationStrong.style.fontSize = "14px";
    apartmentTypeValidationStrong.classList.add("text-danger");
    apartmentTypeValidationStrong.innerText = "Inserire un prezzo valido";
    
    // ADD THE ERROR MESSAGE TO THE DOM
    apartmentTypeValidationSpan.appendChild(apartmentTypeValidationStrong);
    apartmentTypeValidationEl.insertAdjacentElement("afterend", apartmentTypeValidationSpan);
  }

  if(pricePerNight <= 0 || pricePerNight > 999999.99) {
    e.preventDefault();
    scrollToTop();

    // ADD is-invalid CLASS
    pricePerNightValidationEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const pricePerNightValidationSpan = document.createElement("span");
    pricePerNightValidationSpan.classList.add("mt-1");
    pricePerNightValidationSpan.setAttribute("id", "pricePerNightError");
    pricePerNightValidationSpan.setAttribute("role", "alert");
    
    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const pricePerNightValidationStrong = document.createElement("strong");
    pricePerNightValidationStrong.style.fontSize = "14px";
    pricePerNightValidationStrong.classList.add("text-danger");
    pricePerNightValidationStrong.innerText = "Inserire un prezzo valido";
    
    // ADD THE ERROR MESSAGE TO THE DOM
    pricePerNightValidationSpan.appendChild(pricePerNightValidationStrong);
    pricePerNightValidationEl.insertAdjacentElement("afterend", pricePerNightValidationSpan);
  }

  if(rooms < 1 || rooms > 255) {
    e.preventDefault();
    scrollToTop();

    // ADD is-invalid CLASS
    roomsValidationEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const roomsValidationSpan = document.createElement("span");
    roomsValidationSpan.classList.add("mt-1");
    roomsValidationSpan.setAttribute("id", "roomsError");
    roomsValidationSpan.setAttribute("role", "alert");
    
    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const roomsValidationStrong = document.createElement("strong");
    roomsValidationStrong.style.fontSize = "14px";
    roomsValidationStrong.classList.add("text-danger");
    roomsValidationStrong.innerText = "Inserire un numero di stanze valido";
    
    // ADD THE ERROR MESSAGE TO THE DOM
    roomsValidationSpan.appendChild(roomsValidationStrong);
    roomsValidationEl.insertAdjacentElement("afterend", roomsValidationSpan);
  }

  if(beds < 0 || beds > 255) {
    e.preventDefault();
    scrollToTop();

    // ADD is-invalid CLASS
    bedsValidationEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const bedsValidationSpan = document.createElement("span");
    bedsValidationSpan.classList.add("mt-1");
    bedsValidationSpan.setAttribute("id", "bedsError");
    bedsValidationSpan.setAttribute("role", "alert");
    
    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const bedsValidationStrong = document.createElement("strong");
    bedsValidationStrong.style.fontSize = "14px";
    bedsValidationStrong.classList.add("text-danger");
    bedsValidationStrong.innerText = "Inserire un numero di posti letto valido";
    
    // ADD THE ERROR MESSAGE TO THE DOM
    bedsValidationSpan.appendChild(bedsValidationStrong);
    bedsValidationEl.insertAdjacentElement("afterend", bedsValidationSpan);
  }

  if(bathrooms < 0 || bathrooms > 255) {
    e.preventDefault();
    scrollToTop();

    // ADD is-invalid CLASS
    bathroomsValidationEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const bathroomsValidationSpan = document.createElement("span");
    bathroomsValidationSpan.classList.add("mt-1");
    bathroomsValidationSpan.setAttribute("id", "bathroomsError");
    bathroomsValidationSpan.setAttribute("role", "alert");
    
    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const bathroomsValidationStrong = document.createElement("strong");
    bathroomsValidationStrong.style.fontSize = "14px";
    bathroomsValidationStrong.classList.add("text-danger");
    bathroomsValidationStrong.innerText = "Inserire un numero di bagni valido";
    
    // ADD THE ERROR MESSAGE TO THE DOM
    bathroomsValidationSpan.appendChild(bathroomsValidationStrong);
    bathroomsValidationEl.insertAdjacentElement("afterend", bathroomsValidationSpan);
  }

  if(squareMeters <= 0 || squareMeters > 65535) {
    e.preventDefault();
    scrollToTop();

    // ADD is-invalid CLASS
    squareMetersValidationEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const squareMetersValidationSpan = document.createElement("span");
    squareMetersValidationSpan.classList.add("mt-1");
    squareMetersValidationSpan.setAttribute("id", "squareMetersError");
    squareMetersValidationSpan.setAttribute("role", "alert");
    
    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const squareMetersValidationStrong = document.createElement("strong");
    squareMetersValidationStrong.style.fontSize = "14px";
    squareMetersValidationStrong.classList.add("text-danger");
    squareMetersValidationStrong.innerText = "Inserire un numero di mq valido";
    
    // ADD THE ERROR MESSAGE TO THE DOM
    squareMetersValidationSpan.appendChild(squareMetersValidationStrong);
    squareMetersValidationEl.insertAdjacentElement("afterend", squareMetersValidationSpan);
  }

  if(address === "" || latitude === "" || longitude === "" || latitude < -90 || latitude > 90 || longitude < -180 || longitude > 180) {
    e.preventDefault();
    scrollToTop();

    // CLEAN THE PASSWORDS INPUTS
    latitude = "";
    longitude = "";

    // ADD is-invalid CLASS
    addressValidationEl.classList.add("is-invalid");

    // CREATE THE SPAN FOR THE ERROR MESSAGE
    const addressValidationSpan = document.createElement("span");
    addressValidationSpan.classList.add("mt-1");
    addressValidationSpan.setAttribute("id", "addressError");
    addressValidationSpan.setAttribute("role", "alert");
    
    // CREATE THE STRONG WITH THE ERROR MESSAGE
    const addressValidationStrong = document.createElement("strong");
    addressValidationStrong.style.fontSize = "14px";
    addressValidationStrong.classList.add("text-danger");
    addressValidationStrong.innerText = "Selezionare un indirizzo dall'elenco che compare durante la digitazione";
    
    // ADD THE ERROR MESSAGE TO THE DOM
    addressValidationSpan.appendChild(addressValidationStrong);
    addressValidationEl.insertAdjacentElement("afterend", addressValidationSpan);
  }

  apartmentServicesValidationEls.forEach((apartmentService, index) => {
    if(isNaN(parseInt(apartmentService.value)) || apartmentService.value === "" || apartmentService.value < 1 || apartmentService.value > apartmentServicesValidationEls.length) {
      e.preventDefault();
      scrollToTop();

      // SELECT THE LABEL OF THE CHECKBOX WITH THE ERROR
      const targetedLabel = document.querySelectorAll(".apartment_services > label")[index];
  
      // ADD is-invalid CLASS
      apartmentService.classList.add("is-invalid");
  
      // CREATE THE SPAN FOR THE ERROR MESSAGE
      const apartmentServiceValidationSpan = document.createElement("span");
      apartmentServiceValidationSpan.classList.add("d-block");
      apartmentServiceValidationSpan.setAttribute("id", `apartmentServiceError`);
      apartmentServiceValidationSpan.setAttribute("role", "alert");
      
      // CREATE THE STRONG WITH THE ERROR MESSAGE
      const apartmentServiceValidationStrong = document.createElement("strong");
      apartmentServiceValidationStrong.style.fontSize = "14px";
      apartmentServiceValidationStrong.classList.add("text-danger");
      apartmentServiceValidationStrong.innerText = "Inserire un prezzo valido";
      
      // ADD THE ERROR MESSAGE TO THE DOM
      apartmentServiceValidationSpan.appendChild(apartmentServiceValidationStrong);
      targetedLabel.insertAdjacentElement("afterend", apartmentServiceValidationSpan);
    }
  })
})
