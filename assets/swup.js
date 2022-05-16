import Swup from "swup";
import "./styles/vendor/_swup.scss";

const swup = new Swup(); // only this line when included with script tag

swup.on("contentReplaced", () => {
    console.log("again");
});
