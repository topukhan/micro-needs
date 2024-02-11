<x-frontend.layouts.master>
    <!-- News Card Component -->
    <div class=" w-full py-4 mx-auto p-5 rounded-lg text-black dark:text-slate-100 bg-slate-200 dark:bg-slate-900">
        <h2 class="py-2">News API</h2>
        <form id="newsApiForm">
            <input id="topicInput" class="border p-2 focus:border-green-600 focus:ring-green-500 text-black" type="text"
                placeholder="Enter topic name" spellcheck="false">
            <button
                class="py-3 px-4  bg-slate-700 text-center rounded-lg font-medium hover:bg-slate-600 transition ease-in-out delay-75"
                type="submit">Search</button>
        </form>
        <span id="responseMessage" class="py-3 px-2 text-sm"></span>
        <span id="totalNewsCount" class="py-3 px-2"></span>

        <!-- News Cards Section -->
        <div class="flex flex-wrap mt-4">
            <!-- News Card -->
            <div class="w-full sm:w-1/2 md:w-1/3 mb-4 p-4">
                <article class="mb-4 p-6 rounded-xl bg-white dark:bg-slate-800 flex flex-col bg-clip-border">
                    <div class="flex pb-6 items-center justify-between">
                        <div class="flex">

                            <div class="flex flex-col">
                                <div>
                                    <span id="newsSourceName" class="text-lg font-bold text-white">source name</span>

                                </div>
                                <div class="text-slate-500 ">
                                    <span id="newsPublishedDate_Detail">pub date</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between gap-1">
                        <a class="flex" href="#">
                            <img id="newsImage" class="max-w-full rounded-lg"
                                src="https://images.pexels.com/photos/1429748/pexels-photo-1429748.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                        </a>

                    </div>
                    <h2 id="newsTitle" class="text-xl font-extrabold pt-4">
                        news title
                    </h2>
                    <div class="w-full text-slate-500 pt-2">
                        country:<span id="newsCountryName">country</span>
                    </div>
                    <div class="w-full text-slate-500 pt-2">
                        Category:<span id="newsCategoryName">Category</span>
                    </div>
                    <div class="py-4">

                    </div>

                    <!-- ====== Modal Section Start -->
                    <section x-data="{ modalOpen: false }">
                        <div class="pt-2">
                            <!-- Modal Trigger for details -->
                            <div class="w-full">
                                <a id="newsDetailTrigger" href="#" @click="modalOpen = true"
                                    class="py-3 px-4 w-full block bg-slate-100 dark:bg-slate-700 text-center rounded-lg font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition ease-in-out delay-75">Details</a>
                            </div>
                            <!-- End Modal Trigger for details -->
                        </div>
                        <!--  Main Modal  -->
                        <div x-show="modalOpen" x-transition
                            class="fixed top-0 left-0 flex justify-center w-full h-full min-h-screen px-4 py-5 inset-0 bg-gray-500 overflow-y-auto">
                            <div @click.outside="modalOpen = false"
                                class="max-w-5xl rounded-[20px]py-12 px-8 text-center md:py-[60px] md:px-[70px] relative z-20">
                                <!-- Modal content with scrollbar -->
                                <div class="max-h-[90vh]">
                                    <!-- modal main content -->
                                    <article
                                        class="mb-4 p-6 rounded-xl bg-white dark:bg-slate-800 flex flex-col bg-clip-border">
                                        <div class="flex pb-2  justify-between">
                                            <div class="flex">
                                                <div class="flex flex-col text-left">
                                                    <div class="">
                                                        <span id="newsSourceName_Detail"
                                                            class="text-lg font-bold text-white">source
                                                            name</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-slate-500 flex justify-between pb-4">
                                            <span id="newsPublishedDate">pub date</span>
                                            <span id="newsCategoryName">Category</span>
                                        </div>
                                        <div class="">
                                            <a class="" href="#">
                                                <img id="newsImage_Detail" class="max-w-1/3 max-h-[70vh] rounded-lg"
                                                    src="https://images.pexels.com/photos/1429748/pexels-photo-1429748.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                                            </a>
                                        </div>
                                        <div class="text-left">
                                            <h2 id="newsTitle_Detail" class="text-xl font-extrabold pt-4 text-white">
                                                news title
                                            </h2>
                                            <div class="w-full text-slate-500 pt-2">
                                                country:<span id="newsCountryName_Detail">country</span>
                                            </div>
                                            <div class="w-full text-slate-200 pt-2">
                                                Description:<span id="newsDescription_Detail">Description</span>
                                            </div>
                                        </div>
                                        <div class="py-4">
                                        </div>
                                        <div class="pt-2">
                                            <!-- Details -->
                                            <div class="w-full flex flex-wrap md:flex-nowrap md:space-x-2">
                                                <a id="newsSourceUrl" href="#"
                                                    class="py-3 px-4 w-full md:w-1/2 my-2 block bg-red-600 text-center rounded-lg font-medium  hover:bg-red-700 transition ease-in-out delay-75 text-white"
                                                    @click="modalOpen = false">
                                                    Back
                                                </a>
                                                <a id="newsSourceUrl" href="#"
                                                    class="py-3 px-4 w-full md:w-1/2 my-2 block bg-slate-700 text-center rounded-lg font-medium  hover:bg-slate-600 transition ease-in-out delay-75 text-white">
                                                    Complete Article
                                                </a>
                                            </div>
                                            <!-- End Details -->
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- ====== Modal Section End -->
                </article>
            </div>
            <!-- News Card End -->

            <!-- Repeat similar structure for other news cards -->
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const apiKey = 'pub_3777581d6d1f25be66ae6c53874189c9a9b2c';
                let apiUrl = `https://newsdata.io/api/1/news?q=bangladesh&apikey=${apiKey}`;
                document.getElementById('newsApiForm').addEventListener("submit", topicSearch)

                function topicSearch(e) {
                    e.preventDefault();
                    console.log('submitted');

                    let topic = document.getElementById('topicInput').value

                    topic = 'bangladesh';
                    apiUrl = `https://newsdata.io/api/1/news?q=${topic}&apikey=${apiKey}`;

                    fetchNews()
                }

                async function fetchNews() {
                    const response = await fetch(apiUrl);

                    let data = await response.json();
                    if (data.status === "error") {
                        console.error(data.results.message);
                        document.getElementById('responseMessage').innerHTML = data.results.message
                        return;
                    }
                    console.log('response: ', response);
                    console.log('data : ', data);

                    if (data.status === "success" && data.totalResults > 0) {
                        document.getElementById('responseMessage').innerHTML = ''

                        // console.log('Topic : ', topic);
                        document.getElementById('newsTitle').innerHTML = data.results[0].title
                        
                    } else if (data.status === "success" && data.totalResults == 0) {
                        
                        document.getElementById('responseMessage').innerHTML = "No data found"
                        setTimeout(() => {
                            document.getElementById(
                                "responseMessage"
                            ).innerHTML = "";
                        }, 10000);
                    } else {
                        console.log('something went wrong')
                    }
                }
                fetchNews()
            })
        </script>
    @endpush
</x-frontend.layouts.master>
