export default defineNuxtConfig({
  runtimeConfig: {
    public: {
        api: {
            baseUrl: "http://localhost:8000",
            cookieRequestUrl: "/sanctum/csrf-cookie",
            userUrl: "/api/user",
            userKey: "user",
            csrfCookieName: "XSRF-TOKEN",
            csrfHeaderName: "X-XSRF-TOKEN",
            serverCookieName: "set-cookie",
            redirectUnauthenticated: true,
            redirectUnverified: true,
        },
    },
},
});
