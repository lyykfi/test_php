import Widget from './widget.mjs';
import config from './config.mjs';

class PopupWidget extends Widget {
    async #fetch (id) {
        const res = await fetch(`${config.TASK_API_PATH}/${id}`);
        return await res.json();
    }

    #tableScene(task) {
        const parser = new DOMParser();
        const domString = `
        <div class="wrapper">
            <section>
                <h2>Информация о задаче №${task.id}</h2>
                <ul class="content">
                    <li><strong>Заголовок</strong>${task.title}</li>
                    <li><strong>Дата выполнения</strong>${task.data}</li>
                    <li><strong>Автор</strong>${task.author}</li>
                    <li><strong>Статус</strong>${task.status}</li>
                    <li><strong>Описание</strong>${task.description}</li>
                </ul>
                <div class="tools">
                    <button type="button">Закрыть</button>
                </div>
            </section>
        </div>
        `;
        const html = parser.parseFromString(domString, 'text/html');

        this.root.replaceChildren(html.body.firstChild);
    }

    async render(id) {
        const task = await this.#fetch(id);
        
        this.#tableScene(task);
    }
}

export default PopupWidget