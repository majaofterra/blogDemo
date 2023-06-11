<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
</script>
<script>
    export default {
        data(){
            return{
                posts: this.blogs,
            }
        },
        props:{
            blogs: Object,
        },
        methods: {
            destroy : function(hash){
                axios.delete(route('blog.destroy',hash)).then((response)=>{this.posts = response.data});
            }
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
                    <div v-for="post in posts" class="p-2">
                        <button @click="destroy(post.hash)" class="m-1 bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-1 px-2 border border-red-500 hover:border-transparent rounded" >
                            delte
                        </button>
                         <a :href="route('blog.edit',post.hash)" class="m-1 bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded" >
                            edit
                        </a>
                        <strong class="p-2 capitalize">{{post.title}}</strong>
                        <p class="p-4"> {{post.body}} </p>
                        <div v-for="item in post.comments" class="text-gray-700">
                            <strong> {{item.user.name}} -> </strong>
                            <small> {{item.comment}} </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
