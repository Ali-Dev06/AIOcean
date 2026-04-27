const API_BASE = "/api"


function buildUrl(path: string): string {
  if (path.startsWith("http://") || path.startsWith("https://")) {
    return path
  }

  return `${API_BASE}${path.startsWith("/") ? path : `/${path}`}`
}

export async function get<T>(path: string): Promise<T> {
  const res = await fetch(buildUrl(path))

  if (!res.ok) {
    const body = await res.json().catch(() => null)
    const message =
      (body as { error?: string } | null)?.error ??
      `Request failed with status ${res.status}`

    throw new Error(message)
  }

  return (await res.json()) as T
}
