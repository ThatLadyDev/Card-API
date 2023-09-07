
import http from "k6/http";

export const options = {
    iterations: 100,
    // duration: 1000
};

export default function () {
    const response = http.get("https://project-knot.loisbassey.com");
}
