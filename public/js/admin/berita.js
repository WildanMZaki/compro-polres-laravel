$('#confirm_delete').on('show.bs.modal', e => {
    const data = e.relatedTarget.dataset;
    $('#news_title').html(data.title);
    $('#deleteBeritaForm').attr('action', (e.target.dataset.route).replace('#', data.slug));
});
