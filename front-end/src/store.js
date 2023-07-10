import { reactive } from "vue";

export const store = new reactive({
  base_admin_URL: "http://127.0.0.1:8000/",
  apartments: [],
  apartmentTypes: [],
  services: [],
  filteringApartments: [],
  apartmentType: 0,
  checkedServices: [],
  results: [],
  selectedResult: "",
  inputAddress: "",
  selectedAddress: null,
  selectedLat: null,
  selectedLon: null,
  radius: 20,
  rooms: 0,
  beds: 0,
  searchError: false,

  arrowKeysFunction() {
    // ENABLE SCROLLING IN THE ADDRESSES WITH THE ARROW KEYS
    const suggestedAddressesContainer = document.getElementById("addressSuggestions");
    const addressEl = document.getElementById("address");



    let selectedIndex = -1;

    addressEl.addEventListener('keydown', (event) => {
      const key = event.key;

      if (key === 'ArrowDown') {
        event.preventDefault();
        selectedIndex = Math.min(selectedIndex + 1, suggestedAddressesContainer.children.length - 1);
        updateSelection();
        console.log(selectedIndex);

      } else if (key === 'ArrowUp') {
        event.preventDefault();
        selectedIndex = Math.max(selectedIndex - 1, -1);
        if (selectedIndex == -1) {
          const selected = suggestedAddressesContainer.querySelector('.selected');

          if (selected) {
            selected.classList.remove('selected');
            console.log(selectedIndex);
          }
        } else {
          updateSelection();
          console.log(selectedIndex);
        }

        // } else if (key === 'Enter' && store.selectedLat == null && store.selectedLon == null) {
      } else if (key === 'Enter') {

        event.preventDefault();

        if (store.results) {
          store.selectedResult = store.results[selectedIndex];
          store.results = [];
          store.inputAddress = store.selectedResult.address.freeformAddress;
          store.searchError = false;
          // console.log(store.inputAddress);
          // console.log(store.selectedResult);
          // console.log(store.selectedLat);
          // console.log(store.selectedLon);
          // console.log(store.searchError);
        }
      }
    }
    );
    /**
 * Remove the selected class to the old element and add to the new one
 */
    function updateSelection() {
      const selected = suggestedAddressesContainer.querySelector('.selected');

      if (selected) {
        selected.classList.remove('selected');
      }

      const newSelected = suggestedAddressesContainer.children[selectedIndex];
      newSelected.classList.add('selected');
    }
  }


});
