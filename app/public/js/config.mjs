const API_PATH = '/api/v1/';
const TASK_API_PATH = `${API_PATH}task`;

const TASKS_PAGE_SIZE = 10;

const globalScope = {
    page: 1,
    cachedTasks: new Map(),
}

export default {
    API_PATH,
    TASK_API_PATH,
    TASKS_PAGE_SIZE,
    globalScope
}