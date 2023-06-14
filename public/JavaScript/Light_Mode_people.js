function toggleMode() {
    var body = document.getElementsByTagName('body')[0];
    var header = document.getElementsByClassName('header')[0];
    var content = document.getElementsByClassName('content')[0];
    var footer = document.getElementsByClassName('footer')[0];
    var actor = document.getElementsByClassName('actor')[0];
    var nom = document.getElementsByClassName('nom')[0];
    var PlaceOfBirth = document.getElementsByClassName('PlaceOfBirth')[0];
    var Birthday = document.getElementsByClassName('Birthday')[0];
    var Deathday = document.getElementsByClassName('Deathday')[0];
    var bio = document.getElementsByClassName('bio')[0];
    var button = document.getElementById('mode-toggle');
    var roles = document.querySelectorAll('.movie_info .role');
    var titres = document.querySelectorAll('.movie_info .ligne1 .titre');
    var dates = document.querySelectorAll('.movie_info .ligne1 .date');

    if (body.classList.contains('light-mode')) {
        body.classList.remove('light-mode');
        body.classList.add('dark-mode');
        header.style.backgroundColor = 'rgb(80, 80, 80)';
        content.style.backgroundColor = 'rgb(30, 30, 30)';
        footer.style.backgroundColor = 'rgb(80, 80, 80)';
        actor.style.backgroundColor = 'rgb(100, 100, 100)';
        nom.style.backgroundColor = 'rgb(130, 130, 130)';
        PlaceOfBirth.style.backgroundColor = 'rgb(130, 130, 130)';
        Birthday.style.backgroundColor = 'rgb(130, 130, 130)';
        Deathday.style.backgroundColor = 'rgb(130, 130, 130)';
        bio.style.backgroundColor = 'rgb(130, 130, 130)';
        roles.forEach(function(role) {
            role.style.backgroundColor = 'rgb(130, 130, 130)';
        });
        titres.forEach(function(titre) {
            titre.style.backgroundColor = 'rgb(130, 130, 130)';
        });
        dates.forEach(function(date) {
            date.style.backgroundColor = 'rgb(130, 130, 130)';
        });
        button.textContent = 'Light Mode';
    } else {
        body.classList.remove('dark-mode');
        body.classList.add('light-mode');
        header.style.backgroundColor = 'rgb(200, 200, 200)';
        content.style.backgroundColor = 'rgb(150, 150, 150)';
        footer.style.backgroundColor = 'rgb(200, 200, 200)';
        actor.style.backgroundColor = 'rgb(220, 220, 220)';
        nom.style.backgroundColor = 'rgb(250, 250, 250)';
        PlaceOfBirth.style.backgroundColor = 'rgb(250, 250, 250)';
        Birthday.style.backgroundColor = 'rgb(250, 250, 250)';
        Deathday.style.backgroundColor = 'rgb(250, 250, 250)';
        bio.style.backgroundColor = 'rgb(250, 250, 250)';
        roles.forEach(function(role) {
            role.style.backgroundColor = 'rgb(250, 250, 250)';
        });
        titres.forEach(function(titre) {
            titre.style.backgroundColor = 'rgb(250, 250, 250)';
        });
        dates.forEach(function(date) {
            date.style.backgroundColor = 'rgb(250, 250, 250)';
        });
        button.textContent = 'Dark Mode';
    }
}

window.addEventListener('DOMContentLoaded', function() {
    var button = document.getElementById('mode-toggle');
    button.addEventListener('click', toggleMode);
});