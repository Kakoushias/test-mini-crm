import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from "vue";
import App from "../components/Clients.vue";

window.Alpine = Alpine;

Alpine.start();

createApp(App).mount("#app");

require("./bootstrap");
