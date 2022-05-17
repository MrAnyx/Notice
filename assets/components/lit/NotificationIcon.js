/* eslint-disable import/extensions */
import { css, html, LitElement } from "lit";
import { unsafeHTML } from "lit/directives/unsafe-html.js";
import * as feather from "feather-icons";

export default class NotificationIcon extends LitElement {
    static properties = {
        active: { type: Boolean },
        hasNewNotification: { type: Boolean },
        notificationFetchCallInterval: { type: Object },
    };

    static styles = css`
        #notification-icon-container {
            position: relative;
        }

        #notification-icon-svg {
            width: 20px;
            height: 20px;
            color: var(--light-dark);
            transition: color 0.2s ease-in-out;
        }

        #notification-icon-svg:hover {
            color: var(--dark-soft);
        }

        #notification-icon-svg.active {
            fill: var(--dark-soft);
            color: var(--dark-soft);
        }

        #notification-counter {
            background-color: var(--success);
            width: 10px;
            height: 10px;
            border-radius: 50px;
            position: absolute;
            top: -5px;
            right: -2px;
            border: 2px solid var(--light);
        }
    `;

    constructor() {
        super();
        this.attachShadow({ mode: "open" });
        this.active = false;
        this.hasNewNotification = true;
    }

    /**
     * Is executed once the component in fully loaded
     */
    connectedCallback() {
        super.connectedCallback();
        this.retrieveNotificationCounter();
        this.notificationFetchCallInterval = setInterval(() => {
            this.retrieveNotificationCounter();
        }, 1000);
    }

    /**
     * Is executed once the component in fully unloaded
     */
    disconnectedCallback() {
        super.disconnectedCallback();
        clearInterval(this.notificationFetchCallInterval);
    }

    /**
     * Is used to retrieve the notification state.
     * It uses the fetch API to make a call to the API to chck if the user has new notification
     */
    retrieveNotificationCounter() {
        // Use the fetch API to retrieve new notification
        if (!this.active) {
            console.log("Get notif");
        }
    }

    /**
     * Update the icon state when a click is detected
     */
    click() {
        this.active = !this.active;
        this.hasNewNotification = false;
    }

    render() {
        return html`<div id="notification-icon-container" @click="${this.click}">
            ${this.hasNewNotification ? html`<div id="notification-counter"></div>` : ""}
            ${unsafeHTML(feather.icons.bell.toSvg({ id: "notification-icon-svg", class: this.active ? "active" : "" }))}
        </div>`;
    }
}
