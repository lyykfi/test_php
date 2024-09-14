import TasksWidget from './tasks.mjs';
import PopupWidget from './popup.mjs';
import debounce from './debounce.mjs';

document.addEventListener("DOMContentLoaded", () => {
    const popup = new PopupWidget(document.getElementById('popup'));
    const tasks = new TasksWidget(document.getElementById('tasks'));

    tasks.render('');

    document.body.addEventListener('row-click', (data) => {
        popup.render(data.detail);
    })

    const search = document.getElementById('search-input');
    search.addEventListener("keydown", debounce((event) => {
        tasks.render(search.value);
    }, 1000));

});

