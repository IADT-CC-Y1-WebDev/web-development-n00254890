let submitBtn = document.getElementById('submit_btn');
let bookForm = document.getElementById('book_form');
let errorSummaryTop = document.getElementById('error_summary_top');

let titleInput = document.getElementById('title');
let authorInput = document.getElementById('author');
let publisherIdInput = document.getElementById('publisher_id');
let yearInput = document.getElementById('year');
let isbnInput = document.getElementById('isbn');
let descriptionInput = document.getElementById('description');
let formatIdsInput = document.getElementsByName('format_ids[]');

let titleError = document.getElementById('title_error');
let authorError = document.getElementById('author_error');
let publisherIdError = document.getElementById('publisher_id_error');
let yearError = document.getElementById('year_error');
let isbnError = document.getElementById('isbn_error');
let formatIdError = document.getElementById('format_id_error');
let descriptionError = document.getElementById('description_error');

let errors = {};
console.log("form:", bookForm);
//submits the form if validation passes, otherwise shows errors.
bookForm.addEventListener('submit', onSubmitForm);
function addError(fieldName, message) {
    errors[fieldName] = message;
}

function showErrorSummaryTop() {
    const messages = Object.values(errors);

    if (messages.length === 0) {
        errorSummaryTop.style.display = 'none';
        errorSummaryTop.innerHTML = '';
        return;
    }

    errorSummaryTop.innerHTML =
        '<strong>Please fix the following:</strong><ul>' +
        messages.map(m => '<li>' + m + '</li>').join('') +
        '</ul>';

    errorSummaryTop.style.display = 'block';
}

function showFieldErrors() {
    titleError.innerHTML = errors.title || '';
    authorError.innerHTML = errors.author || '';
    publisherIdError.innerHTML = errors.publisher_id || '';
    yearError.innerHTML = errors.year || '';
    isbnError.innerHTML = errors.isbn || '';
    formatIdError.innerHTML = errors.format_ids || '';
    descriptionError.innerHTML = errors.description || '';
}

function isRequired(value) {
    return String(value).trim() !== '';
}

function isValidISBN13(value) {
    let cleaned = value.replace(/[-\s]/g, '');
    return /^\d{13}$/.test(cleaned);
}

function onSubmitForm(evt) {
    evt.preventDefault();
    console.log("ISBN:", isbnInput.value);
    console.log("JS validation running");
    errors = {};

    // title
    if (!isRequired(titleInput.value)) {
        addError('title', 'Title is required.');
    }
    

    // author
    if (!isRequired(authorInput.value)) {
        addError('author', 'Author is required.');
    }

    // publisher
    if (!isRequired(publisherIdInput.value)) {
        addError('publisher_id', 'Select a publisher.');
    }

    // year
    const currentYear = new Date().getFullYear();
    const yearValue = Number(yearInput.value);

    if (!isRequired(yearInput.value)) {
        addError('year', 'Year is required.');
    } else if (isNaN(yearValue)) {
        addError('year', 'Year must be a number.');
    } else if (yearValue < 1900 || yearValue > currentYear) {
        addError('year', 'Year must be between 1900 and ' + currentYear + '.');
    }

    // isbn (must be 13 digits, ignore spaces/dashes)
    if (!isRequired(isbnInput.value)) {
        addError('isbn', 'ISBN is required.');
    } else if (!isValidISBN13(isbnInput.value)) {
        addError('isbn', 'ISBN must be 13 digits (spaces and dashes allowed).');
    }

    // formats
    let formatChecked = false;
    for (let i = 0; i < formatIdsInput.length; i++) {
        if (formatIdsInput[i].checked) {
            formatChecked = true;
            break;
        }
    }

    if (!formatChecked) {
        addError('format_ids', 'Select at least one format.');
    }

    // description
    if (!isRequired(descriptionInput.value)) {
        addError('description', 'Description is required.');
    }

    showErrorSummaryTop();
    showFieldErrors();

    if (Object.keys(errors).length === 0) {
        bookForm.submit();
    }
}