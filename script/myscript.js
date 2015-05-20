function setMap(type) {

    var bStd = true;
    var bFst = true;
    var bBB = true;

    if (type[0]=='0')
        bStd = false;
    if (type[1]=='0')
        bFst = false;
    if (type[2]=='0')
        bBB = false;

    $('.seat').removeClass('na').addClass('avail');
    $('.rowno').removeClass('avail');
    $('.reserved').removeClass('avail').addClass('na');
    $('.info').removeClass('avail').addClass('na');

    if (!bStd)
        $('.s').removeClass('avail').addClass('na');
    if (!bFst)
        $('.f').removeClass('avail').addClass('na');
    if (!bBB)
        $('.b').removeClass('avail').addClass('na');

    $('.selected').removeClass('na');

}

function countSeatType() {
    var std=0;
    var fst=0;
    var bb=0;

    for (var i=1; i<9; i++) {
        switch ($('#fi'+i).attr('name')) {
            case 'SA':
            case 'SP':
            case 'SC':
                std += parseInt($('#fi'+i).val());
                break;
            case 'FA':
            case 'FC':
                fst += parseInt($('#fi'+i).val());
                break;
            default:
                bb += parseInt($('#fi'+i).val());
                break;
        }
    }
    seats = '';
    $('#selectedSeats').children('.seat-selected').each(function () {
        id = this.id;
        seats += ','+id.substr(2,id.length);
        switch (id[2]) {
            case 'A':
            case 'B':
            case 'C':
                bb--;
                break;
            case 'G':
                std--;
                break;
            default:
                num = id.substr(3, id.length);
                if ((parseInt(num) > 5) && (parseInt(num) < 10)) {
                    fst--;
                } else {
                    std--;
                }
                break;
        }
    });
    $('#seatValues').val(seats);

    var html = '';
    if (std > 0) {
        html += '<div class="remain-seat">'+std+' x Standard Seat(s)</div>';
    }
    if (fst > 0) {
        html += '<div class="remain-seat">'+fst+' x First Class Seat(s)</div>';
    }
    if (bb > 0) {
        html += '<div class="remain-seat">'+bb+' x Beanbag(s)</div>';
    }
    setMap(std+''+fst+''+bb);
    $('#remaining-seats').html(html);
}

function updatePrice(id,time) {
    if ($("#"+id).val() < 0)
        $("#"+id).val(0);
    else {

        var price = p1;

        var val = (getPrice(parseInt(id[2])-1,time)*$("#"+id).val()).toFixed(2);
        t1[id[2]-1] = val;

        $("#fsi"+id[2]).text("$"+val);
        updateTotal();
    }
}

var p1 = [12, 10, 8, 25, 20, 20, 20, 20];
var p2 = [18, 15, 12, 30, 25, 30, 30, 30];
function getPrice(id, session) {
    day = session.split(' ')[0];
    time = session.split(' ')[1];
    switch (day) {
        case 'Wednesday':
            if (time=='1pm')
                return p1[id];
            else
                return p2[id];
            break;
        case 'Thursday':
        case 'Friday':
        case 'Saturday':
        case 'Sunday':
            return p2[id];
            break;
        default:
            return p1[id];
            break;
    }
}

function updateTotal() {
    var price = 0;
    for (var i = 0; i < 8; i++) {
        price += parseInt(t1[i]);
    }

    $("#fstotal").text("$"+price.toFixed(2));
}

var t1 = [0, 0, 0, 0, 0, 0, 0, 0];

var tickets = [
    'SA,Standard Adult',
    'SP,Standard Concession',
    'SC,Standard Child',
    'FA,First Class Adult',
    'FC,First Class Child',
    'B1,Beanbag for 1',
    'B2,Beanbag for 2',
    'B3,Beanbag for 3'
];
var ticketList = '';
for (var i = 1; i < 9; i++) {
    var code = tickets[i - 1].split(',')[0];
    var name = tickets[i - 1].split(',')[1];
    ticketList += '<span class="tk-l">' + name + '</span>' +
    '<input id="fi' + i + '" class="tk-ip" type="number" name="' + code + '" value="0" min="0" max="10" />' +
    '<span id="fsi' + i + '" class="tk-r">$0.00</span>';
}
ticketList += '<span class="tk-l lb">Total</span><input id="ip-total" class="tk-ip hidden" type="number" /><span id="fstotal" class="tk-r">$0.00</span>';
