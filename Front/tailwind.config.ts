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
        "highlight-darkest": "rgba(203, 148, 3, 1)",
        "highlight-dark": "rgba(235, 190, 7, 1)",
        "highlight-medium": "rgba(251, 217, 29, 1)",
        "highlight-light": "rgba(254, 233, 70, 1)",
        "highlight-lightest": "rgba(254, 246, 138, 1)",
        "neutral-light-darkest": "rgba(197, 198, 204, 1)",
        "neutral-light-dark": "rgba(212, 214, 221, 1)",
        "neutral-light-medium": "rgba(232, 233, 241, 1)",
        "neutral-light-light": "rgba(248, 249, 254, 1)",
        "neutral-light-lightest": "rgba(255, 255, 255, 1)",
        "neutral-dark-darkest": "rgba(31, 32, 36, 1)",
        "neutral-dark-dark": "rgba(47, 48, 54, 1)",
        "neutral-dark-medium": "rgba(73, 74, 80, 1)",
        "neutral-dark-light": "rgba(113, 114, 122, 1)",
        "neutral-dark-lightest": "rgba(143, 144, 152, 1)",
        "support-success-dark": "rgba(41, 130, 103, 1)",
        "support-success-medium": "rgba(58, 192, 160, 1)",
        "support-success-light": "rgba(231, 244, 232, 1)",
        "support-warning-dark": "rgba(232, 99, 57, 1)",
        "support-warning-medium": "rgba(255, 179, 124, 1)",
        "support-warning-light": "rgba(255, 244, 228, 1)",
        "support-error-dark": "rgba(237, 50, 65, 1)",
        "support-error-medium": "rgba(255, 97, 109, 1)",
        "support-error-light": "rgba(255, 226, 229, 1)"
      },
    },
  },
  plugins: [],
} satisfies Config 