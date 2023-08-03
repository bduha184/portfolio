import type { UseFetchOptions } from "nuxt/app";

export function useApiFetch<T>(path: string, options: UseFetchOptions<T> = {}) {
  let headers: any = {};
  const config = useRuntimeConfig();
  const token = useCookie("XSRF-TOKEN");

  if (token.value) {
    headers["X-XSRF-TOKEN"] = token.value as string;
  }

  return useFetch(config.public.baseURL + path, {
    credential: "include",
    watch: false,
    ...options,
    headers: {
      ...headers,
      ...options?.headers,
    },
  });
}
