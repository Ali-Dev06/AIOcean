# Homepage Design — AI Tools Discovery Platform

## 1. Overview

A calm, browsable landing page where users can explore AI tools at their own pace. The page features a hero section with a search/CTA input, followed by a scrollable grid of tool cards with inline collapsible filters.

## 2. Visual Style

**Minimal & Calm** — Clean white space, modern library aesthetic.

- **Color palette:** Neutral grays, subtle borders, dark text for readability
- **Typography:** Inter (already installed), clear hierarchy
- **Spacing:** Generous padding, breathing room between elements
- **No promotional visuals:** Plain tool logos only

## 3. Layout Structure

```
┌─────────────────────────────────────────────┐
│              HEADER (nav bar)               │
├─────────────────────────────────────────────┤
│                                             │
│        HERO SECTION                         │
│   ┌─────────────────────────────────────┐   │
│   │  "What do you need help with?"     │   │
│   │  [ Search input with icon ]        │   │
│   └─────────────────────────────────────┘   │
│                                             │
│        FILTER BAR (collapsible)             │
│   Category | Pricing | Platform  [+More]   │
│                                             │
├─────────────────────────────────────────────┤
│                                             │
│        TOOL GRID (scrollable)               │
│   ┌────────┐ ┌────────┐ ┌────────┐         │
│   │ Card 1 │ │ Card 2 │ │ Card 3 │         │
│   └────────┘ └────────┘ └────────┘         │
│   ┌────────┐ ┌────────┐ ┌────────┐         │
│   │ Card 4 │ │ Card 5 │ │ Card 6 │         │
│   └────────┘ └────────┘ └────────┘         │
│                                             │
└─────────────────────────────────────────────┘
```

## 4. Component Breakdown

### 4.1 Header

- Logo/App name on left
- Navigation: Browse, Submit Tool, Sign In (text links)
- Minimal, no hero image

### 4.2 Hero Section

- Centered text: "What do you need help with?"
- Large input field with search icon and placeholder text
- Subtle helper text below: "Browse thousands of AI tools curated by the community"
- Input is functional — filters tools as user types

### 4.3 Filter Bar

- Horizontal row of filter chips/buttons
- **Default collapsed state:** Show 3 key filters (Category, Pricing, Platform)
- **Expand button:** "+ More filters" reveals additional options
- **Filter options:**
  - Category: Writing, Image Generation, Productivity, Coding, Research, Audio
  - Pricing: Free, Freemium, Paid
  - Platform: Web, Mobile, API, Browser Extension
- Active filters shown as selected chips with X to remove

### 4.4 Tool Card

Each card displays:

- **Tool logo** (square, 48x48, rounded)
- **Tool name** (bold, dark text)
- **Tagline** (1 line, muted gray)
- **Category tag** (pill badge)
- **Pricing badge** (Free/Freemium/Paid)
- **Usage signal:** "Used by X people"
- **Community rating:** Star display (e.g., "4.2 ★")
- **Primary use case:** e.g., "Writing emails"

Card is clickable → navigates to tool detail page (future)

### 4.5 Tool Grid

- Responsive grid: 1 col mobile, 2 col tablet, 3 col desktop
- 24px gap between cards
- Infinite scroll or "Load more" button (start with simple)

## 5. Data Structure (Mock)

```typescript
interface Tool {
  id: string
  name: string
  logo: string // emoji or placeholder
  tagline: string
  category:
    | "Writing"
    | "Image Generation"
    | "Productivity"
    | "Coding"
    | "Research"
    | "Audio"
  pricing: "Free" | "Freemium" | "Paid"
  platform: "Web" | "Mobile" | "API" | "Browser Extension"
  usageCount: number
  rating: number
  primaryUseCase: string
}
```

## 6. Interactions

- **Search input:** Filters grid in real-time (client-side for v1)
- **Filter chips:** Toggle active state, update grid
- **Expand filters:** Reveals more filter options smoothly
- **Card hover:** Subtle lift/shadow effect
- **Card click:** Placeholder alert (detail page out of scope)

## 7. Out of Scope

- Tool detail page
- User accounts / auth
- Submit tool flow
- Server-side search/filtering

## 8. Acceptance Criteria

- [ ] Hero section displays with search input
- [ ] Filter bar shows 3 filters, expandable to more
- [ ] At least 8 mock tool cards render in responsive grid
- [ ] Cards show: logo, name, tagline, category, pricing, usage, rating
- [ ] Search input filters visible tools by name/tagline
- [ ] Filter buttons toggle and update displayed tools
- [ ] Clean, minimal visual style — no clutter
- [ ] Responsive: works on mobile/tablet/desktop

## 9. Dependencies

- shadcn components: Input, Button, Card, Badge, Separator
- Lucide icons: Search, Filter, ChevronDown, X, Star
- No additional packages needed
