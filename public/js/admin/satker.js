$('#confirm_delete').on('show.bs.modal', e => {
    const data = e.relatedTarget.dataset;
    $('#satker_name_modal').html(data.name);
    $('#deleteSatkerForm').attr('action', (e.target.dataset.route).replace('#', data.slug));
});

const search = new Search({
    classItem: '.satker',
    classSearch: '.satker-name',
    container: '.semua-satker',
    firstLabel: 'All',
    searchLabel: '#label',
    searchNumber: '#number'
});

$('#searchBox').on('input', e => {
    search.filter(e);
    search.result(e);
});

document.addEventListener('DOMContentLoaded', () => $('#searchBox').val(''));
