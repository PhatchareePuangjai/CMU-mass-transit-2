

// ============= time today =============
var timestamp = '<?=time();?>';

function updateTime(){

    const now = new Date();
    var seconds = now.getSeconds();
    var minutes = now.getMinutes();
    var hours = now.getHours();
    var weekday = new Array(7);
    weekday[0] =  "วันอาทิตย์";
    weekday[1] = "วันจันทร์";
    weekday[2] = "วันอังคาร";
    weekday[3] = "วันพุธ";
    weekday[4] = "วันพฤหัสบดี";
    weekday[5] = "วันศุกร์";
    weekday[6] = "วันเสาร์";


    // Add a leading zero to the hours value
    var hours = (( hours < 10 ? "0" : "" ) + hours);
    // Add a leading zero to the minutes value
    var min = (( minutes < 10 ? "0" : "" ) + minutes);
    // Add a leading zero to seconds value
    var sec = (( seconds < 10 ? "0" : "" ) + seconds);

    var day = weekday[now.getDay()];

    // get date
    var d = (( now.getDate() < 10 ? "0" : "" ) + now.getDate());
    var m = (( (now.getMonth() + 1) < 10 ? "0" : "" ) + (now.getMonth() + 1));
    var y = now.getFullYear();

    var date = day + " ที่ " + d + "/" + m + "/" + y;
    var time = hours + " : " + min + " : " + sec;
    $('#time').html(time);
    $('#date').html(date);

    timestamp++;

}

$(function(){
    setInterval(updateTime, 1000);
});

