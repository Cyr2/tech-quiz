import { defineStore } from 'pinia';

export const useAuth = defineStore('auth', {
  state: () => ({
    id: null,
    email: null,
  }),
  actions: {
    initializeUser(id, email) {
      if (typeof window !== 'undefined') {
        const token = localStorage.getItem('token');
        
        if (token) {
          this.id = id;
          this.email = email;
        }
      }
    },
    insertToken(token) {
      if (typeof window !== 'undefined') {
        localStorage.setItem('token', token);
      }
    },
    insertUserId(id) {
      if (typeof window !== 'undefined') {
        localStorage.setItem('userId', id);
      }
    },
    removeToken() {
      if (typeof window !== 'undefined') {
        localStorage.removeItem('token');
        this.id = null;
        this.email = null;
      }
    },
    removeUserId() {
      if (typeof window !== 'undefined') {
        localStorage.removeItem('userId');
      }
    },
    getToken() {
      if (typeof window !== 'undefined') {
        return localStorage.getItem('token');
      }
    },
    getUserId() {
      if (typeof window !== 'undefined') {
        return this.id;
      }
    }
  },
});