import { useAuth } from "../stores/auth.js";

export default defineNuxtRouteMiddleware((to, from) => {
  
  let isAuthenticated = false; // TODO: Remplacer par la logique d'authentification
  const auth = useAuth()

  if(auth.getToken() !== null) {
    isAuthenticated = true
  }

  // Si l'utilisateur est sur la page de login ou d'inscription, on le laisse y accéder
  if (to.path === '/login' || to.path === '/register') {
    return
  }

  if (isAuthenticated) {
    return
  } else {
    // Si l'utilisateur n'est pas authentifié et n'est pas sur la landing page
    if (to.path !== '/login' && to.path !== '/register') {
      return navigateTo('/login')
    }
  }
}) 