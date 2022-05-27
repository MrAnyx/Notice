import { html, LitElement } from "lit";

export default class HashtagOptionDropdown extends LitElement {
    static properties = {};

    // To disable shadow dom
    createRenderRoot() {
        return this;
    }

    constructor() {
        super();
    }

    render() {
        return html`
            <div id="trending-option-dropdown-container">
                <a href="#" class="option-link">Hide this hashtag</a>
            </div>
        `;
    }
}
