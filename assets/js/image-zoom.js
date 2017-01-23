function showBigImg() {
    var url = window.location.origin + '/Shop/assets/img/' + event.target.classList[0];
    if (event.target.classList[0] != 'col-sm-4') {
        $('.img_show').attr('hidden', false);
        $('.img_show p').replaceWith('<p><img src="' + url + '" width="160" height="160"/></p>');
    }
}

function hideBigImg() {
    $('.img_show').attr('hidden', true);
}