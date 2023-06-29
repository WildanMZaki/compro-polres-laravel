// $('.mission-templates').on('click', '.misi-template', e => {
//     const type = parseInt(e.currentTarget.dataset.type);
//     $('#change-template').show();
//     if (type === 1) {
//         $('#misi_t1').show();
//         $('#misi_t2').hide();
//     } else if (type === 2) {
//         $('#misi_t1').hide();
//         $('#misi_t2').show();
//     } else {
//         $('#misi_t1').show();
//         $('#misi_t2').show();
//     }
//     $('[name="misi_type"]').val(((type === 1)? 'paragraf': (type === 2)? 'list': 'paragraf+list'));
//     $('.mission-templates').hide();
// });

// $('#change-template').click(e => {
//     $('.mission-templates').show();
//     $('#misi_t1').hide();
//     $('#misi_t2').hide();
//     $('#change-template').hide();
// });

// let mission_items = 1;
// $('#addMissionListItem').click(e => {
//     let empety = null;
//     $('[name="misi_list_item[]"]').each((i, item) => {
//         if (!$(item).val()) {
//             empety = true;
//         }
//     });
//     if (empety) {
//         showError('Tolong isi dulu kolom yang kosong ya!', 3);
//         return;
//     }
//     const item_count = mission_items +1;
//     mission_items += 1;
//     $('#mission-list').append(`
//         <div class="rmission d-flex align-items-center w-100 flex-stretch mb-3" id="rmission${item_count}">
//             <div class="p-4 row-number-mission-item">${$('.rmission').length +1}</div>
//             <div class="w-100 me-3">
//                 <input type="text" name="misi_list_item[]" class="form-control w-100">
//             </div>
//             <div>
//                 <button type="button" class="remove-mission-item btn btn-danger" data-count="${item_count}"><span class="d-flex align-items-center"><i class="bx bx-x"></i> Hapus</span></button>
//             </div>
//         </div>
//     `);
// });

function showError(message, timer_in_second = 3, id = 'errorMsg'){
    $(`#${id}`).html(message);
    setTimeout(() => {
        $(`#${id}`).html('');
    }, timer_in_second*1000)
}

// $('#mission-list').on('click', '.remove-mission-item', e => {
//     const count = e.currentTarget.dataset.count;
//     $(`#rmission${count}`).remove();
//     $('.row-number-mission-item').each((index, item) => $(item).html(index+1));
// });

let contact = 1;
$('#addContact').click(e => {
    let empety = null;
    $('[name="contacts[]"]').each((i, item) => {
        if (!$(item).val()) {
            empety = true;
        }
    });
    if (empety) {
        showError('Tolong isi dulu kontak yang kosong ya!', 3, 'errorContactMsg');
        return;
    }
    const item_count = contact +1;
    contact += 1;
    $('#contacts').append(`
        <div class="form-control d-flex contact" id="contact${item_count}">
            <select name="contact_type[]" id="" class="form-control w-25 select-contacts">
                <option value="instagram">Instagram</option>
                <option value="email">Email</option>
                <option value="facebook">Facebook</option>
                <option value="whatsapp">Whatsapp</option>
                <option value="twitter">Twitter</option>
                <option value="tik-tok">Tik tok</option>
            </select>
            <input type="text" class="form-control input-contacts" name="contacts[]"  placeholder="Masukan username akun instagram anda">
            <button type="button" class="btn btn-danger m-1 p-3 remove-contact" title="Hapus Contact" data-num="${item_count}"><i class="bx bx-x fs-3 m-2"></i></button>
        </div>
    `);
});

$('#contacts').on('click', '.remove-contact', e => {
    const num = e.currentTarget.dataset.num;
    $(`#contact${num}`).remove();
});

$('#contacts').on('change', '.select-contacts', (e) => {
    const val  = e.currentTarget.value;
    let placeholder, type;
    switch (val) {
        case 'email':
            placeholder = 'Masukan email anda';
            type = 'email';
            break;
        case 'facebook':
            placeholder = 'Tuliskan nama akun facebook anda';
            type = 'text';
            break;
        case 'whatsapp':
            placeholder = 'Tuliskan nomor Whatsapp, contoh: 6212345678980';
            type = 'number';
            break;
        case 'twitter':
            placeholder = 'Tuliskan username dari akun twitter anda';
            type = 'text';
            break;
        case 'tik-tok':
            placeholder = 'Tuliskan username dari akun tik tok anda';
            type = 'text';
            break;

            default:
            placeholder = 'Masukan username akun instagram anda';
            break;
    }

    e.currentTarget.nextElementSibling.placeholder = placeholder;
    e.currentTarget.nextElementSibling.type = type;
})
