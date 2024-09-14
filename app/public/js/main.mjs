import TasksWidget from './tasks.mjs';
import PopupWidget from './popup.mjs';

document.addEventListener("DOMContentLoaded", () => {
    const popup = new PopupWidget(document.getElementById('popup'));
    const tasks = new TasksWidget(document.getElementById('tasks'));

    tasks.render();

    document.body.addEventListener('row-click', (data) => {
        popup.render(data.detail);
    })
});

