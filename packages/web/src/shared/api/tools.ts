import type { Tool } from "@/components/ToolCard"

import { get } from "./client"

export interface ToolsResponse {
  tools: Tool[]
  total: number
  categories: string[]
}

export interface GetToolsParams {
  search?: string
  category?: string | null
}

export async function getTools(params: GetToolsParams = {}): Promise<ToolsResponse> {
  const query = new URLSearchParams()

  if (params.search) {
    query.set("search", params.search)
  }

  if (params.category) {
    query.set("category", params.category)
  }

  const qs = query.toString()
  return get<ToolsResponse>(`/tools${qs ? `?${qs}` : ""}`)
}
