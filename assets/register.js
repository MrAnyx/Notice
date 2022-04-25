import { defineCustomElement } from "vue";

import { HelloWorld } from "@notice/ui-vue";
import { SimpleGreeting } from "@notice/ui-lit";

/* ------------------------------------------------------------------------- */
/*                              Vuejs components                             */
/* ------------------------------------------------------------------------- */
customElements.define("hello-world", defineCustomElement(HelloWorld));

/* ------------------------------------------------------------------------- */
/*                              Litjs components                             */
/* ------------------------------------------------------------------------- */
customElements.define("simple-greeting", SimpleGreeting);
