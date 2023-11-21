$('.detail-view').click(function() {
    // 以下のように変数を設定する
    var contact_id = $(this).attr('id');
    var fullname = $('.name_get' + contact_id).text();
    var gender = $('.gender_get' + contact_id).text();
    var email = $('.email_get' + contact_id).text();
    var tel = $('.tel_get' + contact_id).text();
    var address = $('.address_get' + contact_id).text();
    var building = $('.building_get' + contact_id).text();
    var category = $('.category_get' + contact_id).text();
    var detail = $('.detail_get' + contact_id).text();

    // モーダルに値をセットする
    $('.full-name-modal').text(fullname);
    $('.gender-modal').text(gender);
    $('.email-modal').text(email);
    $('.tel-modal').text(tel);
    $('.address-modal').text(address);
    $('.building-modal').text(building);
    $('.category-modal').text(category);
    $('.detail-text-modal').val(detail);

    // 削除ボタンに連携するIDを設定する
    $('.delete-id').val(contact_id);

    // モーダルを表示する
    $('.modal').css({ 'display': 'block' });
});

$('.close-button').click(function() {
    // モーダルを非表示にする
    $('.modal').css({ 'display': 'none' });
});
