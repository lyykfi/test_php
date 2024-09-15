import Widget from './widget.mjs';
import config from './config.mjs';

class TasksWidget extends Widget {
    async #fetch () {
        const params = new URLSearchParams({ 
            page: config.globalScope.page, 
            size: config.TASKS_PAGE_SIZE,
            title: config.globalScope.search ?? ''
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
        let pagination = '';

        const totalRow = tasks.total_row;
        const paginationWindow = 5;
        const pages = Math.ceil(totalRow / config.TASKS_PAGE_SIZE);
        
        if (config.globalScope.page !== 1 && pages > 1) {
            pagination += `<span class="first" data-page="1">&lt;&lt;</span>`
        }

        const part = Math.floor(paginationWindow / 2);
        let startPage = config.globalScope.page - part;
       
        if (startPage < 1) {
            startPage = 1;
        }

        for(let i = startPage; i <= startPage + paginationWindow; i++) {
            if (i <= pages) {
                pagination += `<span ${i === config.globalScope.page ? `class="current"` : ''} data-page="${i}">${i}</span>`
            }
        }

        if (pages > config.globalScope.page) {
            pagination += `<span class="last" data-page="${pages}">&gt;&gt;</span>`
        }
    

        tasks.tasks.forEach((item) => {
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
            <tfoot>
                <tr>
                    <td colspan="3">
                        <div class="pagination">${pagination}</div>
                    </td>
                </tr>
            </tfoot>
        </table>`;
        const html = parser.parseFromString(domString, 'text/html');

        this.root.replaceChildren(html.body.firstChild);

        const rowsBinded = this.root.querySelectorAll('tbody tr');
        rowsBinded.forEach((item) => {
            item.addEventListener('click', (data) => {
                const customEvent = new CustomEvent('row-click', { detail: item.dataset.id });

                document.body.dispatchEvent(customEvent);
            })
        });

        const paginations = this.root.querySelectorAll('.pagination span');
        paginations.forEach((item) => {
            item.addEventListener('click', () => {
                config.globalScope.page = parseInt(item.dataset.page, 10);

                this.render();
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