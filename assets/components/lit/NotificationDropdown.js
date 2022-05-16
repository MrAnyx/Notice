import { css, html, LitElement } from "lit";

export default class NotificationDropdown extends LitElement {
    static properties = {
        notifs: {},
    };

    constructor() {
        super();
        this.notifs = [
            {
                image: "https://images.unsplash.com/photo-1511367461989-f85a21fda167?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1631&q=80",
                username: "Cody Edward",
                content: "commented on your latest story you posted",
            },
            {
                image: "https://images.unsplash.com/photo-1457449940276-e8deed18bfff?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                username: "Jean Reeves",
                content: "loved your latest photo you posted",
            },
            {
                image: "https://images.unsplash.com/photo-1594751439417-df8aab2a0c11?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                username: "Tyler loved",
                content: "your latest story you posted",
            },
            {
                image: "https://images.unsplash.com/photo-1609010697446-11f2155278f0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80",
                username: "Cody Edward",
                content: "commented on your latest story",
            },
            {
                image: "https://images.unsplash.com/photo-1620117654333-c125fef82817?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
                username: "Jean Reeves",
                content: "loved your latest photo you posted",
            },
            {
                image: "https://images.unsplash.com/photo-1620117654333-c125fef82817?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80",
                username: "Jean Reeves",
                content: "loved your latest photo you posted",
            },
        ];
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
            max-height: 310px;
            overflow-y: auto;
        }

        .notification-item-container:not(.notification-last) {
            border-bottom: 2px solid var(--light-soft);
        }

        .notification-item {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            column-gap: 12px;
            padding: 10px 18px;
        }

        .notification-photo {
            width: 40px;
            height: 40px;
            overflow: hidden;
            border-radius: 50%;
        }

        .notification-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .notification-content {
            flex: 1;
        }
    `;

    // eslint-disable-next-line class-methods-use-this
    render() {
        return html`
            <div id="notification-dropdown">
                <div id="notification-dropdown-title">Notifications</div>
                <div id="notification-dropdown-content">
                    ${this.notifs.map(
                        (notif, i, notifs) => html`
                            <div class="notification-item-container ${notifs.length - 1 === i ? "notification-last" : ""}">
                                <div class="notification-item">
                                    <div class="notification-photo">
                                        <img src="${notif.image}" />
                                    </div>
                                    <div class="notification-content"><b>${notif.username}</b> ${notif.content}</div>
                                </div>
                            </div>
                        `
                    )}
                </div>
            </div>
        `;
    }
}
