import { html, LitElement } from "lit";
import { customElement, property, queryAll, state } from "lit/decorators.js";
import { unsafeHTML } from "lit/directives/unsafe-html.js";
import * as feather from "feather-icons";
import { InputType } from "@/types/types";

@customElement("form-input")
export default class FormInput extends LitElement {
    @property()
    type: InputType;

    @property()
    value: string;

    @property()
    placeholder: string;

    @property()
    icon: string;

    @property()
    name: string;

    @property()
    help: string;

    @state()
    reveal: boolean = false;

    @state()
    currentType: string;

    @queryAll(".password-reveal-icon")
    passwordReveal: SVGElement[];

    connectedCallback() {
        super.connectedCallback();
        this.currentType = this.type;
    }

    // To disable shadow dom
    createRenderRoot(): this {
        return this;
    }

    toggleRevealPassword() {
        this.reveal = !this.reveal;
        this.currentType = this.reveal ? "text" : "password";
    }

    renderPasswordRevealToggler() {
        return html`
            <div @click="${this.toggleRevealPassword}">
                ${unsafeHTML(
                    feather.icons.eye.toSvg({
                        class: "input-icon password-reveal-icon",
                        style: this.reveal ? "display: none" : "",
                    })
                )}
                ${unsafeHTML(
                    feather.icons["eye-off"].toSvg({
                        class: "input-icon password-reveal-icon",
                        style: !this.reveal ? "display: none" : "",
                    })
                )}
            </div>
        `;
    }

    render() {
        return html`
            <div class="custom-input">
                ${unsafeHTML(feather.icons[this.icon].toSvg({ class: "input-icon prefix-icon" }))}
                <input
                    type="${this.currentType}"
                    data-input-type="${this.type}"
                    name="${this.name}"
                    value="${this.value}"
                    placeholder="${this.placeholder}"
                    required
                />
                ${this.type === "password" ? this.renderPasswordRevealToggler() : ""}
            </div>
            <div class="input-help-message">${this.help}</div>
        `;
    }
}
