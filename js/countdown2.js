var end = new Date('03/1/2021 4:50 PM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('countdown').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById('countdown').innerHTML = 
			'<div class="clock-prev"><div class="clock-item"><h1>' + days + '</h1><h2>DÍAS</div></div>';
        document.getElementById('countdown').innerHTML += 
			'<div class="clock-prev"><div class="clock-item"><h1>' + hours + '</h1><h2>Horas</div></div>';
        document.getElementById('countdown').innerHTML += 
			'<div class="clock-prev"><div class="clock-item"><h1>' + minutes + '</h1><h2>MINUTOS</div></div>';
        document.getElementById('countdown').innerHTML +=
			'<div class="clock-prev"><div class="clock-item"><h1>' + seconds + '</h1><h2>SEGUNDOS</div></div>';
    }

    timer = setInterval(showRemaining, 1000);
