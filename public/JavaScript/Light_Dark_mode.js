function toggleMode() {
    var body = document.getElementsByTagName('body')[0];
    var header = document.getElementsByClassName('header')[0];
    var button = document.getElementById('mode-toggle');

    if (body.classList.contains('light-mode')) {
        body.classList.remove('light-mode');
        body.classList.add('dark-mode');
        header.style.backgroundColor = 'rgb(80, 80, 80)';
        button.textContent = 'Light Mode';
    } else {
        body.classList.remove('dark-mode');
        body.classList.add('light-mode');
        header.style.backgroundColor = 'rgb(200, 200, 200)';
        button.textContent = 'Dark Mode';
    }
}

window.addEventListener('DOMContentLoaded', function() {
    var button = document.getElementById('mode-toggle');
    button.addEventListener('click', toggleMode);
});