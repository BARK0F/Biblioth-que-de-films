function toggleMode() {
    var body = document.getElementsByTagName('body')[0];
    var header = document.getElementsByClassName('header')[0];
    var content = document.getElementsByClassName('content')[0];
    var footer = document.getElementsByClassName('footer')[0];
    var principal_content = document.getElementsByClassName('principal_content')[0];
    var Ftitle = document.getElementsByClassName('Ftitle')[0];
    var date = document.getElementsByClassName('date')[0];
    var OriginalTitle = document.getElementsByClassName('OriginalTitle')[0];
    var Tagline = document.getElementsByClassName('Tagline')[0];
    var resumer = document.getElementsByClassName('resumer')[0];
    var roles = document.querySelectorAll('.actor_info .role');
    var names = document.querySelectorAll('.actor_info .name');
    var button = document.getElementById('mode-toggle');

    if (body.classList.contains('light-mode')) {
        body.classList.remove('light-mode');
        body.classList.add('dark-mode');
        header.style.backgroundColor = 'rgb(80, 80, 80)';
        content.style.backgroundColor = 'rgb(30, 30, 30)';
        footer.style.backgroundColor = 'rgb(80, 80, 80)';
        principal_content.style.backgroundColor = 'rgb(100, 100, 100)';
        Ftitle.style.backgroundColor = 'rgb(130, 130, 130)';
        date.style.backgroundColor = 'rgb(130, 130, 130)';
        OriginalTitle.style.backgroundColor = 'rgb(130, 130, 130)';
        Tagline.style.backgroundColor = 'rgb(130, 130, 130)';
        resumer.style.backgroundColor = 'rgb(130, 130, 130)';
        roles.forEach(function(role) {
            role.style.backgroundColor = 'rgb(130, 130, 130)';
        });
        names.forEach(function(name) {
            name.style.backgroundColor = 'rgb(130, 130, 130)';
        });
        button.textContent = 'Light Mode';
    } else {
        body.classList.remove('dark-mode');
        body.classList.add('light-mode');
        header.style.backgroundColor = 'rgb(200, 200, 200)';
        content.style.backgroundColor = 'rgb(150, 150, 150)';
        footer.style.backgroundColor = 'rgb(200, 200, 200)';
        principal_content.style.backgroundColor = 'rgb(220, 220, 220)';
        Ftitle.style.backgroundColor = 'rgb(250, 250, 250)';
        date.style.backgroundColor = 'rgb(250, 250, 250)';
        OriginalTitle.style.backgroundColor = 'rgb(250, 250, 250)';
        Tagline.style.backgroundColor = 'rgb(250, 250, 250)';
        resumer.style.backgroundColor = 'rgb(250, 250, 250)';
        roles.forEach(function(role) {
            role.style.backgroundColor = 'rgb(250, 250, 250)';
        });
        names.forEach(function(name) {
            name.style.backgroundColor = 'rgb(250, 250, 250)';
        });
        button.textContent = 'Dark Mode';
    }
}

window.addEventListener('DOMContentLoaded', function() {
    var button = document.getElementById('mode-toggle');
    button.addEventListener('click', toggleMode);
});