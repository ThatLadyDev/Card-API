
import http from "k6/http";

export const options = {
    iterations: 15,
};

export default function () {
    const response = http.get("https://codevixens.org");
}
