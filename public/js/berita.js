function getData(url, callback) {
    $.get(
        url, data => callback(data)
    );
}

function showNews() {
    getData("../json/news.json", data => {
        data.forEach(berita => {
            $('.semua-berita').append(`
                <div class="berita d-flex flex-lg-column border p-2 mb-lg-4 mb-3 mx-2 shadow rounded-1" onclick="location.href='./baca-berita.html#${berita.id}'">
                    <div class="gambar-berita p-lg-2 pe-2 text-center">
                        <img src="./assets/${berita.gambar}" alt="Gambar Berita" class="img-fluid">
                    </div>
                    <div class="info-berita p-lg-2 d-flex flex-column justify-content-start">
                        <h6 class="m-0 judul-berita">${berita.title}</h6>
                        <small class="tanggal-berita my-2">
                            <i class="bx bx-calendar"></i>${berita.date}
                        </small>
                        <small class="isi-berita">${berita.content[0]}</small>
                    </div>
                </div>
            `);
        });
    });
}
showNews();


const search = new Search({
    classItem: '.berita',
    classSearch: [
        '.judul-berita', '.tanggal-berita', '.isi-berita'
    ],
    container: '.semua-berita'
});

$('#searchBox').on('input', e => search.filter(e));
