<template>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle relative" role="button" id="dropdownNotificationMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 8a6 6 0 0 1 4.03-5.67 2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8zm8 10a2 2 0 1 1-4 0h4z"/></svg>

            <span class="absolute top-0 right-0 -mt-1 text-xs text-white px-2 bg-indigo-500 leading-loose rounded-full" v-if="notifications.length" v-text="notifications.length"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right border-none shadow-md rounded-lg  max-w-sm w-80" aria-labelledby="dropdownNotificationMenu">
            <div class="row" v-if="notifications.length">
                <div class="col-12">
                    <div class="list-group list-group-flush">
                        <div v-for="notification in notifications" class="list-group-item list-group-item-action border-0 py-3">
                            <p class="leading-normal text-gray-600 text-sm mb-2" v-text="notification.data.message"></p>

                            <a @click="markAsRead(notification)" :href="notification.data.link" class="text-xs">Check it out <span class="ml-1">&#8594;</span></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="p-4 text-sm text-gray-500">
                        No new notifications.
                    </div>
                </div>
            </div>
        </div>
    </li>

</template>

<script>
    export default {
        data() {
            return {
                notifications: false
            }
        },

        created() {
            axios.get('/user/@' + window.App.user.username + '/notifications')
                 .then(response => this.notifications = response.data);
        },

        methods: {
            markAsRead(notification) {
                axios.delete('/user/@' + window.App.user.username + '/notifications/' + notification.id)
            }
        }
    }
</script>
