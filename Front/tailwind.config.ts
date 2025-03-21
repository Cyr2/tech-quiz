import type { Config } from 'tailwindcss'

export default {
  content: [
    './components/**/*.{js,vue,ts}',
    './layouts/**/*.vue',
    './pages/**/*.vue',
    './plugins/**/*.{js,ts}',
    './app.vue',
  ],
  theme: {
    extend: {
      colors: {
        "highlight-darkest": "var(--highlight-darkest)",
        "highlight-dark": "var(--highlight-dark)",
        "highlight-medium": "var(--highlight-medium)",
        "highlight-light": "var(--highlight-light)",
        "highlight-lightest": "var(--highlight-lightest)",
        "neutral-light-darkest": "var(--neutral-light-darkest)",
        "neutral-light-dark": "var(--neutral-light-dark)",
        "neutral-light-medium": "var(--neutral-light-medium)",
        "neutral-light-light": "var(--neutral-light-light)",
        "neutral-light-lightest": "var(--neutral-light-lightest)",
        "neutral-dark-darkest": "var(--neutral-dark-darkest)",
        "neutral-dark-dark": "var(--neutral-dark-dark)",
        "neutral-dark-medium": "var(--neutral-dark-medium)",
        "neutral-dark-light": "var(--neutral-dark-light)",
        "neutral-dark-lightest": "var(--neutral-dark-lightest)",
        "support-success-dark": "var(--support-success-dark)",
        "support-success-medium": "var(--support-success-medium)",
        "support-success-light": "var(--support-success-light)",
        "support-warning-dark": "var(--support-warning-dark)",
        "support-warning-medium": "var(--support-warning-medium)",
        "support-warning-light": "var(--support-warning-light)",
        "support-error-dark": "var(--support-error-dark)",
        "support-error-medium": "var(--support-error-medium)",
        "support-error-light": "var(--support-error-light)",
        "bg-primary": "var(--bg-primary)",
        "bg-secondary": "var(--bg-secondary)",
        "text-primary": "var(--text-primary)",
        "text-secondary": "var(--text-secondary)"
      },
    },
  },
  plugins: [],
} satisfies Config 