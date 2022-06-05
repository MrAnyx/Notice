import { html, LitElement } from "lit";
import { customElement } from "lit/decorators.js";

@customElement("trending-period-dropdown")
export default class TrendingPeriodDropdown extends LitElement {

    // To disable shadow dom
    createRenderRoot() {
        return this;
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
