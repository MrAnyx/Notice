import { html, LitElement } from "lit";
import { customElement, property, query, state } from "lit/decorators.js";
import { unsafeHTML } from "lit/directives/unsafe-html.js";
import * as feather from "feather-icons";
import { AlertType } from "@/types/types";

@customElement("custom-alert")
export default class CustomAlert extends LitElement {
    @property()
    message: string;

    @property()
    title: string | null = null;

    @property()
    type: AlertType;

    @property({ type: Boolean })
    dismiss: boolean = false;

    @query(".alert")
    alert: HTMLDivElement;

    @query(".alert-close")
    close: HTMLDivElement;

    firstUpdated() {
        if (this.dismiss) {
            this.close.addEventListener("click", () => {
                this.alert.classList.add("fade");
                setTimeout(() => {
                    this.remove();
                }, 300);
            });
        }
    }

    // To disable shadow dom
    createRenderRoot() {
        return this;
    }

    render() {
        return html`
            <div class="alert alert-${this.type} ${this.dismiss ? "dismissible " : ""}">
                <div class="alert-indicator"></div>
                <div class="alert-container">
                    ${this.title !== null ? unsafeHTML(`<h6 class="alert-title">${this.title}</h6>`) : ""}
                    <div class="alert-message">${this.message}</div>

                    <div class="alert-close">${this.dismiss ? unsafeHTML(feather.icons.x.toSvg({ class: "close-icon" })) : ""}</div>
                </div>
            </div>
        `;
    }
}
