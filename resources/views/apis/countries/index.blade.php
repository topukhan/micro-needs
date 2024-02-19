<x-frontend.layouts.master>
    <div class="container mx-auto mt-8 ">
        <div class="flex justify-end">
            <button id="compareButton"
                class="bg-gray-500 px-4 py-2 rounded hover:bg-gray-700 hover:ring-blue-400 hover:ring-2 text-white">Compare</button>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            {{-- left column --}}
            <div>
                <!-- Search Input Section -->
                <div class="mb-4">
                    <label for="countryInput" class="block text-gray-600">Country Name:</label>
                    <div class="w-full">
                        <form id="countryApiForm" class="p-2">
                            <input type="text" id="countryInput" list="countrySuggestions"
                                class="border focus:border-orange-600 focus:ring-orange-600 focus:ring-2 p-2 rounded-lg "
                                placeholder="Enter country name" required>

                            <datalist id="countrySuggestions">
                                <option value="Afghanistan">
                                <option value="Albania">
                                <option value="Algeria">
                                <option value="Andorra">
                                <option value="Angola">
                                <option value="Anguilla">
                                <option value="Antigua and Barbuda">
                                <option value="Argentina">
                                <option value="Armenia">
                                <option value="Aruba">
                                <option value="Australia">
                                <option value="Austria">
                                <option value="Azerbaijan">
                                <option value="Bahamas">
                                <option value="Bahrain">
                                <option value="Bangladesh">
                                <option value="Barbados">
                                <option value="Belarus">
                                <option value="Belgium">
                                <option value="Belize">
                                <option value="Benin">
                                <option value="Bermuda">
                                <option value="Bhutan">
                                <option value="Bolivia (Plurinational State of)">
                                <option value="Bonaire, Sint Eustatius and Saba">
                                <option value="Bosnia and Herzegovina">
                                <option value="Botswana">
                                <option value="Bouvet Island">
                                <option value="Brazil">
                                <option value="British Indian Ocean Territory">
                                <option value="Brunei Darussalam">
                                <option value="Bulgaria">
                                <option value="Burkina Faso">
                                <option value="Burundi">
                                <option value="Cabo Verde">
                                <option value="Cambodia">
                                <option value="Cameroon">
                                <option value="Canada">
                                <option value="Cayman Islands">
                                <option value="Central African Republic">
                                <option value="Chad">
                                <option value="Chile">
                                <option value="China">
                                <option value="Christmas Island">
                                <option value="Cocos (Keeling) Islands">
                                <option value="Colombia">
                                <option value="Comoros">
                                <option value="Congo">
                                <option value="Congo, the Democratic Republic of the">
                                <option value="Cook Islands">
                                <option value="Costa Rica">
                                <option value="Côte d'Ivoire">
                                <option value="Croatia">
                                <option value="Cuba">
                                <option value="Curaçao">
                                <option value="Cyprus">
                                <option value="Czech Republic">
                                <option value="Denmark">
                                <option value="Djibouti">
                                <option value="Dominica">
                                <option value="Dominican Republic">
                                <option value="Ecuador">
                                <option value="Egypt">
                                <option value="El Salvador">
                                <option value="Equatorial Guinea">
                                <option value="Eritrea">
                                <option value="Estonia">
                                <option value="Eswatini">
                                <option value="Ethiopia">
                                <option value="Falkland Islands (Malvinas)">
                                <option value="Faroe Islands">
                                <option value="Fiji">
                                <option value="Finland">
                                <option value="France">
                                <option value="French Guiana">
                                <option value="French Polynesia">
                                <option value="French Southern Territories">
                                <option value="Gabon">
                                <option value="Gambia">
                                <option value="Georgia">
                                <option value="Germany">
                                <option value="Ghana">
                                <option value="Gibraltar">
                                <option value="Greece">
                                <option value="Greenland">
                                <option value="Grenada">
                                <option value="Guadeloupe">
                                <option value="Guam">
                                <option value="Guatemala">
                                <option value="Guinea">
                                <option value="Guinea-Bissau">
                                <option value="Guyana">
                                <option value="Haiti">
                                <option value="Heard Island and McDonald Islands">
                                <option value="Holy See">
                                <option value="Honduras">
                                <option value="Hungary">
                                <option value="Iceland">
                                <option value="India">
                                <option value="Indonesia">
                                <option value="Iran (Islamic Republic of)">
                                <option value="Iraq">
                                <option value="Ireland">
                                <option value="Isle of Man">
                                <option value="Israel">
                                <option value="Italy">
                                <option value="Jamaica">
                                <option value="Japan">
                                <option value="Jersey">
                                <option value="Jordan">
                                <option value="Kazakhstan">
                                <option value="Kenya">
                                <option value="Kiribati">
                                <option value="Korea (Democratic People's Republic of)">
                                <option value="Korea, Republic of">
                                <option value="Kuwait">
                                <option value="Kyrgyzstan">
                                <option value="Lao People's Democratic Republic">
                                <option value="Latvia">
                                <option value="Lebanon">
                                <option value="Lesotho">
                                <option value="Liberia">
                                <option value="Libya">
                                <option value="Liechtenstein">
                                <option value="Lithuania">
                                <option value="Luxembourg">
                                <option value="Madagascar">
                                <option value="Malawi">
                                <option value="Malaysia">
                                <option value="Maldives">
                                <option value="Mali">
                                <option value="Malta">
                                <option value="Marshall Islands">
                                <option value="Martinique">
                                <option value="Mauritania">
                                <option value="Mauritius">
                                <option value="Mayotte">
                                <option value="Mexico">
                                <option value="Micronesia (Federated States of)">
                                <option value="Monaco">
                                <option value="Mongolia">
                                <option value="Montenegro">
                                <option value="Montserrat">
                                <option value="Morocco">
                                <option value="Mozambique">
                                <option value="Myanmar">
                                <option value="Namibia">
                                <option value="Nauru">
                                <option value="Nepal">
                                <option value="Netherlands">
                                <option value="New Caledonia">
                                <option value="New Zealand">
                                <option value="Nicaragua">
                                <option value="Niger">
                                <option value="Nigeria">
                                <option value="Niue">
                                <option value="Norfolk Island">
                                <option value="North Macedonia">
                                <option value="Norway">
                                <option value="Oman">
                                <option value="Pakistan">
                                <option value="Palau">
                                <option value="Panama">
                                <option value="Papua New Guinea">
                                <option value="Paraguay">
                                <option value="Peru">
                                <option value="Philippines">
                                <option value="Pitcairn">
                                <option value="Poland">
                                <option value="Portugal">
                                <option value="Puerto Rico">
                                <option value="Qatar">
                                <option value="Réunion">
                                <option value="Romania">
                                <option value="Russian Federation">
                                <option value="Rwanda">
                                <option value="Saint Barthélemy">
                                <option value="Saint Helena, Ascension and Tristan da Cunha">
                                <option value="Saint Kitts and Nevis">
                                <option value="Saint Lucia">
                                <option value="Saint Martin (French part)">
                                <option value="Saint Pierre and Miquelon">
                                <option value="Saint Vincent and the Grenadines">
                                <option value="Samoa">
                                <option value="San Marino">
                                <option value="Sao Tome and Principe">
                                <option value="Saudi Arabia">
                                <option value="Senegal">
                                <option value="Serbia">
                                <option value="Seychelles">
                                <option value="Sierra Leone">
                                <option value="Singapore">
                                <option value="Sint Maarten (Dutch part)">
                                <option value="Slovakia">
                                <option value="Slovenia">
                                <option value="Solomon Islands">
                                <option value="Somalia">
                                <option value="South Africa">
                                <option value="South Georgia and the South Sandwich Islands">
                                <option value="South Sudan">
                                <option value="Spain">
                                <option value="Sri Lanka">
                                <option value="Sudan">
                                <option value="Suriname">
                                <option value="Svalbard and Jan Mayen">
                                <option value="Sweden">
                                <option value="Switzerland">
                                <option value="Syrian Arab Republic">
                                <option value="Tajikistan">
                                <option value="Thailand">
                                <option value="The former Yugoslav Republic of Macedonia">
                                <option value="Timor-Leste">
                                <option value="Togo">
                                <option value="Tokelau">
                                <option value="Tonga">
                                <option value="Trinidad and Tobago">
                                <option value="Tunisia">
                                <option value="Turkey">
                                <option value="Turkmenistan">
                                <option value="Turks and Caicos Islands">
                                <option value="Tuvalu">
                                <option value="Uganda">
                                <option value="Ukraine">
                                <option value="United Arab Emirates">
                                <option value="United Kingdom of Great Britain and Northern Ireland">
                                <option value="United Republic of Tanzania">
                                <option value="United States of America">
                                <option value="Uruguay">
                                <option value="Uzbekistan">
                                <option value="Vanuatu">
                                <option value="Venezuela (Bolivarian Republic of)">
                                <option value="Viet Nam">
                                <option value="Wallis and Futuna">
                                <option value="Western Sahara">
                                <option value="Yemen">
                                <option value="Zambia">
                                <option value="Zimbabwe">
                            </datalist>

                            <button id="searchBtn"
                                class="bg-orange-500 text-white p-2 px-4 rounded-lg hover:bg-orange-600 focus:outline-none"
                                type="submit">Search</button>
                        </form>
                        <span id="responseMessage" class="py-3 px-2 text-sm text-orange-600"></span>
                    </div>
                </div>

                <!-- Country Information Card -->
                <div id="countryCard" class="border border-gray-300 p-4 rounded bg-slate-700 text-white">
                    <!-- Components in a Single Column -->
                    <div>
                        <div class="mb-2 p-1 flex">
                            <span class="font-bold">Official Name:</span>
                            <span id="officialName" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>

                        <div class="mb-2 p-1 flex">
                            <span class="font-bold">Native Official Name:</span>
                            <span id="nativeOfficialName"
                                class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Native Common Name: </span>
                            <span id="nativeCommonName"
                                class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Independent: </span>
                            <span id="independentStatus"
                                class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">UN Member: </span>
                            <span id="unMember" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Currency Name: </span>
                            <span id="currencyName" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Currency Symbol: </span>
                            <span id="currencySymbol"
                                class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Capital: </span>
                            <span id="capital" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Alt Spelling: </span>
                            <span id="altSpelling" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Region: </span>
                            <span id="region" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Sub Region: </span>
                            <span id="subRegion" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Languages: </span>
                            <span id="languages" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Latitude: </span>
                            <span id="latitude" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Longitude: </span>
                            <span id="longitude" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Area (sqkm): </span>
                            <span id="area" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Total Population: </span>
                            <span id="population" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2 flex">
                            <span class="font-bold mr-6">Flag: </span>
                            <img id="flag" class="rounded  mt-2 " src="https://picsum.photos/200"
                                alt="Flag" style="width: 300px; height: auto;">
                        </div>
                        <div class="mb-2 flex">
                            <span class="font-bold mr-6">Coat of Arms: </span>
                            <img id="coatOfArms" class="rounded mt-2" src="https://picsum.photos/200"
                                alt="Coat of Arms" style="width: 200px; height: 200px;">
                        </div>
                    </div>
                </div>
            </div>
            {{-- right column --}}
            <div id="compareSection" hidden>
                <!-- Search Input Section -->
                <div class="mb-4">
                    <label for="countryInput" class="block text-gray-600">Country Name:</label>
                    <div class="w-full">
                        <form id="countryApiForm2" class="p-2">
                            <input type="text" id="countryInput2" list="countrySuggestions"
                                class="border focus:border-blue-600 focus:ring-blue-600 focus:ring-2 p-2 rounded-lg "
                                placeholder="Enter country name" required>
                            <button id="searchBtn2"
                                class="bg-blue-500 text-white p-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none"
                                type="submit">Search</button>
                        </form>
                        <span id="responseMessage2" class="py-3 px-2 text-sm text-blue-600"></span>
                    </div>
                </div>

                <!-- Country Information Card -->
                <div id="countryCard2" class="border border-gray-300 p-4 rounded bg-slate-700 text-white">
                    <!-- Components in a Single Column -->
                    <div>
                        <div class="mb-2 p-1 flex">
                            <span class="font-bold">Official Name:</span>
                            <span id="officialName2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>

                        <div class="mb-2 p-1 flex">
                            <span class="font-bold">Native Official Name:</span>
                            <span id="nativeOfficialName2"
                                class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Native Common Name: </span>
                            <span id="nativeCommonName2"
                                class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Independent: </span>
                            <span id="independentStatus2"
                                class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">UN Member: </span>
                            <span id="unMember2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Currency Name: </span>
                            <span id="currencyName2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Currency Symbol: </span>
                            <span id="currencySymbol2"
                                class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Capital: </span>
                            <span id="capital2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Alt Spelling: </span>
                            <span id="altSpelling2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Region: </span>
                            <span id="region2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Sub Region: </span>
                            <span id="subRegion2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Languages: </span>
                            <span id="languages2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Latitude: </span>
                            <span id="latitude2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Longitude: </span>
                            <span id="longitude2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Area (sqkm): </span>
                            <span id="area2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2  p-1 flex">
                            <span class="font-bold">Total Population: </span>
                            <span id="population2" class="block bg-gray-100 ml-2 px-2 rounded-md text-black"></span>
                        </div>
                        <div class="mb-2 flex">
                            <span class="font-bold mr-6">Flag: </span>
                            <img id="flag2" class="rounded  mt-2 " src="https://picsum.photos/200"
                                alt="Flag" style="width: 300px; height: auto;">
                        </div>
                        <div class="mb-2 flex">
                            <span class="font-bold mr-6">Coat of Arms: </span>
                            <img id="coatOfArms2" class="rounded mt-2" src="https://picsum.photos/200"
                                alt="Coat of Arms" style="width: 200px; height: 200px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                let country = 'bangladesh';
                let apiUrl = `https://restcountries.com/v3.1/name/${country}`;

                let countrySearchForm = document.getElementById('countryApiForm')
                countrySearchForm.addEventListener("submit", countrySearch);
                // search button 
                const searchButton = countrySearchForm.querySelector('button[type="submit"]');

                function countrySearch(e) {
                    if (e && e.submitter) {
                        e.preventDefault();
                        country = document.getElementById('countryInput').value;
                        apiUrl = `https://restcountries.com/v3.1/name/${country}`;

                        // Add the loading class to the form to show the spinner
                        countrySearchForm.classList.add('loading-black');
                        searchButton.setAttribute("disabled", "");
                        searchButton.classList.add('opacity-75', 'cursor-not-allowed');

                        fetchCountryInfo();
                    } else {
                        apiUrl = `https://restcountries.com/v3.1/name/${country}`;
                        // Add the loading class to the form to show the spinner
                        countrySearchForm.classList.add('loading-black');
                        searchButton.classList.add('opacity-75', 'cursor-not-allowed');
                        searchButton.setAttribute("disabled", "");

                        fetchCountryInfo();
                    }
                }

                async function fetchCountryInfo() {
                    const response = await fetch(apiUrl);
                    let data = await response.json();

                    countrySearchForm.classList.remove('loading-black');
                    searchButton.classList.remove('opacity-75', 'cursor-not-allowed');
                    searchButton.removeAttribute("disabled");
                    if (response.status == 200) {
                        if (data.status === 404) {
                            console.error(data.message);
                            document.getElementById('responseMessage').innerHTML = data.message;
                            return;
                        }
                        responseMessage.innerHTML = ''

                        const firstObject = data[0]

                        officialName.innerHTML = firstObject.name.common

                        const nativeNameValues = Object.values(firstObject.name.nativeName)
                        nativeOfficialName.innerHTML = nativeNameValues[0].official
                        nativeCommonName.innerHTML = nativeNameValues[0].common

                        independentStatus.innerHTML = firstObject.independent ? 'Yes' : 'No';

                        unMember.innerHTML = firstObject.unMember ? 'Yes' : 'No'

                        const currencyValues = Object.values(firstObject.currencies)
                        currencyName.innerHTML = currencyValues[0].name
                        currencySymbol.innerHTML = currencyValues[0].symbol

                        capital.innerHTML = firstObject.capital

                        altSpelling.innerHTML = firstObject.altSpellings[0]

                        region.innerHTML = firstObject.region

                        subRegion.innerHTML = firstObject.subregion

                        const languageValues = Object.values(firstObject.languages)
                        languages.innerHTML = languageValues[0]

                        latitude.innerHTML = firstObject.latlng[0]
                        longitude.innerHTML = firstObject.latlng[1]

                        area.innerHTML = firstObject.area.toLocaleString() + ' sqkm'

                        population.innerHTML = firstObject.population.toLocaleString()

                        flag.src = firstObject.flags.png ? firstObject.flags.png :
                            'https://i.ibb.co/WF7FspB/no-image-found.png'
                        coatOfArms.src = firstObject.coatOfArms.png ? firstObject.coatOfArms.png :
                            'https://i.ibb.co/WF7FspB/no-image-found.png'
                    } else if (response.status == 404) {
                        responseMessage.innerHTML = data.message

                    } else {
                        responseMessage.innerHTML = 'something went wrong'
                    }
                }

                // Initial fetch on page load
                // document.addEventListener('DOMContentLoaded', fetchCountryInfo);
                countrySearch();
            });
        </script>
        {{-- compare section script --}}
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                let country2 = 'japan';
                let apiUrl2 = `https://restcountries.com/v3.1/name/${country2}`;

                let countrySearchForm2 = document.getElementById('countryApiForm2')
                countrySearchForm2.addEventListener("submit", countrySearch2);
                // search button 
                const searchButton2 = countrySearchForm2.querySelector('button[type="submit"]');

                function countrySearch2(e) {
                    if (e && e.submitter) {
                        e.preventDefault();
                        country2 = document.getElementById('countryInput2').value;
                        apiUrl2 = `https://restcountries.com/v3.1/name/${country2}`;

                        // Add the loading class to the form to show the spinner
                        countrySearchForm2.classList.add('loading-black');
                        searchButton2.setAttribute("disabled", "");
                        searchButton2.classList.add('opacity-75', 'cursor-not-allowed');

                        fetchCountryInfo2();
                    } else {
                        apiUrl2 = `https://restcountries.com/v3.1/name/${country2}`;
                        // Add the loading class to the form to show the spinner
                        countrySearchForm2.classList.add('loading-black');
                        searchButton2.classList.add('opacity-75', 'cursor-not-allowed');
                        searchButton2.setAttribute("disabled", "");

                        fetchCountryInfo2();
                    }
                }

                async function fetchCountryInfo2() {
                    const response = await fetch(apiUrl2);
                    let data2 = await response.json();

                    countrySearchForm2.classList.remove('loading-black');
                    searchButton2.classList.remove('opacity-75', 'cursor-not-allowed');
                    searchButton2.removeAttribute("disabled");
                    if (response.status == 200) {
                        if (data2.status === 404) {
                            console.error(data2.message);
                            document.getElementById('responseMessage2').innerHTML = data2.message;
                            return;
                        }
                        responseMessage2.innerHTML = ''

                        const firstObject2 = data2[0]

                        officialName2.innerHTML = firstObject2.name.common

                        const nativeNameValues2 = Object.values(firstObject2.name.nativeName)
                        nativeOfficialName2.innerHTML = nativeNameValues2[0].official
                        nativeCommonName2.innerHTML = nativeNameValues2[0].common

                        independentStatus2.innerHTML = firstObject2.independent ? 'Yes' : 'No';

                        unMember2.innerHTML = firstObject2.unMember ? 'Yes' : 'No'

                        const currencyValues2 = Object.values(firstObject2.currencies)
                        currencyName2.innerHTML = currencyValues2[0].name
                        currencySymbol2.innerHTML = currencyValues2[0].symbol

                        capital2.innerHTML = firstObject2.capital

                        altSpelling2.innerHTML = firstObject2.altSpellings[0]

                        region2.innerHTML = firstObject2.region

                        subRegion2.innerHTML = firstObject2.subregion

                        const languageValues2 = Object.values(firstObject2.languages)
                        languages2.innerHTML = languageValues2[0]

                        latitude2.innerHTML = firstObject2.latlng[0]
                        longitude2.innerHTML = firstObject2.latlng[1]

                        area2.innerHTML = firstObject2.area.toLocaleString() + ' sqkm'

                        population2.innerHTML = firstObject2.population.toLocaleString()

                        flag2.src = firstObject2.flags.png ? firstObject2.flags.png :
                            'https://i.ibb.co/WF7FspB/no-image-found.png'
                        coatOfArms2.src = firstObject2.coatOfArms.png ? firstObject2.coatOfArms.png :
                            'https://i.ibb.co/WF7FspB/no-image-found.png'
                    } else if (response.status == 404) {
                        responseMessage2.innerHTML = data2.message

                    } else {
                        responseMessage2.innerHTML = 'something went wrong'
                    }
                }
                countrySearch2();
                compareButton.addEventListener("click", function() {
                    toggleHiddenSection("compareSection");
                });

                function toggleHiddenSection(elementId) {
                    const element = document.getElementById(elementId);
                    console.log('inside');

                    if (element) {
                        console.log('clicked');

                        element.hidden = !element.hidden;
                        if (element.hidden) {
                            compareButton.innerText = "Compare";
                        } else {
                            compareButton.innerText = "Hide";
                        }
                    }
                }
            });
        </script>
    @endpush
</x-frontend.layouts.master>
