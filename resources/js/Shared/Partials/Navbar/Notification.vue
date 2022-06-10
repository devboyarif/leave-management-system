<template>
    <li class="nav-item dropdown show">
        <a v-tooltip="'Notification'" class="nav-link" href="#" @click="showNotification = !showNotification">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div v-show="showNotification" class="dropdown-menu dropdown-menu-lg dropdown-menu-right show" style="left: inherit; right: 0px;">
            <a href="#" class="dropdown-item">

                <div class="media">
                    <img src="https://adminlte.io/themes/v3/dist/img/user1-128x128.jpg" alt="User Avatar"
                        class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">Brad Diesel</h3>
                        <p class="text-sm">Call me whenever you can...</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>

            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">

                <div class="media">
                    <img src="https://adminlte.io/themes/v3/dist/img/user1-128x128.jpg" alt="User Avatar"
                        class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">John Pierce</h3>
                        <p class="text-sm">I got your message bro</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>

            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">

                <div class="media">
                    <img src="https://adminlte.io/themes/v3/dist/img/user1-128x128.jpg" alt="User Avatar"
                        class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">Nora Silvester</h3>
                        <p class="text-sm">The subject goes here</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>

            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
    </li>
</template>

<script>
export default {
    data() {
        return {
            showNotification: false,
        };
    },
};
</script>
