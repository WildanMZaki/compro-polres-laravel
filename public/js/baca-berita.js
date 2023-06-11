function sendReq(url, method, token, success_cb, error_cb) {
    $.ajax({
        url: url,
        type: method,
        headers: {'X-CSRF-TOKEN': token},
        dataType: 'JSON',
        success: function (data) {
            // console.log(data);
            success_cb(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            error_cb(jqXHR, textStatus, errorThrown);
        },
    });
}

function scs(data) {
    console.log('data :>> ', data);
}

function err(jqXHR, textStatus, errorThrown) {
    console.log('Message: ' + textStatus + ' , HTTP: ' + errorThrown );
}

$('#commentList').on('click', '.like', (e) => {
    const dataset = e.currentTarget.dataset;
    // likeDislikeReq(dataset);
    sendReq(dataset.link, 'POST', dataset.token, (data) => {
        $(`#likeComment${dataset.id}`).html(data.likes);
        $(`#dislikeComment${dataset.id}`).html(data.dislikes);
        $(`#dislikeBtn${dataset.id}`).removeClass('text-primary');
        $(`#dislikeBtn${dataset.id}`).addClass('text-dark');
        $(`#likeBtn${dataset.id}`).removeClass((data.like_status)? 'text-dark': 'text-primary');
        $(`#likeBtn${dataset.id}`).addClass((data.like_status)? 'text-primary': 'text-dark');
    }, err);
})

$('#commentList').on('click', '.dislike', (e) => {
    const dataset = e.currentTarget.dataset;
    sendReq(dataset.link, 'POST', dataset.token, (data) => {
        $(`#likeComment${dataset.id}`).html(data.likes);
        $(`#dislikeComment${dataset.id}`).html(data.dislikes);
        $(`#likeBtn${dataset.id}`).removeClass('text-primary');
        $(`#likeBtn${dataset.id}`).addClass('text-dark');
        $(`#dislikeBtn${dataset.id}`).removeClass((data.dislike_status)? 'text-dark': 'text-primary');
        $(`#dislikeBtn${dataset.id}`).addClass((data.dislike_status)? 'text-primary': 'text-dark');
    }, err);
});

