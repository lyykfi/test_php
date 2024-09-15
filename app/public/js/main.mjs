import TasksWidget from './tasks.mjs';
import PopupWidget from './popup.mjs';
import debounce from './debounce.mjs';
import config from './config.mjs';

document.addEventListener("DOMContentLoaded", () => {
    const popup = new PopupWidget(document.getElementById('popup'));
    const tasks = new TasksWidget(document.getElementById('tasks'));

    tasks.render();

    document.body.addEventListener('row-click', (data) => {
        popup.render(data.detail);
    })

    const search = document.getElementById('search-input');
    search.addEventListener("keydown", debounce(() => {
        config.globalScope.page = 1;
        config.globalScope.search = search.value;

        tasks.render();
    }, 1000));

});

