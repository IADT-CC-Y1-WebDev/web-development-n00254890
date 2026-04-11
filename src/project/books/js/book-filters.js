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

    cards.forEach(card => {
        let match = cardMatches(card, filters);
        card.classList.toggle('hidden', !match);
    });

    // Optional: sort by title (alphabetical) if needed
    let cardsArray = Array.from(cards);
    const sorted = sortCards(cardsArray, filters.sortBy);
    sorted.forEach(card => {
        cardsContainer.appendChild(card);
    });
}

function sortCards(cards, sortBy) {
    const list = Array.from(cards);

    list.sort((a, b) => {
        let titleA = a.dataset.title.toLowerCase();
        let titleB = b.dataset.title.toLowerCase();

        if (sortBy === "title_desc") return titleB.localeCompare(titleA);
        return titleA.localeCompare(titleB); // default ascending
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

    let titleFilter = (titleEl.value || '').trim().toLowerCase();
    let publisherFilter = publisherEl.value || '';
    let formatFilter = Array.from(formatCheckboxes).map(cb => cb.value);

    return {
        titleFilter,
        publisherFilter,
        formatFilter
    };
}

function clearFilters() {
    form.reset();
    cards.forEach(card => card.classList.remove('hidden'));
}