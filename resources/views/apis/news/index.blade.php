<x-frontend.layouts.master>
    <!-- News Card Component -->
    <div class="w-full py-4 mx-auto p-5 rounded-lg text-black dark:text-slate-100 bg-slate-200 dark:bg-slate-900">
        <h2 class="py-2 px-4">News API (newsdata.io)</h2>
        <form id="newsApiForm" class="p-4">
            <input id="topicInput" class="border p-2 focus:border-blue-600 focus:ring-blue-500 text-black rounded"
                type="text" placeholder="Enter topic name" spellcheck="false" required>
            {{-- 🔎 --}}
            <button
                class="py-3 px-4 bg-slate-700 text-center rounded-lg font-medium hover:bg-slate-800 hover:text-blue-600 hover:border-blue-600 hover:ring-blue-600 hover:ring-2 transition ease-in-out delay-75"
                type="submit">Search</button>
        </form>
        <span id="responseMessage" class="py-3 px-2 text-sm"></span>
        <div class="flex justify-between px-4">
            <span id="totalNewsCount" class="py-3 px-2"></span>
            <button
                class="py-3 px-4 bg-slate-700 text-center rounded-lg font-medium hover:bg-slate-600 transition ease-in-out delay-75 nextButton">Next</button>
        </div>

        <!-- News Cards Section -->
        <div class="flex flex-wrap mt-4" id="newsCardsContainer">
            <!-- News Card placeholders will be dynamically added here -->
        </div>

        <!-- Pagination Buttons -->
        <div class="mt-4 flex justify-end px-4">
            <button
                class="py-3 px-4 bg-slate-700 text-center rounded-lg font-medium hover:bg-slate-600 transition ease-in-out delay-75 nextButton">Next</button>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const apiKey = 'pub_3777581d6d1f25be66ae6c53874189c9a9b2c';
                let apiUrl = `https://newsdata.io/api/1/news?q=bangladesh&apikey=${apiKey}`;
                let topic = 'bangladesh';
                let nextPage = null; // To store the next page token

                let topicSearchFrom = document.getElementById('newsApiForm')
                topicSearchFrom.addEventListener("submit", topicSearch);
                // search button 
                const searchButton = topicSearchFrom.querySelector('button[type="submit"]');

                function topicSearch(e) {
                    if (e && e.submitter) {
                        e.preventDefault();
                        topic = document.getElementById('topicInput').value;
                        apiUrl = `https://newsdata.io/api/1/news?q=${topic}&apikey=${apiKey}`;

                        // Add the loading class to the form to show the spinner
                        topicSearchFrom.classList.add('loading');
                        searchButton.classList.add('opacity-50', 'cursor-not-allowed');


                        fetchNews();
                    } else {
                        apiUrl = `https://newsdata.io/api/1/news?q=${topic}&apikey=${apiKey}`;

                        // Add the loading class to the form to show the spinner
                        topicSearchFrom.classList.add('loading');
                        searchButton.classList.add('opacity-50', 'cursor-not-allowed');

                        fetchNews();
                    }
                }


                async function fetchNews() {
                    const response = await fetch(apiUrl);
                    let data = await response.json();
                    topicSearchFrom.classList.remove('loading');
                    searchButton.classList.remove('opacity-50', 'cursor-not-allowed');

                    if (data.status === "error") {
                        console.error(data.results.message);
                        document.getElementById('responseMessage').innerHTML = data.results.message;
                        return;
                    }

                    if (data.status === "success" && data.totalResults > 0) {
                        document.getElementById('responseMessage').innerHTML = '';
                        document.getElementById('totalNewsCount').innerHTML =
                            `Total ${data.totalResults} News Found for "${topic}"`;

                        // Rendering news cards
                        renderNewsCards(data.results);

                        // Updating next page token
                        nextPage = data.nextPage;
                    } else if (data.status === "success" && data.totalResults == 0) {
                        document.getElementById('totalNewsCount').innerHTML = ''
                        document.getElementById('responseMessage').innerHTML = "No News Found";
                        newsCardsContainer.innerHTML = ''

                    } else {
                        console.log('Something went wrong');
                    }
                }

                // Function to render news cards based on data
                function renderNewsCards(data) {

                    const newsCardsContainer = document.getElementById('newsCardsContainer');
                    newsCardsContainer.innerHTML = ''; // Clear previous content

                    data.forEach((article) => {
                        console.log(article);
                        const card = document.createElement('div');
                        card.classList.add('w-full', 'sm:w-1/2', 'md:w-1/3', 'mb-4', 'p-4');

                        const articleCard = document.createElement('article');
                        articleCard.classList.add('mb-4', 'p-6', 'rounded-xl', 'bg-white', 'dark:bg-slate-800',
                            'flex', 'flex-col', 'bg-clip-border', 'h-full', 'justify-between');

                        // Populating the articleCard with data
                        // source name
                        const sourceName = document.createElement('span');
                        sourceName.classList.add('text-lg', 'font-bold', 'text-white');
                        sourceName.textContent = article.creator && article.creator.length > 0 ? article
                            .creator[0] : article.source_id;

                        //published date 📅
                        const publishedDate = document.createElement('span');
                        publishedDate.classList.add('text-slate-500', 'pb-4');
                        publishedDate.textContent = article.pubDate;

                        // article image 🎦
                        const articleImageContainer = document.createElement('div');
                        articleImageContainer.classList.add('flex', 'justify-between', 'gap-1');

                        const imageLink = document.createElement('a');
                        imageLink.classList.add('flex');
                        imageLink.setAttribute('target', '_blank');
                        imageLink.href = article.link;

                        const newsImage = document.createElement('img');
                        newsImage.classList.add('w-full', 'h-auto', 'rounded-lg');
                        newsImage.src = article.image_url ? article.image_url :
                            'https://i.ibb.co/WF7FspB/no-image-found.png';

                        // Append the elements to build the structure
                        imageLink.appendChild(newsImage);
                        articleImageContainer.appendChild(imageLink);

                        // title of the article
                        const articleTitle = document.createElement('h2')
                        articleTitle.classList.add('text-lg',
                            'font-extrabold', 'pt-4')
                        articleTitle.textContent = article.title

                        // article cetegory container
                        const articleCetegoryContainer = document.createElement('div')
                        articleCetegoryContainer.classList.add('text-slate-500', 'mt-1')
                        // span for static content
                        const categorySpan = document.createElement('span')
                        categorySpan.textContent = 'category: '
                        // article category
                        const articleCategory = document.createElement('span')
                        articleCategory.textContent = article.category['0']
                        // append category childrens to it's container
                        articleCetegoryContainer.appendChild(categorySpan)
                        articleCetegoryContainer.appendChild(articleCategory)

                        // article country container
                        const articleCountryContainer = document.createElement('div')
                        articleCountryContainer.classList.add('text-slate-500', 'mt-1')
                        // span for static content
                        const countrySpan = document.createElement('span')
                        countrySpan.textContent = 'country: '
                        // article country
                        const articleCountry = document.createElement('span')
                        articleCountry.textContent = article.country['0']
                        // append country childrens to it's container
                        articleCountryContainer.appendChild(countrySpan)
                        articleCountryContainer.appendChild(articleCountry)

                        // gap between title and detail button
                        const articlePadding = document.createElement('div')
                        articlePadding.classList.add('py-4')

                        // article detail button container
                        const detailButtonContainer = document.createElement('div')
                        detailButtonContainer.classList.add('pt-2', 'w-full')

                        // article detail button
                        const detailButton = document.createElement('a')
                        detailButton.classList.add(
                            'py-3', 'px-4', 'w-full', 'block', 'bg-slate-100', 'dark:bg-slate-700',
                            'text-center', 'rounded-lg', 'font-medium', 'hover:bg-slate-200',
                            'dark:hover:bg-slate-600', 'transition', 'ease-in-out', 'delay-75'
                        );
                        detailButton.href = article.link
                        detailButton.setAttribute('target', '_blank');
                        detailButton.textContent = 'Read More'

                        // embed button to it's container div
                        detailButtonContainer.appendChild(detailButton)

                        // ... (Add similar code for other elements like image, title, country, category, etc.)

                        articleCard.appendChild(sourceName);
                        articleCard.appendChild(publishedDate);
                        articleCard.appendChild(articleImageContainer);
                        articleCard.appendChild(articleTitle);
                        articleCard.appendChild(articleCetegoryContainer);
                        articleCard.appendChild(articleCountryContainer);
                        articleCard.appendChild(articlePadding);
                        articleCard.appendChild(detailButtonContainer);

                        // ... (Add similar code to append other elements to articleCard)

                        card.appendChild(articleCard);
                        newsCardsContainer.appendChild(card);
                    });
                }

                // Function to handle pagination and fetch next page of news
                function fetchNextPage() {
                    if (nextPage) {
                        apiUrl = `https://newsdata.io/api/1/news?q=${topic}&apikey=${apiKey}&page=${nextPage}`;
                        fetchNews();
                    }
                }

                // Event listener for the Next button
                let nextButtons = document.getElementsByClassName('nextButton')


                Array.from(nextButtons).forEach(button => {
                    button.addEventListener('click', fetchNextPage);
                });

                // Initial fetch on page load
                document.addEventListener('DOMContentLoaded', fetchNews);
                topicSearch();
            });
        </script>
    @endpush
</x-frontend.layouts.master>
