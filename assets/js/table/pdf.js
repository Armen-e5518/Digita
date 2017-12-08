$(document).ready(function () {
    $('#save-pdf').click(function () {
        pdf.save("QR-codes.pdf");
    })
    var pdf = new jsPDF();
    var yqr = 15;
    var yt = 10;
    var index = 1;
    $('.qr-img').each(function () {
        var img = new Image;
        img.onload = function () {
            pdf.text('Table ' + index, 95, yt)
            pdf.addImage(this, 65, yqr);
            yqr = yqr + 100;
            yt = yt + 100;
            if (index % 3 == 0) {
                pdf.addPage();
                yqr = 15;
                yt = 10;
            }
            index = index + 1;
        };
        img.crossOrigin = "";  // for demo as we are at different origin than image
        img.src = $(this).attr('src');  // some random imgur image
    })
})
