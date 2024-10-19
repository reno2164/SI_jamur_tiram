

$(document).ready(function () {
    $(".eksp").change(function (e) {
        e.preventDefault();
        var eksp = $(".eksp").val();

        if (eksp === "jnt") {
            var ongkir = $(".ongkir").val(9000);
        } else if (eksp === "jne") {
            var ongkir = $(".ongkir").val(10000);
        } else if (eksp === "sicepat") {
            var ongkir = $(".ongkir").val(8000);
        } else {
            var ongkir = $(".ongkir").val(9500);
        }

        $(".pembayaran").each(function () {
            var card = $(this);
            var totalBelanja = card.find(".totalBelanja").val();
            var totalPpn = parseInt(totalBelanja) * 0.11;
            var ppn = card.find(".ppn").val(totalPpn);
            var disc = card.find(".discount").val();
            var totalDisc = parseInt(totalBelanja) * parseFloat(disc);
            var ongkir = card.find(".ongkir").val();

            var subtotal = parseInt(totalBelanja) + parseInt(totalPpn);
            var subtotal2 = parseInt(subtotal) + parseInt(ongkir);
            console.log(subtotal2);
            console.log(ongkir);
            card.find("#dibayarkan").val(subtotal2);
            // card.find('.ppn').val(ppn);
        });
    });
});
