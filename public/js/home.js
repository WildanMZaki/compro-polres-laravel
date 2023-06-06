$('.semua-satker').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }
    ]
});

function getData(url, callback) {
    $.get(
        url, data => callback(data)
    );
}

function showNews() {
    getData("../json/news.json", data => {
        data.forEach(berita => {
            $('.semua-berita').append(`
                <div class="berita d-flex border p-2 mb-3" onclick="location.href = './baca-berita.html#${berita.id}'">
                    <div class="gambar-berita w-25 pe-2">
                        <img src="./assets/${berita.gambar}" alt="Gambar Berita" class="img-fluid">
                    </div>
                    <div class="info-berita w-75 d-flex flex-column">
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
// showNews();
