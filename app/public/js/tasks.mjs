import Widget from './widget.mjs';
import config from './config.mjs';

class TasksWidget extends Widget {
    async #fetch () {
        const params = new URLSearchParams({ 
            page: config.globalScope.page, 
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
        let rows = '';

        tasks.forEach((item) => {
            rows += `<tr data-id="${item.id}" class="tags-row">
            <td>${item.id}</td>
            <td>${item.title}</td>
            <td>${item.data}</td>
            </tr>`
        });

        const parser = new DOMParser();
        const domString = `
        <table>
            <thead>
                <tr>
                    <td>Номер задачи</td>
                    <td>Заголовок</td>
                    <td>Дата выполнения</td>
                </tr>
            </thead>
            <tbody>
                ${rows}
            </tbody>
        </table>`;
        const html = parser.parseFromString(domString, 'text/html');

        this.root.replaceChildren(html.body.firstChild);

        const rowsBinded = this.root.querySelectorAll('tbody tr');
        rowsBinded.forEach((item) => {
            console.log(item);

            item.addEventListener('click', (data) => {
                const customEvent = new CustomEvent('row-click', { detail: item.dataset.id });

                document.body.dispatchEvent(customEvent);
            })
        });
    }

    async render() {
        this.#loadingScene();
        const tasks = await this.#fetch();
        
        this.#tableScene(tasks);
    }
}

export default TasksWidget