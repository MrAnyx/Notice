import { defineCustomElement } from "vue";

import { HelloWorld } from "@notice/ui";

import './styles/app.css';

customElements.define("hello-world", defineCustomElement(HelloWorld));
