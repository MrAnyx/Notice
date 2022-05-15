import { css, html, LitElement } from "lit";

export default class NotificationDropdown extends LitElement {
    static properties = {
        notifs: {},
    };

    constructor() {
        super();
        this.notifs = ["notif 1", "notif 2", "notif 3"];
    }

    static styles = css`
        #notification-dropdown {
            width: 350px;
        }

        #notification-dropdown-title {
            padding: 10px 18px;
            border-bottom: 2px solid var(--light-medium);
            color: var(--dark);
            font-weight: 500;
            font-size: 16px;
        }

        #notification-dropdown-content {
            color: black;
        }
    `;

    // eslint-disable-next-line class-methods-use-this
    render() {
        return html`
            <div id="notification-dropdown">
                <div id="notification-dropdown-title">Notifications</div>
                <div id="notification-dropdown-content">${this.notifs.map((notif) => html` <div>${notif}</div> `)}</div>
            </div>
        `;
    }
}
