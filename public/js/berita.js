const search = new Search({
    classItem: '.berita',
    classSearch: [
        '.judul-berita', '.tanggal-berita', '.isi-berita'
    ],
    container: '.semua-berita'
});

$('#searchBox').on('input', e => search.filter(e));
