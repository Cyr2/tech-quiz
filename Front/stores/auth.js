import { defineStore } from 'pinia';

export const useAuth = defineStore('auth', {
  state: () => ({
    id: null,
    email: null,
    role_id: null,
  }),
  actions: {
    initializeUser(id, email, role_id) {
      if (typeof window !== 'undefined') {
        const token = localStorage.getItem('token');
        if (token) {
          this.id = id;
          this.email = email;
          this.role_id = role_id;
        }
      }
    },
    insertToken(token) {
      if (typeof window !== 'undefined') {
        localStorage.setItem('token', token);
      }
    },
    removeToken() {
      if (typeof window !== 'undefined') {
        localStorage.removeItem('token');
        this.id = null;
        this.email = null;
        this.role_id = null;
      }
    },
    getToken() {
      if (typeof window !== 'undefined') {
        return localStorage.getItem('token');
      }
    },
    getRole() {
      return this.role_id;
    }
  },
});