import { useAuth } from "../stores/auth.js";

/* fonction pour fetch tout les utilisateurs */
export async function fetchUsers() {
    const token  = useAuth();

    const response = await fetch(`http://127.0.0.1:8000/api/users`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+token.getToken(),
        },
    });

    const data = await response.json();

    

    return data;

}