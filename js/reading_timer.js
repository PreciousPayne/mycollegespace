document.getElementById('readingTimerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const minutes = document.getElementById('reading_time').value;
    const totalTime = minutes * 60; // Convert minutes to seconds
    let timeRemaining = totalTime;
    
    document.getElementById('timerDisplay').classList.remove('hidden');
    document.getElementById('quoteDisplay').classList.add('hidden');
    document.getElementById('timeRemaining').innerText = timeRemaining;
    
    const timerInterval = setInterval(function() {
        timeRemaining--;
        document.getElementById('timeRemaining').innerText = timeRemaining;

        if (timeRemaining === 60) {
            alert("Only 1 minute left!");
        }

        if (timeRemaining === 300) {
            alert("Only 5 minute left!");
        }

        if (timeRemaining === 1800) {
            alert("Only 30 minute left!");
        }

        if (timeRemaining === 3600) {
            alert("Only 1 hour left!");
        }


        if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            displayQuote();
        }
    }, 1000);
});

function displayQuote() {
    const quotes = [
        "Keep going! Your hard work will pay off.",
        "Believe in yourself and all that you are.",
        "The only way to achieve the impossible is to believe it is possible.",
        "You are capable of amazing things!",
        "Success is not the key to happiness. Happiness is the key to success."
    ];
    const randomIndex = Math.floor(Math.random() * quotes.length);
    document.getElementById('motivationalQuote').innerText = quotes[randomIndex];
    document.getElementById('quoteDisplay').classList.remove('hidden');
}
