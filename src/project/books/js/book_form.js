
let submitBtn = document.getElementById('submit_btn');
let bookForm = document.getElementById('book_form');
let errorSummaryTop = document.getElementById('error_summary_top');

let titleInput = document.getElementById('title');
let authorInput = document.getElementById('author');
let publisherIdInput = document.getElementById('publisher_id');
let yearInput = document.getElementById('year');
let isbnInput = document.getElementById('isbn');
let formatIdInput = document.getElementById('format_id');
let descriptionInput = document.getElementById('description');
let imageInput = document.getElementsByName('image');

let titleError = document.getElementById('title_error');
let authorError = document.getElementById('author_error');
let publisherIdError = document.getElementById('publisher_id_error');
let yearError = document.getElementById('year_error');
let isbnError = document.getElementById('isbn_error');
let formatIdError = document.getElementById('format_id_error');
let descriptionError = document.getElementById('description_error');
let imageError = document.getElementById('image_error');

let errors = {};

submitBtn.addEventListener('click', onSubmitForm);

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
        messages
            .map(function (m) {
                return '<li>' + m + '</li>';
            })
            .join('') +
        '</ul>';
    errorSummaryTop.style.display = 'block';
}

function showFieldErrors() {
    titleError.innerHTML = errors.title || '';
    authorError.innerHTML = errors.author || '';
    publisherIdError.innerHTML = errors.publihser_id || '';
    yearError.innerHTML = errors.year || '';
    isbnError.innerHTML = errors.isbn || '';
    formatIdError.innerHTML = errors.format_id || '';
    descriptionError.innerHTML = errors.description || '';
    imageError.innerHTML = errors.image || '';
}

function isRequired(value) {
    return String(value).trim() !== '';
}

function isMinLength(value, min) {
    return String(value).trim().length >= min;
}

function isMaxLength(value, max) {
    return String(value).trim().length <= max;
}

function onSubmitForm(evt) {
    evt.preventDefault();

    errors = {};

    const titleMin = Number(titleInput.dataset.minlength || 3);
    const titleMax = Number(titleInput.dataset.maxlength || 255);
     const authorMin = Number(auhtorInput.dataset.minlength || 1);
    const authorMax = Number(authorInput.dataset.maxlength || 100);
    const descMin = Number(descriptionInput.dataset.minlength || 10);

    // title
    if (!isRequired(titleInput.value)) {
        addError('title', 'Title is required.');
    } else if (!isMinLength(titleInput.value, titleMin)) {
        addError(
            'title',
            'Title must be at least ' + titleMin + ' characters.'
        );
    } else if (!isMaxLength(titleInput.value, titleMax)) {
        addError('title', 'Title must be at most ' + titleMax + ' characters.');
    }

        // author
    if (!isRequired(authorInput.value)) {
        addError('author', 'Author is required.');
    } else if (!isMinLength(authorInput.value, authorMin)) {
        addError(
            'author',
            'Author must be at least ' + authorMin + ' characters.'
        );
    } else if (!isMaxLength(authorInput.value, authorMax)) {
        addError('author', 'Author must be at most ' + authorMax + ' characters.');
    }

   
     // publisher_ids
    let publisherChecked = false;
    for (let i = 0; i < pubisherIdsInput.length; i++) {
        if (publisherIdsInput[i].checked) {
            publisherChecked = true;
            break;
        }
    }
    if (!publisherChecked) {
        addError('publisher_ids', 'Select at least one publisher.');
    }

    // description
    if (!isRequired(descriptionInput.value)) {
        addError('description', 'Description is required.');
    } else if (!isMinLength(descriptionInput.value, descMin)) {
        addError(
            'description',
            'Description must be at least ' + descMin + ' characters.'
        );
    }
    

    // format_ids
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

    // image
    if (!imageInput.files || imageInput.files.length === 0) {
        addError('image', 'Image is required.');
    }

    showErrorSummaryTop();
    showFieldErrors();

    if (Object.keys(errors).length === 0) {
        alert(
            'Book form is valid. In a real app, this would submit to the server.'
        );
        // bookForm.submit();
    }
}
