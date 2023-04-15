<template>
    <header-component />
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                    Eventos
                </h2>
            </div>
            <div class="max-w-md" v-for="event in events" :key="events.id">
                <div class="bg-white shadow-md p-6">
                    <h2 class="text-xl font-bold mb-2">{{ event.title }}</h2>
                    <hr>
                    <span class="mb-4">{{ event.description }}</span>
                    <br>
                    <span class="mb-4">{{ event.location }}</span>
                    <br>
                    <span class="mb-4">{{ event.date }}</span>
                    <br>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Book here</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import HeaderComponent from '../components/Header.vue';
    import { apiCall } from '../api';

    export default {
        mounted() {
            let comp = this;
            let data = comp.$data;

            apiCall('GET', '/events').then(function (response){
                if(response.status === 200){
                    data.events = response.data;
                }
            });
        },
        data () {
            return {
                events: null,
                message: null
            }
        },
        components: {
            HeaderComponent
        }
    }
</script>
