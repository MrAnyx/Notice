import { html, LitElement } from "lit";
import { customElement } from "lit/decorators.js";

@customElement("hashtag-option-dropdown")
export default class HashtagOptionDropdown extends LitElement {

    // To disable shadow dom
    createRenderRoot() {
        return this;
    }

    render() {
        return html`
            <div id="trending-option-dropdown-container">
                <a href="#" class="option-link">Hide this hashtag</a>
            </div>
        `;
    }
}
