import axios from "axios";

import "@/styles/pages/verification.scss";

const resendLink = document.querySelector("#resend-link a");
resendLink.addEventListener("click", (e: MouseEvent) => {
    axios.get("/api/verify/pending/send");
    // TODO Terminer ici en évitant de pouvoir spam
    // TODO corriger problème après validation email (redirection vers login)
});
