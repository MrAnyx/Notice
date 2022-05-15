/* eslint-disable import/extensions */
import { css, html, LitElement } from "lit";
import { unsafeHTML } from "lit/directives/unsafe-html.js";
import * as feather from "feather-icons";

export default class NotificationIcon extends LitElement {
    static styles = css`
        #notification-icon-svg {
            width: 20px;
            height: 20px;
            color: var(--light-dark);
        }
    `;

    constructor() {
        super();
        this.attachShadow({ mode: "open" });
    }

    // eslint-disable-next-line class-methods-use-this
    render() {
        return html`${unsafeHTML(feather.icons.bell.toSvg({ id: "notification-icon-svg" }))}`;
    }
}
