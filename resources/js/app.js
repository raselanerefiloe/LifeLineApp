import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


$(document).ready(function() {
    // Set the date we're counting down to (example: 1 hour from now)
    var countDownDate = new Date().getTime() + 60 * 60 * 1000; // 1 hour from now

    // Update the count down every 1 second
    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        // Calculate days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the elements
        $('#days').text(pad(days));
        $('#hours').text(pad(hours));
        $('#minutes').text(pad(minutes));
        $('#seconds').text(pad(seconds));

        // If the count down is finished, display a message
        if (distance < 0) {
            clearInterval(x);
            $('#countdown').html("EXPIRED");
        }
    }, 1000);

    // Function to pad numbers with leading zeros
    function pad(num) {
        return num < 10 ? '0' + num : num;
    }
});
