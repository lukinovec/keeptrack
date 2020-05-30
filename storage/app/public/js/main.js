$(document).ready(function () {
    var elementNames = {};

    // Start
    let text = "";
    let results = [];
    let searchtype = document.getElementById("form-select").value;

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

    // Search function
    $('#searchinput').keyup(delay((e) => {
        e.preventDefault();
        text = $('#searchinput').val();
        checkSearch();
        if (searchtype == "Movies & Shows") {
            searchtype = "movies";
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
        } else {
            checkSearch();
            $('.searches').empty();
        }
    }, 800));

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
            } else {
            }

            // Row
            newElement("row", ["row", "p-5"]);

            // Title
            newElement("searchresults", ["col-sm-4", "searchresults"], 0, 0, 0, `<h4> ${result.Title} (${result.Year}) </h4>`);

            // Result's image
            newElement("poster", ["col-sm-4", "poster"], 0, 0, 0, `<img src=${result.Poster} width='40px'></img>`);

            // Misc info, placeholder
            newElement("details", ["col-sm-4", "details"]);

            // Dropdown button for user operations
            newElement("addto", ["col-sm-4", "addto", "dropdown"])
            newElement("dropdownbtn", ["btn", "btn-secondary", "dropdown-toggle"], "button", "Add To List", { "type": "button", "data-toggle": "dropdown", "aria-haspopup": "true", "aria-expanded": "false" });

            // Dropdown menu and items
            newElement("dropdownmenu", ["dropdown-menu"], 0, 0, { "aria-labelledby": "dropdownMenuButton" });
            newElement("plan", ["dropdown-item"], "a", "Plan To Watch", { "href": "ptw" });
            newElement("watching", ["dropdown-item"], "a", "Currently Watching", { "href": "watching" });
            newElement("completed", ["dropdown-item"], "a", "Completed", { "href": "completed" });

            // Appending items to the menu
            elementNames["dropdownmenu"].append(elementNames["plan"], elementNames["watching"], elementNames["completed"]);
            elementNames["addto"].append(elementNames["dropdownmenu"], elementNames["dropdownbtn"]);
        }

        // Append elements to the .searches div
        function appendElements(result) {
            createElements(result);
            // Append elements to the app
            elementNames["row"].append(elementNames["searchresults"], elementNames["poster"], elementNames["addto"]);
            document.querySelector('.searches').append(elementNames["row"]);
        }
        axios.post('search', data)
            .then(function (response) {
                results = response.data;
                $('.searches').empty();
                // Display each result
                if (searchtype == "movies") {
                    console.log(results);
                    results.forEach(result => {
                        if (result.Type != "game") {
                            appendElements(result);
                            console.log(result);
                        }
                    })
                } else if (searchtype == "books") {
                    results.forEach(result => {
                        appendElements(result.best_book);
                    });
                }
            })
            .catch(function (error) {
                console.log(error);
            })
        //.then();
    }

    // End
})