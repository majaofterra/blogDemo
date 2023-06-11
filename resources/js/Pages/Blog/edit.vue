<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, useForm  } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
</script>
<script>
    export default {
        data(){
            return{
                form: useForm({
                    title: this.blog.title,
                    body: this.blog.body,
                }),
                post: this.blog,
            }
        },
        props:{
            blog: Object,
        },
        methods: {
            submit : function(hash){
                this.form.post(route('blog.update',hash), {
                    onFinish: (response) => {},
                });
            },
        },
    }
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 <form class="space-y-6 p-3" @submit.prevent="submit(post.hash)">
                    <div>
                        <input v-model="form.title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="title" required>
                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>
                    <div>
                        <textarea v-model="form.body"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required placeholder="body"> </textarea>
                        <InputError class="mt-2" :message="form.errors.body" />
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save it</button>
                </form>
                <div class="text-center">
                    <small>
                        created : {{post.created_at}} ~ updated : {{post.updated_at}}
                    </small>
                </div>

            </div>
        </div>
    </div>
</AuthenticatedLayout>
</template>
