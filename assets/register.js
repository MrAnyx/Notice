import { defineCustomElement } from "vue";

import HelloWorld from "./components/vue/HelloWorld.ce.vue";

import SimpleGreeting from "./components/lit/SimpleGreeting";
import NotificationDropdown from "./components/lit/NotificationDropdown";
import NotificationIcon from "./components/lit/NotificationIcon";

/* ------------------------------------------------------------------------- */
/*                              Vuejs components                             */
/* ------------------------------------------------------------------------- */
customElements.define("hello-world", defineCustomElement(HelloWorld));

/* ------------------------------------------------------------------------- */
/*                              Litjs components                             */
/* ------------------------------------------------------------------------- */
customElements.define("simple-greeting", SimpleGreeting);
customElements.define("notification-dropdown", NotificationDropdown);
customElements.define("notification-icon", NotificationIcon);
