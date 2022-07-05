import { html, LitElement } from "lit";
import { unsafeHTML } from "lit/directives/unsafe-html.js";
import * as feather from "feather-icons";
import { customElement } from "lit/decorators.js";

@customElement("profile-dropdown")
export default class ProfileDropdown extends LitElement {
    // To disable shadow dom
    createRenderRoot() {
        return this;
    }

    // https://dribbble.com/shots/6746892-DailyUI-027-Dropdown
    // https://dribbble.com/shots/16173355-UI-Menu-Components
    render() {
        return html`
            <div id="profile-dropdown-container">
                <div id="profile-header">
                    <h4 id="username">Hayden Bleasel</h4>
                    <a href="/collections" id="profile-link">View my profile</a>
                </div>
                <div class="profile-section">
                    <a href="#" class="section-link">${unsafeHTML(feather.icons["log-out"].toSvg({ class: "profile-icon" }))} <span>Log Out</span></a>
                </div>
                <div class="profile-section">
                    <a href="#" class="section-link">${unsafeHTML(feather.icons.hash.toSvg({ class: "profile-icon" }))} <span>Hashtags</span></a>
                    <a href="#" class="section-link">${unsafeHTML(feather.icons.star.toSvg({ class: "profile-icon" }))} <span>My Stars</span></a>
                    <a href="#" class="section-link">${unsafeHTML(feather.icons.bookmark.toSvg({ class: "profile-icon" }))} <span>Collections</span></a>
                    <a href="#" class="section-link">${unsafeHTML(feather.icons.zap.toSvg({ class: "profile-icon" }))} <span>Activity Log</span></a>
                </div>
                <div class="profile-section">
                    <a href="#" class="section-link">${unsafeHTML(feather.icons.settings.toSvg({ class: "profile-icon" }))} <span>Account Settings</span></a>
                    <a href="#" class="section-link">${unsafeHTML(feather.icons["help-circle"].toSvg({ class: "profile-icon" }))} <span>Help</span></a>
                    <a href="#" class="section-link">${unsafeHTML(feather.icons.file.toSvg({ class: "profile-icon" }))} <span>Legal</span></a>
                </div>
            </div>
        `;
    }
}
