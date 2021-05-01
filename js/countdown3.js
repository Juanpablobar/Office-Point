var end = new Date('".$date." 12:00 AM'); 

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
			'<h1>' + days + '</h1><h2>DÍAS';
        document.getElementById('countdown').innerHTML += 
			'<h1>' + hours + '</h1><h2>Horas';
        document.getElementById('countdown').innerHTML += 
			'<h1>' + minutes + '</h1><h2>MINUTOS';
        document.getElementById('countdown').innerHTML +=
			'<h1>' + seconds + '</h1><h2>SEGUNDOS';
    }

    timer = setInterval(showRemaining, 1000);
