function toggleMode() {
    var body = document.getElementsByTagName('body')[0];
    var header = document.getElementsByClassName('header')[0];
    var content = document.getElementsByClassName('content')[0];
    var footer = document.getElementsByClassName('footer')[0];
    var list = document.getElementsByClassName('list')[0];
    var movieItems = document.getElementsByClassName('movie-item');
    var button = document.getElementById('mode-toggle');

    if (body.classList.contains('light-mode')) {
        body.classList.remove('light-mode');
        body.classList.add('dark-mode');
        header.style.backgroundColor = 'rgb(80, 80, 80)';
        content.style.backgroundColor = 'rgb(30, 30, 30)';
        footer.style.backgroundColor = 'rgb(80, 80, 80)';
        list.style.backgroundColor = 'rgb(100, 100, 100)';
        for (var i = 0; i < movieItems.length; i++) {
            movieItems[i].style.color = 'white';
        }
        button.textContent = 'Light Mode';
    } else {
        body.classList.remove('dark-mode');
        body.classList.add('light-mode');
        header.style.backgroundColor = 'rgb(200, 200, 200)';
        content.style.backgroundColor = 'rgb(180, 180, 180)';
        footer.style.backgroundColor = 'rgb(200, 200, 200)';
        list.style.backgroundColor = 'rgb(230, 230, 230)';
        for (var i = 0; i < movieItems.length; i++) {
            movieItems[i].style.color = 'black';
        }
        button.textContent = 'Dark Mode';
    }
}

window.addEventListener('DOMContentLoaded', function() {
    var button = document.getElementById('mode-toggle');
    button.addEventListener('click', toggleMode);
});