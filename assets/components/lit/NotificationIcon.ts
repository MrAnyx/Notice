import { html, LitElement } from "lit";
import { unsafeHTML } from "lit/directives/unsafe-html.js";
import * as feather from "feather-icons";
import { customElement, property } from "lit/decorators.js";

@customElement("notification-icon")
export default class NotificationIcon extends LitElement {
    static properties = {
        active: { type: Boolean },
        hasNewNotification: { type: Boolean },
        notificationFetchCallInterval: { type: Object },
    };

    // To disable shadow dom
    createRenderRoot() {
        return this;
    }

    @property()
    active: boolean = false;

    @property()
    hasNewNotification: boolean = false;

    @property()
    notificationFetchCallInterval?: NodeJS.Timer = null;

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

    enableNotificationCheck() {
        this.active = true;
    }

    disableNotificationCheck() {
        this.active = false;
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
