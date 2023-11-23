import TasksView from '@/views/TasksView.vue';
import CreateTask from "@/components/Tasks/CreateTask.vue";
import UpdateTask from "@/components/Tasks/UpdateTask.vue";

export default [
    {
        path: '/tasks',
        name: 'tasks.index',
        component: () => TasksView
    },
    {
        path: '/tasks/create',
        name: 'tasks.create',
        component: () => CreateTask
    },
    {
        path: '/tasks/edit/:id',
        name: 'tasks.edit',
        component: () => UpdateTask
    },
]