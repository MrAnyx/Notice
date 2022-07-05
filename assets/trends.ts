import "@/styles/layout/trends.scss";
import "@/styles/components/TrendingPeriodDropdown.scss";
import "@/styles/components/HashtagOptionDropdown.scss";

import "tippy.js/dist/tippy.css";
import "@/styles/vendor/_tippy.scss";
import "tippy.js/animations/shift-away.css";

import tippy from "tippy.js";

tippy(document.querySelector("#trends-period"), {
    content: "<trending-period-dropdown></trending-period-dropdown>",
    allowHTML: true,
    trigger: "click",
    placement: "bottom",
    theme: "custom",
    arrow: false,
    animation: "shift-away",
    interactive: true,
});

tippy(document.querySelectorAll("#trends-hashtags .more"), {
    content: "<hashtag-option-dropdown></hashtag-option-dropdown>",
    allowHTML: true,
    trigger: "click",
    placement: "bottom",
    theme: "custom",
    arrow: false,
    animation: "shift-away",
    interactive: true,
    offset: [-45, -3],
});
