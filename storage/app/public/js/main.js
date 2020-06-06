$(document).ready(function () {


    var elementNames = {};

    // Start
    let text = "";
    let results = [];
    let users_movies = [];
    let searchtype = document.getElementById("form-select").value;
    let delayTime = 500;
    if (searchtype == "books") {
        delayTime = 800;
    }

    // Delay function, delay count starts when user stops typing
    function delay(callback, ms) {
        var timer = 0;
        return function () {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    function isInList(imdbid) {
        users_movies.forEach(mov => imdbid == mov.id ? mov.status : "none");
    }

    // Search function
    $('#searchinput').keyup(delay((e) => {
        e.preventDefault();
        text = $('#searchinput').val();
        checkSearch();
        if (searchtype == "Movies & Shows") {
            searchtype = "movies";
            newElement("row_head", ["row", "p-5"]);
            newElement("title_head", ["col-sm-4"], 0, 0, 0, "Title");
            newElement("empty_head", ["col-sm-1"]);
            newElement("director_head", ["col-sm-3"], 0, 0, 0, "Directed by");
            newElement("rating_head", ["col-sm-2"], 0, 0, 0, "IMDb Rating");
            newElement("line_head", ["line"], "hr");
        }
        if (searchtype == "Books") {
            searchtype = "books";
        }
        data = {
            'userinput': text,
            'searchtype': searchtype
        }

        // Post search - you have to enter more than 2 characters for search
        if (text.length > 2) {
            // $('.searches').empty();
            getResults();
            $('.scrollgif').removeClass('d-none')
        } else {
            checkSearch();
            $('.searches').empty();
            $('.scrollgif').addClass('d-none');
        }

        // if (typeof ($('.searches').innerHTML) !== "undefined") {

        // } else {

        // }
    }, delayTime));

    function checkSearch() {
        $('#form-select').on('change', function () {
            searchtype = $('#form-select').val();
        });
        searchtype = $('#form-select').val();
    }

    // el = string, classes = array, domname = string, text = string, attrs = object, html = string
    function newElement(el, classes, domname, text, attrs, html) {
        // Check if the element name was specified
        if (typeof (domname) !== "string") {
            domname = "div";
        }

        elementNames[el] = document.createElement(domname);

        // Set inner content if it is provided
        if (typeof (text) === "string") {
            elementNames[el].innerText = text;
        }

        if (typeof (html) === "string") {
            elementNames[el].innerHTML = html;
        }

        // Set attributes
        if (typeof (attrs) === "object") {
            //attrs.forEach(attr => elementNames[el].setAttribute(attr, attrs[attr]));
            for (let attr in attrs) {
                elementNames[el].setAttribute(attr, attrs[attr]);
            }
        }
        // Set classes
        classes.forEach(cl => elementNames[el].classList.add(cl));
    }

    function getResults() {
        function createElements(result) {
            if (searchtype == "books") {
                result.Title = result.title;
                result.Poster = result.image_url;
                // result.imdbID = result.id["0"];
            }

            // Row
            newElement("row", ["row", "p-5", "align-items-center"], "div", 0);
            // Title
            newElement("searchresults", ["col-sm-4", "searchresults"], 0, 0, 0, `<h4> ${result.Title} (${result.Year}) </h4>`);
            // Result's image
            result.Poster != "N/A" ? newElement("poster", ["col-sm-1", "poster"], 0, 0, 0, `<img src=${result.Poster} width='40px'></img>`) : newElement("poster", ["col-sm-1", "poster"], 0, 0, 0, `No Image`);

            // Dropdown button for user operations
            newElement("addto", ["col-sm-2", "addto", "dropdown"])
            newElement("dropdownbtn", ["btn", "btn-secondary", "dropdown-toggle"], "button", "Add To List", { "type": "button", "data-toggle": "dropdown", "aria-haspopup": "true", "aria-expanded": "false" });

            // Dropdown menu and items
            newElement("dropdownmenu", ["dropdown-menu"], 0, 0, { "aria-labelledby": "dropdownMenuButton", "id": result.imdbID });
            newElement("completed", ["dropdown-item"], "a", "Completed", { "status": "Completed", });

            function forMovies() {
                switch (isInList(result.imdbID)) {
                    case "Plan To Watch":
                        elementNames["dropdownbtn"].innerText = "Plan To Watch";
                        break;
                    case "Completed":
                        elementNames["dropdownbtn"].innerText = "Completed";
                        elementNames["dropdownbtn"].removeClass('btn-secondary');
                        elementNames["dropdownbtn"].addClass('btn-success');
                        break;
                    case "Currently Watching":
                        elementNames["dropdownbtn"].innerText = "Currently Watching";
                        elementNames["dropdownbtn"].removeClass('btn-secondary');
                        elementNames["dropdownbtn"].addClass('btn-primary');
                        break;
                }
                // Director
                result.Director != "N/A" ? newElement("director", ["col-sm-3", "director"], 0, 0, 0, `<h4> ${result.Director} </h4>`) : newElement("director", ["col-sm-3", "director"], 0, 0, 0, `<h4> ${result.Writer} </h4>`);
                // Average rating
                newElement("rating", ["col-sm-2", "rating"], 0, 0, 0, `<h4> ${result.imdbRating} / 10 </h4>`);
                newElement("plan", ["dropdown-item"], "a", "Plan To Watch", { "status": "Plan To Watch", });
                newElement("watching", ["dropdown-item"], "a", "Currently Watching", { "status": "Currently Watching", });
            }

            function forBooks() {
                newElement("plan", ["dropdown-item"], "a", "Plan To Read", { "status": "Plan To Read" });
                newElement("watching", ["dropdown-item"], "a", "Currently Reading", { "status": "Currently Reading" });
            }

            if (searchtype == "movies") {
                forMovies();
            } else if (searchtype == "books") {
                forBooks();
            }

            // Appending items to the menu
            elementNames["dropdownmenu"].append(elementNames["plan"], elementNames["watching"], elementNames["completed"]);
            elementNames["addto"].append(elementNames["dropdownmenu"], elementNames["dropdownbtn"]);
        }

        // Append elements to the .searches div
        function appendElements(result) {
            createElements(result);
            // Append elements to the app
            elementNames["row_head"].append(elementNames["title_head"], elementNames["empty_head"], elementNames["director_head"], elementNames["rating_head"]);
            elementNames["row"].append(elementNames["searchresults"], elementNames["poster"], elementNames["director"], elementNames["rating"], elementNames["addto"]);
            document.querySelector('.searches').append(elementNames["row"]);
        }

        // Get results
        axios.post('search', data)
            .then(function (response) {
                results = response.data["details"];
                um = [];
                response.data["usermovies"].forEach(i => um.push({ id: i.imdbID, status: i.status }));
                users_movies = um;
                um = [];
                results = results.map(item => item.data);
                $('.searches').empty();
                setTimeout(() => {
                    $('.scrollgif').addClass("d-none");
                }, 2500);
                // Display each result
                if (searchtype == "movies") {
                    document.querySelector('.searches').append(elementNames["row_head"]);
                    document.querySelector('.searches').append(elementNames["line_head"]);
                    results.forEach(result => result.Type != "game" ? appendElements(result) : console.log('bruh 174'));
                } else if (searchtype == "books") {
                    results.forEach(result => {
                        appendElements(result.best_book);
                    });
                }
                //  Add movie to user's list
                $(".dropdown-item").click(function (event) {
                    event.preventDefault();
                    let status = this.getAttribute("status");
                    let send = {};
                    let thisid = $(event.currentTarget).parent().attr("id");
                    results.forEach(result => {
                        // If movie
                        if (result.imdbID == thisid) {
                            result.status = status;
                            send = {
                                id: result.imdbID,
                                status: status,
                                image: result.Poster,
                                name: result.Title,
                                director: result.Director,
                                year: result.Year
                            };
                        }
                    });
                    axios.post('send', send)
                        .then(function (response) {
                            // handle success
                            console.log("yeet");
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })
                });
            })
            .catch(function (error) {
                console.log(error);
            })
    }
    // End
})