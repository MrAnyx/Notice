import { defineCustomElement } from "vue";

import HelloWorld from "./components/vue/HelloWorld.ce.vue";

import NotificationDropdown from "./components/lit/NotificationDropdown";
import NotificationIcon from "./components/lit/NotificationIcon";
import ProfileDropdown from "./components/lit/ProfileDropdown";
import TrendingPeriodDropdown from "./components/lit/TrendingPeriodDropdown";
import HashtagOptionDropdown from "./components/lit/HashtagOptionDropdown";

/* ------------------------------------------------------------------------- */
/*                              Vuejs components                             */
/* ------------------------------------------------------------------------- */
customElements.define("hello-world", defineCustomElement(HelloWorld));

/* ------------------------------------------------------------------------- */
/*                              Litjs components                             */
/* ------------------------------------------------------------------------- */
customElements.define("notification-dropdown", NotificationDropdown);
customElements.define("notification-icon", NotificationIcon);
customElements.define("profile-dropdown", ProfileDropdown);
customElements.define("trending-period-dropdown", TrendingPeriodDropdown);
customElements.define("hashtag-option-dropdown", HashtagOptionDropdown);
