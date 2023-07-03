import tt from "@tomtom-international/web-sdk-maps";

// CREATE VARIABLES TO STORE SEARCH RESULTS AND ADDRESS SELECTION
let results = [];
let inputAddress = "";
let selectedAddress = null;
let selectedLat = null;
let selectedLon = null;

// GET DOM ELEMENTS
const suggestedAddressesContainer = document.getElementById("addressSuggestions");
const addressEl = document.getElementById("address");
const latEl = document.getElementById("latitude");
const lonEl = document.getElementById("longitude");

// KEEP LATITUDE AND LONGITUDE VALUES IN CASE OF VALIDATION FAIL
if(latEl.value != "" && lonEl.value != "" && addressEl != "") {
  showMap(latEl.value, lonEl.value);
}

// COLLAPSES THE ADDRESS SUGGESTIONS WHEN CLICKING ANYWHERE ON THE PAGE
document.body.addEventListener("click", () => {
  suggestedAddressesContainer.innerHTML = "";
})

// LISTENS TO INPUT ON ADDRESS FIELD
addressEl.addEventListener("input", () => {
  inputAddress = addressEl.value;
  latEl.value = "";
  lonEl.value = "";

  // IF ADDRESS IS MORE THAN 5 CHARSACTERS LONG, STARTS SHOWING THE SUGGESTIONS
  if(inputAddress.length >= 5) {
    getRealtimeResults();
  } else {
    suggestedAddressesContainer.innerHTML = "";
  }
})

/**
 * Provides real-time results while typing an address
 */
function getRealtimeResults() {
  axios
  .get(`https://api.tomtom.com/search/2/search/${inputAddress}.json?key=1tCQiScG72uLCOIZ32Xx2BG2eB07fCTm&typeahead=true&language=it-IT&limit=10&idxSet=PAD,Addr,Str,XStr`)
  .then(response => {
    suggestedAddressesContainer.innerHTML = "";
    results = response.data.results;
    suggestedAddressesContainer.classList.remove("d-none");
    results.forEach(result => {
      const newResult = document.createElement("li");
      newResult.classList.add("list-group-item", "list-group-item-action");
      newResult.innerText = result.address.freeformAddress;
      suggestedAddressesContainer.appendChild(newResult);
    });
    listenForSelection();
  })
  .catch(error => {
    console.error(error.message);
  })
}

/**
 * Listens for a suggestion to be selected and saves address, latitude and longitude values
 */
function listenForSelection() {
  const addresses = document.querySelectorAll("#addressSuggestions li");
  addresses.forEach((singleAddress, index) => {
    singleAddress.addEventListener("click", () => {
      suggestedAddressesContainer.innerHTML = "";
      suggestedAddressesContainer.classList.add("d-none");
      selectedAddress = results[index].address.freeformAddress;
      addressEl.value = selectedAddress;
      selectedLat = results[index].position.lat;
      latEl.value = selectedLat;
      selectedLon = results[index].position.lon;
      lonEl.value = selectedLon;
      results = [];
      showMap(selectedLat, selectedLon);
    })
  })
}

/**
 * Show a map on the page, centered on the address position
 * @param {String} lat The selected address latitude
 * @param {String} lon The selected address longitude
 */
function showMap(lat, lon) {
  const mapWrapper = document.getElementById("map");
  mapWrapper.classList.remove("d-none");
  const mapChilds = document.querySelectorAll("#map *");
  mapChilds.forEach(child => {
      child.remove();
  });
  let map = tt.map({
      key: "1tCQiScG72uLCOIZ32Xx2BG2eB07fCTm",
      container: "map",
      center: [lon, lat],
      zoom: 14,
  })
  let marker = new tt.Marker()
  .setLngLat([lon, lat])
  .addTo(map)
}
