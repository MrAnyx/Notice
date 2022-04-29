import { defineCustomElement } from "vue";

import HelloWorld from "./components/vue/HelloWorld.ce.vue";
import SimpleGreeting from "./components/lit/SimpleGreeting";

/* ------------------------------------------------------------------------- */
/*                              Vuejs components                             */
/* ------------------------------------------------------------------------- */
customElements.define("hello-world", defineCustomElement(HelloWorld));

/* ------------------------------------------------------------------------- */
/*                              Litjs components                             */
/* ------------------------------------------------------------------------- */
customElements.define("simple-greeting", SimpleGreeting);
