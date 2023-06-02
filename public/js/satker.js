const search = new Search({
    classItem: '.satker',
    classSearch: '.satker-name',
    container: '.semua-satker',
    firstLabel: 'Semua Satker',
    searchLabel: '#label',
    searchNumber: '#total'
});

$('#searchBox').on('input', e => {
    search.filter(e);
    search.result(e);
});
