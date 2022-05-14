import Swup from "swup";
import "./styles/swup.scss";

setInterval(() => {
    console.log("once");
}, 1000);

const swup = new Swup(); // only this line when included with script tag

swup.on("contentReplaced", () => {
    console.log("again");
});
