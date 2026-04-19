let applyBtn = document.getElementById('apply_filters');
let clearBtn = document.getElementById('clear_filters');

let cardsContainer = document.querySelector('.cards'); // container for cards
let cards = document.querySelectorAll('.card');

let form = document.querySelector('.filters form');


applyBtn.addEventListener('click', (event) => {
    event.preventDefault();
    applyFilters();
});

clearBtn.addEventListener('click', (event) => {
    event.preventDefault();
    clearFilters();
});

function applyFilters() {
    let filters = getFilters();

    for (let i = 0; i != cards.length; i++) {
        let card = cards[i];
        let match = cardMatches(card, filters);
        card.classList.toggle('hidden', !match);
    }
    let cardsArray = Array.from(cards);
    const sorted = sortCards(cardsArray, filters.sortBy);
    sorted.forEach(card => {
        cardsContainer.appendChild(card);
    });
}


function sortCards(cards, sortBy) {
    const list = cards.slice();
    
    list.sort((a, b) => {
        let titleA = a.dataset.title.toLowerCase();
        let titleB = b.dataset.title.toLowerCase();
        let dateA = Number(a.dataset.date);
        let dateB = Number(b.dataset.date);
        let addedA = Number(a.dataset.added);
        let addedB = Number(b.dataset.added);

        if (sortBy === "date_desc") return dateB - dateA;
        if (sortBy === "date_asc") return dateA - dateB;
        if (sortBy === "added_desc") return addedB - addedA;
        if (sortBy === "added_asc") return addedA - addedB;

        return titleA.localeCompare(titleB);
    });

    return list;
}


function cardMatches(card, filters) {
    let title = card.dataset.title.toLowerCase();
    let publisher = card.dataset.publisher;

    let cardFormats = (card.dataset.format || '').split(',');

    let matchTitle = filters.titleFilter === "" || title.includes(filters.titleFilter);
    let matchPublisher = filters.publisherFilter === "" || publisher === filters.publisherFilter;

    let matchFormat =
        filters.formatFilter.length === 0 ||
        filters.formatFilter.some(f => cardFormats.includes(f));

    return matchTitle && matchPublisher && matchFormat;
}

function getFilters() {
    const titleEl = form.elements['title_filter'];
    const publisherEl = form.elements['publisher_filter'];
    const formatCheckboxes = document.querySelectorAll('.dropdown-content input[type="checkbox"]:checked');
    const sortBy = form.elements['sort_by'].value || 'date_desc';

    let titleFilter = (titleEl.value || '').trim().toLowerCase();
    let publisherFilter = publisherEl.value || '';
    let formatFilter = Array.from(formatCheckboxes).map(cb => cb.value);

    return {
        titleFilter,
        publisherFilter,
        formatFilter,
        sortBy
    };
}

function clearFilters() {
    form.reset();
    cards.forEach(card => card.classList.remove('hidden'));
}