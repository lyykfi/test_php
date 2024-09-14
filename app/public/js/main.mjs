import config from './config.mjs';

const globalScope = {
    page: 1,
}

class Widget {
    #root = null;

    constructor(root) {
        this.root = root;
    }
}

class TasksWidget extends Widget {
    async #fetch () {
        const params = new URLSearchParams({ 
            page: globalScope.page, 
            size: config.TASKS_PAGE_SIZE 
        });

        const res = await fetch(`${config.TASK_API_PATH}?${params.toString()}`);
        return await res.json();
    }

    #loadingScene() {
        const loadingDiv = document.createElement('div');
        loadingDiv.textContent = 'Загрузка'
        loadingDiv.classList.add('loading');

        this.root.replaceChildren(loadingDiv);
    }

    #tableScene(tasks) {
        const table = document.createElement('table');
        const tbody = document.createElement('tbody');
        const thead = document.createElement('thead');
        
        const headTr = document.createElement('tr');

        const td1 = document.createElement('td');
        td1.textContent = 'Номер задачи';

        const td2 = document.createElement('td');
        td2.textContent = 'Заголовок';

        const td3 = document.createElement('td');
        td3.textContent = 'Дата выполнения';

        thead.appendChild(headTr);

        headTr.appendChild(td1);
        headTr.appendChild(td2);
        headTr.appendChild(td3);

        table.appendChild(thead);

        tasks.forEach((item) => {
            const row = document.createElement('tr');

            const td1 = document.createElement('td');
            td1.textContent = item.id;

            const td2 = document.createElement('td');
            td2.textContent = item.title;

            const td3 = document.createElement('td');
            td3.textContent = item.data;

            row.appendChild(td1);
            row.appendChild(td2);
            row.appendChild(td3);

            tbody.appendChild(row); 
        });


        table.appendChild(tbody);

        this.root.replaceChildren(table);
    }

    async render() {
        this.#loadingScene();
        const tasks = await this.#fetch();
        
        this.#tableScene(tasks);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const tasks = new TasksWidget(document.getElementById('tasks'));
    tasks.render();
});

