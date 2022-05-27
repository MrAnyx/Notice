import { html, LitElement } from "lit";

export default class TrendingPeriodDropdown extends LitElement {
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
            <div id="trending-period-dropdown-container">
                <a href="#" class="period-link">Last 24h</a>
                <a href="#" class="period-link">This week</a>
                <a href="#" class="period-link">This month</a>
            </div>
        `;
    }
}
